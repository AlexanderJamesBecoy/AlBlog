<?php
	if(isset($_SESSION['id'])) {
		header("Location: index.php");
	}
	
	if(isset($_POST['register'])) {
		include_once("connect.php");
		
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
		$password_confirm = strip_tags($_POST['password_confirm']);
		$email = strip_tags($_POST['email']);
		
		$username = stripslashes($username);
		$password = stripslashes($password);
		$password_confirm = stripslashes($password_confirm);
		$email = stripslashes($email);
		
		$username = mysqli_real_escape_string($conn, $username);
		$password = mysqli_real_escape_string($conn, $password);
		$password_confirm = mysqli_real_escape_string($conn, $password_confirm);
		$email = mysqli_real_escape_string($conn, $email);
		
		$password = md5($password);
		$password_confirm = md5($password_confirm);
		
		$sql_store = "INSERT into users (username, password, email) VALUES ('$username', '$password', '$email')";
		$sql_fetch_username = "SELECT username FROM users WHERE username = '$username'";
		$sql_fetch_email = "SELECT email FROM users WHERE email = '$email'";
		
		$query_username = mysqli_query($conn, $sql_fetch_username);
		$query_email = mysqli_query($conn, $sql_fetch_email);
		
		if(mysqli_num_rows($query_username)) {
			echo "There is already a user with that name!";
			return;
		}
		
		if($username == "") {
			echo "Please insert a username.";
			return;
		}
		
		if($password == "" || $password_confirm == "") {
			echo "Please insert your password.";
			return;
		}
		
		if($password != $password_confirm) {
			echo "The passwords do not match!";
			return;
		}
		
		if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $email == "") {
			echo "This email is not valid!";
			return;
		}
		
		if(mysqli_num_rows($query_email)) {
			echo "That email is already in use!";
			return;
		}
		
		mysqli_query($conn, $sql_store);
		header("Location: index.php");
		
	}

?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Alblog - Register</title>
	
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
			<h1>Register</h1>
			<form action="register.php" method="post" enctype="multipart/form-data">
			<input placeholder="Username" name="username" type="text" autofocus><br/>
			<input placeholder="Password" name="password" type="password"><br/>
			<input placeholder="Confirm Password" name="password_confirm" type="password"><br/>
			<input placeholder="Email Address" name="email" type="text"><br/>
			<input name="register" type="submit" value="Register">
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