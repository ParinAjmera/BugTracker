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
$servername = "localhost";
$user = "root";
$pass = "root";
$dbname = "Test";
$selected_employee = $selected_role  = "";

if(isset($_POST['submit'])){
    
$selected_employee = $_POST["selected_employee"];
$selected_role = $_POST["selected_role"];

try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // prepare sql and bind parameters
        $stmt = $conn->prepare("UPDATE Employees Set Level_Access = :selected_role Where Employee_Name = :selected_employee ;");
        
        $stmt->bindParam(':selected_employee', $selected_employee);
        $stmt->bindParam(':selected_role', $selected_role);
        $stmt->execute();

        $message = "You have successfully made $selected_employee a $selected_role!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    catch(PDOException $e)
    {
      echo "Error is here: " . $e->getMessage();
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
    <title>Update Employee Role</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <style>.bg-grey {background-color: #e4e6e7;} </style>
</head>

<body class="bg-grey">
<div class="container">
    </br></br>
    <h1>Update employee information</h1>
    </br></br>

    <form class="form-horizontal" role="form" method="post" action="Update_Employee.php">
        <div class="row">
            <div class="form-group" style="padding-bottom: 10px">
                <label for="selected_employee" class="col-sm-2 control-label">Select Employee</label>
                <div class="col-sm-4">
                     <select class="form-control" id="selected_employee" name="selected_employee" required="true" autofocus>
                          <?php
                              $pdo = new PDO('mysql:host=localhost;dbname=Test', 'root', 'root');
                              #Set Error Mode to ERRMODE_EXCEPTION.
                              $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

                              $stmt = $pdo->prepare('Select Employee_Name from Employees');
                              $stmt->execute();
                              echo '<option></option>';
                                 while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                   echo '<option>'.$row['Employee_Name'].'</option>';
                                 }
                          ?>
                        
                    </select>
                    <!-- <?php echo "<p class='text-danger'>$selected_employee</p>" ?> -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group" style="padding-bottom: 10px">
                <label for="selected_role" class="col-sm-2 control-label">Select New Role</label>
                <div class="col-sm-4">
                    <select class="form-control" id="selected_role" name="selected_role" required="true">
                        <option></option>
                        <option>Developer</option>
                        <option>Manager</option>
                        <option>Tester</option>
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