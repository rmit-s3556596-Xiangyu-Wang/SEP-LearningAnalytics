<?php
$city = 'London';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Manipulating Values</title>
<link href="../../styles/exercises.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Using Functions</h1>
<p><span class="label">Original value:</span> 

<?php echo $city; 
// this is a comment ?>

</p>
<p><span class="label">Uppercase:</span>      <?php echo strtoupper($city); 
/* This is a second 
 * comment
 */?></p>
<?php $converted = strtoupper($city); 
# hello, this is a third comment
?>
<p><span class="label">Converted:</span>      <?php echo $converted; ?></p>
<p><span class="label">Original value:</span> <?php echo $city; ?></p>
</body>
</html>