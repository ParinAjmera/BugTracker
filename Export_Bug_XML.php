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
$sql = "SELECT * FROM buginfo";
$res = mysql_query($sql);

$xml = new XMLWriter();

$xml->openURI("php://output");
$xml->startDocument();
$xml->setIndent(true);

$xml->startElement('BugTable');

$xml->writeRaw($date);
$xml->writeRaw("\n");
while ($row = mysql_fetch_assoc($res)) {
  $xml->startElement("BugInfo");

  $xml->writeAttribute('PgmName', $row['PgmName']);

  $xml->writeRaw('Product: ');
  $xml->writeRaw($row['product']);
  $xml->writeRaw(', ');


  $xml->writeRaw('Release: ');
  $xml->writeRaw($row['PgmRel']);
  $xml->writeRaw(', ');  
 
  $xml->writeRaw('Version: ');
  $xml->writeRaw($row['version']);
  $xml->writeRaw(', ');  

  $xml->writeRaw('Description: ');
  $xml->writeRaw($row['description']);
  $xml->writeRaw(', ');  

  $xml->writeRaw('Summary: ');
  $xml->writeRaw($row['summary']);
  $xml->writeRaw(', ');


  $xml->writeRaw('reported Date: ');
  $xml->writeRaw($row['reportedDate']);
  $xml->writeRaw(', ');

  $xml->writeRaw('reportedBy: ');
  $xml->writeRaw($row['reportedBy']);
  $xml->writeRaw(', ');

  $xml->writeRaw('Reproducible: ');
  $xml->writeRaw($row['Reproducible']);
  $xml->writeRaw(', ');

  $xml->writeRaw('Reproduce: ');
  $xml->writeRaw($row['StepsToReproduce']);
  $xml->writeRaw(', ');

  $xml->writeRaw('Functional Area: ');
  $xml->writeRaw($row['funcArea']);
  $xml->writeRaw(', ');

  $xml->writeRaw('Assigned To: ');
  $xml->writeRaw($row['assignedTo']);
  $xml->writeRaw(', ');

  $xml->writeRaw('Status: ');
  $xml->writeRaw($row['status']);
  $xml->writeRaw(', ');

  $xml->writeRaw('Resolved By: ');
  $xml->writeRaw($row['resolvedBy']);
  $xml->writeRaw(', ');

  $xml->writeRaw('Resolved Date: ');
  $xml->writeRaw($row['resolvedDate']);
  $xml->writeRaw(', ');

  $xml->writeRaw('Severity:');
  $xml->writeRaw($row['Severity']);
  $xml->writeRaw(', ');

  $xml->writeRaw('reportType:');
  $xml->writeRaw($row['reportType']);
  $xml->writeRaw(', ');

  $xml->writeRaw('Suggested Fix:');
  $xml->writeRaw($row['suggestedFix']);
  $xml->writeRaw(', ');

  $xml->writeRaw('Modified By:');
  $xml->writeRaw($row['modifiedBy']);

  $xml->endElement();
}

$xml->endElement();

header('Content-type: text/xml');
header('Content-Disposition: attachment; filename=example.xml');
$xml->flush();
}

?>