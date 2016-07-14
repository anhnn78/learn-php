<?php
	$dsn="mysql:host=localhost;dbname=user.db";
	$user ="root";
	$pass ="";

	try{
		$db = new PDO($dsn,$user,$pass);
		echo "Connected"

	}catch(PDOExeption $e){
		$errors=$e->getMessage();
		echo $errors;
		exit();
	}
	
?>