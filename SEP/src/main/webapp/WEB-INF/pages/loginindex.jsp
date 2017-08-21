<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
	pageEncoding="ISO-8859-1"%>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Learning Analytics Login Page</title>
<link rel="stylesheet" type="text/css" href="../login.css" />
</head>
<body>
	<h1>Learning Analytics Login Page</h1>
	<div class="login">
		<form:form class="form-signin" method="post" role="form">
			<p>Username:</p>
			<div>
				<input type="text" name="username" id="name" required autofocus placeholder="s123456">
			</div>
			<p>Password:</p>
			<div>
				<input type="password" name="password" id="pwd" required>
			</div>
			<div class="button">
				<input type="submit" value="login"><input type="reset"
					value="Clear">
			</div>
		</form:form>
	</div>
</body>
</html>