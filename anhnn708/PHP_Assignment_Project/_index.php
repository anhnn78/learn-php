Trang Chu
<br>
<?php 
session_start();
if (isset($_SESSION['user']['name'])) {
echo "Xin chao ".$_SESSION['user']['name']. " - role = ".$_SESSION['user']['role'];
echo "<br>";
echo "<a href=\"account/logout.php\">Log out</a> <br>";
	if ($_SESSION['user']['role']==1) {
		echo "<a href='admin/index.php'>Quan ly trang web </a> <br>";
	}
} else {
	echo "<a href=\"account/login.php\">Log in</a> or <a href=\"account/register.php\">Register</a>";
}

 ?>

 
 

