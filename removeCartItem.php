<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'cart.php';

$isn = $_GET['isn'];

remove_item_from_cart($isn);

header("Location: viewCart.php");
exit;