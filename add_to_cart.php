<?php

include 'cart.php';
include_once 'query.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$isn = $_POST['isn'];
    //$item = get_item_by_isn($_POST['isn']);
$qty = $_POST['qty'];

function redir_to_item($err){
    global $isn;
    header("Location: item.php?isn=${isn}&err=${err}");
}

if (chk_sufficient_quantity($isn, $qty))
{
        add_to_cart($isn,$qty);
	//In the future maybe add support for an item added signal
	redir_to_item('0');
}else{
        //header("Location: http://cs.uky.edu/~jkbl225/cs405-store/")
    redir_to_item('1');
}
