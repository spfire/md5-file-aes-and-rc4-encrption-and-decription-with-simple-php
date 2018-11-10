<header>
	<title>AES Encription</title>
</header>
<body background="world.jpg">
	<br><br><br><br><br>
	<p align="center"><a href="mini.php"><img src="home.png" alt="Home" class="image" style="width:50px;height:50px; border-style: solid; border-color: black;"></a>
	<a href="login.php"><img src="logout.png" alt="Home" class="image" style="width:50px;height:50px; border-style: solid; border-color: black;"></a></p>

	<form action="aes.php" method="post" enctype="multipart/form-data">
		<fieldset style='background-color:#E5FF00; width:500px; margin:0px auto;' ><legend><b><span style='background-color: #00FF99; border-style: solid;'>
		This is encryption using AES-256-CBC algorithm</span></legend>
		<p><b>Enter your input text:</b> <input type="text" name="plaintext" size="20" maxlength="50" required ></p>
		<p><b>Enter your Key:</b> <input type="text" name="secret_key" size="20" maxlength="50" required ></p>
		<p><b>Enter your Initialization Vector (IV):</b> <input type="text" name="secret_iv" size="20" maxlength="50" required ></p>
		<!-- Select image to upload:
		<input type="file" name="files"> -->
		<div align="left"><input type="submit" name="submitE" value="Encrypt" /><input type="submit" name="submitD" value="Decrypt" /></div>
		</fieldset>
	</form>
</body>

<?php
if (isset($_POST['submitE'])) {
	function crypto($action, $plaintext) {
		$output = false;
		$algorithm = "AES-256-CBC";
		$secret_key = $_POST["secret_key"];
		$secret_iv = $_POST["secret_iv"];
		// hash
		$key = hash('sha256', $secret_key);
    
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		if ( $action == 'encrypt' ) {
			$output = openssl_encrypt($plaintext, $algorithm, $key, 0, $iv);
			$output = base64_encode($output);
		} else if( $action == 'decrypt' ) {
			$output = openssl_decrypt(base64_decode($plaintext), $algorithm, $key, 0, $iv);
		}
		return $output;
	}
	
	//plaintext
	echo "<br><fieldset style='background-color:#00FF99; width:500px; margin:0px auto;'><legend><b><span style='background-color: #FFFF00; border-style: solid;'>RESULT</span></b></legend>";
	$plaintext = $_POST["plaintext"];
	echo "Plain Text =" .$plaintext. "<br>";
	
	//secret key
	$secret_key = $_POST["secret_key"];
	echo "Secret Key =" .$secret_key. "<br>";

	//initialization vector
	$secret_iv = $_POST["secret_iv"];
	echo "Initialization Vector =" .$secret_iv. "<br><br>";
	
	//ciphertext
	$ciphertext = crypto('encrypt', $plaintext);
	echo "Encrypted Text = " .$ciphertext. "<br>";
	
	echo "</fieldset>";
	}
?>

<?php
if (isset($_POST['submitD'])) {
	function crypto($action, $plaintext) {
		$output = false;
		$algorithm = "AES-256-CBC";
		$secret_key = $_POST["secret_key"];
		$secret_iv = $_POST["secret_iv"];
		// hash
		$key = hash('sha256', $secret_key);
    
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		$output = openssl_decrypt(base64_decode($plaintext), $algorithm, $key, 0, $iv);
		return $output;
	}
	
	//plaintext
	echo "<br><fieldset style='background-color:#00FF99; width:500px; margin:0px auto;'><legend><b><span style='background-color: #FFFF00; border-style: solid;'>RESULT</span></b></legend>";
	$plaintext = $_POST["plaintext"];
	echo "Cipher Text =" .$plaintext. "<br>";
	
	//secret key
	$secret_key = $_POST["secret_key"];
	echo "Secret Key =" .$secret_key. "<br>";

	//initialization vector
	$secret_iv = $_POST["secret_iv"];
	echo "Initialization Vector =" .$secret_iv. "<br><br>";
	
	//decrypted text
	$decrypted_txt = crypto('decrypt', $plaintext);
	echo "Decrypted Text =" .$decrypted_txt. "<br>";
	
	echo "</fieldset>";
	}
?>