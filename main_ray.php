<!DOCTYPE html>
<html>
<head>
<title>Welcome</title>

<link rel="stylesheet" href="css.css" type="text/css" />
<script type="text/javascript" language="javascript">
    function iFrameHeight() {
        var ifm= document.getElementById("iframeset");
        var subWeb = document.frames ? document.frames["iframeset"].document : ifm.contentDocument;
        if(ifm != null && subWeb != null) {
            ifm.height = subWeb.body.scrollHeight;
            //ifm.width = 1425;
        }
    }
</script>
</head>
<body>
	<header> RMIT - Learning Analytics </header>

	<main>

	<ul>
    <li><a class="active" href="ProgramAnalysis.html" target="upload">Program Analysis</a></li>
    <li><a href="CourseAnalysis.html" target="upload">Course Analysis</a></li>
    <!--<li><a href="./sort_by_student_id.html" target="upload">Sort by student</a></li>-->
    <!--<li><a href="#about">关于</a></li>-->
</ul>
<br /><br />

<iframe id="iframeset" name="upload" src="ProgramAnalysis.html" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
        onLoad="iFrameHeight()" style="width: 100%"></iframe>

	</main>

<footer>
<?php include("footer.php"); ?>
</footer>

</body>
</html>