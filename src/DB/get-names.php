  <?php
//$root = $_SERVER['DOCUMENT_ROOT'];
//include ($root."/DB/db-setup.php");
/*SELECT playername 
FROM users
WHERE id = player_locations.playerid 
  AND player_locations.location = "DOWNTOWN";
  */

$names = array();
$length = count($id);
$i = 0;
for ($i = 0; $i <= $length; $i++) {
        $res = $db->query("SELECT $varname FROM $tablename WHERE ID = '$id[$i]'");
        while (($value = $res->fetcharray(SQLITE3_ASSOC))) {
   array_push($names,$value);
    }
 }
/*
 foreach ($names as $row) {
    foreach ($row as $value) {
        echo "<tr>$value</tr>";
        }
    }

$sql =<<<EOF
EOF;
   $ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
   } else {
      //echo "Tabe Read Successfully\n";
   }

//include ($root."/DB/db-close.php");
*/
?>