<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once "header.php";
include "item-ops.php";
include_once "users.php";

function addUpdateBtn($isn = null){
    if ($_GET['edit'] == 'yes'){
        echo "<td><button class='btn' type='submit' name='update'>Update</button>";
    }
}

function addPromo($promo,$isn){
    if ($_GET['edit'] == 'yes'){
        //echo "<td><input type='text' size='3' name='" . $isn . "' value='" . strval($promo) . "'></td>";
        echo "<td><input type='text' size='3' id='${isn}' name='" . "stuff" . "' value='" . strval($promo) . "'"
                . "onkeydown=\"updated(this.id)\"></td>";
    }else{
        echo "<td>" . strval($promo) . "</td>";
    }
}

function displayItems($items){
    while ($item = mysqli_fetch_array($items)){
        echo "<tr>";
        echo "<td>" . $item['name'] . "</td>";
        echo "<td>";
        if ($item['promotion'] > 0){
            promoValue($item);
        }else{
            echo strval($item['price']);
        }
        echo "</td>";
        echo "<td>" . $item['isn'] . "</td><td>" . $item['quantity'] . "</td>";
        addPromo($item['promotion'],$item['isn']);
        addUpdateBtn();
        echo "</tr>";
    }
}

function populateItems(){
    $items = null;
    if ((logged_in_user() != null) and isManager()){
        $items = get_all_items();
    }
    displayItems($items);
}

function addEditButton(){
    if ($_GET['edit'] == 'yes'){
        echo "<a class='btn' href='promotions.php?edit=no'>Turn <font style='color:red;'>OFF</font> Edit Mode</a>";
    }else{
        echo "<a class='btn' href='promotions.php?edit=yes'>Turn <font style='color:green;'>ON</font> Edit Mode</a>";
    }
}

function tableheader(){
    echo "<thead>";
    echo "<tr>";
    echo "<td colspan='4'><h4>All Merchandise</h4></td>"
    . "<td style='align-text: right'>";
    addEditButton();
    echo "</td></tr></thead>";
}

?>

<?php head("Items"); ?>
<body>
    <?php include "toolbar.php"; ?>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-12'>
                <form id='promoValue' action='updatePromotions.php' method='POST'>
                <table class='table table-hover'>
                    <?php tableheader() ?>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>ISN</th>
                        <th>Quantity</th>
                        <th>Promotion</th>
                        <?php if (($_GET['edit'] == 'yes') and isManager()) { echo "<th>Update</th>"; } ?>
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
        $('#promoValue').submit(function() {
            $("form#promoValue :input[type=text]").each(function() {
                var input = $(this);
                if ((input.name !== 'stuff') && (input.value === '0')){
                    input.value = '0.0';
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