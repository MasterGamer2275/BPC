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
   CREATE TABLE TEST_SUPPLIER_4(
   ID INTEGER  PRIMARY KEY AUTOINCREMENT  UNIQUE,
   NAME           TEXT  NOT NULL UNIQUE,
   GSTIN          VARCHAR(15)  NOT NULL,
   ADDRESS        TEXT,
   CITY           TEXT,
   STATE          TEXT,
   PINCODE        INTEGER(6),
   PHONE          INTEGER(10),
   EMAIL          TEXT,
   COMPANYID   INTEGER,
   IGST        TEXT
);
EOF;
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Table created successfully\n";
   }
$sql =<<<EOF
      INSERT INTO TEST_SUPPLIER_4 (NAME,GSTIN,ADDRESS,CITY,STATE,PINCODE,PHONE,EMAIL,COMPANYID,IGST)
      VALUES ('Bluemount Paper Board', '33asfhpp2146b','24- 42 Rupa Nagar, Vincent Road Sun', 'Coimbatore', 'Tamilnadu', '641045', '9894007403', 'infipackaging@gmail.com','6100','Enabled');
      INSERT INTO TEST_SUPPLIER_4 (NAME,GSTIN,ADDRESS,CITY,STATE,PINCODE,PHONE,EMAIL,COMPANYID,IGST)
      VALUES ('Sri Ragunandha Paper Board P ltd', '33AAShpp2146B','J 201 J Block Deccan All Seasons ap', 'COIMBATORE', 'Tamilnadu', '641045', '9894007403','infipackaging@gmail.com','6100','');
EOF;
   $ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
   } else {
      echo "Records created successfully\n";
   }
$res = $db->query("SELECT * FROM TEST_SUPPLIER_4");
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