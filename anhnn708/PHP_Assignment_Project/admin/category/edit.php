<?php
session_start();
require_once '../../account/check_user.php';
require_once '../../includes/database.php';


	$category_name = $_POST['category_name'];

	$query = $db->prepare('SELECT cate_id FROM category ORDER BY cate_id');
	$query->execute();
	$cate_id = $query->fetchAll();var_dump($cate_id);

	for ($i=0; $i < count($category_name); $i++) { 
		$query = $db->prepare('UPDATE category SET cate_name = :category_name
			WHERE cate_id = :cate_id');
		$query->bindParam(':category_name', $category_name[$i]);
		$query->bindParam(':cate_id', $cate_id[$i]['cate_id']);
		$query->execute();
	}

	$db = null;

	header('location: .');
?>