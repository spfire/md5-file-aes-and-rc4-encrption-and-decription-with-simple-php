<header>
	<title>RC4 Encription</title>
</header>
<body background="world.jpg">
	<br><br><br><br><br>
	<p align="center"><a href="mini.php"><img src="home.png" alt="Home" style="width:50px;height:50px; border-style: solid; border-color: black;"></a>
	<a href="login.php"><img src="logout.png" alt="Home" class="image" style="width:50px;height:50px; border-style: solid; border-color: black;"></a></p>

	<form action="rc4.php" method="post" enctype="multipart/form-data">
		<fieldset style='background-color:#E5FF00; width:500px; margin:0px auto;' ><legend><b><span style='background-color: #00FF99; border-style: solid;'>
		This is encryption using RC4 algorithm</span></legend>
		<p><b>Enter your input text:</b> <input type="text" name="plaintext" size="20" maxlength="50" required ></p>
		<p><b>Enter your Key:</b> <input type="text" name="key" size="20" maxlength="50" required ></p>
		<!-- Select image to upload:
		<input type="file" name="files"> -->
		<div align="left">
		<input type="submit" name="submit" value="Encrypt" />
		</fieldset>
	</form>

<?php
if(isset($_POST['submit'])){
	
	$plaintext = $_POST['plaintext'];
	$key = $_POST['key'];
	$encrc4 =  RC4($key, $plaintext);
	
	//plaintext
	echo "<br><fieldset style='background-color:#00FF99; width:500px; margin:0px auto;'><legend><b><span style='background-color: #FFFF00; border-style: solid;'>RESULT</span></b></legend>";
	echo "Plain Text =" .$plaintext. "<br>";
	
	//secret key
	$secret_key = $_POST["key"];
	echo "Secret Key =" .$key. "<br>";

	//ciphertext
	echo "Encrypted Text = " .$encrc4. "<br>";
	
	echo "</fieldset>";
}

function RC4($key, $str) {
	$s = array();
	for ($i = 0; $i < 256; $i++) {
		$s[$i] = $i;
	}
	$j = 0;
	for ($i = 0; $i < 256; $i++) {
		$j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
		$x = $s[$i];
		$s[$i] = $s[$j];
		$s[$j] = $x;
	}
	$i = 0;
	$j = 0;
	$res = '';
	for ($y = 0; $y < strlen($str); $y++) {
		$i = ($i + 1) % 256;
		$j = ($j + $s[$i]) % 256;
		$x = $s[$i];
		$s[$i] = $s[$j];
		$s[$j] = $x;
		$res .= $str[$y] ^ chr($s[($s[$i] + $s[$j]) % 256]);
	}
	return $res;
}
?>
</body>