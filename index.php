<?php
session_start();

$conn = new PDO('mysql:host=localhost;dbname=Test','root', 'root');
if(isset($_POST['submit'])){
  $EmployeeID = $_POST["EmployeeID"];
  $Password = $_POST["Password"];

  $query = $conn->prepare("SELECT Level_Access FROM Employees WHERE Employee_Name = :EmployeeID AND Employee_Password = :Password;");
  $query->bindParam(':EmployeeID',$EmployeeID);
  $query->bindParam(':Password',$Password);
  $query->execute();

  $row = $query->fetch(PDO::FETCH_ASSOC);
  

  //setting up session variables
  if($row){
    $_SESSION['EmployeeID'] = $EmployeeID;
    $_SESSION['Level_Access'] = $row['Level_Access'];
    $_SESSION['logon'] = true;
    header('location:Home.php');
  }
  else{
    die(header("location:index.php?loginFailed=true&reason=password"));
  }
}

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
    <style>
  .jumbotron {
      background-color: #2e2e2e;
      color: #fff;
  }
  .bg-grey {
      background-color: #f6f6f6;
  }
  </style>
</head>
<body>

<div class="jumbotron text-center">

<h1>BugHound Website</h1>
  <p class="text-primary">Hello, Welcome to Bughound</p>
 <form name="form1" class="form-inline" role="form" method="post" action="">
    <input name="EmployeeID" type="EmployeeID" class="form-control" size="50" placeholder="EmployeeID" required>
    <input name="Password" type="Password" class="form-control" size="50" placeholder="Password" required>
    <input id="submit" name="submit" type="submit" value="Login" class="btn btn-primary">
  </form>
  <?php $reasons = array("password" => "Wrong Username or Password", "blank" => "You have left one or more fields blank."); if ($_GET["loginFailed"]) echo $reasons[$_GET["reason"]]; ?>
</div>
	
<!-- our names, just for fun :) -->
<div class="container-fluid bg-grey">
  <h4>Creators of BugHound</h4>    
  <p class="text-muted"> RAMYA SHARMA </p>
  <p class="text-muted"> PARIN AJMERA </p>
</div>
<script src="tota11y.min.js"></script>
</body>
</html>