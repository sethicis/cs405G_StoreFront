<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once "query.php";

foreach ($_POST as $isn => $qty){
    if ($isn != 'updateQty'){
	$qty = intval($qty);
	$item = get_item_by_isn($isn);
	if ($item['quantity'] != $qty){
		update_item($isn,$qty);
	}
    }
}

header("Location: items.php?edit=no");
exit;