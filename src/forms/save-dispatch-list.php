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
require "/home/app/src/Reset.php";
dbsetup($db, $text);
 $dDate = $_POST["dpdate"];
 $DiD = $_POST["dpdid"];
 $CuName = $_POST["dpcuname"];
 $tableDataJSON = $_POST['dptableData'];
 $tableData = json_decode($tableDataJSON, true);
 $myArray = array();
 $str = json_encode($tableData);
 $word1 = str_replace("]","",$str);
 $word2 = str_replace("[","", $word1);
 $word3 = str_replace('"', '',$word2);
 $myArray = explode(";", $word3);
 for ($i = 1; $i < (count($myArray)-1); $i++) { 
     $myArray1 = explode(",", $myArray[$i]);
     $tablename = $_SESSION["DispTabName"];
     dbadddispatchrecord($db, $tablename, ($i+1), $DiD, $dDate, $myArray1[9], $CuName, $myArray1[3], $myArray1[4], $myArray1[5], $myArray1[6], $myArray1[7], $pCnum, $text);
     $tablename = $_SESSION["PListTabName"];
     $paramname = "CLOSINGSTOCK";
     $filter1 = "CUSTOMERNAME";
     $filter2 = "SIZE";
     dbgetvalue($db, $tablename, $paramname, $filter1, $myArray1[9], $filter2, $myArray1[3], $outputvalue, $rowdata, $text);    
     $newStock = $outputvalue - $myArray1[5];
     dbeditproductrecord($db, $tablename, $myArray1[9], $myArray1[3], $outputvalue, $myArray1[5], $newStock, "0", $text);
 }
 echo "Records Added.";
 $tablename = $_SESSION["DocIdTabName"];
 dbeditdocidrecord($db, $tablename, "Dispatch", $DiD, "used", $text);
 dbclose($db, $text);

?>