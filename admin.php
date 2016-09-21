<?php

	session_start();
	include_once("connect.php");
	
	if(!isset($_SESSION['admin']) && $_SESSION['admin'] != 1) {
		header("Location: login.php");
		return;
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Blog</title>
	</head>
	<body>
		<?php
			$username = $_SESSION['username'];
			echo "<h3>Username| $username</h3>";
			
			$sql = "SELECT * FROM posts ORDER BY id DESC";
			
			$res = mysqli_query($conn, $sql) or die(mysqli_error());
			
			$posts = "";
			
			if(mysqli_num_rows($res) > 0) {
				while($row = mysqli_fetch_assoc($res)) {
					$id = $row['id'];
					$title = $row['title'];
					$date = $row['date'];
					
					$admin = "<div><a href='del_post.php?pid=$id'>Delete</a>&nbsp;<a href='edit_post.php?pid=$id'>Edit</a></div>";
					
					$posts .= "<div><h2><a href='view_post.php?pid=$id' target='_blank'>$title</a><h3>$date</h3>$admin<hr/></h2></div>";
				}
				echo $posts;
			}else{
				echo "There are no posts to display! <a href='post.php'>Post</a>";
			}
		?>
	</body>
</html>