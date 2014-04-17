<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'cart.php';
include 'query.php';
include 'header.php';

function cartItems(){
    $cartItems = get_cart_items();
    foreach ($cartItems as $isn => $qty){
        $itemInfo = get_item_by_isn($isn);
        echo 
        "<tr>"
        . "<td>" . $itemInfo['name'] . "</td>"
        . "<td>" . $isn . "</td>"
        . "<td>" . strval($itemInfo['price']*$qty) . "</td>"
        . "<td><input type='text' size='3' default='" . strval($qty) . "' name='" . $isn . "'></td>"
        . "<td><a href='removeCartItem.php?isn=" . $isn . "'>remove</a></td>"
        . "</tr>";
    }
}

head("Shopping Cart");
?>

<body>
    <?php include 'toolbar.php'; ?>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-9'>
                <form class='form-inline' action='updateCart.php' method='POST'>
                    <table class='table table-hover'>
                        <thead>
                            <tr>
                                <td>Name</td><td>ISN</td><td>Price</td><td>Quantity</td><td>Remove</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php cartItems(); ?>
                            <tr>
                                <td colspan="5" style="text-align: right">
                                    <button type='submit' class='btn' id='update' name='update' value='Update'>Update</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class='col-lg-3'>
                <form class='form-inline' action='purchase.php' method='POST'>
                    <p>Ready to checkout?</p>
                    <button type='submit' name='purchase' id='purchase' value='Purchase' class='btn'>Purchase</button>
                </form>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>