 <?php
// If the request is made from our space preview functionality then turn on PHP error reporting
if (isset($_SERVER['HTTP_X_FORWARDED_URL']) && strpos($_SERVER['HTTP_X_FORWARDED_URL'], '.w3spaces-preview.com/') !== false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}
?>
 <?php
include 'main-page/db-setup.php';
$sql =<<<EOF
   CREATE TABLE TEST_SUPPLIER(
   ID INT PRIMARY KEY     NOT NULL,
   NAME           TEXT    NOT NULL,
   ADDRESS        TEXT    NOT NULL,
   CITY           TEXT     NOT NULL,
   STATE          TEXT     NOT NULL,
   PINCODE        TEXT     NOT NULL,
   PHONE          TEXT     NOT NULL,
   EMAIL          TEXT     NOT NULL
);
EOF;
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Table created successfully\n";
   }
$sql =<<<EOF
      INSERT INTO TEST_SUPPLIER (ID,NAME,ADDRESS,CITY,STATE,PINCODE,PHONE,EMAIL)
      VALUES (1, 'Sup1', '20 Mount Road', 'Chennai', 'Tamilnadu', '401789','9788856789','test@gmail.com');
EOF;
   $ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
   } else {
      echo "Records created successfully\n";
   }
$res = $db->query("SELECT * FROM TEST_SUPPLIER");
$data = array(array());
while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
  array_push($data,$row);
}
foreach ($data as $row) {
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

include 'main-page/db-close.php';

?>