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
</head>
<body>
	<div class="container">
		<header><?php include("header.php"); ?></header>

		<section class="content">
			<div class="main">
				<div class="middle">
					<h1>
						Enter Program Analysis <a href="programanalysis.php">Windows</a>/<a href="programanalysis_mac.php">Mac OS</a> page<br/>
                        &nbsp;&nbsp;or Course Analysis <a href="courseanalysis.php">Windows</a>/<a href="courseanalysis_mac.php">Mac OS</a> page
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