<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function promoValue($item){
   //return $price - ($price * $promo);
   $price = $item['price'] - ($item['price'] * $item['promotion']);
   echo "<del style='color:red'>$" . number_format((float)$item['price'],2) . 
           "</del>&nbsp $" . number_format((float)$price,2);
}