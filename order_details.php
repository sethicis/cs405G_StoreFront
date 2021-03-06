<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'header.php';
include_once 'query.php';
include_once 'users.php';

function processErr(){
    $errcount = $_GET['errcount'];
    if (intval($errcount) > 0){
        echo "<div class='row'>";
        echo "<div class='col-lg-12 text-center'>";
        for ($i = 0; $i < intval($errcount); $i += 1){
            $err = "err" . strval($i);
            $err = $_GET[$err];
            echo "<font style='color:red'>Item isn " . $err . " in order " . $_GET['order']
             . " has insuffient inventory</font><br>";
        }
        echo "</div></div>";
    }
}

function get_order_items(){
    $orderID = $_GET['order'];
    $order = get_ordered_items($orderID);
    $sum = 0; $count = 0;
    while ($row = mysqli_fetch_array($order)){
        echo "<tr>";
            echo "<td>"
            . $row['name'] . "</td>";
            echo "<td>" . $row['isn'] . "</td>";
            echo "<td>\$" . strval($row['price']) . "</td>";
            echo "<td>" . strval($row['oqty']) . "</td>";
            if (isStaff()) { echo "<td>" . strval($row['iqty']) . "</td>"; }
            echo "<td>\$" . strval($row['price']*$row['oqty']) . "</td>";
        echo "</tr>";
        $sum += $row['price']*$row['oqty'];
        $count += ($row['oqty']);
    }
    
    echo "<tr>
            <td>---</td><td>---</td><td>---</td><td>${count}</td><td>---</td><td>\$${sum}</td>
         </tr>";
}

function tableTitle(){
    $orderID = $_GET['order'];
    echo "<h3>Order# " . $orderID . "</h3>";
}

function print_order_status(){
    $orderID = $_GET['order'];
    $order = get_order($orderID);
    echo "<div class='col-lg-3'>"
        . "<form action='shiporders.php' method='POST'>"
        . "<table class='table table-condensed'>"
        . "<tr><th>Order Status</th></tr>";
        if ($order['status'] == 'shipped')
            { echo "<tr><td><font style='color:green;'>" . $order['status'] . "</font></td></tr>";}
            else{
                echo "<tr><td><font style='color:red;'>" . $order['status'] . "</font></td></tr>"
                . "<tr><td>"
                . "<button type='submit' class='btn' name='order' value='" . $orderID . "'>Ship It</button>"
                . "</td></tr>";
            }
        echo "</table>"
        . "</form></div>";
}

function staffViewHeader(){
    echo "<div class='row'>"
        . "<div class='col-lg-9'>"
            . "<h3>Customer Info</h3>"
            . "<table class='table table-condensed'>"
            . "<tr>"
            . "<th>Email</th><th>First Name</th><th>Last Name</th>"
            . "<th>Street</th><th>City</th><th>State</th><th>Zipcode</th>"
            . "</tr>";
}

function staffView(){
    if (isStaff()){
        staffViewHeader();
        $customer = get_customer_for_order($_GET['order']);
        echo "<tr>"
        . "<td>" . $customer['email'] . "</td><td>" . $customer['fname'] . "</td>"
        . "<td>" . $customer['lname'] . "</td><td>" . $customer['street'] . "</td>"
        . "<td>" . $customer['city'] . "</td><td>" . $customer['state'] . "</td>"
        . "<td>" . $customer['zipcode'] .  "</td>"
        . "</tr>";
        echo "</table>";
        echo "</div>";
        print_order_status();
        echo "</div>";
    }
}
head("Order Details");
?>

<body>
    <?php include 'toolbar.php'; ?>
    <div class='container'>
        <?php processErr(); ?>
        <div class='row'>
            <div class='col-lg-12'>
                <?php tableTitle() ?>
            </div>
        </div>
        <div class='row'>
            <div class='col-lg-12'>
                <table class='table table-striped'>
                    <tr>
                        <th>Item Name</th>
                        <th>ISN</th>
                        <th>Price</th>
                        <th>Order Qty</th>
                            <?php if (isStaff()) {echo "<th>Inventory Qty</th>";} ?>
                        <th>Total</th>
                    </tr>
                    <?php get_order_items(); ?>
                </table>
            </div>
        </div>
        <?php staffView(); ?>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>