<?php

include 'header.php';
include_once 'query.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function notFound($term){
        head('Search Item not Found');
        echo "<body>";
        include 'toolbar.php';
        echo "<div class='container'>";
        echo "<div class='row'>"
        . "<div class='col-lg-12'>"
                . "<h2>Item: " . $term . "not found. :(</h2>";
        echo "</div>"
            . "</div>"
            . "</div>";
        include 'footer.php';
        echo "</body>";
        echo "</html>";
}

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
        notFound($term);
    }
}else{
    //Browse all items
    notFound($term);
}

?>