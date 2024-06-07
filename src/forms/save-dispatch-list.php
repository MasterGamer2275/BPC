 <?php
 /*form - dispatch feed- ($_POST["dpSave"] not working)------------------------------------------------- */ if ($_POST["dptableData"] != "") { 
 $dDate = $_POST["dpdate"];
 $DiD = $_POST["dpdid"];
 $CuName = $_POST["dpcuname"];
 $tableDataJSON = $_POST['dptableData'];
 echo $tableDataJSON;
 echo '<script>alert("This is an alert from PHP!");</script>';
 $tableData = json_decode($tableDataJSON, true);
 $myArray = array();
 $str = json_encode($tableData);
 $word1 = str_replace("]","",$str);
 $word2 = str_replace("[","", $word1);
 $word3 = str_replace('"', '',$word2);
 $myArray = explode(";", $word3);
 dbsetup($db, $text);
 $tablename = $_SESSION["DocIdTabName"];
 dbeditdocidrecord($db, $tablename, "Dispatch", $DiD, "used", $text);
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
 dbclose($db, $text);
 echo json_encode(['status' => 'success', 'message' => 'Data saved successfully']);

?>