 <?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root."/DB/call-db.php";
  dbsetup($db, $text);
  $tablename = $_SESSION["CoListTabName"];
  $paramname = "ID";
  $paramvalue = "6100";
  $mycompanyvalues = array();
  dbcreatecompanylisttable($db, $tablename, $text);
  dbreadrecord($db, $tablename, $paramname, $paramvalue, $mycompanyvalues, $text);
  dbclose($db, $text);
  //$locationlist = json_encode($mycompanyvalues[15]);
  $tempArray = explode(",\r\n", $mycompanyvalues[15]);
  $templist = json_encode($tempArray );
  $val = str_replace("]", "", $templist);
  $val = str_replace("[", "", $val);
  $val = str_replace("\"", "", $val);
  $locationlist = explode(",", $val);
      foreach ($locationlist as $value) {
            echo "<option value='$value'>$value</option>";
          }
?>