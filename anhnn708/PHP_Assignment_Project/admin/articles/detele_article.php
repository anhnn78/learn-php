<?php 
session_start();
require 'check_user.php';
$id_baiviet = $_GET['id'];

require 'database.php';

$query = "DELETE FROM article WHERE article_id= :id_baiviet";
$records = $db->prepare($query);
$records->bindParam('id_baiviet', $id_baiviet);
$records->execute();

$db = null;

header('location: article.php');

exit();
?>