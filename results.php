<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Vote results</title>

<?php 
session_start();
$host="localhost"; // Host name
$username="kb"; // Mysql username
$password="kbpw"; // Mysql password
$db_name="kb"; // Database name
$tbl_name="users"; // Table name

// Connect to server and select databse.
$con = mysqli_connect("$host", "$username", "$password", "$db_name");

$sql = "SELECT choice FROM $tbl_name";
$query=mysqli_query($con,$sql);
$pizza = array();
while ($row = mysqli_fetch_assoc($query)) {
	$pizza[] = [str_split($row["choice"])];
}
$cheetahFunction = array(); 
foreach ($pizza as $ingredient){
	for($i=0;$i<=6;$i++){
		$cheetahFunction[$i][] = $ingredient[0][$i];
	}
}
for($i=0;$i<=6;$i++){
	if($cheetahFunction != NULL){
		$cheetahFunctionVote[$i] = array_count_values($cheetahFunction[$i]);
	}
}
$cheetahFunctionName = array("1"=>"Arnout Franken",
								"2"=>"Douwe Hut",
								"3"=>"Henk Jonker",
								"4"=>"Jochem Schutte",
								"5"=>"Juliet van der Rijst",
								"6"=>"Lotte Weedage",
								"7"=>"Maaike van der Ven",
								"8"=>"Mariya Karlashchuk",
								"9"=>"Steven Horstink",
								"A"=>"Wouter van Harten",
								"B"=>"Yanna Kraakman");
$data2 = array();
if($cheetahFunction != NULL){
	for($i=0;$i<=6;$i++){
		$data2[$i] = "";
		foreach ($cheetahFunctionName as $key => $name){
			if(isset($cheetahFunctionVote[$i][$key])){
				$data2[$i] .= "{ label: '".$name."', data:".$cheetahFunctionVote[$i][$key]."},";
			}else{
				$data2[$i] .= "{ label: '".$name."', data:0},";
			}
		}
	}
}else{
	for($i=0;$i<=6;$i++){
		$data2[$i] = "{ label: 'Onbekend', data:1},";
	}
}

if(isset($_POST['submit'])){	
	if ($_POST['submit'] =="Next function"){
		if ($_SESSION['resultCount']<6){
			$_SESSION['resultCount'] += 1;
		}
	}
	if ($_POST['submit'] =="Previous function"){
		if ($_SESSION['resultCount']>0){
			$_SESSION['resultCount'] -= 1;
		}
	}	
}else{
	$_SESSION['resultCount'] = 0;
}
$kbFunctions = array("Voorzitter","Secretaris","Penningmeester","Extern","Onderwijs","Intern","Boeken");
?>

<link href="css/style.css" rel="stylesheet">
 
<!--[if lte IE 8]><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/flot/0.8.2/excanvas.min.js"></script><![endif]-->
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/flot/0.8.2/jquery.flot.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/flot/0.8.2/jquery.flot.pie.min.js"></script>  
<script type="text/javascript">
$(document).ready(function () {
	var data = [<?php echo $data2[$_SESSION['resultCount']] ?>
	];
	
	function labelFormatter(label, series) {
        return("<div style='font-size:24pt; text-align:center; padding:2px; color:black;'>" +label+ '<br/>' + series.data[0][1] + '</div>');
    }

    $.plot($("#resultPlot"), data, {
        series: {
            pie: {
				radius: 7/8,
                show: true,
				label:{
					show:true,
					radius: 2/4,
					formatter: labelFormatter,
					threshold:0.15
				}
            }
		}, legend: {
			show: false
		}
        
    });
	
});
</script>
</head>
  
<body>
<div class="container">
	<div class="main">
		<h2><?php ECHO $kbFunctions[$_SESSION['resultCount']]?></h2>
		<div class="inputBox" id="resultPlot"></div>
		<form action="results.php" method="post">
			<input name="submit" type="submit" value="Next function">
		</form>
		<form action="results.php" method="post">
			<input name="submit" type="submit" value="Previous function">
		</form>
	</div>
</div>
</body>
</html>