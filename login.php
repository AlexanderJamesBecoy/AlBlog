<?php
	session_start();
	
	if(isset($_POST['login'])) {
		include_once("connect.php");
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
		
		$username = stripslashes($username);
		$password = stripslashes($password);
		
		$username = mysqli_real_escape_string($conn, $username);
		$password = mysqli_real_escape_string($conn, $password);
		
		$password = md5($password);
		
		$sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
		$query = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($query);
		$id = $row['id'];
		$db_password = $row['password'];
		$admin = $row['admin'];
		
		if($password == $db_password) {
			$_SESSION['username'] = $username;
			$_SESSION['id'] = $id;
			if($admin == 1) {
				$_SESSION['admin'] = 1;
			}
			header("Location: index.php");
		}else{
			echo "Incorrect username/password!";
		}
	}
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Alblog - Login</title>
	
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
			echo "<li><a href='register.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>";
			echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Log In</a></li>";
		?>
		</ul>
	</div>
</nav>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h1>Login</h1>
			<form action="login.php" method="post" enctype="multipart/form-data">
				<input placeholder="Username" name="username" type="text" autofocus>
				<input placeholder="Password" name="password" type="password">
				<input name="login" type="submit" value="Login">
			</form>
		</div>
	</div>
</div>

<!-- Link jquery and modified script -->
<script src="js/jquery-3.1.0.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/app.js"></script>

</body>
</html>