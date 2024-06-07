DELETE FROM $tablename WHERE ID BETWEEN 5 AND 8;
ALTER TABLE TEST_SUPPLIER_4 ADD COLUMN IGST Text;
UPDATE $tablename SET IGST = 'off' WHERE ID = "3";
UPDATE $tablename SET IGST = 'off' WHERE ID = "4";
SELECT * FROM $tablename  WHERE NAME = '$hId';
SELECT * FROM Customers  ORDER BY City DESC;
DELETE FROM $tablename;
SELECT MIN($columnname) FROM $tablename;
SELECT Count(*) FROM $tablename WHERE Price = 18;
SELECT Avg(Price) FROM $tablename;
SELECT Sum(Price) FROM Products;
SELECT * FROM Customers WHERE City LIKE 'a%';
SELECT * FROM Customers WHERE City LIKE '_a%';
SELECT * FROM Customers WHERE City LIKE '[acs]%';
SELECT * FROM Customers WHERE Country IN ('Norway', 'France');
ALTER TABLE TEST_COMMODITY_3 ADD REELSIZEinCM INTEGER;
UPDATE $tablename SET REELSIZEinCM = '31.2' WHERE ID BETWEEN '1' AND '6';

  $sql =<<<EOF
    DELETE FROM $tablename WHERE ID BETWEEN 15 AND 17;
  EOF;
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Done!";
   }


    $sql =<<<EOF
    UPDATE $tablename SET UNIT = 'cm';
  EOF;
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Done!";
   }

     $sql =<<<EOF
   ALTER TABLE TEST_COMPANY_LIST_2 ADD MACHINELIST TEXT NOT NULL DEFAULT 'your_default_value';
   ALTER TABLE TEST_COMPANY_LIST_2 ADD GODOWNLIST TEXT NOT NULL DEFAULT 'your_default_value';
  EOF;
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Done!";
   }

     $sql =<<<EOF
     DROP TABLE TEST_PURCHASE_1;
  EOF;
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Done!";
   }
  

    $sql =<<<EOF
   ALTER TABLE PRODUCT_TABLE_1
   RENAME COLUMN STOCK TO OPENINGSTOCK1;
  EOF;
   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Done!";
   }

   <?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  dbsetup($db, $text);
  $tablename = $_SESSION["DocIdTabName"];
  dbcreatedocidtable($db, $tablename, $text);
for ($i = 0; $i < 15000; $i++) {
    $k = 820000 + $i; // Increment $k within the loop
    dbadddocidrecord($db, $tablename, "Quotation", $k, $text);
}
  $dbtabdata = array(array());
  dbreadtable($db, $tablename, $dbtabdata, $text);
      foreach ($dbtabdata as $row) {
        echo "<tr>";
        foreach ($row as $cell) {
                  echo "<td>$cell</td>";
                }
        echo "</tr>";
    }
  dbclose($db, $text);
  echo $text;
  ?>

  <?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  dbsetup($db, $text);
  $tablename = $_SESSION["DocIdTabName"];
  dbcreatedocidtable($db, $tablename, $text);
  dbgetdocid($db, $tablename, "Dispatch", $DOCID, $text);
  dbeditdocidrecord($db, $tablename, "Dispatch", $DOCID, "alloted", $text);
  echo $DOCID;
  dbclose($db, $text);
  echo $text;
  ?>

  <?php
  require "/home/app/src/Reset.php";
  require "/home/app/src/DB/call-db.php";
$tablename = "DOCID_TABLE";

for ($i = 0; $i < 15000; $i++) {
    $k = 820000 + $i; // Increment $k within the loop
    dbadddocidrecord($db, $tablename, "Quotation", $k, $text);
}

for ($i = 0; $i < 15000; $i++) {
    $k = 710000 + $i; // Increment $k within the loop
    dbadddocidrecord($db, $tablename, "Dispatch", $k, $text);
}


for ($i = 0; $i < 15000; $i++) {
    $k = 810000 + $i; // Increment $k within the loop
    dbadddocidrecord($db, $tablename, "Purchase", $k, $text);
}


for ($i = 0; $i < 15000; $i++) {
    $k = 720000 + $i; // Increment $k within the loop
    dbadddocidrecord($db, $tablename, "Invoice", $k, $text);
}

?>