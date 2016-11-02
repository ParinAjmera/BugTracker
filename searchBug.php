<?php
session_start();
if(!isset($_SESSION['logon'])){
   header("Location:index.php");
}

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Test";
$tbl_name= "Test.bugInfo";


// define variables and set to empty values
$nameErr = $passErr = $employErr = "";
$pgm = $reportType = $status= $funcArea= $assignedTo = $resolvedBy= $product= $pgmRel= $version= $bugId="";
$reportedDate= $resolvedDate= $severity=$reportedBy="";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed, Switch on MySQL Server and try again: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["Program"])) {
        $pgmErr = "SELECT Program";
    }else {
        $pgm = $_POST["Program"];
    }

    if (empty($_POST["status"])) {
        $statusErr = "Select status please";
    }else {
        $status = test_input($_POST["status"]);
    }
    if (empty($_POST["funcArea"])) {
    	$FAErr = "SELECT funcArea";
    }else {
    	$funcArea = $_POST["funcArea"];
    }
    
    if (empty($_POST["assignedTo"])) {
    	$ATErr = "select assignedTo";
    }else {
    	$assignedTo = $_POST["assignedTo"];
    }
    
    if (empty($_POST["resolvedBy"])) {
    	$statusErr = "Select resolvedBy please";
    }else {
    	$resolvedBy = test_input($_POST["resolvedBy"]);
    }
    if (empty($_POST["reportedBy"])) {
    	
    }else {
    	$reportedBy = test_input($_POST["reportedBy"]);
    } 
    
    if (empty($_POST["reportedDate"])) {
    	$RDErr = "select reportedDate";
    }else {
    	$reportedDate = $_POST["reportedDate"];
    }
    
    if (empty($_POST["resolvedDate"])) {
    	$RVDErr = "Select resolvedDate please";
    }else {
    	$resolvedDate = test_input($_POST["resolvedDate"]);
    }
  	if (empty($_POST["product"])) {
    	
    }else {
    	$resolvedBy = test_input($_POST["product"]);
    }
    if (empty($_POST["pgmRel"])) {
    	
    }else {
    	$pgmRel = $_POST["pgmRel"];
    }
    
    if (empty($_POST["version"])) {
    	
    }else {
    	$version = test_input($_POST["version"]);
    }
    if (empty($_POST["bugId"])) {
    	 
    }else {
    	$bugId = test_input($_POST["bugId"]);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function test_null($data)
{
	if(!$data)
		return 1;
	else return 0;
}



// sql to display search results here
/*
 * Note: I am not doing this here anymore, doing it in searchResult.php
$sql = "select * from $tbl_name where bugId=$bugId;";

if(mysqli_query($conn,$sql))
{
	$cdresult=mysqli_query($conn,$sql) or die ("Query to get data from firsttable failed: ".mysql_error());
    echo "<table>\n";
    echo "<tr><td>(BugId) Name</td></tr>\n";
    while ($myrow = mysqli_fetch_row($cdresult)) {
         printf("<tr><td><a href=\"old_rec.php?ID=%s\">(%s)     
           %s</a></td></tr>\n", $myrow[4], $myrow[0], $myrow[1]);
    }
    echo "</table>\n";
 
	
			
	}
		
	

else 
	echo "Failed :( ";

*/
	
$conn->close();
include_once('header.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
  jumbotron {
     background-image: url("paper.gif");
    background-color: #cccccc;
  }
   container {
   padding-right: 15px;
   padding-left: 15px;
   margin-right: auto;
   margin-left: auto;
}
  .bg-grey {
      background-color: #bde9ba;
  }

  input, select, textarea {
	background-color: #cccccc;
}
  </style>
    
    <title>Search A Bug</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
</head>

<body>

	<div class="jumbotron text-center">
    
    <h2>Search A Bug</h2>
    </br></br>
   
    <form class="form-horizontal" role="form" method="post" action="searchResult.php">
    
                 <div class="row">
            <div class="form-group" >
                <label for="bugId" class="col-sm-2 control-label">Bug ID </label>
                <div class="col-sm-8">               	
                    <select class="form-control" id="bugId" name="bugId">
                        <?php
                        
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
							
							$cdquery="select distinct bugId from $tbl_name;";
							$cdresult=mysql_query($cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
							echo "<option></option>";
							while ($cdrow=mysql_fetch_array($cdresult)) {
								$cdTitle=$cdrow[0];		
								if($cdTitle)
									echo "<option>$cdTitle</option>";
								
							
							}
							
							$conn->close();
							?>                     
                    </select>
                 	 
                </div>
            </div>
        </div>
    
    
              <div class="row">
            <div class="form-group" >
                <label for="funcArea" class="col-sm-2 control-label">Functional Area</label>
                <div class="col-sm-8">               	
                    <select class="form-control" id="funcArea" name="funcArea">
                        <?php
                        
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
							
							$cdquery="select distinct funcArea from $tbl_name;";
							$cdresult=mysql_query($cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
							echo "<option></option>";
							while ($cdrow=mysql_fetch_array($cdresult)) {
								$cdTitle=$cdrow[0];	
								if($cdTitle)
									echo "<option>$cdTitle</option>";
								
							
							}
							
							$conn->close();
							?>                     
                    </select>
                    <?php echo "<p class='text-danger'>$funcArea</p>";?>
                </div>
            </div>
        </div>


      <div class="row">
            <div class="form-group" >
                <label for="assignedTo" class="col-sm-2 control-label">Assigned To</label>
                <div class="col-sm-8">               	
                    <select class="form-control" id="assignedTo" name="assignedTo">
                        <?php
                        
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
							
							$cdquery="select distinct assignedTo from $tbl_name;";
							$cdresult=mysql_query($cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
							echo "<option></option>";
							while ($cdrow=mysql_fetch_array($cdresult)) {
								$cdTitle=$cdrow[0];					
								if($cdTitle)
									echo "<option>$cdTitle</option>";
								
							
							}
							
							$conn->close();
							?>                     
                    </select>
                    <?php echo "<p class='text-danger'>$assignedTo</p>";?>
                </div>
            </div>
        </div>

      <div class="row">
            <div class="form-group" >
                <label for="reportedBy" class="col-sm-2 control-label">Reported By</label>
                <div class="col-sm-8">               	
                    <select class="form-control" id="reportedBy" name="reportedBy">
                        <?php
                        
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
							
							$cdquery="select distinct reportedBy from $tbl_name;";
							$cdresult=mysql_query($cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
							echo "<option></option>";
							while ($cdrow=mysql_fetch_array($cdresult)) {
								$cdTitle=$cdrow[0];					
								if($cdTitle)
									echo "<option>$cdTitle</option>";
								
							
							}
							
							$conn->close();
							?>                     
                    </select>
                    <?php echo "<p class='text-danger'>$reportedBy</p>";?>
                </div>
            </div>
        </div>

      <div class="row">
            <div class="form-group" >
                <label for="resolvedBy" class="col-sm-2 control-label">Resolved By</label>
                <div class="col-sm-8">               	
                    <select class="form-control" id="resolvedBy" name="resolvedBy">
                        <?php
                        
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
							
							$cdquery="select distinct resolvedBy from $tbl_name;";
							$cdresult=mysql_query($cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
							echo "<option></option>";
							while ($cdrow=mysql_fetch_array($cdresult)) {
								$cdTitle=$cdrow[0];					
								if($cdTitle)
									echo "<option>$cdTitle</option>";
								
							
							}
							
							$conn->close();
							?>                     
                    </select>
                    <?php echo "<p class='text-danger'>$resolvedBy</p>";?>
                </div>
            </div>
        </div>

      <div class="row">
            <div class="form-group" >
                <label for="reportedDate" class="col-sm-2 control-label">Reported Date</label>
                <div class="col-sm-8">               	
                    <select class="form-control" id="reportedDate" name="reportedDate">
                        <?php
                        
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
							
							$cdquery="select distinct reportedDate from $tbl_name;";
							$cdresult=mysql_query($cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
							echo "<option></option>";
							while ($cdrow=mysql_fetch_array($cdresult)) {
								$cdTitle=$cdrow[0];					
								if($cdTitle)
									echo "<option>$cdTitle</option>";
								
							
							}
							
							$conn->close();
							?>                     
                    </select>
                    <?php echo "<p class='text-danger'>$reportedDate</p>";?>
                </div>
            </div>
        </div>

      <div class="row">
            <div class="form-group">
                <label for="resolvedDate" class="col-sm-2 control-label">Resolved Date</label>
                <div class="col-sm-8">               	
                    <select class="form-control" id="resolvedDate" name="resolvedDate">
                        <?php
                        
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
							
							$cdquery="select distinct resolvedDate from $tbl_name;";
							$cdresult=mysql_query($cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
							echo "<option></option>";
							while ($cdrow=mysql_fetch_array($cdresult)) {
								$cdTitle=$cdrow[0];					
								if($cdTitle)
									echo "<option>$cdTitle</option>";
								
							
							}
							
							$conn->close();
							?>                     
                    </select>
                    <?php echo "<p class='text-danger'>$resolvedDate</p>";?>
                </div>
            </div>
        </div>
        	
        <div class="row">
            <div class="form-group" >
                <label for="Program" class="col-sm-2 control-label">Program Name</label>
                <div class="col-sm-8">               	
                    <select class="form-control" id="Program" name="Program">
                        <?php
                        
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
							
							$cdquery="select distinct PgmName from $tbl_name;";
							$cdresult=mysql_query($cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
							echo "<option></option>";
							while ($cdrow=mysql_fetch_array($cdresult)) {
								$cdTitle=$cdrow[0];					
								if($cdTitle)
									echo "<option>$cdTitle</option>";
								
							
							}
							
							$conn->close();
							?>                     
                    </select>
                    <?php echo "<p class='text-danger'>$pgm</p>";?>
                </div>
            </div>
        </div>

        
            <div class="row">
            <div class="form-group" >
                <label for="status" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-8">               	
                    <select class="form-control" id="status" name="status">
                        <?php
                        
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
							
							$cdquery="select distinct status from $tbl_name;";
							$cdresult=mysql_query($cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
							echo "<option></option>";
							while ($cdrow=mysql_fetch_array($cdresult)) {
								$cdTitle=$cdrow[0];					
								if($cdTitle)
									echo "<option>$cdTitle</option>";															
							}
							
							$conn->close();
							?>                     
                    </select>
                    <?php echo "<p class='text-danger'>$status</p>"; ?>
                </div>
            </div>
            </div>


       		 <div class="row">
            <div class="form-group" >
                <label for="status" class="col-sm-2 control-label">Version</label>
                <div class="col-sm-8">               	
                    <select class="form-control" id="version" name="version">
                        <?php
                        
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
							
							$cdquery="select distinct version from $tbl_name;";
							$cdresult=mysql_query($cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
							echo "<option></option>";
							while ($cdrow=mysql_fetch_array($cdresult)) {
								$cdTitle=$cdrow[0];					
								if($cdTitle)
									echo "<option>$cdTitle</option>";
								
							
							}
							
							$conn->close();
							?>                     
                    </select>
                    <?php echo "<p class='text-danger'>$version</p>"; ?>
                </div>
            </div>
            </div>
			

  
			 <div class="row">
            <div class="form-group" >
                <label for="status" class="col-sm-2 control-label">Release</label>
                <div class="col-sm-8">               	
                    <select class="form-control" id="pgmRel" name="pgmRel">
                        <?php
                        
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
							
							$cdquery="select distinct pgmRel from $tbl_name;";
							$cdresult=mysql_query($cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
							echo "<option></option>";
							while ($cdrow=mysql_fetch_array($cdresult)) {
								$cdTitle=$cdrow[0];					
								if($cdTitle)
									echo "<option>$cdTitle</option>";
															
							}
							
							$conn->close();
							?>                     
                    </select>
                    <?php echo "<p class='text-danger'>$pgmRel</p>"; ?>
                </div>
            </div>
            </div>
	
			<div class="row">
            <div class="form-group" >
                <label for="status" class="col-sm-2 control-label">Severity</label>
                <div class="col-sm-8">               	
                    <select class="form-control" id="severity" name="severity">
                        <?php
                        
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
							
							$cdquery="select distinct severity from $tbl_name;";
							$cdresult=mysql_query($cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
							echo "<option></option>";
							while ($cdrow=mysql_fetch_array($cdresult)) {
								$cdTitle=$cdrow[0];					
								if($cdTitle)
									echo "<option>$cdTitle</option>";															
							}
							
							$conn->close();
							?>                     
                    </select>
                    <?php echo "<p class='text-danger'>$severity</p>"; ?>
                </div>
            </div>
            </div>
			
		<div class="row">
            <div class="col-sm-1 col-sm-offset-4">
                <button id="submit" name="submit" type="Submit" class="btn btn-primary">Search</button>           
            </div>

            <div class="col-sm-1">
                 <button type="Reset" id="Reset" name="reset" class="btn btn-primary">Reset</button>           
            </div>

            <div class="col-sm-1">
                 <a href="Home.php" class="btn btn-primary" role="button">Cancel</a>          
            </div>        
        </div>

    </form>
</div>
	<p class="text-muted"><small> RAMYA SHARMA, PARIN AJMERA </small></p>
	
</body>
</html>
