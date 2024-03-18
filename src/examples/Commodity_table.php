 <?php
include 'main-page/db-setup.php';
$sql =<<<EOF
   CREATE TABLE TEST_COMMODITY1(
   ID INT AUTO_INCREMENT   PRIMARY KEY     NOT NULL,
   NAME           TEXT    NOT NULL,
   SUPPLIERID     INT     NOT NULL,
   GSM            INT     NOT NULL,
   BF        INT     NOT NULL
);
EOF;
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Table created successfully\n";
   }
$sql =<<<EOF
      INSERT INTO TEST_COMMODITY (NAME,SUPPLIERID,GSM,BF)
      VALUES ('GYS', 1, 70, 8);

      INSERT INTO TEST_COMMODITY (NAME,SUPPLIERID,GSM,BF)
      VALUES ('SDL', 1, 70, 8);

      INSERT INTO TEST_COMMODITY (NAME,SUPPLIERID,GSM,BF)
      VALUES ('GYS', 1, 90, 8);

      INSERT INTO TEST_COMMODITY (NAME,SUPPLIERID,GSM,BF)
      VALUES ('GYS', 1, 110, 8);
EOF;

   $ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
   } else {
      echo "Records created successfully\n";
   }
$res = $db->query("SELECT * FROM TEST_COMMODITY");
while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
  var_dump($row);
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