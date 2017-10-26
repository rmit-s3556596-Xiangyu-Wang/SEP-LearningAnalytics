<!DOCTYPE html>
<html lang="en">
<head>
<title><?php include("header.php"); ?></title>
<link rel="stylesheet" href="css.css" type="text/css" />
<script>
        function iFrameHeight() {
            var ifm= document.getElementById("iframeset");
            var subWeb = document.frames ? document.frames["iframeset"].document : ifm.contentDocument;
            if(ifm != null && subWeb != null) {
                ifm.height = subWeb.body.scrollHeight;
                //ifm.width = 1425;
            }
        }
    </script>
<!--    <script>-->
<!--        var OSName="Unknown OS";-->
<!--        if (navigator.appVersion.indexOf("Win")!=-1) {-->
<!--            OSName = "Windows";-->
<!--            document.getElementById("program").attributes("href", "./programanalysis.php");-->
<!--            alert(document.getElementById("program").attributes);-->
<!--        }-->
<!--        if (navigator.appVersion.indexOf("Mac")!=-1){-->
<!--            OSName="MacOS";-->
<!--            document.getElementById("course").attributes("href", "./programanalysis_mac.php");-->
<!--        }-->
<!--        if (navigator.appVersion.indexOf("X11")!=-1) OSName="UNIX";-->
<!--        if (navigator.appVersion.indexOf("Linux")!=-1) OSName="Linux";-->
<!--    </script>-->

    <script type="text/javascript">
        var isMac = (navigator.platform.indexOf("MacPPC") != -1) ? true : false;
        if(isMac) location.href = "index_mac.php";
        else location.href = "index.php";
    </script>
</head>
<body>
	<div class="container">
		<header><?php include("header.php"); ?></header>

		<section class="content">
			<div class="main">
				<div class="middle">
                    <h1>
                        Enter<a id="program" href="programanalysis_mac.php">Program Analysis</a> page or <a id="course" href="courseanalysis_mac.php">Course Analysis</a> page
                    </h1>
				</div>
			</div>
		</section>
		<footer>
		<?php include("footer.php"); ?>
		</footer>
	</div>
</body>
</html>