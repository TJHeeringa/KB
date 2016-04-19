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
	<h2>Candidateboard poll</h2>
		<form action="start_vote.php" method="post">
			<input class="inputBox" name="myusername" type="text" value="">
			<input class="inputBox" name="mypassword" type="text" value="">
			<input name="submit" type="submit" value="Login">
		</form>
	</div>
</body>
</html>
