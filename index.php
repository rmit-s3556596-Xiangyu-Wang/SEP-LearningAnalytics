<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php include("header.php"); ?></title>
    <link rel="stylesheet" href="css.css" type="text/css" />
    <script>
        var OSName="Unknown OS";
        if (navigator.appVersion.indexOf("Win")!=-1) OSName="Windows";
        if (navigator.appVersion.indexOf("Mac")!=-1) OSName="MacOS";
        if (navigator.appVersion.indexOf("X11")!=-1) OSName="UNIX";
        if (navigator.appVersion.indexOf("Linux")!=-1) OSName="Linux";
    </script>
    <script type="text/javascript">
        var isChrome = navigator.userAgent.toLowerCase().match(/chrome/) != null;
        var message = "*We highly recommend you to use Google Chrome to get best experience.";
        var isIE = window.ActiveXObject != undefined && ua.indexOf("MSIE") != -1;
    </script>
    <script>

    </script>
    <script>
        function navigatorProgram() {
            if(OSName=="Windows") {
                window.location="programanalysis.php"
            }
            else {
                window.location="programanalysis_mac.php"
            }
        }

        function navigatorCourse() {
            if(OSName=="Windows") {
                window.location="courseanalysis.php"
            }
            else {
                window.location="courseanalysis_mac.php"
            }
        }
    </script>
</head>
<body>
<div class="container">
    <header><?php include("header.php"); ?></header>
    <section class="content">
        <div class="main">
            <p id="bversion" style="text-align: center">
                <script type="text/javascript">
                    if (!isChrome||isIE) {
                        document.write(message);
                        document.write("<br/>");
                    }
                </script>
            </p>
            <div class="middle">

                <h1>
                Enter <a href="javascript:navigatorProgram();">Program Analysis</a> page or <a href="javascript:navigatorCourse();">Course Analysis</a> page
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