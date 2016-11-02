<?php
session_start();
if(!isset($_SESSION['logon'])){
      
       header("Location:index.php");
      } 
//delare variables
$bugId=$summary=$descr=$ver=$pgmRel=$product=$reportedBy=$reportedDate="";
$reproducible=$steps=$funcArea=$pgmName=$assignedTo=$resolvedBy=$uploaded_file="";
$resolvedDate=$severity=$status=$pgmInfo=$report_type = $suggested_fix = $modified_by = $program_name = $version = $release = "";

$servername = "localhost";
$user = "root";
$pass = "root";
$dbname = "Test";
$tbl_name = "Test.bugInfo";

  
if(isset($_POST['submit'])) {	
    
$reportedBy = $_POST["reportedBy"];   //req
$reportedDate = $_POST["reportedDate"];
$reproducible = $_POST["reproducible"];

if($reproducible == 'on')
			$reproducible = 1;
else
	    $reproducible=0;
			
if (isset($_POST['bugId']))    
 $bugId = $_POST["bugId"];

else
	{
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
					die("Connection failed, Switch on MySQL Server and try again: " . $conn->connect_error);
			}
							
			$cdquery="select max(bugId) from $tbl_name;";
			$cdresult=mysql_query($cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());

			while ($cdrow=mysql_fetch_array($cdresult)) {
			$cdTitle=$cdrow[0];					
								
			$bugId = $cdTitle+1;	
			/*echo $bugId;*/

			$conn->close();	
			}
		
	}
    $summary = $_POST["summary"];         //req
    $descr = $_POST["descr"];            //req
    $suggested_fix = $_POST["suggested_fix"];
    $steps = $_POST["steps"];            
    $report_type = $_POST["report_type"];
    $pgmInfo = $_POST["pgmInfo"];       //req
    list($program_name, $version, $release) = explode(".", $pgmInfo); 
    $severity = $_POST["severity"];     
    $funcArea = $_POST["funcArea"];
    $status = $_POST["status"];
    $product = $_POST["product"];
    $assignedTo = $_POST["assignedTo"];
    
    if($summary==" " or $descr==" ")
    {
            $customMsg = "Summary/Description must be properly filled!";
            echo "<script type='text/javascript'>alert('$customMsg');</script>";
            header("Location:AddBug.php");
    }       
    
    if (isset($_POST['uploaded_file']))
    {
    	$uploaded_file = $_POST["uploaded_file"];
    
    }
/* 		   
    	//Settings
    	$max_allowed_file_size = 5000; // size in KB
    
    	//Get the uploaded file information
    	$name_of_uploaded_file =basename($_FILES['uploaded_file']['name']);
    
    	//get the file extension of the file
    	$type_of_uploaded_file =substr($name_of_uploaded_file,strrpos($name_of_uploaded_file, '.') + 1);
    	$size_of_uploaded_file =$_FILES["uploaded_file"]["size"]/1024;//size in KBs
    
    	//Validations
    	if($size_of_uploaded_file > $max_allowed_file_size )
    	{
    		$errors .= "\n Size of file should be less than $max_allowed_file_size";
    	}
   */ 
      
    // Create connection
      $conn = new mysqli($servername, $user, $pass, $dbname);
      // Check connection
      if ($conn->connect_error) {
      die("Connection failed, Switch on MySQL Server and try again: " . $conn->connect_error);
      }

    $cdquery = "INSERT INTO $tbl_name values($bugId, '$summary', '$descr', $version, $release, '$product', '$reportedBy', '$reportedDate', $reproducible, '$steps', '$funcArea', '$program_name', '$assignedTo', '$status', '$resolvedBy', '$resolvedDate', '$severity', '$report_type', '$suggested_fix', '$modified_by');";

   	$display='Home.php';
			echo "<h2><b><a href='$display'>You have successfully added a Bug, go Home now</a></b></h2>";
          //  $message = "You have successfully reported the bug!";
         //echo "<script type='text/javascript'>alert('$message');</script>";



    $cdresult=mysql_query($cdquery) or die ("Query to get data from $tbl_name failed: ".mysql_error());
    
 /*   if($uploaded_file)
    {
    	$cdquery="insert into bugAttachments values($bugId,$uploaded_file);";
    }
*/	
     $conn.close();
	
}
include_once('header.php');  
?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <title>BugHound Software</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
<style>
  small { 
    font-size: smaller;
	 }
  
  .jumbotron {
    background-image: url("paper.gif");
    background-color: #f6f6f6;
   
  }
  .bg-grey {
      background-color: #f6f6f6;
  }
  
 .container {
   padding-right: 15px;
   padding-left: 15px;
   margin-right: auto;
   margin-left: auto;
  }

