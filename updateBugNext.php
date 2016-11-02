<?php
session_start();
if(!isset($_SESSION['logon'])){
   header("Location:index.php");
}

$reportedBy= $bugId=$funcArea=$assignedTo=$resolvedBy=$reportedDate=$resolvedDate=$steps="";
$descr=$descr1=$sql=$sqlAdd=$status=$severity=$modifiedBy="";

	if (isset($_POST['descr']))
		$descr = $_POST["descr"];
	
	if (isset($_POST['descr1']))
	{
		$descr1 = $_POST["descr1"];
		if($descr1!='')
		{
			$descr=$descr.$descr1;
		//echo $descr;
			$sqlAdd=$sqlAdd.", description='$descr'";
		}
	}	
	if (isset($_POST['bugId']))
	{
		$bugId = $_POST["bugId"];
		//echo $bugId;
	}
	if (isset($_POST['status']))
	{
		$status = $_POST["status"];
		if($status!='')
			$sqlAdd=$sqlAdd.", status='$status'";
	}
	if (isset($_POST['funcArea']))
	{
		$funcArea = $_POST["funcArea"];
		if($funcArea!='')
			$sqlAdd=$sqlAdd.", funcArea='$funcArea'";
	}
	if (isset($_POST['severity']))
	{
		$severity = $_POST["severity"];
		if($severity!='')
			$sqlAdd=$sqlAdd.", Severity='$severity'";
	}
	if (isset($_POST['modifiedBy']))
	{
		$modifiedBy = $_POST["modifiedBy"];
		if($modifiedBy!='')
			$sqlAdd=$sqlAdd.", modifiedBy='$modifiedBy'";
	}
	if (isset($_POST['reportedDate']))
	{
		$reportedDate = $_POST["reportedDate"];
		if($reportedDate!='')
			$sqlAdd=$sqlAdd.", reportedDate='$reportedDate'";
	}
	if (isset($_POST['suggested_fix']))
	{
		$steps = $_POST["suggested_fix"];
		if($steps!='')
			$sqlAdd=$sqlAdd.", suggestedFix='$suggested_fix'";
	}
	if (isset($_POST['resolvedBy']))
	{
		$resolvedBy = $_POST["resolvedBy"];
		if($resolvedBy!='')
			$sqlAdd=$sqlAdd.", resolvedBy='$resolvedBy'";
	}
	if (isset($_POST['resolvedDate']))
	{
		$resolvedDate = $_POST["resolvedDate"];
		if($resolvedDate!='')
			$sqlAdd=$sqlAdd.", resolvedDate='$resolvedDate'";
	}
	if (isset($_POST['assignedTo']))
	{
		$assignedTo = $_POST["assignedTo"];
		if($assignedTo!='')
			$sqlAdd=$sqlAdd.", assignedTo='$assignedTo'";
	}
	if (isset($_POST['defered']))
	{
	$reproducible = $_POST["defered"];
	if($reproducible == 'on')
	{
		$status = "defered";
				$sqlAdd=$sqlAdd.", status='defered'";
	}
		
	
	}

//SQL update
		$servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "Test";
		$tbl_name= "Test.bugInfo";
		
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed, Switch on MySQL Server and try again: " . $conn->connect_error);
		}
			
		
		$query1="update $tbl_name set modifiedBy='$modifiedBy'";
		$query2=" where bugId=$bugId;";
		$cdquery=$query1.$sqlAdd;
		$cdquery=$cdquery.$query2;
		//echo $cdquery;
		$display='Home.php';
		echo "<h2><b><a href='$display'>You have successfully updated a Bug, go Home now</a></b></h2>";

		
		$cdresult=mysql_query($cdquery) or die ("Query to get data from $tbl_name failed: ".mysql_error());
			
			
		$conn->close();
	
		
?>