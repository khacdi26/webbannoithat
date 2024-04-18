<?php
include_once 'app/views/share/header.php';
?>
<style>
    .order-details {
        display: none;
    }
</style>

<body>

    <div class="container">
        <h2>Order Details</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Note</th>
                    <th>Payment Method</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ordersWithDetails as $order) : ?>
                    <tr>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo $order['fullname']; ?></td>
                        <td><?php echo $order['phone']; ?></td>
                        <td><?php echo $order['email']; ?></td>
                        <td><?php echo $order['address']; ?></td>
                        <td><?php echo $order['note']; ?></td>
                        <td><?php echo $order['payment_method']; ?></td>
                        <td><?php echo $order['created_at']; ?></td>
                        <td><button class="btn btn-primary view">View</button></td>
                    </tr>

                    <?php if (!empty($order['details'])) : ?>
                        <tr class="order-details">
                            <td colspan="9">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($order['details'] as $orderDetail) : ?>
                                            <tr>
                                                <td><?php echo $orderDetail['product_name']; ?></td>
                                                <td><?php echo $orderDetail['quantity']; ?></td>
                                                <td><?php echo $orderDetail['price']; ?></td>
                                                <td><?php echo $orderDetail['total_price']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    <?php endif; ?>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            // Xử lý sự kiện khi người dùng nhấp vào nút "view"
            $('.view').click(function() {
                // Tìm phần tử cha (thẻ <tr>) chứa nút "view"
                var $orderRow = $(this).closest('tr');

                // Tìm phần tử con (thẻ <tr>) chứa chi tiết đơn hàng
                var $orderDetailsRow = $orderRow.next('.order-details');

                // Kiểm tra xem chi tiết đơn hàng đang ở trạng thái ẩn hay hiển thị
                if ($orderDetailsRow.is(':visible')) {
                    // Ẩn chi tiết đơn hàng
                    $orderDetailsRow.hide();

                    // Thay đổi văn bản của nút "view" thành "view"
                    $(this).text('View');
                } else {
                    // Ẩn tất cả các chi tiết đơn hàng khác
                    $('.order-details').hide();

                    // Đặt văn bản của tất cả các nút "view" khác thành "view"
                    $('.view').text('View');

                    // Hiển thị chi tiết đơn hàng
                    $orderDetailsRow.show();

                    // Thay đổi văn bản của nút "view" thành "hide"
                    $(this).text('Hide');
                }
            });
        });
    </script>
</body>

<?php
include_once 'app/views/share/footer.php';
?>