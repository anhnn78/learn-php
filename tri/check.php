<?php
	$dsn="mysql:host=localhost;dbname=user";
	$user ="root";
	$pass ="";

	try{
		$db = new PDO($dsn,$user,$pass);
			

	}catch(PDOExeption $e){
		$errors=$e->getMessage();
		echo $errors;
		exit();
	}
	
?>