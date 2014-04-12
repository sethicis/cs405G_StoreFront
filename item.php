<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function order_item($item){
    echo "<form action='add_to_cart.php' method='POST'>"
    . "<tr><td colspan='2'><input type='text' name='quantity' size='10'>"
            . "<button type='submit' name='isn' value='" . $item['isn'] . "'>Add to Cart</button>"
            . "</td></tr></form>";
}

function displayItemDetails($item){
    $item = mysqli_fetch_array($item);
    echo "<table>"
        . "<tr>"
            . "<th colspan='2'><h3>" . $item['name'] . "</h3></th>"
            . "</tr>"
            . "<tr>"
            . "<td>Price:</td>"; if ($item['promotion'] > 0) {
                                        promoValue($item);
                                        echo "</tr>"
                                        . "<tr><td>Sale:</td><td><font style='color:green'>" 
                                                . strval(($item['promotion']*100)) . "% off!</font></td></tr>";}
                                 else{
                                     echo "<td>" . strval($item['price']) . "</td></tr>";
                                 }
            echo "<tr><td>Number in Stock:</td><td>" . strval($item['quantity']) . "</td></tr>";
            order_item($item);
            echo "<tr><td>Description:</td><td>" . $item['description'] . "</td></tr>";
            echo "<tr><td>ISN:</td><td>" . $item['isn'] . "</td></tr>";
            echo "</table>";
}