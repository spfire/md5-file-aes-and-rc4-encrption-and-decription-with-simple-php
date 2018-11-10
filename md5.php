<header>
	<title>MD5 Encription</title>
</header>
<body background="world.jpg">
	<br><br><br>
	<p align="center"><a href="mini.php"><img src="home.png" alt="Home" class="image" style="width:50px;height:50px; border-style: solid; border-color: black;"></a>
	<a href="login.php"><img src="logout.png" alt="Home" class="image" style="width:50px;height:50px; border-style: solid; border-color: black;"></a></p>

	<form action="md5.php" method="post" enctype="multipart/form-data">
		<fieldset style='background-color:#E5FF00; width:500px; margin:0px auto;' ><legend><b><span style='background-color: #00FF99; border-style: solid;'>
		This is encryption using MD5 algorithm</span></legend>
		<p><b>Select image to upload:</b> <input type="file" name="fileToUpload" id="file"></p>
		<p><b>Enter your Key:</b> <input type="text" name="key" size="20" maxlength="50" required ></p>
<?php
if (isset($_POST['submitE'])){
	$filename = basename($_FILES["fileToUpload"]["name"]);
	$size = $_FILES["fileToUpload"]["size"];
	$format = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	
	if ($format == "txt"){
		$type = "Text File";
	} else if($format == "png"){
		$type = "Image File";
	}	else {
		$type = "Undefined file format";
	}
	echo "<b>File Name: $filename <br>
	File Size: $size bytes <br>
	File Format: $format / $type";			

} else if (isset($_POST['submitD'])){
	$filename = basename($_FILES["fileToUpload"]["name"]);
	$size = $_FILES["fileToUpload"]["size"];
	$format = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	
	if ($format == "txt"){
		$type = "Text File";
	} else if($format == "png"){
		$type = "Image File";
	}	else {
		$type = "Undefined file format";
	}
	echo "<b>File Name: $filename <br>
	File Size: $size bytes <br>
	File Format: $format / $type";		
}

?>		
		<div align="left">
		<input type="submit" onclick="myFunction()" name="submitE" value="Encrypt" />
		<input type="submit" onclick="myFunction()" name="submitD" value="Decrypt" /></div>
		</fieldset>
	</form>
	<script>
	function myFunction() {
    document.getElementById("file").required = true;
	}
	</script>
</body>

<?php
if (isset($_POST['submitE'])){
	$key = $_POST['key'];
	$filename = basename($_FILES["fileToUpload"]["name"]);
	$size = $_FILES["fileToUpload"]["size"];
	$format = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	
	if ($format == "txt"){
		$type = "Text File";
	} else if($format == "png"){
		$type = "Image File";
	}	else {
		$type = "Undefined file format";
	}
	//encrypt file
	encrypt_file($filename, "encrypted/".$filename,$key);

} else if (isset($_POST['submitD'])){
	$key = $_POST['key'];
	$filename = basename($_FILES["fileToUpload"]["name"]);
	$size = $_FILES["fileToUpload"]["size"];
	$format = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	
	if ($format == "txt"){
		$type = "Text File";
	} else if($format == "png"){
		$type = "Image File";
	}	else {
		$type = "Undefined file format";
	}	
	
	//decrypt file
	decrypt_file($filename, "decrypted/".$filename, $key);
}


function encrypt_file($file, $destination, $passphrase){
  $handle = fopen($file, "rb") or die("could not open the file");
  $contents = fread($handle,filesize($file));
  fclose($handle);
  $iv = substr(md5("\x18\x3C\x58".$passphrase,true),0,8);
  $key = substr(md5("\x2D\xFC\xD8".$passphrase,true).md5("\x2D\xFC\xD8".$passphrase,true),0,24);
  $opts = array('iv'=>$iv, 'key'=>$key);
  $fp = fopen($destination,'wb') or die("Could not open file for writing");
  stream_filter_append($fp, 'mcrypt.tripledes',STREAM_FILTER_WRITE, $opts);
  fwrite($fp, $contents) or die('Could not write to file');
  chmod($destination,0400);
  
	echo "<br><fieldset style='background-color:#00FF99; width:500px; margin:0px auto;' ><legend><b><span style='background-color: #E5FF00; border-style: solid;'>
	Result</span></legend>
	The file is successfully encrypted. <br>
	Destination file: $destination";
  fclose($fp);
}

function decrypt_file($file, $destination, $passphrase){
  $handle = fopen($file, "rb") or die("could not open the file");
  $contents = fread($handle,filesize($file));
  fclose($handle);
  
  
  $iv = substr(md5("\x18\x3C\x58".$passphrase,true),0,8);
  $key = substr(md5("\x2D\xFC\xD8".$passphrase,true).md5("\x2D\xFC\xD8".$passphrase,true),0,24);
  $opts = array('iv'=>$iv, 'key'=>$key);
  //$fp = fopen($file,'rb');
  $fp = fopen($destination,'wb') or die("Could not open file for writing");
  stream_filter_append($fp, 'mdecrypt.tripledes', STREAM_FILTER_READ, $opts);
  //return $fp;
  fwrite($fp, $contents) or die('Could not write to file');
	echo "<br><fieldset style='background-color:#00FF99; width:500px; margin:0px auto;' ><legend><b><span style='background-color: #E5FF00; border-style: solid;'>
	Result</span></legend>
	The file is successfully decrypted. <br>
	Destination file: $destination";
  fclose($fp);
  
}

?>