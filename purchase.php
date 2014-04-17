<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'cart.php';
include_once 'query.php';
include_once 'users.php';

$cartItems = get_cart_items();

if (logged_in_user() == NULL){
    header("Location: login.php?type=customer&err=no");
    exit;
}

foreach ($cartItems as $isn => $qty){
    if (get_item_quantity($isn) < $qty){
        $goto = 'viewCart.php?err=' . $isn;
        header("Location: ${goto}");
        exit;
    }
}

purchase_items($cartItems);

header("Location: orders.php?type=customer");
exit;