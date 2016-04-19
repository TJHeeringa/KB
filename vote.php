<!DOCTYPE html>
<html>
<head>
<title>PHP Get Value of Select Option and Radio Button</title>
<link href="css/style.css" rel="stylesheet">
<?php
session_start();
$kbFunctions = array("Voorzitter","Secretaris","Penningmeester","Extern","Onderwijs","Intern","Boeken");
$kbCandidates = array("Arnout Franken","Douwe Hut","Henk Jonker","Jochem Schutte","Juliet van der Rijst","Lotte Weedage","Maaike van der Ven","Mariya Karlashchuk","Steven Horstink","Wouter van Harten","Yanna Kraakman");
if(!isset($_SESSION['count']) or !isset($_SESSION['name'])){
		header("location:index.php");
}

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
$myusername=$_SESSION['name'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$myusername = mysqli_real_escape_string($con, $myusername);

if (isset($_POST['submit'])) {
	if(isset($_POST['radio'])){
		$sql = "SELECT choice FROM $tbl_name WHERE name='$myusername'";
		$query=mysqli_query($con,$sql);
		$result = mysqli_fetch_array($query)['choice'];
		$allChoices = str_split($result);
		$allChoices[$_SESSION['count']-1] = $_POST['radio'];
		$allChoices = join('',$allChoices);
		$sql="UPDATE $tbl_name SET choice='$allChoices' WHERE name='$myusername'";
		$result=mysqli_query($con,$sql);
	}
	else{ 
		echo "<span>Please choose any radio button.</span>";
	}
}

if($_SESSION['count']>=7){
	$_SESSION['voted']=TRUE;
	header("location:end_vote.php");
}
?>
</head>
<body>
<div class="main">
	<h2><?php ECHO $kbFunctions[$_SESSION['count']]?></h2>
	<form action="vote.php" method="post">
			<table>
				<tr>
					<td><input name="radio" type="radio" value="1"></td>
					<td class="image_row" ><?php ECHO $kbCandidates[0]?>
						<div class="image_container"><img src="images/Arnout"></div>
					</td>
				<tr>
				<tr>
					<td><input name="radio" type="radio" value="2"></td>
					<td class="image_row" ><?php ECHO $kbCandidates[1]?>
						<div class="image_container"><img src="images/Douwe"></div>
					</td>
				<tr>
				<tr>
					<td><input name="radio" type="radio" value="3"></td>
					<td class="image_row" ><?php ECHO $kbCandidates[2]?>
						<div class="image_container"><img src="images/Henk"></div>
					</td>
				<tr>
				<tr>
					<td><input name="radio" type="radio" value="4"></td>
					<td class="image_row" ><?php ECHO $kbCandidates[3]?>
						<div class="image_container"><img src="images/Jochem"></div>
					</td>
				<tr>
				<tr>
					<td><input name="radio" type="radio" value="5"></td>
					<td class="image_row" ><?php ECHO $kbCandidates[4]?>
						<div class="image_container"><img src="images/Juliet"></div>
					</td>
				<tr>
				<tr>
					<td><input name="radio" type="radio" value="6"></td>
					<td class="image_row" ><?php ECHO $kbCandidates[5]?>
						<div class="image_container"><img src="images/Lotte"></div>
					</td>
				<tr>
				<tr>
					<td><input name="radio" type="radio" value="7"></td>
					<td class="image_row" ><?php ECHO $kbCandidates[6]?>
						<div class="image_container"><img src="images/Maaike"></div>
					</td>
				<tr>
				<tr>
					<td><input name="radio" type="radio" value="8"></td>
					<td class="image_row" ><?php ECHO $kbCandidates[7]?>
						<div class="image_container"><img src="images/Mariya"></div>
					</td>
				<tr>
				<tr>
					<td><input name="radio" type="radio" value="9"></td>
					<td class="image_row" ><?php ECHO $kbCandidates[8]?>
						<div class="image_container"><img src="images/Steven"></div>
					</td>
				<tr>
				<tr>
					<td><input name="radio" type="radio" value="A"></td>
					<td class="image_row" ><?php ECHO $kbCandidates[9]?>
						<div class="image_container"><img src="images/Wouter"></div>
					</td>
				<tr>
				<tr>
					<td><input name="radio" type="radio" value="B"></td>
					<td class="image_row" ><?php ECHO $kbCandidates[10]?>
						<div class="image_container"><img src="images/Yanna"></div>
					</td>
				<tr>
			</table>
			<input name="submit" type="submit" value="Submit choice">
	</form>
</div>
</body>
<?php
$_SESSION['count']+=1;
?>
</html>
