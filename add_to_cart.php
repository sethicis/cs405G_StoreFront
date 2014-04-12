<?php

include 'cart.php';
include 'query.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function invalid_item_qty($isn){
    header("Location: item.php?isn=" . $isn . "&error=1");
}

function prepare_cart(){
    //$item = get_item_by_isn($_POST['isn']);
    $qty = $_POST['quantity'];
    if (chk_sufficient_quantity($_POST['isn'], $qty)){
        add_to_cart($_POST['isn'],$qty);
    }else{
        //header("Location: http://cs.uky.edu/~jkbl225/cs405-store/")
        invalid_item_qty($_POST['isn']);
    }
}