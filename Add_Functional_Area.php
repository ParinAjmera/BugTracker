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
$program_info = $funcName = $program_name = $release = $version = "";
$servername = "localhost";
$user = "root";
$pass = "root";
$dbname = "Test";

if(isset($_POST['submit'])){

$program_info = $_POST["program_info"]; 
$funcName = $_POST["functional_area"];

list($program_name, $version, $release) = explode(".", $program_info);  //seperates concatinated strings

        try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // prepare sql and bind parameters
                $stmt = $conn->prepare('INSERT INTO Area2 (AreaName, Program_Id) VALUES (:funcName, (Select Program_Id From Program2 Where Program_Name = :program_name AND Program_Version = :version AND Program_Release = :release))');            

                $stmt->bindParam(':program_name', $program_name);
                $stmt->bindParam(':version', $version);
                $stmt->bindParam(':release', $release);
                $stmt->bindParam(':funcName',$funcName);

                $stmt->execute();

                $message = "You have successfully added a $funcName as a functional area for $program_name.$version.$release!";
                echo "<script type='text/javascript'>alert('$message');</script>";
           }
        catch(PDOException $e)
            {
              $errString = $e->getMessage();
              //The code below checks if the error string has integrity constraint violation. It checks for the error code and 
              if (strpos($errString, '23000') == true) {
              $customMsg = "The name $funcName is already in added. Please pick another Functional Area for $program_name.$version.$release!";
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
    <title>Functional Area</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <style>.bg-grey {background-color: #e4e6e7;} </style>
</head>

<body class="bg-grey">
<div class="container">
    </br></br>
    <h1>Add new functional area to the database</h1>
    </br></br>
    <form class="form-horizontal" role="form" method="post" action="Add_Functional_Area.php">

        <div class="row">
            <div class="form-group" style="padding-bottom: 10px">
                <label for="program_info" class="col-sm-2 control-label">Program Information</label>
                <div class="col-sm-4">
                     <select class="form-control" id="program_info" name="program_info" required="true" autofocus>
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
        </div>

         <div class="row">
            <div class="form-group" style="padding-bottom: 10px">
                <label for="name" class="col-sm-2 control-label">Functional Area</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="functional_area" name="functional_area" placeholder="Functional Area" required="true" maxlength="25" autocomplete="off">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</html>