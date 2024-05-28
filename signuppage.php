<html>
<body>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Please signup below</title>
    <link rel="stylesheet" href="style.css">
</head>
<div class="container">
    <form method="POST" action="signup.php">
        <h2>Please sign up:</h2>
        <input name="username" placeholder="username">
        <h5 class="error"><?php echo $_GET["username_error"];?></h5>
        <input name="email" placeholder="e-mail">
        <h5 class="error"><?php echo $_GET["email_error"];?></h5>
        <input name="password" placeholder="password" type="password">
        <h5 class="error"><?php echo $_GET["password_error"];?></h5>
        <input name="confirm_password" placeholder="confirm password" type="password">
        <h5 class="error"><?php echo $_GET["confirmpassword_error"];?></h5>
        <input type="submit">
        <h6>Already have an account? <a href="index.php">Sign in instead!</a></h6>
    </form>
</div>

</body>
</html>
