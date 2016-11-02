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
$program_name = $new_program_name = "";
$servername = "localhost";
$user = "root";
$pass = "root";
$dbname = "Test";

if(isset($_POST['submit'])){

$program_name = $_POST["program_name"];
$new_program_name = $_POST["new_program_name"];
    
try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // prepare sql and bind parameters
            $stmt = $conn->prepare("UPDATE Program2 SET Program_Name = :new_program_name WHERE Program_Name = :program_name;");
            

            $stmt->bindParam(':program_name', $program_name);
            $stmt->bindParam(':new_program_name', $new_program_name);
            $stmt->execute();

            $message = "You have successfully updated $program_name to $new_program_name!";
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
    <title>Update Existing Program</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <style>.bg-grey {background-color: #e4e6e7;} </style>
</head>

<body class="bg-grey">
<div class="container">
    </br></br>
    <h1>Update Existing Program</h1>
    </br></br>

    <form class="form-horizontal" role="form" method="post" action="Update_Program.php">
        <div class="row">
            <div class="form-group" style="padding-bottom: 10px">
                <label for="program_name" class="col-sm-2 control-label">Program Name</label>
                <div class="col-sm-4">
                     <select class="form-control" id="program_name" name="program_name" required="true" autofocus>
                          <?php
                              $pdo = new PDO('mysql:host=localhost;dbname=Test', 'root', 'root');
                              #Set Error Mode to ERRMODE_EXCEPTION.
                              $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

                              $stmt = $pdo->prepare('Select Distinct Program_Name from Program2');
                              $stmt->execute();
                              echo '<option></option>';
                                 while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                   echo '<option>'.$row['Program_Name'].'</option>';
                                 }
                          ?>
                    </select>
                    <p><i>If there are no program to select. Please <a href = "Add_New_Program.php">Add New Program</a></i></p>                   
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group" style="padding-bottom: 10px">
                <label for="new_program_name" class="col-sm-2 control-label">New Program Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" maxlength="15" id="new_program_name" name="new_program_name" placeholder="Enter New Program Name" required="true" autocomplete="off">
                </div>
                   <!-- <?php echo "<p class='text-danger'>$new_program_name</p>" ?> -->
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