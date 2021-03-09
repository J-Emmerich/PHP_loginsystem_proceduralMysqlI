<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Me</title>
</head>
<body>
    
<header>
<nav>
<a href="img.jpg"></a>
<ul>
<li><a href="#">Home</a></li>
<li><a href="#">Portfolio</a></li>
<li><a href="#">About Us</a></li>
<li><a href="#">Contact</a></li>
</ul>
<div>
<form action="includes/login.inc.php" method="post">
<input type="text" name="mailuid" placeholder="Username or Email">
<input type="password" name="pwd" placeholder="password">
<button type="submit" name="login-submit">Login</button>
</form>
<a href="signup.php">Signup</a>

<form action="includes/logout.inc.php" method="post">
<button type="submit" name="logout-submit">Logout</button>
</form>

</div>
</nav>
</header>
