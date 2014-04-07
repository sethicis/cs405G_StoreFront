<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="index.css">
<title>Kyle Wares Store Front!</title>
<?php
ini_set(‘error_log’, ‘/mounts/u-zon-d2/ugrad/jkbl225/HTML/cs405g/script_errors.log’);
ini_set(‘log_errors’, ‘On’);
ini_set('display_errors', 'Off');
error_reporting(E_ALL);
?>
</head>
<body>
&nbsp
<div id="login" align="right">
	<table border=1 cellpadding='10'>
	<tr>
		<td><a href="orders.php">View Orders</a></td><td>Shopping Cart</td><td><a href="http://cs.uky.edu/~jkbl225/cs405g/empLogin.php">Employee Login</a></td>
	</tr>
	</table>
</div>
&nbsp
<?php
	if(empty($_POST))
	{
		echo"
		<div id='container' class='searchDiv'>
		<form action='index.php' method='POST'>
			<table border=1>
			<tr>
				<td colspan='2' align='center'><h1>Search The Store</h1></td>
			</tr>
			<tr>
				<td colspan='2' align='center'><input style='font-size:25px' size='30' type='text' name='term'></td>
			</tr>
			<tr>
				<td align='center'><input type='submit' style='font-size:35px'></td>
				<td align='center'><input type='button' name='browse' style='font-size:30px' value='Browse Store Items'></td>
			</tr>
			</table>
		</form>
		</div>
		";
	}
	else
	{	echo "
		<div id='container' class='searchDiv'>
			<table>
			<tr>
				<td align='right'>Hello:</td><td>{$_POST["name"]}<td>
			</tr>
			<tr>
				<td>Your email is:</td><td>{$_POST["email"]}</td>
			</tr>
			</table>
		</dvi>
		";
	}
?>
&nbsp
&nbsp
</body>
</html>
