<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once "cart.php";
include_once "users.php";

/*
 * If no one is logged in, create the generic login link
 */
function login(){
    if (!isCustomer() && !isStaff()){
        echo "<li><a href='login.php?type=customer&err=no'>Login</a></li>";
    }
}

//If a user is logged in greet them by name.
//The same type of greeting can be used for both a customer
//  and a staff member.
function greet(){
    if (isCustomer() or isStaff()){
        echo "<li>Hello " . $_SESSION['username'] . "</li>";
    }
}

//Create a link to view the customers current cart.
//Does not require the user to be logged in, but cannot be viewed
//  as a staff member.
function shoppingCart(){
    if (!isStaff()){
        echo "<li><a href='viewCart.php'>Cart " . strval(cartCount()) . "</a></li>";
    }
}
/*
 * Depending on whether staff or customer is logged in create
 * links to either all orders, or just the particular customer's orders.
 */
function orders(){
    if (isCustomer()){
        echo "<li><a href='orders.php?type=customer'>Orders</a></li>";
    }
    if (isStaff()){
        echo "<li><a href='orders.php?type=staff'>Orders</a></li>";
    }
}
?>


<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Widgets and Wingdings Store</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <!--<li class="active"><a href="index.php">Welcome Page</a></li>-->
        <?php greet() ?>
        <li><a href="items.php">Items</a></li>
        <?php shoppingCart() ?>
        <?php orders() ?>
        <?php login() ?>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>