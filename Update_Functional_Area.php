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

$selected_program= "";
$servername = "localhost";
$user = "root";
$pass = "root";
$dbname = "Test";

if(isset($_POST['submit'])) {
   
$selected_program = $_POST["program_info"];
header("Location:Update_Functional_Area2.php?selected_program=$selected_program");
    
}
include_once('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Functional Area</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <style>.bg-grey {background-color: #e4e6e7;} </style>
</head>

<body class="bg-grey">
<div class="container">
    </br></br>
    <h1>Update Functional Area</h1>
    </br></br>
    <p><strong>Select a Program from the list for which you wish to update the functional area.</strong></p> </br></br>

    <form class="form-horizontal" role="form" method="post" action="Update_Functional_Area.php">
        
        <div class="row">
            <div class="form-group" style="padding-bottom: 10px">
                <label for="selected_program" class="col-sm-2 control-label">Select Program</label>
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
            <div class="col-sm-1 col-sm-offset-2">
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
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</html>