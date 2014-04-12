<?php
    include 'header.php';
    include 'operations.php';
    include 'items.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function order_item($isn,$err){
    echo "<form action='add_to_cart.php' method='POST'>";
    if ($err == '1'){
        echo "<tr><td colspan='2'><input type='text' name='quantity' size='6'"
        . "style='background-color: #df0078;'>"
                . "<font style='color:red;'>Insufficient Inventory</font>";
    }else{
        echo "<tr><td colspan='2'><input type='text' name='quantity' size='10'>";
    }
    echo "<button type='submit' name='isn' value='" . $isn . "'>Add to Cart</button>"
        . "</td></tr></form>";
}

function displayItemDetails(){
    $item = get_item_by_isn($_GET['isn']);
    echo "<table>"
        . "<tr>"
            . "<th colspan='2'><h3>" . $item['name'] . "</h3></th>"
        . "</tr>"
        . "<tr>"
            . "<td>Price:</td>"; 
    if ($item['promotion'] > 0) {
            promoValue($item);
    echo "</tr>"
        . "<tr><td>Sale:</td><td><font style='color:green'>" 
              . strval(number_format($item['promotion']*100,2)) . "% off!</font></td></tr>";}
    else{
         echo "<td>" . strval($item['price']) . "</td></tr>";
        }
    echo "<tr><td>Number in Stock:</td><td>" . strval($item['quantity']) . "</td></tr>";
       order_item($_GET['isn'],$_GET['error']);
    echo "<tr><td>Description:</td><td>" . $item['description'] . "</td></tr>";
    echo "<tr><td>ISN:</td><td>" . $item['isn'] . "</td></tr>";
    echo "</table>";
}
?>
<?php
    head('Item Details');
?>
<body>
    <?php
        navigation();
        displayItemDetails();
    ?>
</body>