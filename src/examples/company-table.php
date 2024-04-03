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
   CREATE TABLE TEST_COMPANY_LIST_2(
   ID                      INTEGER           PRIMARY KEY AUTOINCREMENT  UNIQUE,
   NAME                    TEXT              NOT NULL    UNIQUE,
   GSTIN                   VARCHAR(15)       NOT NULL    UNIQUE,
   ADDRESS                 TEXT              NOT NULL,
   CITY                    TEXT              NOT NULL,
   STATE                   TEXT              NOT NULL,
   PINCODE                 TEXT              NOT NULL,
   PHONE                   TEXT              NOT NULL,
   EMAIL                   TEXT              NOT NULL,
   ADMINPHONEAREACODE      TEXT,
   ADMINPHONE              TEXT,
   COMPANYLOGO             TEXT              NOT NULL,
   DIGISIG                 TEXT              NOT NULL,
   LETTERHEAD              TEXT              NOT NULL
);
EOF;
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Table created successfully\n";
   }
$sql =<<<EOF
      INSERT INTO TEST_COMPANY_LIST_2 (ID,NAME,GSTIN,ADDRESS,CITY,STATE,PINCODE,PHONE,EMAIL,ADMINPHONEAREACODE,ADMINPHONE,COMPANYLOGO,DIGISIG,LETTERHEAD)
      VALUES ('6100', 'INFI PACKAGING1', '33AYRPD6236E1ZJ','24- 42 RUPA NAGAR, RAMANATHAPURAM', 'COIMBATORE', 'Tamilnadu', '641045', '9894007403', 'infipackaging@gmail.com', '+9144', '253689', 'Company_Logo.png', 'DigitalSignature.png', 'Letterhead1.png');
EOF;    
$ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
   } else {
      echo "Records created successfully\n";
   }
$res = $db->query("SELECT * FROM TEST_COMPANY_LIST_2");
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