<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'cart.php';
include_once 'users.php';
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
    
    $customer_exists_query = "SELECT * FROM Customers WHERE email = '$username';";
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
    
    $staff_exists_query = "SELECT * FROM Staff WHERE sid = '$username';";
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
    $pass_query = "SELECT * FROM Customers WHERE email = '$id' AND password = '$pass';";
    }else{
        $pass_query = "SELECT * FROM Staff WHERE sid = '$id' AND password = '$pass';";
    }
    $rows = send_query($connection, $pass_query);
    if (mysqli_num_rows($rows) > 0){
        return TRUE;
    }else{
        return FALSE;
    }
}

function get_customer_for_order($orderID){
    $connection = make_connection();
    $query = "SELECT * "
            . "FROM "
            . "(SELECT email FROM Purchased WHERE id = '${orderID}') AS o,"
            . " Customers AS c WHERE c.email = o.email;";
    $result = send_query($connection, $query);
    if (mysqli_num_rows($result) > 0){
        return mysqli_fetch_assoc($result);
    }else{
        return null;
    }
}

function get_customer($id){
    $connection = make_connection();
    $id = mysqli_escape_string($connection, $id);
    $customer_query = "SELECT * FROM Customers WHERE email = '$id';";
    $result = send_query($connection, $customer_query);
    if (mysqli_num_rows($result) > 0){
        return mysqli_fetch_assoc($result);
    }else{
        return null;
    }
}

function get_staff($id){
    $connection = make_connection();
    $id = mysqli_escape_string($connection, $id);
    $staff_query = "SELECT * FROM Staff WHERE sid = '$id';";
    $result = send_query($connection, $staff_query);
    if (mysqli_num_rows($result) > 0){
        return mysqli_fetch_assoc($result);
    }else{
        return null;
    }
}

function chk_mgt($id){
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

function generateOrderID(){
    $connection = make_connection();
    $order_count_query = "SELECT COUNT(*) AS Count FROM Orders;";
    $id = "";
    $result = send_query($connection, $order_count_query);
    if (mysqli_num_rows($result) > 0){
        $result = mysqli_fetch_assoc($result);
        $id = strval($result['Count']);
        while (strlen($id) < 6){
            $id = '0' . $id;
        }
    }else{
        $id = '000000';
    }
    return $id;
}

function check_for_mysql_error($con,$err){
    if (!$err){
        die('Error: ' . mysqli_error($con));
    }
}

function customer_orders($customer){
    $connection = make_connection();
    //$customer = mysqli_escape_string($customer);
    $customer_orders_query = "SELECT O.id,O.status,O.date "
            . "FROM "
            . "(SELECT id FROM Purchased WHERE email = '${customer}') AS t1,"
            . " Orders AS O "
            . "WHERE O.id = t1.id;";
    $result = send_query($connection, $customer_orders_query);
    if (mysqli_num_rows($result) > 0){
        return $result;
    }else{
        return null;
    }
}

function all_orders(){
    $connection = make_connection();
    $all_orders_query = "SELECT c.email,o.*"
            . "FROM Purchased AS c, Orders AS o "
            . "WHERE c.id = o.id;";
    $result = send_query($connection, $all_orders_query);
    if (mysqli_num_rows($result) > 0){
        return $result;
    }else{
        return null;
    }
}

function get_ordered_items($id){
    $connection = make_connection();
    $items_in_order_query = "SELECT "
            . "i.name,i.price,i.promotion"
            . ",i.isn,o.quantity AS oqty,i.quantity AS iqty "
            . "FROM "
            . "Items AS i, "
            . "("
                . "SELECT b.isn,b.quantity "
                . "FROM Bought AS b "
                . "WHERE b.id = '${id}') AS o "
            . "WHERE i.isn = o.isn;";
    $result = send_query($connection, $items_in_order_query);
    if (mysqli_num_rows($result) > 0){
        return $result;
    }else{
        return null;
    }
}

function set_order_shipped($id){
    $connection = make_connection();
    
    $set_shipped_query = "UPDATE Orders status = 'shipped' WHERE id = '${id}';";
    check_for_mysql_error($connection, send_query($connection, $set_shipped_query));
    
}

function purchase_items($cartItems){
    $connection = make_connection();
    
    $orderID = generateOrderID();
    $newOrderQuery = "INSERT INTO Orders (id,date) VALUE ('${orderID}',CURDATE());";
    check_for_mysql_error($connection, send_query($connection, $newOrderQuery));
    $newPurchaseQuery = "INSERT INTO Purchased VALUE ('" . logged_in_user() . "','${orderID}');";
    check_for_mysql_error($connection, send_query($connection, $newPurchaseQuery));
    foreach ($cartItems as $isn => $qty){
        $newBoughtQuery = "INSERT INTO Bought VALUE ('${isn}','${orderID}'," . strval($qty) . ");";
        check_for_mysql_error($connection, send_query($connection, $newBoughtQuery));
        remove_item_from_cart($isn);
    }
}

function get_order($id){
    $connection = make_connection();
    $order_query = "SELECT * FROM Orders WHERE id = '${id}';";
    $result = send_query($connection, $order_query);
    if (mysqli_num_rows($result) > 0){
        return mysqli_fetch_assoc($result);
    }else{
        return null;
    }
}

function chk_sufficient_quantity($isn,$amt){
    return ((get_item_quantity($isn) - get_item_from_cart($isn)) > $amt);
}

function get_item_quantity($isn){
    $result = get_item_by_isn($isn);
    $qty = $result['quantity'];
    return $qty;
}

function get_item_by_isn($isn){
    $connection = make_connection();
    $isn = mysqli_escape_string($connection, $isn);
    $item_query = "SELECT * FROM Items WHERE isn = '$isn';";
    $result = send_query($connection, $item_query);
    if (mysqli_num_rows($result) > 0){
        return mysqli_fetch_assoc($result);
    }else{
        return NULL;
    }
}

function get_item($name){
    $connection = make_connection();
	echo "searching : " . $name;
    $name = mysqli_escape_string($connection, $name);
    
    $item_query = "SELECT * FROM Items WHERE name = '" . $name . "';";
    $result = send_query($connection, $item_query);
    if (mysqli_num_rows($result) > 0){
        return mysqli_fetch_assoc($result);
    }else{
//	echo "returning null";
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

function lower_item_qty($isn,$quantity){
    $connection = make_connection();
    $isn = mysqli_escape_string($connection, $isn);
    $query = "SELECT quantity FROM Items WHERE isn = '${isn}';";
    $item = mysqli_fetch_assoc(send_query($connection, $query));
    $curCount = $item['quantity'];
    $newCount = $curCount - $quantity;
    
    $new_Item_count_sql = "UPDATE Items"
            . "SET Items.quantity = ${newCount}"
            . "WHERE Items.isn = '${isn}';";
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

function get_all_available_items(){
    $connection = make_connection();
    
    $all_avail_items_query = "SELECT * FROM Items WHERE quantity > 0 ORDER BY name asc;";
    $result = send_query($connection, $all_avail_items_query);
    if (mysqli_num_rows($result) > 0){
        return ($result);
    }else{
        return null;
    }
}

function get_all_items(){
    $connection = make_connection();
    
    $all_items_query = "SELECT * FROM Items ORDER BY name asc";
    $result = send_query($connection, $all_items_query);
    if (mysqli_num_rows($result) > 0){
        return $result;
    }else{
        return NULL;
    }
}

