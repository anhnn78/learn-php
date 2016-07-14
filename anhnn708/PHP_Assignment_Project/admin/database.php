<?php 
$dsn = 'mysql:host=localhost;dbname=news_website';
$username = 'root';
$password = '';

try {
	$db = new PDO($dsn, $username, $password);
	echo "Connected";
} catch (PDOException $e) {
	$errors = $e->getMessage();
	echo $error;
}

?>