  <?php
  if ($_POST["dptableData"] != "") {
     $dDate = $_POST["dpDate"];
     $DiD = $_POST["dpDiD"];
     $pCnum = $_POST["dpPOnum"];
     $CuName = $_POST["dpCuName"];
     $tableDataJSON = $_POST["dptableData"];
     $tableData = json_decode($tableDataJSON, true);
     $myArray = array();
     $str = json_encode($tableData);
     $word1 = str_replace("]","",$str);
     $word2 = str_replace("[","", $word1);
     $word3 = str_replace('"', '',$word2);
     $myArray = explode(";", $word3);
     dbsetup($db, $text);
     $tablename = $_SESSION["DocIdTabName"];
     dbcreatedocidtable($db, $tablename, $text);
     dbcleanupdocidtable($db, $tablename, $text);
     dbgetdocid($db, $tablename, "Dispatch", $DOCID, $text);
     dbeditdocidrecord($db, $tablename, "Dispatch", $DiD, "used", $text);
     $tablename = $_SESSION["DispTabName"];
     dbcreatedispatchtable($db, $tablename, $text);
     $tablename = $_SESSION["PListTabName"];
     dbcreateproducttable($db, $tablename, $text);
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
         echo "Record Added.<br>";
     }
     dbclose($db, $text)
     echo $text<br>
  }
?>