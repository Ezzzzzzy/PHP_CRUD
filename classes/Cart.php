<?php
include_once "Crud.php";
class Cart 
{

    private $shipping;
    public function getCart()
    {
        $crud = new Crud();
        
        $queryCart = "SELECT user_products.id, products.id as product_id, products.name 
        as product_name, round(user_products.quantity * products.price,2) as product_total, products.price, user_products.quantity 
        FROM `products` JOIN user_products on products.id = user_products.product_id";

        $resultCart = $crud->getData($queryCart);
        return $resultCart;
    }

    public function addProduct($product_id, $quantity)
    {
        $crud = new Crud();
        $queryCart = "SELECT user_products.id, products.id as product_id, products.name 
        as product_name, products.price, user_products.quantity 
        FROM `products` JOIN user_products on products.id = user_products.product_id";
        $result = $crud->getData($queryCart);

        foreach($result as $val)
        {
            if($val['product_id'] == $product_id){
                if($this->duplicateItems($val['id'], $quantity))
                {
                    return true;
                }
                return false;
            }    
        }

        if($this->insertProduct($product_id, $quantity))
        {
            return true;
        }
        return false;
    }

    public function getUser()
    {
        $crud = new Crud();
        $query = "Select * from users where id = 1";
        $result = $crud->getData($query);
        return $result[0];
    }

    
    public function removeProduct($id)
    {
        $crud = new Crud();
        $result = $crud->delete($id, 'user_products');

        if($result)
        {
            return true;
        }
        return false;
    }

    private function insertProduct($product_id, $quantity)
    {
        $crud = new Crud();
        $result = $crud->execute("INSERT INTO user_products(product_id,user_id,quantity) VALUES($product_id, 1, $quantity);");

        if($result)
        {
            return true;
        }
        return false;
    }

    private function duplicateItems($product_id, $quantity)
    {
        $crud = new Crud();

        $query = "UPDATE `user_products` SET `quantity` = `quantity` + $quantity WHERE `user_products`.`id` = $product_id;";
        if($crud->execute($query))
        {
            return true;
        }
        return false;
    }

    public function getTotal()
    {
        $crud = new Crud();
        $query = "SELECT round(SUM(products.price * user_products.quantity),2) as total FROM products
        JOIN user_products ON products.id = user_products.product_id";

        $result = $crud->getData($query); 
        return $result[0]['total'];
    }

    public function  checkout($shipping){
        $crud = new Crud();
        $total = $this->getTotal();
        if($shipping == "ups"){
            $total += 5;
        }
        $query = "UPDATE `users` SET `credits` = `credits` - $total WHERE users.id = 1";
        $crud->execute($query);
        $query = "TRUNCATE TABLE `user_products`";
        $crud->execute($query);
        return true;
    }

    
}