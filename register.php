<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Error if username is already in use, email not unique
function nameErr(){
    if ($_GET['err'] == 'user'){
        echo "<font style='color:red'>Username/Email already in use</font>";
    }
}
//Error if passwords do not match
function passErr(){
    if ($_GET['err'] == 'pass'){
        echo "<font style='color:red'>Passwords do not match</font>";
    }
}
//Display error message if not all fields are filled out
function allfields(){
    if ($_GET['err'] == 'notall'){
        echo "
            <div class='row'>
                <div class='col-lg-12'>
                    <h3><font style='color:red'>Error: All Fields MUST Be Completed</font></h3>
            </div>";
    }
}
?>
<?php include 'header.php'; 
      head("New Customer Registration"); ?>

<body>

<?php include 'toolbar.php'; ?>

<div class="container">
    <div class='row'>
        <div class='col-lg-12'>
        &nbsp
        </div>
    </div>
    <?php allfields() ?>
    <div class='row'>
        <div class='col-lg-12 text-center'>
            <form class="form-horizontal" id="register" method="POST" action="adduser.php">
                <fieldset>
                    <legend>Register New Customer</legend>
                    <div class="control-group">
                        <label class="control-label" for="email">Email</label>
                        <div class="controls">
                            <input type="text" placeholder="Email" id="email" name="email">
                        </div>
                        <?php nameErr() ?>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password1">Password</label>
                        <div class="controls">
                            <input type="password" id="password1" placeholder="Enter a Password" name="password1">
                            <?php passErr() ?>
                            <input type="password" placeholder="Confirm Password" name="password2">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class='control-label'>First Name</label>
                        <div class="controls">
                            <input type="text" placeholder="First name" name="fname">
                        </div>
                    </div>
                    <div class='control-group'>
                        <label class='control-label'>Last Name</label>
                        <div class='controls'>
                            <input type="text" placeholder="Last name" name="lname">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Shipping Address</legend>
                    <div class='control-group'>
                        <label class='control-label'>Street Address</label>
                        <div class='controls'>
                            <input type="text" placeholder="street" name="street">
                        </div>
                    </div>
                    <div class='control-group'>
                        <label class='control-label'>City</label>
                        <div class='controls'>
                            <input type="text" placeholder="city" name="city">
                        </div>
                    </div>
                    <div class='control-group'>
                        <label class='control-label'>State</label>
                        <div class='controls'>
                            <input type="text" placeholder="state" name="state">
                        </div>
                    </div>
                    <div class='control-group'>
                        <label class='control-label'>Postal Code</label>
                        <div class='controls'>
                            <input type="text" placeholder="zip" name="zip">
                        </div>
                    </div>
                </fieldset>
            </form>
                
<?php include 'footer.php'; ?>

<script>

    $(document).ready(function() {
        $('#register').validate({
            rules: {
                email: {
                    required: true,
                    maxlength: MAX_STRING_LENGTH
                },
                lname: {
                    required: true,
                    maxlength: MAX_STRING_LENGTH
                },
                fname: {
                    required: true,
                    maxlength: MAX_STRING_LENGTH
                },
                password1: {
                    required: true,
                    maxlength: MAX_STRING_LENGTH
                },
                password2: {
                    required: true,
                    maxlength: MAX_STRING_LENGTH,
                    equalTo: "#password1"
                },
                street: {
                    required: true,
                    maxlength: MAX_STRING_LENGTH
                },
                city: {
                    required: true,
                    maxlength: MAX_STRING_LENGTH
                },
                state: {
                    required: true,
                    regex: /^[a-zA-Z]{2}$/
                },
                zip: {
                    required: true,
                    regex: /^\d{5}$/
                }
            },
        });
    });

</script>

    </body>
</html>