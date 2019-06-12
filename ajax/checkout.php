<?php
include_once("../classes/Cart.php");

$cart = new Cart();
$total = $cart->getTotal();
$user = $cart->getUser();

if(empty($_POST['inlineRadioOptions']))
{   
    echo '<script language="javascript">';
    echo "
        if (window.confirm('Please pick a Shipping method?'))
        {
            window.location.replace('../index.php')
        }
        else
        {
            window.location.replace('../index.php')
        }   
    ";
    echo '</script>';
    return 0;

} else if($total>$user['credits']) {
    echo '<script language="javascript">';
    echo "
        if (window.confirm('You dont have enough credits to make this puchase?'))
        {
            window.location.replace('../index.php')
        }
        else
        {
            window.location.replace('../index.php')
        }   
    ";
    echo '</script>';
    return 0;
}

$cart->checkout($_POST['inlineRadioOptions']);
    echo '<script language="javascript">';
    echo "window.location.replace('../index.php')";
    echo '</script>';


