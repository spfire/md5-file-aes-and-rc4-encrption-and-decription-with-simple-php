<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

require_once('mysql_connect.php'); //Connect to db

// REGISTER USER
if (isset($_POST['reg_user'])) {
  
// receive all input values from the form
	$username = $_POST['username'];
	$password_1 = $_POST['password_1'];
	$password_2 = $_POST['password_2'];

	if ($password_1 != $password_2) {
		 array_push($errors, "Password Not Match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
  $result = mysqli_query($dbc, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

  	$query = "INSERT INTO users (username, password) VALUES('$username', SHA('$password_1'))";
  	mysqli_query($dbc, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
	header('location: mini.php');
  }
}

?>


<html>
<head>
	<title>REGISTERATION</title>
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
	<fieldset><legend><h2>Register</h2></legend>
	
	<form method="post" action="register.php">
	<?php  if (count($errors) > 0) : ?>
  	<?php foreach ($errors as $error) : ?>
  	<p><?php echo $error ?></p>
  	<?php endforeach ?>
	<?php  endif ?>
		
	<label>Username:</label>
  	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" name="username" required value="<?php echo $username; ?>"><br>
	
  	<label>Password:</label>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="password" required name="password_1"><br>
	
	Confirm password:
	&nbsp;
	<input type="password" required name="password_2"><br>
  	<button type="submit" class="btn" name="reg_user">Register</button>
  	
  		Already a member? <a href="login.php">Sign in</a>
  	
	</form>
	</fieldset>
	</div>
</body>
</html>