<?php

session_start();
if(!isset($_SESSION['logon'])){
      
       header("Location:index.php");
      }  
if(strcmp($_SESSION['Level_Access'],'Manager') !== 0)
    {
     header("Location:Home.php");
    }


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
 
 <h2> Export Tables in XML</h2>
	
 <form class="form-inline">
 
 <!-- Add the link to login page here -->
 	 <p><b><a href="Export_Program_XML.php" target="_blank">Program Table in XML</a></b></p>
   <p><b><a href="Export_Area_XML.php" target="_blank">Area Table in XML</a></b></p>
   <p><b><a href="Export_Employee_XML.php" target="_blank">Employee Table in XML</a></b></p>
   <p><b><a href="Export_Bug_XML.php" target="_blank">Bug Info Table in XML</a></b></p>
 	
  </form>

   <h2> Export Tables in ASCII</h2>
  
 <form class="form-inline">
 
   <p><b><a href="Export_Program_ASCII.php" target="_blank">Program Table in ASCII</a></b></p>
   <p><b><a href="Export_Area_ASCII.php" target="_blank">Area Table in ASCII</a></b></p>
   <p><b><a href="Export_Employee_ASCII.php" target="_blank">Employee Table in ASCII</a></b></p>
   <p><b><a href="Export_Bug_ASCII.php" target="_blank">Bug Info Table in ASCII</a></b></p>

  
  </form>
</div>

</body>
</html>


</body>
</html>