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
            <form id="register" method="POST" action="adduser.php">
                <fieldset>
                    <legend>Register New Customer</legend>
                    <label>Email</label>
                    <input type="text" placeholder="Email" name="email">
                    <?php nameErr() ?>
                    <label>Password</label>
                    <input type="password" id="password1" placeholder="Enter a Password" name="password1">
                    <?php passErr() ?>
                    <input type="password" placeholder="Confirm your Password" name="password2">
                    <label>First Name</label>
                    <input type="text" placeholder="First name" name="fname">
                    <label>Last Name</label>
                    <input type="text" placeholder="Last name" name="lname">
                </fieldset>
                <fieldset>
                    <legend>Address</legend>
                    <label>Street Address</label>
                    <input type="text" placeholder="street" name="street">
                    <label>City</label>
                    <input type="text" placeholder="City" name="city">
                    <label>State</label>
                    <input size="2" maxlength="2" type="text" placeholder="State" name="state">
                    <label>Postal Code</label>
                    <input type="text" size="6" maxlength="5" placeholder="Zip" name="zip">
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
                }
                fname: {
                    required: true,
                    maxlength: MAX_STRING_LENGTH
                }
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