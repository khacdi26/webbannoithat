<?php include_once 'app/views/share/header.php'; ?>

<style>
    .image-container {
        width: 100%;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 200px;
        /* Chiều cao tối thiểu của card */
        max-height: 200px;
        /* Chiều cao tối đa của card */
    }

    .card-title {
        font-size: 16px;
        font-weight: bold;
        line-height: 1.25;
        /* Chiều cao của 1 dòng */
    }

    .card-text {
        font-size: 14px;
        line-height: 1.25;
        /* Chiều cao của 1 dòng */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-price {
        font-size: 14px;
        font-weight: bold;
        color: #f00;
    }
</style>

<body>
    <h1>Danh sách sản phẩm</h1>
    <div class="container">
        <div class="row">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="image-container">
                            <?php if (empty($row['image']) || !file_exists($row['image'])) : ?>
                                <img src="/doan/default-image.jpg" alt="No Image" class="card-img-top">
                            <?php else : ?>
                                <img src="/doan/<?php echo $row['image']; ?>" alt="" class="card-img-top">
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                            <p class="card-price"><?php echo $row['price']; ?></p>
                            <button class="btn btn-primary" onclick="addToCart(<?= $row['id'] ?>)">Add to Cart</button>
                            <!-- Add to Cart button -->
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>

</html>
<script>
    function addToCart(productId) {
        // Thực hiện hành động addAction tại đây
        if (<?php echo !isset($_SESSION['username']) || !isset($_SESSION['role']) ? 'true' : 'false'; ?>) {
            // Chuyển hướng đến trang đăng nhập
            window.location.href = '/doan/Shopping/login'; // Đường dẫn đến trang đăng nhập
            return; // Dừng thực hiện hàm
        }

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
</script>
<?php include_once 'app/views/share/footer.php'; ?>