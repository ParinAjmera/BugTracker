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
<title>BugHound Software</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>.bg-grey {background-color: #e4e6e7;} </style>
</head>

<body class="bg-grey">
<div class="container bg-grey">
<h2>Database Maintenance Page</h2>
</br>
<p style="font-size:20px" > Welcome to the database maintenance page. In the navigation bar above you will find three set of operations you can perform to edit the system's database. 
</br></br>
This functionality will let you do the following 
<ul style="font-size:20px">
<li> Add Employees, Programs and Functional Areas to the database </li>
<li> Delete Employees, Programs and Functional Areas to the database </li>
<li> Update Employees, Programs and Functional Areas to the database </li>
</ul>
</p>
</div>

</body>

</html>