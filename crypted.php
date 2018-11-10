<?php 

//if(isset($_POST['submitted'])){

	// Validate method
	if (!empty($_POST['method'])) {
		$method = $_POST['method'];
	} else {
		$plaintext = NULL;
		echo '<p><b>Please choose your method!</b></p>';
	}
	
	// Validate key
	if (!empty($_POST['key'])) {
		$key = $_POST['key'];
	} else {
		$key = NULL;
		echo '<p><b>You forgot to enter your encryption key!</b></p>';
	}
	
if (isset($_POST['submitEncrypt'])){
	// If everything is okay, print the message.
	if ($key && $method) {
		if ($method == "MD5"){
			$filename = basename($_FILES["fileToUpload"]["name"]);
			//encrypt file
			encrypt_file($filename, "encrypted/".$filename,$key);
			//header('Content-type:application/txt');
			echo '<p>The file is encrypted</p>';			
		} else {
		}
		
	} else { // One form element was not filled out properly.
		echo '<p><font color="red">Please fill out the form properly.</font></p>';
	}
} else if (isset($_POST['submitDecrypt'])){
	if ($key && $method) {
			if ($method == "MD5"){
				$filename = basename($_FILES["fileToUpload"]["name"]);
				//decrypt file
				decrypt_file($filename, "decrypted/".$filename, $key);
				//header('Content-type:application/txt');
				//fpassthru($decrypted);
				echo '<p>The file is decrypted</p>';				
			} else {
			}
			
		} else { // One form element was not filled out properly.
			echo '<p><font color="red">Please fill out the form properly.</font></p>';
		}

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
  fclose($fp);
  
}

?>