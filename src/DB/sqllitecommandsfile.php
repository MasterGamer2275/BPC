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