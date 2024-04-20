<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  $dbtabdata = array(array());
  dbsetup($db, $text);
  $tablename = $_SESSION["StListTabName"];
  $companyId = $_SESSION["companyID"];
  dbcreatestocktable($db, $tablename, $text);
  $res = $db->query("
    SELECT 
      INVNUM,
      SUPPLIERNAME,
      COUNT(REELNUMBER) As NumofReels,
      SUM(REELWEIGHT) As TotalWeight,
      SUM(TOTAL) as Total
    FROM 
      $tablename 
    WHERE 
      COMPANYID = '$companyId' 
    GROUP BY 
      INVNUM;
");
// Output data
while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
  array_push($dbtabdata,$row);
}
                    foreach ($dbtabdata as $row) {
                        echo "<tr>";
                            foreach ($row as $cell) {
                                echo "<td>$cell</td>&emsp;";
                            }      
                    echo "</tr><br>";
                    }
  dbclose($db, $text);
?>