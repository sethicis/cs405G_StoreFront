<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'query.php';

session_start();

function isCustomer(){
    //Determine if the session has a user logged in as customer
    //Return false if there is no one logged in or if the user is staff
    //TODO: add logic to determine presense of customer
    return isset($_SESSION['customer']);
}

function isStaff(){
    //Determine if the session has a user logged in as staff
    //Return false if there is no one logged in or if the user is customer
    //TODO: add logic to determine presense of staff
    return isset($_SESSION['staff']);
}

//isManager function implies isStaff so no need to call both
//when checking if a person has writes to access something
function isManager(){
    if (isStaff()){
        return (chk_mgt($_SESSION['staff']));
    }
    return FALSE;
}

