<?php
session_start();
?>


<!DOCTYPE html>
<html>
<style type="text/css">
  .navbar-new {
    background-color: #004466;
    border-color: #E7E7E7;
    color: #ffffff;
}

</style>
<nav style="margin-bottom: 0.5em;" class="navbar navbar-inverse navbar-custom">

  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <!-- For Mobile Screens -->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <a class="navbar-brand" href="Home.php">Bug Hound</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

        <li><a href="addBug.php">Add Bug</a></li> <!-- for everyone -->

        <li><a href="searchBug.php">Search Bug</a></li> <!-- for everyone -->

        <!-- for manager access only -->
        <?php
          if(strcmp($_SESSION['Level_Access'],'Manager') == 0){           
            echo '<li><a href="databaseMaintain.php">DB Home</a></li> ';
          }
        ?>  

        <?php
          if(strcmp($_SESSION['Level_Access'],'Manager') == 0){ 
          echo '<li class="dropdown"> ';
          echo ' <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Add';
          echo ' <span class="caret"></span></a>';
          echo '<ul class="dropdown-menu"> ';
          echo ' <li><a href="Add_New_Employee.php" target="">New Employee</a></li> ';
          echo ' <li><a href="Add_New_Program.php" target="">New Program</a></li> ';
          echo ' <li><a href="Add_Functional_Area.php" target="">New Functional Area</a></li>  ';
          echo '</ul>';
          echo '</li>';
        }
        ?>


        <?php
          if(strcmp($_SESSION['Level_Access'],'Manager') == 0){ 
          echo '<li class="dropdown"> ';
          echo ' <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Delete';
          echo ' <span class="caret"></span></a>';
          echo '<ul class="dropdown-menu"> ';
          echo ' <li><a href="Delete_Employee.php" target="">Employee</a></li>';
          echo ' <li><a href="Delete_Program.php" target="">Program</a></li>';
          echo ' <li><a href="Delete_Functional_Area.php" target="">Functional Area</a></li>';
          echo '</ul>';
          echo '</li>';
        }
        ?>
        
        <?php
          if(strcmp($_SESSION['Level_Access'],'Manager') == 0){ 
          echo '<li class="dropdown"> ';
          echo ' <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Update';
          echo ' <span class="caret"></span></a>';
          echo '<ul class="dropdown-menu"> ';
          echo '<li><a href="Update_Employee.php" target="">Employee</a></li>';
          echo '<li><a href="Update_Program.php" target="">Program</a></li>';
          echo '<li><a href="Update_Functional_Area.php" target="">Functional Area</a></li>';
          echo '</ul>';
          echo '</li>';
        }
        ?>

        <?php
          if(strcmp($_SESSION['Level_Access'],'Manager') == 0){ 
          echo '<li><a href="export.php">Export</a></li> ';
        }
        ?>

      </ul>
    
        <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php" class="navbar-brand pull-right"><strong>Logout</strong></a></li>
        <li class="navbar-brand pull-right"><span class="glyphicon glyphicon-user"></span><strong>Welcome, <?php echo $_SESSION['EmployeeID']; ?></strong></li>
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</html>
