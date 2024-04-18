<?php
include_once 'app/views/share/header.php';
?>

<!-- Display the products in the cart -->
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="col-md-1">Id</th>
            <th class="col-md-3">Name</th>
            <th class="col-md-2">Price</th>
            <th class="col-md-2">Quantity</th>
            <th class="col-md-2">Total</th>
            <th class="col-md-2">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($_SESSION['cart'] as $productId => $cartItem) : ?>
        <tr id="product_<?= $productId ?>">
            <td><?= $cartItem['product']->id ?></td>
            <td><?= $cartItem['product']->name ?></td>
            <td><?= $cartItem['product']->price ?></td>
            <td>
                <input type="number" class="form-control" id="quantity_<?= $productId ?>"
                    value="<?= $cartItem['quantity'] ?>" min="0">
            </td>
            <td><?= $cartItem['product']->price * $cartItem['quantity'] ?></td>
            <td>
                <button class="btn btn-sm btn-success" onclick="updateQuantity(<?= $productId ?>)">Update</button>
                <button class="btn btn-sm btn-primary"
                    onclick="confirmAndRemoveFromCart(<?= $productId ?>)">deleteProduct</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Add a "Checkout" button -->
<div class="text-right">
    <a href="/doan/Shopping/checkout" class="btn btn-primary">Checkout</a>
</div>

<script>
function confirmAndRemoveFromCart(productId) {
    // Hiển thị hộp thoại xác nhận
    var confirmed = confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?');
    if (!confirmed) {
        return; // Hủy xóa nếu người dùng không xác nhận
    }

    // Gọi hàm removeFromCart để xóa sản phẩm
    removeFromCart(productId);
}

function removeFromCart(productId) {
    // Gửi yêu cầu AJAX để xóa sản phẩm khỏi giỏ hàng
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/doan/Shopping/RemoveFromCartAction/' + productId, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status == 200) {
            // Xóa sản phẩm khỏi giao diện người dùng
            var productRow = document.getElementById('product_' + productId);
            productRow.parentNode.removeChild(productRow);
        } else {
            console.log('Error: ' + xhr.status);
        }
    };
    xhr.send();
}

function calculateTotalAmount() {
    var total = 0;
    // Iterate through each product row to calculate total amount
    var productRows = document.querySelectorAll('tbody tr');
    productRows.forEach(function(row) {
        var price = parseFloat(row.querySelector('td:nth-child(3)').innerHTML);
        var quantity = parseFloat(row.querySelector('td:nth-child(4) input').value);
        total += price * quantity;
    });
    return total;
}

function updateQuantity(productId) {
    var quantityInput = document.getElementById('quantity_' + productId);
    var newQuantity = quantityInput.value;

    // Send AJAX request to update quantity
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/doan/Shopping/UpdateQuantityAction/' + productId, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status == 200) {
            // Update quantity on the user interface
            var productRow = document.getElementById('product_' + productId);

            // Calculate new total price
            var price = parseFloat(productRow.querySelector('td:nth-child(3)').textContent);
            var totalPrice = price * newQuantity;

            // Update value of the quantity input
            quantityInput.value = newQuantity;

            // Update total price
            productRow.querySelector('td:nth-child(5)').textContent = totalPrice;
            if (newQuantity == 0) {
                var confirmed = confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?');
                if (confirmed) {
                    removeFromCart(productId);
                } else {
                    // Khôi phục số lượng cũ
                    quantityInput.value = 1;
                    productRow.querySelector('td:nth-child(5)').textContent = price;
                }
            }
        } else {
            console.log('Error: ' + xhr.status);
        }
    };
    xhr.send('quantity=' + newQuantity);
}
</script>

<?php
include_once 'app/views/share/footer.php';
?>