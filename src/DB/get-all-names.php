  <?php
//$root = $_SERVER['DOCUMENT_ROOT'];
//include ($root."/DB/db-setup.php");
/*SELECT playername 
FROM users
WHERE id = player_locations.playerid 
  AND player_locations.location = "DOWNTOWN";
  */

$allnames = array();
$res = $db->query(f"SELECT COUNT(*) FROM {$tablename}");
$value = $res->fetchone();
$row_count = $res[0];
echo "$row_count";
$i = 0;
for ($i = 0; $i <= $row_count; $i++) {
        $res = $db->query("SELECT $varname FROM $tablename WHERE ID = '$i'");
        echo "$i";
        while (($value = $res->fetcharray(SQLITE3_ASSOC))) {
   array_push($allnames,$value);
    }
 }

 foreach ($allnames as $row) {
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
      echo "Tabe Read Successfully\n";
   }

//include ($root."/DB/db-close.php");

?> 