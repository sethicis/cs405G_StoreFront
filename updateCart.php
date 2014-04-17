<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'cart.php';

$cartItems = get_cart_items();

foreach ($cartItems as $isn => $qty){
    if (intval($_POST[$isn]) != $qty){
        update_cart($isn, $_POST[$isn]);
    }
}

header("Location: viewCart.php");
exit;