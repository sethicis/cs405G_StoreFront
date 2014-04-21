<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'header.php';
include_once 'item-ops.php';
include_once 'query.php';

function addUpdateBtn($isn = null){
    if ($_GET['edit'] == 'yes'){
        echo "<td><button class='btn' type='submit' name='updateQty'>Update</button>";
    }
}

function addQty($qty,$isn){
    if ($_GET['edit'] == 'yes'){
        echo "<td><input type='text' size='3' id='" . $isn . "' name='stuff' "
                . "value='" . strval($qty) . "' onkeydown='updated(this.id)'></td>";
    }else{
        echo "<td>" . strval($qty) . "</td>";
    }
}

function displayItems($items){
    while ($item = mysqli_fetch_array($items)){
        echo "<tr>"
        . "<td><a href='item.php?isn=${item['isn']}&err=0'>" . $item['name'] . "</a></td>";
        if (($item['promotion']) > 0){
            echo "<td>";promoValue($item); echo "</td>";
            echo "<td><font style='color:green'>" . strval(($item['promotion']*100)) . "% off!</font></td>";
        }
        else{
            echo "<td>$" . strval($item['price']) . "</td>". "<td></td>"; //No promotion
        }
        echo "<td>" . $item['isn'] . "</td>";
        if (isStaff() or isManager()){
            addQty($item['quantity'],$item['isn']);
            addUpdateBtn();
        }
        echo "</tr>";
    }
}

function populateItems(){
    $items = null;
    if ((logged_in_user() != null) and isStaff()){
        $items = get_all_items();
    }else{
        $items = get_all_available_items();
    }
    displayItems($items);
}

function addEditButton(){
    if ($_GET['edit'] == 'yes'){
        echo "<a class='btn' href='items.php?edit=no'>Turn <font style='color:red;'>OFF</font> Edit Mode</a>";
    }else{
        echo "<a class='btn' href='items.php?edit=yes'>Turn <font style='color:green;'>ON</font> Edit Mode</a>";
    }
}

function tableheader(){
    if (isStaff()){ 
        echo "<thead>";
        echo "<tr>";
        echo "<td colspan='4'><h4>All Merchandise</h4></td>"
        . "<td style='align-text: right'>";
        addEditButton();
        echo "</td></tr></thead>";
    }else{
        echo "<thead>";
        echo "<tr>";
        echo "<td colspan='4'><h4>All Merchandise</h4></td>";
        echo "</tr></thead>";
    }
}
?>

<?php head("Items"); ?>
<body>
    <?php include "toolbar.php"; ?>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-12'>
                <form action='updateInventory.php' method='POST' id='itemValues'>
                <table class='table table-hover'>
                    <?php tableheader() ?>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Promotion</th>
                        <th>ISN</th>
                        <?php if (isStaff()){ echo "<th>Quantity</th>";} ?>
                        <?php if (($_GET['edit'] == 'yes') and isStaff()) { echo "<th>Update</th>"; } ?>
                    </tr>
                    <?php
                    populateItems();
                    ?>
                </table>
                </form>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script>
        $('#itemValues').submit(function() {
            $("form#promoValue :input[type=text]").each(function() {
                var input = $(this);
                if ((input.name !== 'stuff') && (input.value === '0')){
                    input.value = 0;
                }
            })
        });
        function updated(isn){
            var x = document.getElementById(isn);
            x.name = isn;
        }
    </script>
</body>
</html>