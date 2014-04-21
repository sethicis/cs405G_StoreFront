<?php

include 'header.php';
include_once 'query.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST['term']))
{
    //Search for term
    $term = $_POST['term']; //Get the name of the variable to search for
    //Feature, add support to search by not just name, but isn as well.
    //Get the details for a particular item
    $item = get_item($term);
    if ($item != NULL){
        header("Location: item.php?isn=" . $item['isn'] . "&error=0");
        exit;
    }else{
        head('Search Item not Found');
        echo "<body>";
        include 'toolbar.php';
        echo "<p>Blank Page...</p>";
        include 'footer.php';
        echo "</body>";
        echo "</html>";
    }
}
else
{
    //Browse all items
    //$items = get_all_items();
    head('Search Item not found');
    echo "<body>";
    include 'toolbar.php';
    echo "<p>Blank Page...</p>";
    include 'footer.php';
    echo "</body>";
    echo "</html>";
}

?>