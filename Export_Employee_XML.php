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

mysql_connect('localhost', 'root', 'root');
mysql_select_db('Test');
$date = date('c');
$sql = "SELECT Employee_Name, Employee_Password, Level_Access FROM Employees";
$res = mysql_query($sql);

$xml = new XMLWriter();

$xml->openURI("php://output");
$xml->startDocument();
$xml->setIndent(true);

$xml->startElement('EmployeeTable');

$xml->writeRaw($date);
while ($row = mysql_fetch_assoc($res)) {
  $xml->startElement("EmployeeName");

  $xml->writeAttribute('Employee_Password', $row['Employee_Password']);
  $xml->writeAttribute('Level_Access', $row['Level_Access']);
  $xml->writeRaw($row['Employee_Name']);

  $xml->endElement();
}

$xml->endElement();

header('Content-type: text/xml');
header('Content-Disposition: attachment; filename=example.xml');
$xml->flush();
}

?>