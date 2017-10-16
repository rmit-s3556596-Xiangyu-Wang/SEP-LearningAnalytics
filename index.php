<!DOCTYPE html>
<html>
<head>
<title><?php include("header.php"); ?></title>
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
	<div class="container">
		<header><?php include("header.php"); ?></header>

		<section class="content">
			<div class="main">
				<div class="middle">
					<p class="titles">
						Enter <a href="programanalysis.php">Program Analysis</a> or <a
							href="courseanalysis.php">Course Analysis</a> page
					</p>
				</div>
			</div>
		</section>
		<footer>
		<?php include("footer.php"); ?>
		</footer>
	</div>
</body>
</html>