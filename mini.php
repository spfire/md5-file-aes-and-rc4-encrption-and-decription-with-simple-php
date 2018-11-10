<head>
	<title>Cryptography Encription</title>
	<style>
	body {
		font-family: "Comic Sans MS", "Comic Sans", cursive;
		text-align: center;
	}
	
	div {
		height: 200px;
		width: 800px;
		position: fixed;
		top: 50%;
		left: 50%;
		margin-top: -100px;
		margin-left: -400px;
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
	<br><br><br><br><br>

	<p align="center"><a href="login.php"><img src="logout.png" alt="Home" class="image" style="width:50px;height:50px; border-style: solid; border-color: black;"></a></p>

	<div><h1>Hello adventurer, this website will encrypt your data.</h1>
	<h2>Please choose your desired algorithm.</h2>
	<input type="button" class="btn" value="AES PLAINTEXT ENCRIPTION" onclick="window.location.href='aes.php'" />
	<input type="button" class="btn" value="MD5 FILE ENCRIPTION" onclick="window.location.href='md5.php'" />
	<input type="button" class="btn" value="RC4 PLAINTEXT ENCRIPTION" onclick="window.location.href='rc4.php'" />	
	</div>
</body>