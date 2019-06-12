<?php
include_once("../classes/Cart.php");

$cart = new Cart();
$total = $cart->getTotal();

if($_POST['shipping'] == "ups" ){
    echo $total+5;
} else {
    echo $total;
}