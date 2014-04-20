<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'query.php';

$orderID = $_POST['order'];

$order = get_ordered_items($orderID);

$goto = "";
$count = 0;

while ($row = mysqli_fetch_array($order)){
    if ($row['quantity'] > get_item_quantity($row['isn'])){
        $goto = $goto . "&err" . strval($count) . "=" . $row['isn'];
        $count++;
    }
}

if ($count > 0){
    $goto = "order_details.php?order=". $orderID . "&errcount=" . strval($count) . $goto;
    header("Location: ${goto}");
    exit;
}else{
    while ($row = mysqli_fetch_array($order)){
        lower_item_qty($row['isn'], $row['quantity']);
    }
    set_order_shipped($orderID);
    header("Location: order_details.php?order=${orderID}&errcount=0");
    exit;
}