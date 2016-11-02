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

$reportedBy= $bugId=$funcArea=$assignedTo=$resolvedBy=$reportedDate=$resolvedDate=$descr=$descr1="";


if($_GET["bugId"])
	$bugId = $_GET["bugId"];
if($_GET["reportedBy"])
	$reportedBy=$_GET["reportedBy"];	
if($_GET["descr"])
	$descr=$_GET["descr"];



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed, Switch on MySQL Server and try again: " . $conn->connect_error);
}

if (isset($_POST['defered']))
{
	$reproducible = $_POST["defered"];
	if($reproducible == 'on')
	{
		$status = "defered";
		$cdquery="update $tbl_name set status='defered' where bugId=$bugId";
		$cdresult=mysql_query($cdquery) or die ("Query to get data from $tbl_name failed: ".mysql_error());
	}
		
	else
		$status='';
}
	
		
	
	//$cdquery="update $tbl_name values($bugId, '$summary', '$descr', $ver, $pgmRel, '$product', '$reportedBy', '$reportedDate', $reproducible, '$steps', '$funcArea', '$pgmName', '$assignedTo', '$status', '$resolvedBy', '$resolvedDate', '$severity');";
	/*echo $cdquery;*/
	//$cdresult=mysql_query($cdquery) or die ("Query to get data from $tbl_name failed: ".mysql_error());
		
		
	$conn->close();
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
  jumbotron {
    background-image: url("paper.gif");
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
  <style>.bg-grey {background-color: #e4e6e7;} </style>
  
 
</head>


<body class="bg-grey">
	<div class="jumbotron text-center">

 	 <h2>Update A Bug</h2>
   	<form class="form-horizontal" role="form" method="post" action="updateBugNext.php">
  
	<div class="form-group">
	<fieldset>
  	<legend></legend>
	
     <label class="control-label col-sm-2" for="bugId">Bug Id:</label>
     <div class="col-sm-2">
      <input type="text" class="form-control" id="bugId" name="bugId" value=<?php echo $bugId;?> readonly>	 
    </div>
   
        <label class="control-label col-sm-2" for="reportedBy">Reported By:</label>
     <div class="col-sm-2">
      <input type="text" class="form-control" id="reportedBy" name="reportedBy" value=<?php echo $reportedBy;?> disabled>	 
    </div>
    
 
       <div class="control-label col-sm-2" class="checkbox">
      <label><input type="checkbox"  name="defered"> Treat as Defered?</label>
    </div>
 	</div>	
 
 
 
 
 
	 <div class="form-group">
      <label for="Problem" class="control-label col-sm-2">Problem Description:</label>      
      <div class="col-sm-8">  
      <textarea class = "form-control" name="descr" rows = "3"  readonly><?php echo "$descr";?></textarea>
     
    </div>
    </div>
    
      <div class="form-group">
      <label for="Problem" class="control-label col-sm-2">Add any additional Info:</label>      
      <div class="col-sm-8">  
      <textarea class = "form-control" name="descr1" rows = "3" placeholder="Enter any additional Problem Details"></textarea>
             <?php echo "<p class='text-danger'>$descr1</p>";?>
    </div>
    </div>
    
       <div class="form-group">
      <label for="Suggested Fix" class="control-label col-sm-2">Any changes in Suggested Fix??</label>
      <div class="col-sm-8">  
      <textarea class ="form-control" name="suggested_fix" rows="3" placeholder="Any changes in Suggested Fix??"></textarea>
    </div>
    </div>
 
    <div class="form-group" style="padding-bottom: 2px">
    <label for="severity" class="control-label col-sm-2">Any change in Severity??</label>   
    <div class="col-sm-8">                	
    <select class="form-control" id="severity" name="severity" >
     	<option></option>
    <option value="major">Fatal</option>
    <option value="serious">Major</option>
    <option value="minor">Minor</option>
    </select>
 	</div>
 	</div>
  
	 <div class="form-group" style="padding-bottom: 2px">
     <label for="status" class="control-label col-sm-2">Any change in Status??</label>  
     <div class="col-sm-8">          	
     <select class="form-control" id="status" name="status">
     	<option></option>
   		<option value="open">Open</option>
    	<option value="assigned">Assigned</option>
    	<option value="resolved">Resolved</option>
    	<option value="in progress">In progress</option>
    </select>
 	</div>
	</div>
  
              
            <div class="form-group" style="padding-bottom: 2px">
                <label for="funcArea" class="col-sm-2"> Any change in Functional Area??</label>
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
                <label for="assignedTo" class="col-sm-2 control-label">Assigned To</label>
                <div class="col-sm-8">               	
                    <select class="form-control" id="assignedTo" name="assignedTo">
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
                <label for="modifiedBy" class="col-sm-2 control-label">Modified By</label>
                <div class="col-sm-8">               	
                    <select class="form-control" id="modifiedBy" name="modifiedBy" required>
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
                  
                </div>
            </div>


            <div class="form-group" style="padding-bottom: 2px">
                <label for="resolvedBy" class="col-sm-2 control-label">Resolved By</label>
                <div class="col-sm-8">               	
                    <select class="form-control" id="resolvedBy" name="resolvedBy">
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
                    <?php echo "<p class='text-danger'>$resolvedBy</p>";?>
                </div>
            </div>


    <div class="form-group">
      <label class="control-label col-sm-2" for="date"> Modified Date:</label>
      <div class="col-sm-3">
       <input type="Date" class="form-control" id="Date" name="reportedDate" placeholder="Enter Today's Date" >
    </div>

	    <div class="form-group">
      <label class="control-label col-sm-2" for="date"> Resolved Date:</label>
      <div class="col-sm-3">
       <input type="Date" class="form-control" id="Date" name="resolvedDate">
    </div>
     </div> 	
    
   
  <div class="form-group" style="padding-bottom: 10px">
  	<label for='uploaded_file' class="control-label col-sm-2">Select A File To Upload:</label>
	   <div class="col-sm-8">     
	     <input type="file" name="uploaded_file">
      </div>
  </div>    


        
  
	</fieldset>
 	        <div class="row">
            <div class="col-sm-1 col-sm-offset-4">
                <button id="submit" name="submit" type="Submit" class="btn btn-primary">Update</button>           
            </div>

            <div class="col-sm-1">
                 <button type="Reset" id="Reset" name="reset" class="btn btn-primary">Reset</button>           
            </div>

            <div class="col-sm-1">
                 <a href="databaseMaintain.php" class="btn btn-primary" role="button">Cancel</a>          
            </div>        
        </div>

  	
  	</form>
	</div>

</body>
</html>
