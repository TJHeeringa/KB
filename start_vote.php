<?php
ob_start();
session_start();
$host="localhost"; // Host name
$username="kb"; // Mysql username
$password="kbpw"; // Mysql password
#$username="symfony"; // Mysql username
#$password="symfonypw"; // Mysql password
$db_name="kb"; // Database name
$tbl_name="users"; // Table name

// Connect to server and select databse.
$con = mysqli_connect("$host", "$username", "$password", "$db_name");

// Define $myusername and $mypassword
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($con, $myusername);
$mypassword = mysqli_real_escape_string($con, $mypassword);

if($mypassword=="KB49"){
	if($_SESSION['voted'] == FALSE){
		$sql="INSERT INTO $tbl_name (name) VALUES ('$myusername')";
		$result=mysqli_query($con,$sql);
		// Mysql_num_row is counting table row

		// Register $myusername and redirect to file "vote.php"
		$_SESSION['name'] = $myusername;
		header("location:vote.php");
	} else {
		header("location:index.php");
		echo "Already voted";
	}
} else {
	header("location:index.php");
}
ob_end_flush();
?>