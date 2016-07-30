<?php 
session_start();
require_once '../../account/check_user.php';
require_once '../../includes/database.php';

$id_baiviet = $_GET['id'];

$query = $db->prepare('SELECT feature_image FROM post WHERE post_id = :id_baiviet');
$query->bindValue(':id_baiviet', $id_baiviet);
$query->execute();

$result = $query->fetch(PDO::FETCH_ASSOC);

$img = $result['feature_image'];

unlink("../../uploads/thumbnail/".$img);

#######################

$query = "DELETE FROM post WHERE post_id= :id_baiviet";
$records = $db->prepare($query);
$records->bindParam('id_baiviet', $id_baiviet);
$records->execute();

#####################


$db = null;

header('location: .');

exit();
?>