<?php

	session_start();
	include_once("connect.php");
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Blog - View Post</title>
	</head>
	<body>
		<?php
			if(isset($_SESSION['username'])) {
				$username = $_SESSION['username'];
				echo "<h3>Username| $username</h3>";
			}
			
			require_once("nbbc/nbbc.php");
			
			$bbcode = new BBCode;
			
			$pid = $_GET['pid'];
			
			$sql = "SELECT * FROM posts WHERE id=$pid LIMIT 1";
			
			$res = mysqli_query($conn, $sql) or die(mysqli_error());

			if(mysqli_num_rows($res) > 0) {
				while($row = mysqli_fetch_assoc($res)) {
					$id = $row['id'];
					$title = $row['title'];
					$content = $row['content'];
					$date = $row['date'];
					
					if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
						$admin = "<div><a href='del_post.php?pid=$id'>Delete</a>&nbsp;<a href='edit_post.php?pid=$id'>Edit</a></div>";
					}else{
						$admin = "";
					}
					
					$output = $bbcode->Parse($content);
					
					echo "<div><h2>$title<h3>$date</h3><p>$output</p>$admin<h4><a href='index.php'>Return</a></h4><hr/></h2></div>";
				}
			}else{
				echo "There are no posts to display!";
			}
			
			if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
				echo "<a href='admin.php'>Admin</a> <a href='logout.php'>Logout</a>";
			}else if(isset($_SESSION['username'])) {
				echo "<a href='login.php'>Logout</a>";
			}else{
				echo "<a href='login.php'>Login</a>";
			}
			
		?>
	</body>
</html>