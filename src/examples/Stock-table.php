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
   CREATE TABLE if not exists TEST_STOCK_1(
   ID INTEGER  PRIMARY KEY AUTOINCREMENT  UNIQUE,
   DATE                 VARCHAR(15)  NOT NULL,
   INVNUM               VARCHAR(50) NOT NULL,
   SUPPLIERNAME         TEXT  NOT NULL,
   COMMODITYNAMEORDESC  VARCHAR(50) NOT NULL,
   REELSIZE          INTEGER(20)  NOT NULL,
   REELNUMBER         INTEGER(20) NOT NULL,
   REELWEIGHT       INTEGER(20)  NOT NULL,
   RATE          INTEGER(20)  NOT NULL,
   SGST          INTEGER(3) NOT NULL,
   CGST          INTEGER(3) NOT NULL,
   IGST          INTEGER(3) NOT NULL,
   TOTAL        INTEGER(20) NOT NULL,
   COMPANYID    INTEGER     NOT NULL
);
EOF;
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Table created successfully\n";
   }
$sql =<<<EOF
    INSERT INTO TEST_STOCK_1 (DATE,INVNUM,SUPPLIERNAME,COMMODITYNAMEORDESC,REELSIZE,REELNUMBER,REELWEIGHT,RATE,SGST,CGST,IGST,TOTAL,COMPANYID)
    VALUES ('03/24/2024', 'ASD12', 'SUP1', 'SLDX', '37.5', '9003', '146', '35', '6', '6', '0', '22.6', "6100");
    INSERT INTO TEST_STOCK_1 (DATE,INVNUM,SUPPLIERNAME,COMMODITYNAMEORDESC,REELSIZE,REELNUMBER,REELWEIGHT,RATE,SGST,CGST,IGST,TOTAL,COMPANYID)
    VALUES ('03/24/2024', 'ASD12', 'SUP1', 'SLDX', '37.5', '9003', '10', '35', '0', '0', '0', '11.3', "6100");
EOF;
$ret = $db->exec($sql);
     if(!$ret) {
          echo $db->lastErrorMsg();
        } else { 
          echo "Records created succssfully\n";
      }
$res = $db->query("SELECT * FROM TEST_STOCK_1 ");
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