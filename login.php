<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>RMIT - Learning Analytics</title>
<link rel="stylesheet" href="css.css" type="text/css" />
<script>
	function checkEmail() {
		"use strict";
		var input;
		input = document.getElementById("email").value;
		if (input.endsWith("@rmit.edu.au")) {
			console.log("Email validated.");
			document.getElementById("warning").innerHTML = "&nbsp";
			return true;
		} else {
			console.log("Incorrect email entered.");
			document.getElementById("warning").innerHTML = "Email address must end with @rmit.edu.au";
			return false;
		}
	}
</script>
</head>
<body>

	<header> RMIT - Learning Analytics </header>

	<main>
	<p>Login using your RMIT email and password.</p>
	<div class="login">
		<form action="upload.php" method="post"
			onsubmit="return checkEmail();">
			<p>
				<label for="username">Staff email:</label>
			</p>
			<input type="email" name="email" id="email" autofocus
				autocomplete="on" placeholder="@rmit.edu.au" required
				title="RMIT email address">
			<p id="warning">&nbsp</p>

			<p>
				<label for="password">Password:</label>
			</p>
			<input type="password" name="password" id="password" required
				title="Your password">
			<p id="warning">&nbsp</p>

			<p class="center">
				<input type="reset" value="Clear">&nbsp<input type="submit"
					value="Submit" onclick="checkEmail()">
			</p>

		</form>
	</div>
	</main>

	<footer>
<?php include("footer.php"); ?>
</footer>

</body>
</html>
