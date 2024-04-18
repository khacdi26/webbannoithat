<?php

class ShoppingController
{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
        if (!Auth::isUser()) {
            header('Location: /doan/account/login');
        }
    }

    public function listShoppingCart()
    {


        $stmt = $this->productModel->readAll();

        include_once 'app/views/shoppingCart/index.php';
    }
    public function listShoppingDonHang()
    {

        $stmt = $this->productModel->readAll();

        include_once 'app/views/detail/index.php';
    }

    // Hành động thêm sản phẩm vào giỏ hàng
    public function addAction($productId)
    {

        // Giả sử đã có hàm getProductById để lấy thông tin sản phẩm từ cơ sở dữ liệu
        $product = $this->productModel->getProductById($productId);

        if (!$product) {
            // Redirect hoặc hiển thị thông báo lỗi nếu sản phẩm không tồn tại
            return;
        }

        // Kiểm tra xem giỏ hàng đã được khởi tạo chưa
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        if (isset($_SESSION['cart'][$productId])) {
            // Nếu có, tăng số lượng sản phẩm lên 1
            $_SESSION['cart'][$productId]['quantity']++;
        } else {
            // Nếu chưa, thêm sản phẩm vào giỏ hàng với số lượng là 1
            $_SESSION['cart'][$productId] = [
                'product' => $product,
                'quantity' => 1
            ];
        }
        echo "<script>
        alert('Thêm sản phẩm thành công !');
      </script>";
    }

    // Hành động tăng số lượng sản phẩm trong giỏ hàng
    public function increaseQuantityAction($productId)
    {
        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if (isset($_SESSION['cart'][$productId])) {
            // Tăng số lượng sản phẩm lên 1
            $_SESSION['cart'][$productId]['quantity']++;
        }

        // Trở về trang giỏ hàng
    }

    // Hành động giảm số lượng sản phẩm trong giỏ hàng
    public function decreaseQuantityAction($productId)
    {
        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if (isset($_SESSION['cart'][$productId])) {
            // Giảm số lượng sản phẩm đi 1
            $_SESSION['cart'][$productId]['quantity']--;

            // Kiểm tra xem số lượng sản phẩm có nhỏ hơn 1 không
            if ($_SESSION['cart'][$productId]['quantity'] < 1) {
                // Nếu nhỏ hơn 1, loại bỏ sản phẩm khỏi giỏ hàng
                unset($_SESSION['cart'][$productId]);
            }
        }

        // Trở về trang giỏ hàng
    }

    // Hành động cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateQuantityAction($productId)
    {
        if (isset($_SESSION['cart'][$productId])) {
            // Lấy số lượng mới từ yêu cầu AJAX
            $newQuantity = $_POST['quantity'];
            // Cập nhật số lượng sản phẩm trong giỏ hàng
            $_SESSION['cart'][$productId]['quantity'] = $newQuantity;
            // Trả về kết quả là số lượng mới
            echo $newQuantity;
        } else {
            // Trả về lỗi nếu sản phẩm không tồn tại trong giỏ hàng
            echo 'Error: Product not found in cart.';
        }
    }

    public function checkout()
    {

        // Display the checkout form
        include_once 'app/views/CheckOut/index.php';
    }

    public function removeFromCartAction($productId)
    {

        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if (isset($_SESSION['cart'][$productId])) {
            // Xóa sản phẩm khỏi session
            unset($_SESSION['cart'][$productId]);
            // Trả về kết quả thành công
            http_response_code(200);
            echo "Sản phẩm đã được xóa khỏi giỏ hàng.";
        } else {
            // Trả về lỗi nếu sản phẩm không tồn tại trong giỏ hàng
            echo 'Error: Product not found in cart.';
        }
    }

    public function saveOrder()
    {
        try {
            // Lấy dữ liệu từ biểu mẫu HTML
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $note = $_POST['note'];
            $paymentMethod = $_POST['payment_method'];

            // Thực hiện lưu thông tin đơn hàng vào bảng `order`
            $stmt = $this->db->prepare("INSERT INTO `orders` (fullname, phone, email, address, note, payment_method) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$fullname, $phone, $email, $address, $note, $paymentMethod]);

            // Lấy ID của đơn hàng vừa được chèn vào
            $orderId = $this->db->lastInsertId();

            // Thực hiện lưu thông tin chi tiết đơn hàng vào bảng `order_detail`
            $cart = $_SESSION['cart']; // Giỏ hàng
            foreach ($cart as $productId => $cartItem) {
                $productName = $cartItem['product']->name;
                $productId = $cartItem['product']->id;
                $quantity = $cartItem['quantity'];
                $price = $cartItem['product']->price;
                $totalPrice = $price * $quantity;

                $stmt = $this->db->prepare("INSERT INTO order_detail (order_id, product_name, product_id, quantity, price, total_price) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$orderId, $productName, $productId, $quantity, $price, $totalPrice]);
            }

            // Xóa giỏ hàng sau khi đã tạo đơn hàng thành công
            unset($_SESSION['cart']);

            echo "Hóa đơn đã được tạo thành công!";
            header('Location: /doan/');
            return $orderId;
        } catch (PDOException $e) {
            // Xử lý lỗi của cơ sở dữ liệu
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
}
