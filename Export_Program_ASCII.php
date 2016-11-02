<?php
session_start();
if(!isset($_SESSION['logon'])){
      
       header("Location:index.php");
      }  
if(strcmp($_SESSION['Level_Access'],'Manager') !== 0)
    {
     header("Location:Home.php");
    }
 else{ 
        $fh = fopen('ProgramInfo.txt', 'w');
    $con = mysql_connect("localhost","root","root");
    mysql_select_db("Test", $con);

    /* insert field values into data.txt */
    $date = date('c');
    fwrite($fh,$date);
    fwrite($fh,"\n");

    $result = mysql_query("SELECT * FROM Test.program2");   
    while ($row = mysql_fetch_array($result)) {          
        $last = end($row);          
        $num = mysql_num_fields($result) ;    
        for($i = 0; $i < $num; $i++) {            
            fwrite($fh, $row[$i]);                      
            if ($row[$i] != $last)
               fwrite($fh, ", ");
        }                                                                 
        fwrite($fh, "\n");
    }
    fclose($fh);
    header("Location:export.php");

    }

?>