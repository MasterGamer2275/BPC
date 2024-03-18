<?php

   class MyDB extends SQLite3 {
      function __construct() {
         $this->open('w3s-dynamic-storage\database.db');
      }
   }
   $db = new MyDB();
   if(!$db) {
      echo $db->lastErrorMsg();
   } else {
     echo "Opened database successfully\n";
   }

$sql =<<<EOF
   CREATE TABLE TEST_SUPPLIER_2(
   ID INTEGER  PRIMARY KEY AUTOINCREMENT,
   NAME           TEXT  NOT NULL,
   GSTIN          TEXT  NOT NULL,
   ADDRESS        TEXT,
   CITY           TEXT,
   STATE          TEXT,
   PINCODE        TEXT,
   PHONE          TEXT,
   EMAIL          TEXT
);
EOF;
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Table created successfully\n";
   }
$sql =<<<EOF
      INSERT INTO TEST_SUPPLIER_2 (NAME,GSTIN,ADDRESS,CITY,STATE,PINCODE,PHONE,EMAIL)
      VALUES ('Mill no.1', '1234567891011','20 Mount Road', 'Chennai', 'Tamilnadu', '401789','9788856789','test@gmail.com');
      INSERT INTO TEST_SUPPLIER_2 (NAME,GSTIN,ADDRESS,CITY,STATE,PINCODE,PHONE,EMAIL)
      VALUES ('Mill no.2', '1234567891011','', '', '', '','','');
EOF;
   $ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
   } else {
      echo "Records created successfully\n";
   }
$res = $db->query("SELECT * FROM TEST_SUPPLIER_2");
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
?>

<?php

   $db->close();
   echo "Closed database successfully\n";

?>