.fieldset {
  border: 0;
  margin: 0;
  padding: 0;
  }
</style>  
</head>

<body>

<div class="jumbotron text-center">
<h2>Add A New Bug in Bughound</h2>
</br><br> 	 
<form class="form-horizontal" role="form" method="post" action="addBug.php" enctype="multipart/form-data">
  
  <div class="form-group">
      <label class="control-label col-sm-2" for="reportedBy">Reported By:</label>
         <div class="col-sm-2">
            <select class="form-control" id="reportedBy" name="reportedBy" required autofocus>                     
             <?php
                  $pdo = new PDO('mysql:host=localhost;dbname=Test', 'root', 'root');
                  #Set Error Mode to ERRMODE_EXCEPTION.
                  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

                  $stmt = $pdo->prepare('Select Employee_Name from Employees');
                  $stmt->execute();
                  echo '<option></option>';
                  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option>'.$row['Employee_Name'].'</option>';
                  }
              ?>                                                                
            </select>        
            <?php echo "<p class='text-danger'>$reportedBy</p>";?>  
         </div>

      <label class="control-label col-sm-1" for="date"> Date:</label>
        <div class="col-sm-2">
          <input type="Date" class="form-control" id="Date" name="reportedDate" placeholder="Enter Date"  required>
          <?php echo "<p class='text-danger'>$reportedDate</p>";?>
        </div>

      <label class="control-label col-sm-1" for="date"> Reproducible?</label>
        <div class="col-sm-1" class="checkbox">
         <input type="checkbox" name="reproducible">
        </div>
        <?php echo "<p class='text-danger'>$reproducible</p>";?>
  </div> 

  <div class="form-group">
     <label for="product" class="control-label col-sm-2">Product:</label>    
       <div class="col-sm-8">     
            <input type="text" class="form-control" id="product" name="product" placeholder="Product eg, CPU"  required>
            <?php echo "<p class='text-danger'>$product</p>";?>
        </div>
  </div>

  <div class="form-group">
     <label for="Problem Summary" class="control-label col-sm-2">Problem Summary:</label>    
       <div class="col-sm-8">     
            <input type="text" class="form-control" id="summary" name="summary" placeholder="Brief description of Bug"  required>
            <?php echo "<p class='text-danger'>$summary</p>";?>
        </div>
  </div>
    
  <div class="form-group">
      <label for="Problem" class="control-label col-sm-2">Problem Description:</label>      
        <div class="col-sm-8">  
          <textarea class = "form-control" name="descr" rows = "3" placeholder="Enter The Problem Details"  required></textarea>
          <?php echo "<p class='text-danger'>$descr</p>";?>
        </div>
  </div>

  <div class="form-group">
      <label for="Suggested Fix" class="control-label col-sm-2">Suggested Fix:</label>
        <div class="col-sm-8">  
          <textarea class = "form-control" rows = "3" placeholder="Enter a Suggested Fix" name="suggested_fix"></textarea>
          <?php echo "<p class='text-danger'>$suggested_fix</p>";?>
        </div>
  </div>
  
  <div class="form-group">
      <label for="Steps to Reproduce" class="control-label col-sm-2">Steps to Reproduce:</label>
        <div class="col-sm-8">  
          <textarea class ="form-control" name="steps" rows="3" placeholder="Steps to Reproduce"></textarea>
          <?php echo "<p class='text-danger'>$steps</p>";?>
    </div>
  </div> 

  <div class="form-group">
    <label class="control-label col-sm-2" for="assignedTo">Assigned To:</label>
     <div class="col-sm-8">
        <select class="form-control" id="assignedTo" name="assignedTo" autofocus>                     
          <?php
            $pdo = new PDO('mysql:host=localhost;dbname=Test', 'root', 'root');
            #Set Error Mode to ERRMODE_EXCEPTION.
            $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

            $stmt = $pdo->prepare('Select Employee_Name from Employees');
            $stmt->execute();
            echo '<option></option>';
            
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo '<option>'.$row['Employee_Name'].'</option>';
            }
          ?>                                                  
        </select>        
        <?php echo "<p class='text-danger'>$assignedTo</p>";?>  
    </div>
  </div>

  <div class="form-group" style="padding-bottom: 2px">
     <label for="report_type" class="control-label col-sm-2">Report Type:</label> 
      <div class="col-sm-8">                	
         <select class="form-control" id="report_type" name="report_type">
         	<option></option>
     	    <option value="coding error">Coding Error</option>
            <option value="hardware">Hardware Problem</option>
            <option value="design issue">Design Issue</option>
            <option value="suggestion">Suggestion</option>
            <option value="documentation">Documentation</option>
        </select>
        <?php echo "<p class='text-danger'>$report_type</p>";?>
 	    </div>
 	</div>
  
  <div class="form-group" style="padding-bottom: 2px">
     <label for="pgmInfo" class="control-label col-sm-2">Program Info:</label> 
        <div class="col-sm-8">                	
          <select class="form-control" id="pgmInfo" name="pgmInfo" required="true">
              <?php
                $pdo = new PDO('mysql:host=localhost;dbname=Test', 'root', 'root');
                  #Set Error Mode to ERRMODE_EXCEPTION.
                $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

                $stmt = $pdo->prepare('Select Program_Name, Program_Version, Program_Release from Program2');
                $stmt->execute();
                echo '<option></option>';
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option>'.$row['Program_Name'].".".$row['Program_Version'].".".$row['Program_Release'].'</option>';
                  }
              ?>
          </select>
 	      </div>
 	</div>
 
  <div class="form-group" style="padding-bottom: 2px">
     <label for="severity" class="control-label col-sm-2">Severity:</label> 
      <div class="col-sm-8">                  
         <select class="form-control" id="severity" name="severity">
          <option></option>
          <option value="Major">Major</option>
            <option value="Minor">Minor</option>
            <option value="Red Alert">Fatal</option>
        </select>
        <?php echo "<p class='text-danger'>$severity</p>";?>
      </div>
  </div>
  
	 <div class="form-group" style="padding-bottom: 2px">
     <label for="funcArea" class="control-label col-sm-2">Functional Area:</label>
       <div class="col-sm-8">               	
       <select class="form-control" id="funcArea" name="funcArea">
          <?php
          $pdo = new PDO('mysql:host=localhost;dbname=Test', 'root', 'root');
          #Set Error Mode to ERRMODE_EXCEPTION.
          $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

          $stmt = $pdo->prepare('SELECT Distinct AreaName FROM Area2');

          $stmt->execute();
          echo '<option></option>';
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
             echo '<option>'.$row['AreaName'].'</option>';
            }
          ?>
       </select>
      <?php echo "<p class='text-danger'>$funcArea</p>";?>
 	  </div>
 	</div>

	<div class="form-group" style="padding-bottom: 2px">
     <label for="status" class="control-label col-sm-2">Status:</label>  
       <div class="col-sm-8">          	
         <select class="form-control" id="status" name="status">
         	<option></option>
       		<option value="open">Open</option>
        	<option value="assigned">Assigned</option>
        	<option value="resolved">Resolved</option>
        	<option value="in progress">In progress</option>
        </select>
        <?php echo "<p class='text-danger'>$status</p>";?>
   	</div>
	</div>

  <div class="form-group" style="padding-bottom: 10px">
  	<label for='uploaded_file' class="control-label col-sm-2">Select A File To Upload:</label>
	   <div class="col-sm-8">     
	     <input type="file" name="uploaded_file">
      </div>
  </div>    

 		
  <div class="row">
      <div class="col-sm-1 col-sm-offset-4">
          <button id="submit" name="submit" type="Submit" class="btn btn-primary">Add</button>           
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
    
</body>
</html>
