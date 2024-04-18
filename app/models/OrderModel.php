<?php
class OrderModel
{
    private $conn;
    private $table_name = "orders";
    private $order_detail_table = "order_detail";

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getOrders()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOrderDetails($orderId)
    {
        $query = "SELECT * FROM " . $this->order_detail_table . " WHERE order_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$orderId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
