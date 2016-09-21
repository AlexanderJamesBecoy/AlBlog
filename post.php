<?php
	session_start();
	include_once("connect.php");
	
	if(!isset($_SESSION['username'])) {
		header("Location: login.php");
		return;
	}
	
	if(isset($_POST['post'])) {
		$title = strip_tags($_POST['title']);
		$content = strip_tags($_POST['content']);
		
		$title = mysqli_real_escape_string($conn, $title);
		$content = mysqli_real_escape_string($conn, $content);
		
		$date = date('F j Y\, h:iA');
		$user_id = $_SESSION['username'];
		
		$sql = "INSERT into posts (title, content, date, user_id) VALUES ('$title', '$content', '$date', '$user_id')";
		
		if($title == "" || $content == "") {
			echo "Please complete your post!";
			return;
		}
		
		mysqli_query($conn, $sql);
		
		header("Location: index.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Blog - Post</title>
	</head>
	<body>
		<form action="post.php" method="post" enctype="multipart/form-data">
			<input placeholder="Title" name="title" type="text" autofocus size="48"><br/><br/>
			<textarea placeholder="Content" name="content" rows="20" cols="50"></textarea><br/>
			<input name="post" type="submit" value="Post">
		</form>
	</body>
</html>