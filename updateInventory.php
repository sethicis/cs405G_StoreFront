<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once "query.php";

$items = get_all_items();

foreach ($_POST as $isn => $qty){
    if ($isn != 'updateQty'){
        while ($row = mysqli_fetch_array($items)){
            if ($row['isn'] === $isn){
                if ($row['quantity'] != $qty){
                    update_item($isn, $qty);
                }
            }
        }
    }
}

header("Location: items.php?edit=no");
exit;