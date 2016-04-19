<!DOCTYPE html>
<html>
<head>
<title>Candidateboard poll</title> <!-- Include CSS File Here-->
<link href="css/style.css" rel="stylesheet">

<?php
session_start();
$_SESSION['count'] = 0;
$_SESSION['voted']=FALSE;
if(!isset($_SESSION['voted'])){
	$_SESSION['voted'] = FALSE;
}
if(isset($_SESSION['message'])){
	ECHO "<script type='text/javascript'>alert('".$_SESSION['message']."');</script>";
	unset($_SESSION['message']);
}
?>
</head>
<body>
	<div class="main">
	<h2>Candidateboard poll</h2>
		<form action="start_vote.php" method="post">
			<input class="inputBox" name="myusername" type="text" placeholder="Name">
			<input class="inputBox" name="mypassword" type="text" placeholder="Access code">
			<input name="submit" type="submit" value="Login">
		</form>
	</div>
</body>
</html>
