<?php

include 'header.php';
include 'items.php';
include 'operations.php';
include 'query.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function search_type(){
    if (isset($_POST['search'])){
        //Search for term
        $term = $_POST['term']; //Get the name of the variable to search for
        //Feature, add support to search by not just name, but isn as well.
        //Get the details for a particular item
        //displayItemDetails(get_item($term));
        $item = get_item($term);
        if ($item != NULL){
            header("Location: item.php?isn=" . $item['isn'] . "&error=0");
        }else{
            //TODO: Handle search term with no hits
        }
    }
    else{
        //Browse all items
        $items = get_all_items();
        displayItems($items);
    }
}

head('Browse Items');

navigation();

search_type(); //Get the appropriate item