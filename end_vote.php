<!DOCTYPE html>
<html>
<head>
<title>PHP Get Value of Select Option and Radio Button</title> <!-- Include CSS File Here-->
<link href="css/style.css" rel="stylesheet">

<?php
session_start();
$_SESSION['count'] = 0;
$_SESSION['voted']=FALSE;
if(!isset($_SESSION['voted'])){
	$_SESSION['voted'] = FALSE;
}
?>

</head>
<body>
<div class="main">
	<h2>Cheetah quiz</h2>
	<div id="thxContainer">Thank you for voting.</div>
</div>
</body>
</html>
