<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'query.php';

$username = $_POST['email'];
$pass1 = $_POST['password1'];
$pass2 = $_POST['password2'];
$street = $_POST['street'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$state = $_POST['state'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];

$goto;

//if (!customer_exists($username)){
//    if ($pass1 == $pass2){
//        //passwords match
//        //Check that all fields were filled
//        if (($pass1 != "") and ($street != "") and ($city != "") 
//                and ($zip != "") and ($state != "")
//                and ($fname != "") and ($lname != "")){
//            if (add_customer($username,$pass1,$fname,$lname,$street,$city,$state,$zip)){
//                
//                $goto = 'login.php?type=customer&err=no';
//            }
//        }
//    }
//}

if (!customer_exists($username)){
    add_customer($username,$pass1,$fname,$lname,$street,$city,$state,$zip);
}else{
    $goto = 'register.php?err=user';
    header("Location: ${goto}");
    exit;
    //if the add_customer funciton returns false then something has happened with
    //  the query insertion.
    //  See query log for more information
}

$goto = 'login.php?type=customer&err=no';

header("Location: ${goto}");
exit;


