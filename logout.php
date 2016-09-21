<?php
	session_start();
	session_destroy();
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>AlBlog - Logout</title>
	
	<!-- Link bootstrap and modified css -->
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/style.css" />
</head>
<body>

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<a href="#" class="navbar-brand">PHP Test</a>
		</div>
		<ul class="nav navbar-nav">
			<li class="active"><a href="#">Home</a></li>
			<li><a href="#">Page 1</a></li>
			<li><a href="#">Page 2</a></li>
			<li><a href="#">Page 3</a></li>
		</ul>
	</div>
</nav>

<meta http-equiv="refresh" content="1;url=index.php"/>
<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<h1>Logging out...</h1>
		</div>
	</div>
</div>

<!-- Link jquery and modified script -->
<script src="js/jquery-3.1.0.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/app.js"></script>

</body>
</html>