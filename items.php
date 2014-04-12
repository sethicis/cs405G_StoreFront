<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function promoValue($item){
   $price = $item['price'] - ($item['price'] * $item['promotion']);
   echo "<td><del style='color:red'>$" . strval($item['price']) . 
           "</del>&nbsp $" . $price . "</td>"; /*. "<td><font style='color:green'>" . 
           strval(($item['promotion']*100)) . "% off!</font></td>";*/
   return;
}

function displayItems($items){
    echo "<table>"
    . "<tr>"
      . "<th>Name</th>" . "<th>Price</th>" . "<th>Promotion</th>" . "<th>ISN</th>"
    . "</tr>";
    while ($item = mysqli_fetch_array($items)){
        echo "<tr>"
        . "<td>" . $item['name'] . "</td>";
        if (($item['promotion']) > 0){
            promoValue($item);
            //$price = $item['price'] - ($item['price'] * $item['promotion']);
            //echo "<td><del style='color:red'>$" . strval($item['price']) . "</del>&nbsp $" . $price . "</td>" . "<td><font style='color:green'>" . strval(($item['promotion']*100)) . "% off!</font></td>";
            echo "<td><font style='color:green'>" . strval(($item['promotion']*100)) . "% off!</font></td>";
        }
        else{
            echo "<td>$" . strval($item['price']) . "</td>". "<td></td>"; //No promotion
        }
        echo "<td>" . $item['isn'] . "</td>"
             . "</tr>";
    }
    echo "</table>";
}