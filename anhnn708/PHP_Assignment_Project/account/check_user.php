<?php
if (isset($_SESSION['user'])) {
	if ($_SESSION['user']['role'] > 2) {
		header('location: ..');
	}
} else {
	header('location: ..');
}
?>