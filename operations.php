<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'cart.php';
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
        <div class=\"container\">
            <div class='row'>
                <div class='col-lg-12'>
                &nbsp
                </div>
            </div>
            <div class='row'>
		<div class='col-lg-12 text-center'>
                    <h1>
                        Widgets and Wingdings<br>
                        <small>The first and only of its kind</small>
                    </h1>
                </div>
            </div>
            <div class='row'>
                <div class='col-lg-12'>
                    <p>
                        &nbsp
                    </p>
                </div>
            </div>
            <div class='row'>
                <div class='col-lg-12 text-center'>
                    <form action='search_handle.php' method='POST' class='form-search'>
                        <h4>Item Search</h4>
                        <input type='text' size='50' class='input-medium search-query' name='term' placeholder='Search for an Item'>		
                        <button type='submit' name='search' value='search' class='btn'>Submit</button>
                    </form>
                </div>
            </div>
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
