<?php
if (isset($_POST['sendname'])) {
	$name = trim($_POST['name']);
	if (empty($name)) {
		$name = 'stranger';
	}
	$hour = date('G');
	if ($hour > 23 || $hour < 5) {
		$greeting = "Wow, you're up late,";
	} elseif ($hour < 7) {
		$greeting = 'Good morning, early-bird,';
	} elseif ($hour < 12) {
		$greeting = 'Good morning,';
	} elseif ($hour < 18) {
		$greeting = 'Good afternoon,';
	} else {
		$greeting = 'Good evening,';
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Dynamic form</title>
<link href="../../styles/exercises.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Welcome</h1>
<?php if (isset($name)) { 
	echo "<p>$greeting $name</p>";
} else {
?>
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <p>
        <label for="name">Enter your name:</label>
        <input type="text" name="name" id="name">
    </p>
    <p>
        <input type="submit" name="sendname" id="sendname" value="Submit">
    </p>
</form>
<?php } ?>
</body>
</html>