<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//If login error display message
function success(){
    if ($_GET['err'] != "no"){
        echo "<font style='color:red'>Password or Username is incorrect, try again</font>";
    }
}
//Output the type of user logging in
function type(){
    if ($_GET['type'] != "customer"){
        echo "staff";
    }else{
        echo "customer";
    }
}
//Return the label associated with the type of login
function loginType(){
    if ($_GET['type'] === "customer"){
        echo "Email";
    }else{
        echo "Staff ID";
    }
}
/*
 * If a customer is logging in display a link to the
 * staff login page, and vice versa.
 */
function staffIn(){
    if ($_GET['type'] == "customer"){
        echo "<div class=\"row\">
            <div class=\"col-lg-12 text-right\">
                <h6>Not a Customer?</h6><a href=\"login.php?type=staff&err=no\">Staff Login</a>
            </div>
        </div>";
    }else{
        echo "<div class=\"row\">
            <div class=\"col-lg-12 text-right\">
                <h6>Not an Employee?</h6><a href=\"login.php?type=customer&err=no\">Customer Login</a>
            </div>
        </div>";
    }
}
//Create a button for a new customer
function regButton(){
    if ($_GET['type'] == "customer"){
        echo "<button type='submit' name='register' value='register' class='btn'>Register</button>";
    }
}

?>

<?php include "header.php";
    head("Login Page"); ?>
    <body>
        <?php include "toolbar.php"; ?>

        <div class="container">
            <div class='row'>
                <div class='col-lg-12'>
                &nbsp
                </div>
            </div>
            <div class='row'>
                <div class='col-lg-12 text-center form-group'>
                    
                    <form class="form-horizontal" method="POST" action="signin.php">
                        <fieldset>
                            <legend><?php type()?> Login</legend>
                            <div class="control-group">
                                <label class="control-label" for="inputUsername"><?php loginType() ?></label>
                                <div class="controls">
                                    <input type="text" id="inputUsername" name="inputUsername" placeholder="<?php loginType() ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputPassword">Password</label>
                                <div class="controls">
                                    <input type="password" id="inputPassword" name="inputPassword" placeholder="Password">
                                    <br>
                                    <?php success() ?>
                                </div>
                            </div>
                            <div class='control-group' style="padding-top: 5px;">
                                <div class="controls">
                                    <button type='submit' name="submit" value="<?php type() ?>" class='btn'>Sign in</button>&nbsp;
                                    <?php regButton() ?>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <?php staffIn() ?>
        </div>

        <?php include 'footer.php'; ?>

    </body>
</html>