<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'cart.php';
include 'users.php';

//Unused function. May be removed
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
	<div id='container' class='row'>
            <form action='search_handle.php' method='POST'>
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

/*function navigation(){
    
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    /*echo '<div id="login" align="right">';
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
echo'</div>';*/
//}
