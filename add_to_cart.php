<?php

include 'cart.php';
include_once 'query.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function redir_to_item($isn,$err){
    header("Location: item.php?isn=" . $isn . "&error=" . $err);
}

    //$item = get_item_by_isn($_POST['isn']);
$qty = $_POST['quantity'];
if (chk_sufficient_quantity($_POST['isn'], $qty))
{
        add_to_cart($_POST['isn'],$qty);
	//In the future maybe add support for an item added signal
	redir_to_item($_POST['isn'],'0');
}else{
        //header("Location: http://cs.uky.edu/~jkbl225/cs405-store/")
    redir_to_item($_POST['isn'],'1');
}
