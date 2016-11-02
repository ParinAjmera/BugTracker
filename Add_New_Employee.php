<?php
session_start();
if(!isset($_SESSION['logon'])){
      
       header("Location:index.php");
      }  
if(strcmp($_SESSION['Level_Access'],'Manager') !== 0)
    {
     header("Location:Home.php");
    }
// define variables and set to empty values
$name = $emppassword = $emprole = "";
$servername = "localhost";
$user = "root";
$pass = "root";
$dbname = "Test";


if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $emppassword = $_POST["password"];
    $emprole = $_POST["employee_role"];
    

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO Employees (Employee_Name, Employee_Password, Level_Access) VALUES(:name, :emppassword, :emprole);");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':emppassword', $emppassword);
        $stmt->bindParam(':emprole', $emprole);

        $stmt->execute();

        $message = "You have successfully added $name as a new employee in the DB!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    catch(PDOException $e)
    {      
        $errString = $e->getMessage();
        //The code below checks if the error string has integrity constraint violation. It checks for the error code and 
        if (strpos($errString, '23000') == true) {
            $customMsg = "The name $name is already in use. Please pick another name!";
            echo "<script type='text/javascript'>alert('$customMsg');</script>";
        }                       
    }

    $conn = null;

}
include_once('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Employee</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>.bg-grey {background-color: #e4e6e7;} </style>
</head>

<body class="bg-grey">

<div class="container bg-grey">
    </br></br>
    <h1>Add new employee to the database</h1>
    </br></br>
    <form  name="myForm" class="form-horizontal" role="form" method="post" action="Add_New_Employee.php" >

        <div class="row">
            <div class="form-group" style="padding-bottom: 10px">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="name" name="name" placeholder="First Name" required="true" autofocus maxlength="25" autocomplete="off">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group" style="padding-bottom: 10px">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="password" name="password" placeholder="Password" required="true"  maxlength="25" autocomplete="off">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group" style="padding-bottom: 10px">
                <label for="employee_role" class="col-sm-2 control-label">Employee Role</label>
                <div class="col-sm-4">
                    <select class="form-control" id="employee_role" name="employee_role" required="true">
                        <option></option>
                        <option>Developer</option>
                        <option>Tester</option>
                        <option>Manager</option>
                    </select>
                </div>                
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-1 col-sm-offset-2">
                <button id="submit" name="submit" type="Submit" class="btn btn-primary">Add   </button>           
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
</div>
</body>
</html>