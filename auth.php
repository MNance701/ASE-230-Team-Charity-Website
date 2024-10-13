<?php
require_once('functions.php');
if(isset($_SESSION['email'])) die('You are already sign in, please sign out if you want to create a new account.');
$showForm=true;
if(count($_POST)>0){
	if(isset($_POST['email'][0]) && isset($_POST['password'][0])){

		$fp=fopen(__DIR__.'/data/users.csv.php','a+');
		fputs($fp,$_POST['email'].';'.password_hash($_POST['password'],PASSWORD_DEFAULT).PHP_EOL);
		fclose($fp);
		echo 'Your account has been created, proceed to the <a href="signin.php">Sign in page</a>.';
		$showForm=false;
	}else echo 'Email and password are missing';
}

if(isset($_SESSION['email'])) die('You are already signed in, no need to sign in.');
$showForm=true;
if(count($_POST)>0){
	if(isset($_POST['email'][0]) && isset($_POST['password'][0])){

		$index=0;
		$fp=fopen(__DIR__.'/data/users.csv.php','r');
		while(!feof($fp)){
			$line=fgets($fp);
			if(strstr($line,'<?php die() ?>') || strlen($line)<5) continue;
			$index++;
			$line=explode(';',trim($line));
			if($line[0]==$_POST['email'] && password_verify($_POST['password'],$line[1])){

				$_SESSION['email']=$_POST['email'];
				$_SESSION['ID']=$index;

				echo 'Welcome to our website';$showForm=false;
			}
		}
		fclose($fp);

		if($showForm) echo 'Your credentials are wrong';
	}else echo 'Email and password are missing';
}
