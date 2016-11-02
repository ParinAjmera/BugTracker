<?php 
session_start();
if(!isset($_SESSION['logon'])){
      
       header("Location:index.php");
      }  
if(strcmp($_SESSION['Level_Access'],'Manager') !== 0)
    {
     header("Location:Home.php");
    }
$program_name = $version =$release ="";
$servername = "localhost";
$user = "root";
$pass = "root";
$dbname = "Test";
$p_selected=$_GET["selected_program"];
list($program_name, $version, $release) = explode(".", $p_selected); 
if(isset($_POST['submit'])){
    
$functional_area = $_POST["functional_area"];
$program_name = $_POST["program_name"];
$version = $_POST["version"];
$release = $_POST["release"];

 try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     // prepare sql and bind parameters
    // $stmt = $conn->prepare("UPDATE Program Set Area_Name = '' WHERE Program_Name = :program_name AND Program_Version = :version AND Program_Release = :release AND Area_Name = :functional_area; ");
    $stmt = $conn->prepare('DELETE FROM Area2 WHERE Program_Id = (SELECT Program_Id FROM Program2 WHERE Program_Name = :program_name AND Program_Version = :version AND Program_Release = :release) AND AreaName = :functional_area');

    $stmt->bindParam(':program_name', $program_name);
    $stmt->bindParam(':version', $version);
    $stmt->bindParam(':release', $release);
    $stmt->bindParam(':functional_area', $functional_area);

    $stmt->execute();

    $message = "You have successfully deleted $functional_area as a functional area for $program_name.$version.$release";
    echo "<script type='text/javascript'>alert('$message');</script>";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
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
    <h1>Delete Functional Area</h1>
    </br></br>
    <form class="form-horizontal" role="form" method="post" action="Delete_Functional_Area2.php">
    	<div class="row">
            <div class="form-group" style="padding-bottom: 10px">
                <label for="program_name" class="col-sm-2 control-label">Program Name selected</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="program_name" name="program_name" required="true" placeholder="Program Name" readonly value= <?php echo $program_name ?> >
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group" style="padding-bottom: 10px">
                <label for="version" class="col-sm-2 control-label">Version selected is</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="version" name="version"  required="true" placeholder="Version" readonly value= <?php echo $version ?> >
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group" style="padding-bottom: 10px">
                <label for="release" class="col-sm-2 control-label">Release selected is</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="release" name="release" placeholder="Release" required="true" readonly value= <?php echo $release ?>>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group" style="padding-bottom: 10px">
                <label for="functional_area" class="col-sm-2 control-label">Select Functional Area</label>
                <div class="col-sm-4">
                     <select class="form-control" id="functional_area" name="functional_area" required="true" autofocus>
                          <?php
                              $pdo = new PDO('mysql:host=localhost;dbname=Test', 'root', 'root');
                              #Set Error Mode to ERRMODE_EXCEPTION.
                              $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

                              $stmt = $pdo->prepare('SELECT AreaName FROM Area2 
                              WHERE Program_ID = (SELECT Program_Id FROM Program2 WHERE Program_Name = :program_name AND Program_Version = :version AND Program_Release = :release)');

                              	 $stmt->bindParam(':program_name', $program_name);
       							             $stmt->bindParam(':version', $version);
       							             $stmt->bindParam(':release', $release);
                              	 $stmt->execute();
                              echo '<option></option>';
                                 while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                   echo '<option>'.$row['AreaName'].'</option>';
                                 }
                          ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-1 col-sm-offset-2">
                <button id="submit" name="submit" type="Submit" class="btn btn-primary">Delete</button>           
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