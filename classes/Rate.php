<?php
include_once "Crud.php";

class Rate
{
    public function addRate($product_id, $rate)
    {
        $crud = new Crud();

        $queryRate = "INSERT INTO product_rates(product_id, rate) VALUES($product_id, $rate);";
        $result = $crud->execute($queryRate);

        if($result)
        {
            session_start();
            $_SESSION["product".$product_id] = true;
            return true;
        }
        return false;
    }

    public function getRate($product_id)
    {
        $crud = new Crud();

        $query = "SELECT (
            ((
                SELECT COUNT(*)
                FROM   product_rates WHERE rate = 1 AND product_id = $product_id
            )*1) + 
            ((
                SELECT COUNT(*)
                FROM   product_rates WHERE rate = 2 AND product_id = $product_id
            ) * 2) +
            ((
                SELECT COUNT(*)
                FROM  product_rates WHERE rate = 3 AND product_id = $product_id
            ) * 3) +
            ((
                SELECT COUNT(*)
                FROM  product_rates WHERE rate = 4 AND product_id = $product_id
            ) *4)  +
            ((
                SELECT COUNT(*)
                FROM  product_rates WHERE rate = 5 AND product_id = $product_id
            )*5 )
            ) / 
            (
                (
                    SELECT COUNT(*)
                    FROM   product_rates WHERE rate = 1 AND product_id = $product_id
                ) + 
                (
                    SELECT COUNT(*)
                    FROM   product_rates WHERE rate = 2 AND product_id = $product_id
                ) +
                (
                    SELECT COUNT(*)
                    FROM  product_rates WHERE rate = 3 AND product_id = $product_id
                ) +
                (
                    SELECT COUNT(*)
                    FROM  product_rates WHERE rate = 4 AND product_id = $product_id
                )  +
                (
                    SELECT COUNT(*)
                    FROM  product_rates WHERE rate = 5 AND product_id = $product_id
                )
            ) as rating";
        $result = $crud->getData($query);

        if($result)
        {   
            return round($result[0]['rating'],2);
        }
    }

}