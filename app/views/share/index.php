<?php
include_once 'app/views/share/header.php';
?>

<div class="row">

    <a href="/doan/product/add" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-flag"></i>
        </span>
        <span class="text">Add Product</span>
    </a>

    <div class="col-sm-12">
        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Action (Edit/Delete)</th>
                    <!-- <th>Add to Cart</th> -->
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <th><?= $row['id'] ?></th>
                        <th><?= $row['name'] ?></th>
                        <th><?= $row['description'] ?></th>
                        <th>

                            <?php
                            if (empty($row['image']) || !file_exists($row['image'])) {
                                echo "No Image!";
                            } else {
                                echo "<img src='/doan/" . $row['image'] . "' alt='' />";
                            }
                            ?>

                        </th>
                        <th><?= $row['price'] ?></th>
                        <th>
                            <a href="/doan/product/edit/<?= $row['id'] ?>">
                                Edit
                            </a>
                            |
                            <a class="text-danger" href="" onclick="deleteProduct(<?= $row['id'] ?>)"> Delete</a>
                        </th>
                        <!-- <th>
                        
                        <button class="btn btn-success btn-sm" onclick="addToCart(<?= $row['id'] ?>)">Add to
                            Cart</button>
                    </th> -->
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>


<script>
    function addToCart(productId) {
        // Thực hiện hành động addAction tại đây
        // ...

        // Ví dụ: Gửi yêu cầu AJAX để thêm sản phẩm vào giỏ hàng
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/doan/Shopping/addAction/' + productId, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status == 200) {
                // Xử lý kết quả thành công
                alert('Thêm sản phẩm vào giỏ hàng thành công!');
            } else {
                // Xử lý lỗi
                alert('Đã xảy ra lỗi khi thêm vào giỏ hàng!');
            }
        };
        xhr.send();
    }

    function deleteProduct(productId) {
        if (confirm("Are you sure you want to remove this product from the cart?")) {
            var xhr = new XMLHttpRequest();
            xhr.open('DELETE', '/doan/product/delete/' + productId, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status == 200) {
                    // Xử lý kết quả thành công
                    alert('Product removed from the cart successfully!');
                } else {
                    // Xử lý lỗi
                    alert('An error occurred while removing the product from the cart!');
                }
            };
            xhr.send();
        }
    }
</script>
<?php

include_once 'app/views/share/footer.php';

?>