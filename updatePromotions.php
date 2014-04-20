<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'query.php';

foreach ($_POST as $isn => $promo) {
    if ($isn != 'update' and $isn != 'stuff'){
        set_item_promotion($isn, $promo);
    }
}

header("Location: promotions.php?edit=no");
exit;