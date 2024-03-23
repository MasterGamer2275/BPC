<?php
//SQL lite 3 DB API for all forms
//----------------------------------------DB - Setup----------------------------------------//
function dbsetup(&$db) {
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
}
//----------------------------------------DB - Close----------------------------------------//

function dbclose (&$db) {
   $db->close();
   echo "Closed database successfully\n";
}

//----------------------------------------DB - Read Table----------------------------------------//

function dbreadtable(&$db, &$tablename, &$dbtabdata) {
  $CompanyID = "6100";
  $res = $db->query("SELECT * FROM $tablename WHERE CompanyID = '$CompanyID' ORDER BY ID DESC");
  while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
  array_push($dbtabdata,$row);
  }
  $sql =<<<EOF
  EOF;
   $ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
   } else {
      echo "Tabe Read Successfully\n";
    }
}  

//----------------------------------------DB - Add record (Supplier Table)----------------------------------------//

function dbaddsupplierrecord(&$db, &$tablename, &$Sname, &$SuGST, &$SAddr, &$SCity, &$SState, &$SPcode, &$SPh, &$SEmail, &$CompanyID, &$SIGST) { 
  $CompanyID = "6100";
  $sql =<<<EOF
    INSERT INTO $tablename (NAME,GSTIN,ADDRESS,CITY,STATE,PINCODE,PHONE,EMAIL,COMPANYID,IGST)
    VALUES ('$Sname', '$SuGST', '$SAddr', '$SCity', '$SState', '$SPcode', '$SPh', '$SEmail', '$CompanyID','$SIGST');
  EOF;
  $ret = $db->exec($sql);
     if(!$ret) {
          echo $db->lastErrorMsg();
        } else { 
          echo "Records created succssfully\n";
      }
}

//----------------------------------------DB - Add record (Stock Table)----------------------------------------//

function dbaddstockrecord(&$db, &$tablename, &$date, &$invnum,&$name, &$desc, &$rs, &$rn, &$rw, &$rate, &$sgst, &$cgst, &$igst, &$total) { 
  $CompanyID = "6100";
  $sql =<<<EOF
    INSERT INTO $tablename (DATE,INVNUM,SUPPLIERNAME,COMMODITYNAMEORDESC,REELSIZE,REELNUMBER,REELWEIGHT,RATE,SGST,CGST,IGST,TOTAL,COMPANYID)
    VALUES ('$date', '$invnum', '$name', '$desc', '$rs', '$rn', '$rw', '$rate', '$sgst', '$cgst', '$igst', '$total', '$CompanyID');
  EOF;
  $ret = $db->exec($sql);
     if(!$ret) {
          echo $db->lastErrorMsg();
        } else { 
          echo "Records created succssfully\n";
      }
}

//----------------------------------------DB - Update record (Supplier Table)----------------------------------------//

function dbeditsupplierrecord(&$db, &$tablename, &$ID, &$SuGST, &$SAddr, &$SCity, &$SState, &$SPcode, &$SPh, &$SEmail, &$SIGST) { 
    $sql =<<<EOF
    UPDATE $tablename SET 
    GSTIN = '$SuGST',
    ADDRESS = '$SAddr',
    CITY= '$SCity',
    STATE= '$SState',
    PINCODE= '$SPcode',
    PHONE= '$SPh',
    EMAIL= '$SEmail',
    IGST= '$SIGST' WHERE ID = '$ID';
  EOF;
  $ret = $db->exec($sql);
     if(!$ret) {
          echo $db->lastErrorMsg();
        } else { 
          echo "Records updated successfully\n";
      }
}

//----------------------------------------DB - Add record (Commodity Table)----------------------------------------//

function dbaddcommodityrecord(&$db, &$tablename, &$Cname, &$CSname, &$CGSM, &$CBF, &$CompanyID) {
  $CompanyID = "6100";
  $sql =<<<EOF
    INSERT INTO $tablename (NAME,SUPPLIERNAME,GSM,BF,COMPANYID)
    VALUES ('$Cname', '$CSname', '$CGSM', '$CBF', '$CompanyID');
 EOF;
 $ret = $db->exec($sql);
     if(!$ret) {
          echo $db->lastErrorMsg();
        } else { 
          echo "Records created succssfully\n";
      }
}

//----------------------------------------DB - Create Table (Suppliers)----------------------------------------//

function dbcreatesuppliertable(&$db, &$tablename) {
   echo "welcome to create supplier table if not exists";

  $sql =<<<EOF
   CREATE TABLE if not exists $tablename(
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
}

//----------------------------------------DB - Create Table (Commodities)----------------------------------------//

function dbcreatecommoditytable(&$db, &$tablename) {
 echo "welcome to create commodity table if not exists\n";
 $sql =<<<EOF
   CREATE TABLE if not exists $tablename (
   ID           INTEGER     NOT NULL    PRIMARY KEY AUTOINCREMENT  UNIQUE,
   NAME         TEXT        NOT NULL,
   SUPPLIERNAME TEXT        NOT NULL,
   GSM          INTEGER     NOT NULL,
   BF           INTEGER     NOT NULL,
   COMPANYID    INTEGER     NOT NULL
);
EOF;
$ret = $db->exec($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        echo "Commodity Table created successfully\n";
    }
}
//----------------------------------------DB - Create Table (Stock)----------------------------------------//

function dbcreatestocktable(&$db, &$tablename) {
   echo "welcome to create stock table if not exists";
$sql =<<<EOF
   CREATE TABLE if not exists $tablename(
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
      echo "Stock table created successfully\n";
   }
}

//----------------------------------------DB - Get Column Values----------------------------------------//

function dbgetcolumnname(&$db, &$tablename, &$columnname, &$dbcolvalues) {
  $res = $db->query("SELECT $columnname FROM $tablename ORDER BY ID DESC");
  $dbcolvalues = array();
  while (($value = $res->fetcharray(SQLITE3_ASSOC))) {
      array_push($dbcolvalues,$value);
      }
  $sql =<<<EOF
  EOF;
    $ret = $db->exec($sql);
    if(!$ret) {
        echo $db->lastErrorMsg();
    } else {
        echo "Column Read Successfully\n";
    }
}

//----------------------------------------DB - Get Single Value----------------------------------------//
function dbgetvalue(&$db, &$tablename, &$columnname, &$paramname, &$paramvalue, &$outputvalue) {
  $res = $db->query("SELECT $columnname FROM $tablename WHERE $paramname = '$paramvalue'");
  //$res = $db->query("SELECT IGST FROM TEST_SUPPLIER_4");
  $outputvalue = array();
  while (($value = $res->fetcharray(SQLITE3_ASSOC))) {
      array_push($outputvalue,$value);
      }

  $sql =<<<EOF
  EOF;
    $ret = $db->exec($sql);
    if(!$ret) {
        echo $db->lastErrorMsg();
    } else {
        echo "Data Read Successfully\n";
    }
}

?>