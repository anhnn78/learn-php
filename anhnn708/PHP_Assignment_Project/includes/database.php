<?php
$dsn = 'mysql:host=localhost;dbname=assignment';
$username = 'root';
$passwd = '';

try {
	$db = new PDO($dsn, $username, $passwd);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->exec("set names utf8");
} catch (PDOException $e) {
	echo $e->getMessage();
}

?>