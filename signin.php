<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include "query.php";

const USERID = 'userid';//Current user's unique ID
const USERNAME = 'username';//Current user's full name
const USERTYPE = 'utype'; //The current user's type (customer, staff, manager)
const cTYPE = 1; //type customer
const sTYPE = 2; //type staff
const mTYPE = 3; //type manager

session_start();

$username = $_POST['inputUsername'];
$password = $_POST['password'];
$type = $_POST['submit'];

$goto;
if (isset($_POST['register'])){
    if ($_POST['register'] == 'register'){
        header("Location: register.php?err=no");
        exit;
    }
}

if ($type === "customer"){
    if (customer_exists($username)){
        if(chk_password($username, $password, TRUE)){
            $_SESSION[USERID] = $username; //Store the current users unique id
            $person = get_customer($username);
            $name = $person['fname'] . " " . $person['lname'];
            $_SESSION[USERNAME] = $name; //Store the current users full name
            $_SESSION[USERTYPE] = cTYPE;
            $goto = 'index.php';
        }else{
            $goto = 'login.php?type=customer&err=yes';
        }
    }else{
        $goto = 'register.php?err=no';
    }
}else{
    if (staff_exists($username)){
        if (chk_password($username, $password, FALSE)){
            $_SESSION[USERID] = $username; //Store the current users unique id
            $person = get_staff($username);
            $name = $person['fname'] . " " . $person['lname'];
            $_SESSION[USERNAME] = $name; //Store the current users full name
            if (chk_mgt($username)){
                $_SESSION[USERTYPE] = mTYPE;
            }else{
                $_SESSION[USERTYPE] = sTYPE;
            }
            $goto = 'index.php';
        }else{
            $goto = 'login.php?type=staff&err=yes';
        }
    }else{
        $goto = 'login.php?type=staff&err=yes';
    }
}

header("Location: ${goto}");
exit;

?>
