<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'header.php';
include_once 'query.php';
include_once 'users.php';

function displayItems($items){
    while ($row = mysqli_fetch_array($items)){
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['qty'] . "</td>";
        echo "<td>" . $row['isn'] . "</td>";
        echo "</tr>";
    }
}

function populateItems(){
    $time = $_GET['time'];
    $items = null;
    if ($time === 'week'){
        $items = get_items_bought_in_last_week();
    }
    else if ($time === 'month'){
        $items = get_items_bought_in_last_month();
    }else{
        $items = get_items_bought_in_last_year();
    }
    displayItems($items);
}

function addTimeButtons(){
    echo "<td><a class='btn' href='statistics.php?time=week'>Week</a></td>"
        . "<td><a class='btn' href='statistics.php?time=month'>Month</a></td>"
        . "<td><a class='btn' href='statistics.php?time=year'>Year</a></td>";
}

function tableheader(){
    if (isManager()){
        $time = $_GET['time'];
        echo "<thead>";
        echo "<tr>";
        echo "<td colspan='3'><h4>Items Purchased in last ${time}</h4></td>"
        . "</tr></thead>";
    }
}

function options(){
    echo "<div class='row'>";
        echo "<div class='col-lg-12'>";
            echo "<table class='table table-condensed'>"
                . "<thead><tr><td colspan='3'>Select Sale Interval:</td></tr></thead>";
            echo "<tr>";
            addTimeButtons();
            echo "</tr>"
            . "</table>";
        echo "</div>";
    echo "</div>";
}

head("Item Sale Statistics");
?>

<body>
    <?php include "toolbar.php"; ?>
    <div class='container'>
        <?php options() ?>
        <div class='row'>
            <div class='col-lg-12'>
                <table class='table table-striped'>
                    <?php tableheader() ?>
                    <tr>
                        <th>Name</th>
                        <th>Number Sold</th>
                        <th>ISN</th>
                    </tr>
                    <?php
                    populateItems();
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>