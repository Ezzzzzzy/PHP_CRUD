<?php
include_once("classes/Crud.php");

class Product
{
    public function getProducts()
    {
        $crud = new Crud();
        $queryProduct = "SELECT * FROM products ORDER BY id ASC";
        $resultProduct = $crud->getData($queryProduct);
        return $resultProduct;
    }
}