<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login test page</title>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="../signin.css" rel="stylesheet">
</head>
<body>
<div class="container">

    <form:form class="form-signin" action="login.spring" method="post" modelAndView="user" commandName="loginuser" role="form">
        <h2 class="form-signin-heading">Please sign in first！</h2>
        <label for="username">Username:</label>
        <input type="text" name="username" id="user_name" class="form-control" placeholder="username..." required autofocus>
        <label for="password">password:</label>
        <input type="password" name="password" id="user_password"class="form-control" placeholder="password..." required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form:form>

</div> <!-- /container -->

<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
