<?php
//SQL lite 3 DB API for all forms
$root = $_SERVER['DOCUMENT_ROOT'];
//set all constant values used in the DB operations
$CompanyID = "6100";

//----------------------------------------DB - Setup----------------------------------------//
function dbsetup() {
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

function dbclose() {
   $db->close();
   echo "Closed database successfully\n";
}

//----------------------------------------DB - Read Table----------------------------------------//

function dbreadtable($tablename) {
  $res = $db->query("SELECT * FROM $tablename");
  $tabdata = array(array());
  while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
  array_push($tabdata,$row);
  }
  $sql =<<<EOF
  EOF;
   $ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
   } else {
      echo "Tabe Read Successfully\n";
    }
  return $data;
}  

//----------------------------------------DB - Add record (Supplier Table)----------------------------------------//

function dbaddsupplierrecord($tablename, $Sname, $SuGST, $SAddr, $SCity, $SState, $SPcode, $SPh, $SEmail, $CompanyID, $SIGST) { 
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

//----------------------------------------DB - Add record (Commodity Table)----------------------------------------//

function dbaddcommodityrecord($tablename, $Cname, $CSname, $CGSM, $CBF, $CompanyID) {
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

function dbcreatesuppliertable($tablename) {
   echo "welcome to create supplier table if not exists";
   $sql =<<<EOF
      CREATE TABLE if not exists $tablename (
      ID INTEGER  PRIMARY KEY AUTOINCREMENT  UNIQUE,
      NAME           TEXT  NOT NULL UNIQUE,
      GSTIN          VARCHAR(15)  NOT NULL,
      ADDRESS        TEXT,
      CITY           TEXT,
      STATE          TEXT,
      PINCODE        INTEGER(6),
      PHONE          INTEGER(10),
      EMAIL          TEXT,
      COMPANYID      INTEGER,
      IGST           TEXT
      );
   EOF;
   $ret = $db->exec($sql);
     if(!$ret){
         echo $db->lastErrorMsg();
     } else {
         echo "Supplier Table created successfully\n";
     }
}

//----------------------------------------DB - Create Table (Commodities)----------------------------------------//

function dbcreatecommoditytable($tablename) {
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

//----------------------------------------DB - Get Column Values----------------------------------------//

function dbgetcolumnname($tablename, $columnname) {
  $res = $db->query("SELECT $columnname FROM $tablename");
  $dbcolvalues = array();
  while (($value = $res->fetcharray(SQLITE3_ASSOC))) {
      array_push($colvalues,$value);
      }
  $sql =<<<EOF
  EOF;
    $ret = $db->exec($sql);
    if(!$ret) {
        echo $db->lastErrorMsg();
    } else {
        echo "Column Read Successfully\n";
    }
  return $dbcolvalues;
}

//----------------------------------------DB - Get Value----------------------------------------//

function dbgetvalue($tablename, $columnname) {
  $res = $db->query("SELECT $columnname FROM $tablename");
  $colvalues = array();
  while (($value = $res->fetcharray(SQLITE3_ASSOC))) {
      array_push($colvalues,$value);
      }
  $sql =<<<EOF
  EOF;
    $ret = $db->exec($sql);
    if(!$ret) {
        echo $db->lastErrorMsg();
    } else {
        echo "Column Read Successfully\n";
    }
  return $value;
}

//----------------------------------------DB - Get Column Values (filter by)----------------------------------------//






?>