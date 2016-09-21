<?php
	session_start();
	include_once("connect.php");
	
	if(!isset($_SESSION['username'])) {
		header("Location: login.php");
		return;
	}
	
	if(!isset($_GET['pid'])) {
		header("Location: index.php");
	}else{
		$pid = $_GET['pid'];
		$sql = "DELETE FROM posts WHERE id=$pid";
		mysqli_query($conn, $sql);
		header("Location: index.php");
	}
?>