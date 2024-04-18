<?php
class DefaultController
{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }
    public function Index()
    {


        $stmt = $this->productModel->readAll();

        include_once 'app/views/product_list.php';
    }
}
