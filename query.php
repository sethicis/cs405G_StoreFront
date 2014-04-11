<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function make_connection() {
    //Get info from ini file for server connection
    $info = parse_ini_file('database.ini');
    
    //Populate variables for mysql connection
    $host = $info['host'];
    $username = $info['username'];
    $password = $info['password'];
    $db = $info['database'];
    $port = $info['port'];
    
    //Return connection
    $result = mysqli_connect($host,$username,$password,$db,$port);
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    return $result;
}

function log_query($sql){
    //Dump the query to log file for analysis
    //Dump location is not standard error file since
    //that location is not accessable on the multilab.
    //echo $sql;
    error_log($sql, 3, "/mounts/u-zon-d2/ugrad/jkbl225/HTML/cs405-store/script_errors.log");
}
 
function send_query($connection,$sql){
    if($connection){
        log_query($sql);
        return mysqli_query($connection,$sql);
    }
}

function customer_exists($username){
    $connection = make_connection();
    $username = mysqli_escape_string($connection, $username);
    
    $customer_exists_query = "SELECT * FROM Customers WHERE email = '$username'";
    $rows = send_query($connection, $customer_exists_query);
    if (mysqli_num_rows($rows) > 0){
        return TRUE;
    }else{
        return FALSE;
    }
}

function staff_exists($username){
    $connection = make_connection();
    $username = mysqli_escape_string($connection, $username);
    
    $staff_exists_query = "SELECT * FROM Staff WHERE sid = '$username'";
    $rows = send_query($connection, $staff_exists_query);
    if (mysqli_num_rows($rows) > 0){
        return TRUE;
    }else{
        return FALSE;
    }
}

function chk_password($id,$pass,$customer){
    $connection = make_connection();
    $id = mysqli_escape_string($connection, $id);
    $pass = mysqli_escape_string($connection, $pass);
    if ($customer){
    $pass_query = "SELECT * FROM Customers WHERE email = '$id' AND password = '$pass'";
    }else{
        $pass_query = "SELECT * FROM Staff WHERE sid = '$id' AND password = '$pass'";
    }
    $rows = send_query($connection, $pass_query);
    if (mysqli_num_rows($rows) > 0){
        return TRUE;
    }else{
        return FALSE;
    }
}

function isManager($id){
    $connection = make_connection();
    $id = mysqli_escape_string($connection, $id);
    
    $query = "SELECT * FROM Staff WHERE sid ='$id' AND manager = 1;";
    $result = send_query($connection, $query);
    if (mysqli_num_rows($result) > 0){
        return TRUE;
    }else{
        return FALSE;
    }
}

function get_item($name){
    $connection = make_connection();
    $name = mysqli_escape_string($connection, $name);
    
    $item_query = "SELECT * FROM Items WHERE name = '$name';";
    $result = send_query($connection, $item_query);
    if (mysqli_num_rows($result) > 0){
        return $result;
    }else{
        return NULL;
    }
}

function update_item($name, $quantity, $promotion){
    $connection = make_connection();
    
    $name = mysqli_escape_string($connection, $name);
    $quantity = mysqli_escape_string($connection, $quantity);
    $promotion = mysqli_escape_string($connection, $promotion);
    
    $update_item_query = "UPDATE Items"
            . "SET Items.quantity = $quantity, "
            . "Items.promotion = $promotion"
            . "WHERE Items.name = '$name';";
    send_query($connection, $update_item_query);
    return;
}

function lower_item_qty($name,$quantity){
    $connection = make_connection();
    $name = mysqli_escape_string($connection, $name);
    $query = "SELECT quantity FROM Items WHERE name = '$name';";
    $item = mysqli_fetch_assoc(send_query($connection, $query));
    $curCount = $item['quantity'];
    $newCount = $curCount - $quantity;
    
    $new_Item_count_sql = "UPDATE Items"
            . "SET Items.quantity = $newCount"
            . "WHERE Items.name = '$name';";
    send_query($connection, $new_Item_count_sql);
    return;
}

function increase_item_qty($name,$quantity){
    //TODO:
    //I'm not sure if this function needs to be implemented
    //or not.  There may not be a need for an increase
    //item quantity function. So I'll just leave this here
    //stubbed.
}

function get_all_items(){
    $connection = make_connection();
    
    $all_items_query = "SELECT * FROM Items ORDER BY name asc";
    $result = send_query($connection, $all_items_query);
    if (mysqli_num_rows($result) > 0){
        return $result;
    }else{
        return "No Items found.";
    }
}

