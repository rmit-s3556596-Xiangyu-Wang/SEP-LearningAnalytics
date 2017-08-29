<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>PHP Time</title>
<link href="../../styles/exercises.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>One-Time Script</h1>
<p>PHP is processed on the web server, so the time indicates only when the page was sent to the browser.</p>
<p>The time is now <?php echo date('H:i:s'); ?></p>
<p>&copy; <?php include 'copyright.php'; ?> Hansel and Petal</p>
</body>
</html>