<?php 
$dsn = 'mysql:host=localhost;dbname=news_website';
$username = 'root';
$password = '';

try {
	$db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
	$errors = $e->getMessage();
	exit();
}

?>