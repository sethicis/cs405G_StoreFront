<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include "header.php";
include_once "users.php";
include_once "query.php";

function get_customer_orders(){
    $user = logged_in_user();
    $customer_orders = customer_orders($user);
    while ($order = mysqli_fetch_array($customer_orders)){
        echo "<tr>";
        echo "<td><a href='order_details.php?order=" . $order['id'] . "&errcount=0'>"
                . $order['id'] . "</a></td>";
        echo "<td>" . $order['date'] . "</td>";
        echo "<td><font style='color:red'>" . $order['status'] . "</font></td>";
        echo "</tr>";
    }
}

function get_all_orders(){
    $all_orders = all_orders();
    while ($order = mysqli_fetch_array($all_orders)){
        echo "<tr>";
        echo "<td>" . $order['email'] . "</td>"
        . "<td><a href='order_details.php?order=" . $order['id'] . "&errcount=0'>"
                . $order['id'] . "</a></td>";
        echo "<td>" . $order['date'] . "</td>";
        if ($order['status'] == 'shipped')
            { echo "<tr><td><font style='color:green;'>" . $order['status'] . "</font></td></tr>";}
            else{echo "<tr><td><font style='color:red;'>" . $order['status'] . "</font></td></tr>";}
        //echo "<td><font style='color:red;'>" . $order['status'] . "</font></td>";
        echo "</tr>";
    }
}

function get_orders(){
    $type = $_GET['type'];
    if ($type == 'customer'){
        get_customer_orders();
    }else{
        get_all_orders();
    }
}

function header_row(){
    $type = $_GET['type'];
    if ($type == 'customer'){
        echo "<th>Order ID</th><th>Date Ordered</th><th>Status</th>";
    }else{
        echo "<th>Customer</th><th>Order ID</th><th>Date Ordered</th><th>Status</th>";
    }
}

head("Orders");
?>

<body>
    <?php include 'toolbar.php'; ?>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-12'>
                <table class='table table-striped'>
                    <tr>
                        <?php header_row() ?>
                    </tr>
                    <?php get_orders(); ?>
                </table>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>