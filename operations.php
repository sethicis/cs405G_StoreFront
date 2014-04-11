<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function parsePOST($str='test'){
    if(!empty($_POST)){
        if (isset($_POST[$str]) ){
            return TRUE;
        }
    }
    return FALSE;
}

function searchBox(){
    echo"
	<div id='container' class='searchDiv'>
            <form action='index.php' method='POST'>
                <table border=1>
		<tr>
                    <td colspan='2' align='center'><h1>Search The Store</h1></td>
		</tr>
		<tr>
                    <td colspan='2' align='center'><input style='font-size:20px' size='30' type='text' name='term'></td>
		</tr>
		<tr>
                    <td align='center'><button type='submit' name='search' value='search' style='font-size:24px'>Submit</button></td>
                    <td align='center'><button type='submit' name='browse' style='font-size:24px' value='Browse Store Items'>Browse</button></td>
		</tr>
		</table>
            </form>
	</div>
	";
}

function navigation(){
    echo '<div id="login" align="right">';
    echo "<table border=1 cellpadding='10'>";
    echo"   <tr>";
    if (isCustomer()){
        echo '<td><a href="checkout.php">Checkout</a></td><td><a href="orders.php">View Orders</a></td><td><a href="cart.php">Shopping Cart</a></td><td>' . cartCount() . '</td><td><a href="logoff.php">Logoff</a></td>';
    }
    else if (isStaff()){
        echo '<td><a href="orders.php">View Orders</a></td><td><a href="browser.php">Inventory</a></td><td><a href="logoff.php">Logoff</a></td>';
    }
    else{
        echo '<td><a href="checkout.php">Checkout</a></td><td><a href="cart.php">Shopping Cart</a></td><td>' . cartCount() . '</td><td><a href="Clogin.php">Customer Login</a></td><td><a href="Slogin.php">Staff Login</a></td>';
    }	
    echo     '</tr>';
    echo '</table>';
echo'</div>';
}

function cartCount(){
    //TODO: Return number of items in cart
    //Stubbed code to allow for compile
    return '';
}

function isCustomer(){
    //Determine if the session has a user logged in as customer
    //Return false if there is no one logged in or if the user is staff
    //TODO: add logic to determine presense of customer
    return false;
}

function isStaff(){
    //Determine if the session has a user logged in as staff
    //Return false if there is no one logged in or if the user is customer
    //TODO: add logic to determine presense of staff
    return false;
}

