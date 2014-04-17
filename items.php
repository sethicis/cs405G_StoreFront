<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'header.php';
include_once 'item-ops.php';
include_once 'query.php';

function displayItems($items){
    while ($item = mysqli_fetch_array($items)){
        echo "<tr>"
        . "<td><a href='item.php?isn=${item['isn']}&err=0'>" . $item['name'] . "</a></td>";
        if (($item['promotion']) > 0){
            echo "<td>";promoValue($item); echo "</td>";
            //$price = $item['price'] - ($item['price'] * $item['promotion']);
            //echo "<td><del style='color:red'>$" . strval($item['price']) . "</del>&nbsp $" . $price . "</td>" . "<td><font style='color:green'>" . strval(($item['promotion']*100)) . "% off!</font></td>";
            echo "<td><font style='color:green'>" . strval(($item['promotion']*100)) . "% off!</font></td>";
        }
        else{
            echo "<td>$" . strval($item['price']) . "</td>". "<td></td>"; //No promotion
        }
        echo "<td>" . $item['isn'] . "</td>";
        if (isStaff()){
            echo "<td>" . strval($item['quantity']) . "</td>";
        }
        echo "</tr>";
    }
}

function populateItems(){
    $items = null;
    if (logged_in_user() != null){
        if (isStaff()){
            $items = get_all_items();
        }else{
            $items = get_all_available_items();
        }
    }
    displayItems($items);
}

?>

<?php head("Items"); ?>
<body>
    <?php include "toolbar.php"; ?>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-12 text-center'>
                <table class='table table-hover'>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Promotion</th>
                        <th>ISN</th>
                        <?php if (isStaff()){ echo "<th>Quantity</th>";} ?>
                    </tr>
                    <?php
                    populateItems();
                    if (isStaff()){ echo "<tr><td colspan='5' style='align-text: right'>"
                    . "<a class='btn' href='updateInventory.php'>Update Inventory</a></td></tr>";}
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>