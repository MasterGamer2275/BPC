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
   CREATE TABLE if not exists TEST_CUSTOMER_1(
   ID INTEGER  PRIMARY KEY AUTOINCREMENT  UNIQUE,
   NAME           TEXT  NOT NULL UNIQUE,
   GSTIN          VARCHAR(15)  NOT NULL,
   ADDRESS        TEXT		   NOT NULL,
   CITY           TEXT		   NOT NULL,
   STATE          TEXT		   NOT NULL,
   PINCODE        TEXT		   NOT NULL,
   PHONE          TEXT		   NOT NULL,
   EMAIL          TEXT		   NOT NULL,
   SECADDRESS     TEXT,
   AREACODE       TEXT,
   ADMINPHONE     TEXT,
   COMPANYID   INTEGER		   NOT NULL
);
EOF;
   $ret = $db->exec($sql);
   if(!$ret){
      $err = $db->lastErrorMsg();
      $text .= $err;
      $text .= "<br>";
   } else {
      $text .= "Table created successfully<br>";
   }
$sql =<<<EOF
      INSERT INTO TEST_CUSTOMER_1 (NAME,GSTIN,ADDRESS,CITY,STATE,PINCODE,PHONE,EMAIL, SECADDRESS, AREACODE, ADMINPHONE, COMPANYID)
      VALUES ('TULASI PHARMACY', '33AYRPD6236ACDF','Complex Rd, Sundarapuram', 'COIMBATORE', 'Tamilnadu', '641045', '9894007403', 'test@gmail.com', '+91422', '253689', '', '', '', '6100');
EOF;    
$ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
   } else {
      echo "Records created successfully\n";
   }
$res = $db->query("SELECT * FROM TEST_CUSTOMER_1");
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

   $db->close();
   echo "Closed database successfully\n";

?>   