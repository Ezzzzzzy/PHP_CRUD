<?php
include_once "../classes/Rate.php";

$rate = new Rate();

if($rate->addRate($_GET['product_id'], $_GET['rate']+1))
{
    header("Location:../index.php");
}
