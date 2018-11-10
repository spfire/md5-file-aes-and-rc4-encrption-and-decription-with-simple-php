<?php // LOGIN USER
if (isset($_POST['login_user'])) {
	require_once('mysql_connect.php'); //Connect to db

	$username = $_POST['username'];
	$password = $_POST['password'];
	
  	$query = "SELECT * FROM users WHERE username='$username' AND password= SHA('$password')";
  	$results = mysqli_query($dbc, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
	  header('location: mini.php');

  	}else {
  		echo "<script type='text/javascript'>alert('Wrong Password / Username')</script>";
  	}
}
?>
<html>
<head>
  <title>LOGIN</title>
  	<style>	body {
		font-family: "Comic Sans MS", "Comic Sans", cursive;
		text-align: left;
	}
	
	div {
		height: 200px;
		width: 400px;
		position: fixed;
		top: 50%;
		left: 50%;
		margin-top: -100px;
		margin-left: -200px;
	}
	
	.btn {
		background-color: #f4511e;
		border: none;
		color: white;
		padding: 8px 16px;
		text-align: center;
		font-size: 16px;
		margin: 4px 2px;
		opacity: 0.8;
		transition: 0.3s;
	}
	
	.btn:hover {
		background-color: #3e8e41;
		color: white;
	}
	</style>
</head>
<body background="world.jpg">
  	<div>
	<fieldset><legend><h2>Login</h2></legend>
	 
	<form method="post" action="login.php">

	Username:
	&nbsp;&nbsp;
	<input type="text" required name="username" ><br>

	Password:
	&nbsp;&nbsp;&nbsp;
	<input type="password" required name="password"><br>

  	<button type="submit" class="btn" name="login_user">Login</button>
  	Not yet a member? <a href="register.php">Sign up</a>
	</form>
	</fieldset>
	</div>
</body>
</html>