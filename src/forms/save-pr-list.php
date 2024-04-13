 <?php
$root = $_SERVER['DOCUMENT_ROOT'];
require $root."/DB/call-db.php";
dbsetup($db, $text);
$tablename = $_SESSION["PRTabName"];
dbcreatePRtable($db, $tablename, $text);
$tabledata = $_POST['myTable'];
$pONum = $_POST['pONum'];
$pODate = date("d-m-Y");
$pOTime = date("h:i:sa");
$pOSname = $_POST['PSname'];
  $i = 0;
  foreach ($tableData as $row) {
        if ($i >= 1) {
        $rowstr = json_encode($row);
        $word1 = str_replace("]","",$rowstr);
        $word2 = str_replace("[","", $word1);
        $word3 = str_replace('"', '',$word2);
        $myArray = explode(",", $word3);
        dbaddpurchaserecord($db, $tablename, $pONum, $pODate, $pOTime, $pOSname, $myArray[0], $myArray[2], $myArray[3], $myArray[4], $myArray[5], $myArray[6], $myArray[7], $myArray[8], $myArray[9], $myArray[10], &$text);
         }
      $i = $i+1;
  }
echo $Text . "Records Added.<br>";
$tablename = $_SESSION["PRNumTabName"];
$PRNum = $pONum;
dbdeleteprnumrecord($db, $tablename, $PRNum, $text);
dbclose($db, $text);

?>