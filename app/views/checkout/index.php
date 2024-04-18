<?php
include_once 'app/views/share/header.php';
?>

<body>
    <div class="container">
        <h1>Checkout Information</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">Id</th>
                    <th class="col-md-3">Name</th>
                    <th class="col-md-2">Price</th>
                    <th class="col-md-2">Quantity</th>
                    <th class="col-md-2">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $productId => $cartItem) : ?>
                    <tr id="product_<?= $productId ?>">
                        <td><?= $cartItem['product']->id ?></td>
                        <td><?= $cartItem['product']->name ?></td>
                        <td><?= $cartItem['product']->price ?></td>
                        <td>
                            <input type="text" class="form-control" id="quantity_<?= $productId ?>" value="<?= $cartItem['quantity'] ?>" readonly>
                        </td>
                        <td><?= $cartItem['product']->price * $cartItem['quantity'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <form method="post" action="/doan/ShopPing/saveOrder">
            <div class="form-group">
                <label for="fullname">Full Name:</label>
                <input type="text" class="form-control" id="fullname" name="fullname" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="address">Shipping Address:</label>
                <textarea class="form-control" id="address" name="address" required></textarea>
            </div>

            <div class="form-group">
                <label for="note">Order Note:</label>
                <textarea class="form-control" id="note" name="note"></textarea>
            </div>

            <div class="form-group">
                <label>Payment Method:</label><br>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="bank_transfer" name="payment_method" value="bank_transfer">
                    <label class="form-check-label" for="bank_transfer">Bank Transfer</label>
                </div>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="agree" name="agree" required>
                    <label class="form-check-label" for="agree">I have read and agree to the store's policy.</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Confirm Order</button>
        </form>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<?php
include_once 'app/views/share/footer.php';
?>