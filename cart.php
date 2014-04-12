<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
const CART_NAME = 'cart';

session_start();

function cartCount(){
    $cart = get_cart_items();
    return strval(count($cart));
}

function add_to_cart($isn,$qty=1){
    $cart = get_cart_items();
    
    if (array_key_exists($isn, $cart)){
        $cart[$isn] += $qty;
    }else{
        $cart += array($isn => $qty);
    }
    
    save_cart($cart);
}

//Get the quantity of items by a certain isn
//currently in the cart.
function get_item_from_cart($isn){
    $cart = get_cart_items();
    if (array_key_exists($isn, $cart)){
        return $cart[$isn];
    }
    return 0;
}

//Used if a user decides to add more items to their cart or
//remove items from their cart
function update_cart($isn, $qty=1){
    $cart = get_cart_items();
    if (array_key_exists($isn, $cart)){
        if ($cart[$isn] > 0){
            if ($qty < 1){
                unset($cart[$isn]);
            }else{
                $cart[$isn] = $qty;
            }
        }else{
            unset($cart[$isn]);
        }
    }
    
    save_cart($cart);
}

function get_cart_items(){
    if (cartExists()){
        return unserialize($_SESSION[CART_NAME]);
    }else{
        return array();
    }
}

function cartExists(){
    return isset($_SESSION[CART_NAME]);
}

function save_cart($cart){
    $_SESSION[CART_NAME] = serialize($cart);
}

function remove_cart_items(){
    if(cartExists()){
        remove_cart();
    }
}

function remove_cart(){
    unset($_SESSION[CART_NAME]);
}