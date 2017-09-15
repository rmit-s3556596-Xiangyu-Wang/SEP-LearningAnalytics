<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>RMIT - Learning Analytics</title>
<link rel="stylesheet" href="css.css" type="text/css" />
</head>
<body>

	<header> RMIT - Learning Analytics </header>

	<main>
	<p>Login using your RMIT email and password.</p>
	<div class="login">
		<form>
			<p><label for="username">Staff email:</label></p>
			<input type="email" name="username" id="username" autofocus autocomplete="on" placeholder="@rmit.edu.au" required title="RMIT email address">

			<p><label for="password">Password:</label></p>
			<input type="password" name="password" id="password" required>
			
			<p class="center"><input type="reset" value="Clear">&nbsp<input type="submit" value="Submit" title="Your password"></p>

		</form>
	</div>
	</main>

	<footer>
<?php include("footer.php"); ?>
</footer>

</body>
</html>