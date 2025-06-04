<?php
header('Access-Control-Allow-Origin: *');


$dbhost = $_GET["dbhost"];
$dbuser = $_GET["dbuser"];
$dbpass = $_GET["dbpass"];
$dbname = $_GET["dbname"];
$outstanding = $_GET["outstanding"];


if (empty($dbhost) || empty($dbuser) || empty($dbpass) || empty($dbname) || empty($outstanding) ) {
  exit();
} 


//Create database connection
$dblink = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

//Check connection was successful
if ($dblink->connect_errno) {
  printf("Failed to connect");
  echo "Failed to connect";
  exit();
}   

try {
 
$strSQL = "update outstanding set alreadypaid = alreadypaid + ".$outstanding[1].",salesmanid='".$outstanding[4]."',pay=".$outstanding[5]." where inp_id = '" .$outstanding[2] . "' ;";
 
       $dblink->query($strSQL);

  if ($dblink->query($strSQL) === TRUE) {
    echo "1";     
  } else {
    echo $strSQL . " " . $dblink->error;
  }

  $dblink->close();



} catch (Exception $e) {
  // An exception has been thrown
  // We must rollback the transaction

 echo "Error: " . $e->getMessage();
}




?>
