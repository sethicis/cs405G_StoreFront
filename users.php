<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

const cTYPE = 1;
const sTYPE = 2;
const mTYPE = 3;
const USERTYPE = 'utype';
const USERNAME = 'username';
const USERID = 'userid';

include_once 'query.php';

session_start();

function isCustomer(){
    if (isset($_SESSION[USERID])){
        if ($_SESSION[USERTYPE] == cTYPE)
            return TRUE;
    }
    return FALSE;
}

function isStaff(){
    if (isset($_SESSION[USERID])){
        if ($_SESSION[USERTYPE] == sTYPE)
            return TRUE;
    }
    return FALSE;
}

//isManager function implies isStaff so no need to call both
//when checking if a person has writes to access something
function isManager(){
    if (isset($_SESSION[USERID])){
        if ($_SESSION[USERTYPE] == mTYPE)
            return TRUE;
    }
    return FALSE;
}
//Returns whether or not a user is logged in.
//If a user is logged in then it returns their unique id.
//If no user is logged in the function returns null.
function logged_in_user() {
    if (isset($_SESSION[USERID])){
        return $_SESSION[USERID];
    }else{
        return null;
    }
}


