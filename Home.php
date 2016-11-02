<?php

session_start();
if(!isset($_SESSION['logon'])){
   header("Location:index.php");
}

$name = $_SESSION['EmployeeID'];
$level = $_SESSION['Level_Access'];


include_once('header.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>BugHound</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
  .jumbotron {
      background-color: #2e2e2e;
      color: #fff;
  }
  </style>
  <style>.bg-grey {background-color: #e4e6e7;} </style>
</head>
<body class="bg-grey">

<div class="jumbotron text-center">

<h1>BugHound</h1>
 <!-- Find a way to track employee name from ID to greet him hello -->
 
 <h2 class="text-danger"> Welcome Home, <?php echo $name; ?></h2>
	
 <form class="form-inline">
 
 <!-- Add the link to login page here -->
 	 <p><b><a href="addBug.php" target="_blank">Add a new Bug</a></b></p>
 	 <p><b><a href="searchBug.php" target="_blank">Search a Bug</a></b></p>
 	 <?php
		$levelaccess="Manager";
		
		if(strcmp($level,$levelaccess) == 0)
		{
			/* you are a manager, so you can see database maintenance pages */
			$display='databaseMaintain.php';
			echo "<p><b><a href='$display'>Database Maintenance</a></b></p>";
		}
		   
	  ?>
   <?php
    $levelaccess="Manager";
    
    if(strcmp($level,$levelaccess) == 0)
    {
      /* you are a manager, so you can see database maintenance pages */
      $display='export.php';
      echo "<p><b><a href='$display'>Export Data</a></b></p>";
    }
       
    ?>
 	
 	  <a href="logout.php" class="btn btn-info" role="button">Log Out</a>
  </form>
</div>

</body>
</html>

<!-- our names, just for fun :) -->
<div class="container-fluid bg-grey">
  <h4>Creators of BugHound</h4>    
  <p class="text-muted"> RAMYA SHARMA </p>
  <p class="text-muted"> PARIN AJMERA </p>
</div>

</body>
</html>