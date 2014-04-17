<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'header.php';
include 'query.php';
include 'item-ops.php';

$isn = $_GET['isn'];
$item = get_item_by_isn($isn);

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
function itemName(){
    echo $item['name'];
}

function itemPrice(){
    if ($item['promotion'] > 0){
        promoValue($item);
    }else{
        echo $item['price'];
    }
}

function itemDiscount(){
    if ($item['promotion'] > 0){
        echo "<font style='color:green'>" 
              . strval(number_format($item['promotion']*100,2))
              . "% off!</font>";
    }else{
        echo "Not on Sale";
    }
}

function itemQty(){
    echo $item['quantity'];
}

function itemDescription(){
    echo $item['description'];
}

function itemISN(){
    echo $item['isn'];
}
?>
<?php
    head('Item Details');
?>
    <body>
        <?php include 'toolbar.php'; ?>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-6 text-center'>
                    <table class='table table-condensed'>
                        <tr>
                            <th>Name</th><td><?php itemName(); ?></td>
                        </tr>
                        <tr>
                            <th>ISN</th><td><?php itemISN(); ?></td>
                        </tr>
                        <tr>
                        <th>Price</th><td><?php itemPrice(); ?></td>
                        </tr>
                        <tr>
                            <th>Discount</th><td><?php itemDiscount(); ?></td>
                        </tr>
                        <tr>
                            <th>quantity</th><td><?php itemQty(); ?></td>
                        </tr>
                        <tr>
                            <th>Description</th><td><?php itemDescription(); ?></td>
                        </tr>
                    </table>
                </div>
                <div class='col-lg-6 text-center'>
                    <form class='form-horizontal' action='add_to_cart.php' method="POST">
                        <fieldset>
                            <legend>Order Item</legend>
                            <div class='control-group'>
                                <label class='control-label'>Order Quantity</label>
                                <div class='controls'>
                                    <input type='text' size='3' name='qty' id='orderQty'>
                                </div>
                            </div>
                            <div class='control-group'>
                                <div class='controls'>
                                    <button type='submit' class='btn' name='isn' value='<?php itemISN() ?>'>Add to Cart</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>