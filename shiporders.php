<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'query.php';

$orderID = $_POST['order'];

$order = get_ordered_items($orderID);
//if ($order === null) {echo "Null returned";}
$goto = "";
$count = 0;

while ($row = mysqli_fetch_array($order)){
    if ($row['oqty'] > $row['iqty']){
        $goto = $goto . "&err" . strval($count) . "=" . $row['isn'];
        $count++;
    }
}

(mysqli_data_seek($order, 0));

if ($count > 0){
    $goto = "order_details.php?order=". $orderID . "&errcount=" . strval($count) . $goto;
    header("Location: ${goto}");
    exit;
}else{
    while ($row = mysqli_fetch_array($order)){
        lower_item_qty($row['isn'], $row['oqty']);
    }
    set_order_shipped($orderID);
    header("Location: order_details.php?order=${orderID}&errcount=0");
    exit;
}