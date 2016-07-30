<?php 
session_start();

if ($_SESSION['user']['role'] != 1) {
	header('location: ..');
}

require_once '../../includes/database.php';
$id = $_GET['id'];

$delete_user = $db->prepare("DELETE FROM user WHERE user_id = :id");
$delete_user->bindParam(':id', $id);
$delete_user->execute();

$db = null;

header('location: .');
?>