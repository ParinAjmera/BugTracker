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
$sql = "Select Program_Name, Program_Version, Program_Release From Program2;";
$res = mysql_query($sql);

$xml = new XMLWriter();

$xml->openURI("php://output");
$xml->startDocument();
$xml->setIndent(true);

$xml->startElement('ProgramTable');

$xml->writeRaw($date);
while ($row = mysql_fetch_assoc($res)) {
  $xml->startElement("ProgramName");

  $xml->writeAttribute('Program_Version', $row['Program_Version']);
  $xml->writeAttribute('Program_Release', $row['Program_Release']);

  $xml->writeRaw($row['Program_Name']);

  $xml->endElement();
}

$xml->endElement();

header('Content-type: text/xml');
header('Content-Disposition: attachment; filename=example.xml');
$xml->flush();
}

?>