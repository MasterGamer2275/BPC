 <?php
// If the request is made from our space preview functionality then turn on PHP error reporting
if (isset($_SERVER['HTTP_X_FORWARDED_URL']) && strpos($_SERVER['HTTP_X_FORWARDED_URL'], '.w3spaces-preview.com/') !== false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  }
?>
<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root."/DB/call-db.php";
  dbsetup($db, $text);
  //$tablename = $_SESSION["PRNumTabName"];
  //dbcreateprnumtable($db, $tablename, $text);
  //$tablename = $_SESSION["PRTabName"];
  ///dbcreatePRtable($db, $tablename, $text);
  //$PRNum = 56703;
  //$PRDes = "Allocated";
  //dbaddprnumrecord($db, $tablename, $PRNum, $PRDes, $text);
  //dbeditprnumrecord($db, $tablename, $ID, $PRNum, $PRDes, $text);
  //$PRNum = 56701;
  //$PRDes = "Allocated";
  //dbaddprnumrecord($db, $tablename, $PRNum, $PRDes, $text);
  //$PRDes = "Checking";
  //dbeditprnumrecord($db, $tablename, $ID, $PRNum, $PRDes, $text);
  //$PRNum = 56701;
  //dbdeleteprnumrecord($db, $tablename, $PRNum, $text);
  /*
  $dbtabdata = array(array());
  $paramname = "PRNUMBER";
  dbreadprnumrecord($db, $tablename, $paramname, $newPRNum, $text);
 if ($newPRNum == 1) {
    $paramname = "PONUM";
    $tablename = $_SESSION["PRTabName"];
    dbreadprnumrecord($db, $tablename, $paramname, $newPRNum, $text);
      if ($newPRNum == 1) {
          $newPRNum = $_SESSION["InitPONum"];
      }
  }
  echo $newPRNum;
  */
  $tablename = $_SESSION["PRTabName"];
  dbreadtable($db, $tablename, $dbtabdata, $text);
  // Loop through the array to generate table rows
  foreach ($dbtabdata as $row) {
      echo "<tr>";
      foreach ($row as $cell) {
                echo "<td>$cell</td>";
              }
      echo "</tr><br>";
  }

  dbclose($db, $text);
  //echo $text;
?>