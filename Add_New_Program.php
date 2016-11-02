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
$name = $release = $version = "";
$servername = "localhost";
$user = "root";
$pass = "root";
$dbname = "Test";

if(isset($_POST["submit"])){
 
        $name = $_POST["name"];
        $release = $_POST["release"];
        $version = $_POST["version"];

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // prepare sql and bind parameters
            $stmt = $conn->prepare("INSERT INTO Program2 (Program_Name, Program_Version, Program_Release) VALUES(:name, :version, :release);");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':version', $version);
            $stmt->bindParam(':release', $release);

            $stmt->execute();

            $message = "You have successfully added $name.$version.$release as new program in the systems!";
            echo "<script type='text/javascript'>alert('$message');</script>";
           }
        catch(PDOException $e)
            {
              // echo "Error: " . $e->getMessage();
              $errString = $e->getMessage();
              //The code below checks if the error string has integrity constraint violation. It checks for the error code and 
              if (strpos($errString, '23000') == true) {
                  $customMsg = "The name $name.$version.$release is already in the system. Try again!";
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
    <title>Add new program</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <style>.bg-grey {background-color: #e4e6e7;} </style>

</head>

<body class="bg-grey">
<div class="container bg-grey">
            </br></br>
            <h1>Add a new program to the database</h1>
            </br></br>
            <form class="form-horizontal" role="form" method="post" action="Add_New_Program.php">

                <div class="row">

                <div class="form-group" style="padding-bottom: 10px">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Program Name" required="true" autofocus maxlength="25" autocomplete="off">
                        <!-- <?php echo "<p class='text-danger'>$name</p>" ?> -->

                    </div>
                </div>
                </div>

                <div class="row">
                <div class="form-group" style="padding-bottom: 10px">
                    <label for="version" class="col-sm-2 control-label">Version</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" id="version" name="version" placeholder="Version" required="true" 
                                autocomplete="off" min="0" max="50" >
                    </div>
                </div>
                </div>

                <div class="row">
                <div class="form-group" style="padding-bottom: 10px">
                    <label for="release" class="col-sm-2 control-label">Release</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" id="release" name="release" placeholder="Release" required="true" autocomplete="off" min="0" max="50">
                    </div>
                </div>
                </div>

                <div class="row">
                    <div class="col-sm-1 col-sm-offset-2">
                        <button id="submit" name="submit" type="Submit" class="btn btn-primary">Add</button>           
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