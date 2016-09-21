<?php

session_start();
include_once("connect.php");

if(isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
}

?>


<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Alblog</title>
	
	<!-- Link bootstrap and modified css -->
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/style.css" />
</head>
<body>

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<a href="index.php" class="navbar-brand">Alblog</a>
		</div>
		<ul class="nav navbar-nav">
			<li class="active"><a href="#">Home</a></li>
			<li><a href="#">Page 1</a></li>
			<li><a href="#">Page 2</a></li>
			<li><a href="#">Page 3</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
		<?php
		
			if(isset($_SESSION['username'])) {
				echo "<li class='dropdown'>";
					echo "<a class='dropdown-toggle' data-toggle='dropdown''href='#'>$username
					<span class='caret'></span></a>";
					echo "<ul class='dropdown-menu'>";
						if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
							echo "<li><a href='admin.php'><span class='glyphicon glyphicon-pencil'></span> Admin</a></li>";
						}
						echo "<li><a href='post.php'><span class='glyphicon glyphicon-file'></span> Post</a></li>";
					echo "</ul>
				</li>";
				echo "<li><a href='logout.php'><span class='glyphicon glyphicon-log-in'></span> Logout</a></li>";
			}else{
				echo "<li><a href='register.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>";
				echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Log In</a></li>";
			}
		?>
		</ul>
	</div>
</nav>

<div class="container">
	<div class="row">
		<div class="jumbotron">
		</div>
	</div>
	<div class="row">
		<div class="col-md-9">
			<ul class="blog-posts">
				<?php
				require_once("nbbc/nbbc.php");
				$bbcode = new BBCode;
				
				$sql = "SELECT * FROM posts ORDER BY id DESC";
				
				$res = mysqli_query($conn, $sql) or die(mysqli_error());
				$posts = "";
				
				if(mysqli_num_rows($res) > 0) {
					while($row = mysqli_fetch_assoc($res)) {
						$id = $row['id'];
						$title = $row['title'];
						$content = $row['content'];
						$date = $row['date'];
						$user_id = $row['user_id'];
						
						$output = $bbcode->Parse($content);
						
						$posts .= "<li class='view_post'>
							<div class='jumbotron'>
								<h2><a href='#$id'>$title</a></h2>
								<h4>by <a href='#'>$user_id</a> at $date</h4>
							</div>
							<div class='view_content'>
								<p>$output</p><hr/>
							</div>
						</li>";
					}
					echo $posts;
				}else{
					echo "There are no posts to display!";
				}
				
				?>
			</ul>
		</div>
		<div class="col-md-3">
			<h1>Test</h1>
		</div>
	</div>
</div>

<!-- Link jquery and modified script -->
<script src="js/jquery-3.1.0.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/app.js"></script>

</body>
</html>