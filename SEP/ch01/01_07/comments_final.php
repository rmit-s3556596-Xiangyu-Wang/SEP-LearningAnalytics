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
<?php echo $city; ?></p>
<p><span class="label">Uppercase:</span>      
<?php echo strtoupper($city); // Temporary conversion to uppercase ?></p>
<?php 
/* The result of the function is assigned to a new variable.
   Consequently, the original value is preserved in $city. */
$converted = strtoupper($city); ?>
<p><span class="label">Converted:</span>      
<?php echo $converted; ?></p>
<p><span class="label">Original value:</span> 
<?php 
# Original value remains unchanged
# echo $city; ?></p>
</body
></html>