<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form" %>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Login test page</title>

    <!-- 新 Bootstrap 核心 CSS 文件
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="../signin.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">

    <form:form class="form-signin" action="/index/login" method="post" commandName="loginuser" role="form">
        <h2 class="form-signin-heading">Please sign in first！</h2>
        <label for="loginName">Username:</label>
        <input type="text" id="loginName" class="form-control" placeholder="username..." required autofocus>
        <label for="password">password:</label>
        <input type="password" id="password" class="form-control" placeholder="password..." required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form:form>

</div> <!-- /container -->
<%@ page import ="java.sql.*" %>
<%
    String userid = request.getParameter("loginName");    
    String pwd = request.getParameter("password");
    Class.forName("com.postgresql.jdbc.Driver");
    Connection con = DriverManager.getConnection("jdbc:postgresql://ec2-54-221-254-72.compute-1.amazonaws.com:dtb2d40pikkr8",
            "znnuybwdzqhavc", "872a6885f75972f76e867e38ceb6a92a27bc81aedc795dbd2e5fa1317119166e");
    Statement st = con.createStatement();
    ResultSet rs;
    rs = st.executeQuery("select * from user where user_name='" + userid + "' and password='" + pwd + "'");
    if (rs.next()) {
        session.setAttribute("loginName", userid);
        //out.println("welcome " + userid);
        //out.println("<a href='logout.jsp'>Log out</a>");
        response.sendRedirect("home.jsp");
    } else {
        out.println("Invalid password <a href='index.jsp'>try again</a>");
    }
%>

<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
