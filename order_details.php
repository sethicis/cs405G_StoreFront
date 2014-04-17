<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'header.php';
include 'query.php';

function get_order_items(){
    $orderID = $_GET['order'];
    $order = get_ordered_items($orderID);
    $sum = 0;
    while ($row = mysqli_fetch_array($order)){
        echo "<tr>";
            echo "<td>"
            . $row['name'] . "</td>";
            echo "<td>" . $row['isn'] . "</td>";
            echo "<td>\$" . strval($row['price'] - $row['promotion']*$row['price']) . "</td>";
            echo "<td>" . strval($row['quantity']) . "</td>";
            echo "<td>\$" . strval(($row['price'] - $row['promotion']*$row['price'])*$row['quantity']) . "</td>";
        echo "</tr>";
        $sum += ($row['price'] - $row['promotion']*$row['price'])*$row['quantity'];
    }
    
    echo "<tr>
            <td>---</td><td>---</td><td>---</td><td>---</td><td>\$${sum}</td>
         </tr>";
}
head("Order Details");
?>

<body>
    <?php include 'toolbar.php'; ?>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-12'>
                <table class='table table-striped'>
                    <tr>
                        <th>Name</th><th>ISN</th><th>Price</th><th>Quantity</th><th>Total</th>
                    </tr>
                    <?php get_order_items(); ?>
                </table>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>