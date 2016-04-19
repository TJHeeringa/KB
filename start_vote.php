<?php
ob_start();
session_start();
$host="localhost"; // Host name
$username="kb"; // Mysql username
$password="kbpw"; // Mysql password
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

$sql = "SELECT name FROM $tbl_name WHERE name='$myusername'";
$query=mysqli_query($con,$sql);
$result = mysqli_fetch_array($query);

if($mypassword=="KB49"){
	if($_SESSION['voted'] == FALSE){
		if ($result == NULL){
			$sql="INSERT INTO $tbl_name (name) VALUES ('$myusername')";
			$result=mysqli_query($con,$sql);
			// Mysql_num_row is counting table row

			// Register $myusername and redirect to file "vote.php"
			$_SESSION['name'] = $myusername;
			header("location:vote.php");
		}else{			
			$_SESSION['message'] = "Please enter a different name.";
			header("location:index.php");
		}
	} else {
		$_SESSION['message'] = "You have already voted.";
		header("location:index.php");
	}
} else {
	$_SESSION['message'] = "Please enter the correct code.";
	header("location:index.php");
}
ob_end_flush();
?>