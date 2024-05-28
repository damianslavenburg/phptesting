<html>
	<body>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Please login below</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<div class="container">
		<form method="POST" action="login.php">
			<h2>Please login:</h2>
			<input name="username" placeholder="username">
            <h5 class="error"><?php echo $_GET["username_error"];?></h5>
			<input name="password" placeholder="password" type="password">
            <h5 class="error"><?php echo $_GET["password_error"];?></h5>
			<input type="submit">
			<h6>Don't have an account yet? <a href="signuppage.php">Sign up!</a></h6>
		</form>
	</div>

	</body>
</html>
