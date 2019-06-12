<?php
//including the Cart class
include_once("../classes/Cart.php");

$add = new Cart();
$result = $add->addProduct($_POST['id'], $_POST['quantity']);

if ($result) {
    header("Location:../index.php");
}
return true;
?>