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

function itemName(){
    global $item;
    echo $item['name'];
}

function itemPrice(){
    global $item;
    if ($item['promotion'] > 0){
        promoValue($item);
    }else{
        echo "$" . $item['price'];
    }
}

function itemDiscount(){
    global $item;
    if ($item['promotion'] > 0){
        echo "<font style='color:green'>" 
              . strval(number_format($item['promotion']*100,2))
              . "% off!</font>";
    }else{
        echo "Not on Sale";
    }
}

function itemQty(){
    global $item;
    echo $item['quantity'];
}

function itemDescription(){
    global $item;
    echo $item['description'];
}

function itemISN(){
    global $item;
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
                                <div class='controls' style='padding-bottom: 5px;'>
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