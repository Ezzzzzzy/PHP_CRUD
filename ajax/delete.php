<?php
include_once("../classes/Cart.php");
 
$cart = new Cart();
$result = $cart->removeProduct($_GET['id']);
 
if ($result) {
    header("Location:../index.php");
}
?>