<?php

class OrderDetailController
{
    private $orderModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->orderModel = new OrderModel($this->db);
        if (!Auth::isAdmin()) {
            header('Location: /doan/account/login');
        }
    }
    public function details()
    {
        // Lấy danh sách đơn hàng
        $orders = $this->orderModel->getOrders();

        // Tạo một mảng mới để lưu trữ các chi tiết đơn hàng
        $ordersWithDetails = [];

        // Lặp qua từng đơn hàng để lấy chi tiết đơn hàng
        foreach ($orders as $order) {
            $orderDetails = $this->orderModel->getOrderDetails($order['id']);
            $order['details'] = $orderDetails;
            // Thêm đơn hàng với chi tiết vào mảng mới
            $ordersWithDetails[] = $order;
        }

        // Bao gồm view và chuyển đến view các chi tiết đơn hàng
        include_once 'app/views/detail/index.php';
    }
}
