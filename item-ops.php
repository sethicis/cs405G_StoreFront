<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function promoValue($item){
   //return $price - ($price * $promo);
   $price = $item['price'] - ($item['price'] * $item['promotion']);
   echo "<td><del style='color:red'>$" . strval($item['price']) . 
           "</del>&nbsp $" . $price . "</td>"; /*. "<td><font style='color:green'>" . 
           strval(($item['promotion']*100)) . "% off!</font></td>";*/
   return;
}