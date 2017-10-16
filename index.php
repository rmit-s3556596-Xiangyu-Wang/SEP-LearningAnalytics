<!DOCTYPE html>
<html>
<head>
<title>WELCOME</title>
<link rel="stylesheet" href="maincss.css" type="text/css" />
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
	<div class="main">
		<ul id="optionbar">
			<div>
				<a href="programanalysis.html" ;target="upload">Program Analysis</a>
			</div>
			<div>
				<a href="courseanalysis.html" ; target="_blank">Course Analysis</a>
			</div>
		</ul>
	</div>
	<br />
	<br />



	</main>

	<footer>
		<p>
			RMIT - COSC2616 Software Engineering Postgraduate Project - 2017, Sem
			2<br> &copy 2017 <a href="mailto:nebojsa.pajkic@rmit.edu.au">Learning
				Analytics Team</a>
		</p>
	</footer>

</body>
</html>