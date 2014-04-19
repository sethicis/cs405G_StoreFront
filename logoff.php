<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

const USERID = 'userid';//Current user's unique ID
const USERNAME = 'username';//Current user's full name
const USERTYPE = 'utype'; //The current user's type (customer, staff, manager)

session_start();

if (isset($_SESSION[USERID])){
    unset($_SESSION[USERID]);
    unset($_SESSION[USERNAME]);
    unset($_SESSION[USERTYPE]);
}

session_destroy();

header("Location: index.php");
exit;

?>