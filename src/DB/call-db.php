<?php
//change the global variable to a function input
//***SQL Injection Vulnerability: Your code is vulnerable to SQL injection attacks because it directly inserts variables into SQL queries. Consider using prepared statements or parameterized queries to prevent this vulnerability.
//Passing variables by reference (&) is not necessary unless you intend to modify them within the function. In most cases, it's better to pass variables by value.
//You're handling errors by appending them to $text, which is reasonable for debugging. However, it might be better to throw exceptions or return error codes for better error handling.global $text;
//Function names like dbcreatesuppliertable could be made more concise and follow a consistent naming convention for better readability.
//Ensure consistent indentation for better code readability.

//SQL lite 3 DB API for all forms
//----------------------------------------DB - Setup----------------------------------------//
function dbsetup(&$db, &$text) {
     $text = "Debug Mode:<br>";
     class MyDB extends SQLite3 {
      function __construct() {
         $this->open('w3s-dynamic-storage\database.db');
      }
   }
   $db = new MyDB();
   if(!$db) {
      $err = $db->lastErrorMsg();
      $text .= $err;
      $text .= "<br>";
   } else {
     $text .= "Opened database successfully<br>";
   }
}

//----------------------------------------DB - Close----------------------------------------//

function dbclose (&$db, &$text) {
   $db->close();
   $text .= "Closed database successfully<br>";
   echo $text;
}

//----------------------------------------DB - Read Table----------------------------------------//

function dbreadtable(&$db, $tablename, &$dbtabdata, &$text) {
  $CompanyID = "6100";
  $res = $db->query("SELECT * FROM $tablename WHERE CompanyID = '$CompanyID' ORDER BY ID DESC");
  while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
  array_push($dbtabdata,$row);
  }
  $ret = $db->exec($sql);
   if(!$ret) {
      $err = $db->lastErrorMsg();
      $text .= $err;
      $text .= "<br>";
   } else {
      $text .= "Tabe Read Successfully<br>";
    }
}  

//----------------------------------------DB - Add record (Supplier Table)----------------------------------------//

function dbaddsupplierrecord(&$db, $tablename, $Sname, $SuGST, $SAddr, $SCity, $SState, $SPcode, $SPh, $SEmail, &$CompanyID, $SIGST, &$text) { 
  $CompanyID = "6100";
  $sql =<<<EOF
    INSERT INTO $tablename (NAME,GSTIN,ADDRESS,CITY,STATE,PINCODE,PHONE,EMAIL,COMPANYID,IGST)
    VALUES ('$Sname', '$SuGST', '$SAddr', '$SCity', '$SState', '$SPcode', '$SPh', '$SEmail', '$CompanyID','$SIGST');
  EOF;
  $ret = $db->exec($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records created succssfully<br>";
      }
}

//----------------------------------------DB - Add record (Stock Table)----------------------------------------//

function dbaddstockrecord(&$db, $tablename, $date, $invnum, $name, $desc, $rn, $rw, $rate, $sgst, $cgst, $igst, $total, &$text) { 
  $CompanyID = "6100";
  $sql =<<<EOF
    INSERT INTO $tablename (DATE,INVNUM,SUPPLIERNAME,COMMODITYNAME,REELNUMBER,REELWEIGHT,RATE,SGST,CGST,IGST,TOTAL,COMPANYID)
    VALUES ('$date', '$invnum', '$name', '$desc', '$rn', '$rw', '$rate', '$sgst', '$cgst', '$igst', '$total', '$CompanyID');
  EOF;
  $ret = $db->exec($sql);
  echo $ret;
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records created succssfully<br>";
      }
}

//----------------------------------------DB - Update record (Supplier Table)----------------------------------------//

function dbeditsupplierrecord(&$db, $tablename, $ID, $SuGST, $SAddr, $SCity, $SState, $SPcode, $SPh, $SEmail, $SIGST, &$text) { 
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
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records updated successfully<br>";
      }
}

//----------------------------------------DB - Delete record (Supplier Table)----------------------------------------//

function dbdeletesupplierrecord(&$db, $tablename, $ID, &$text) { 
  $sql =<<<EOF
  DELETE FROM $tablename WHERE ID = '$ID';
  EOF;
  $ret = $db->exec($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records deleted successfully<br>";
      }
}

//----------------------------------------DB - Add record (Commodity Table)----------------------------------------//

function dbaddcommodityrecord(&$db, $tablename, $Cname, $CSname, $CGSM, $CBF, &$CompanyID, $ReelSize, &$text) {
  $CompanyID = "6100";
  $sql =<<<EOF
    INSERT INTO $tablename (NAME,SUPPLIERNAME,GSM,BF,COMPANYID, REELSIZEinCM)
    VALUES ('$Cname', '$CSname', '$CGSM', '$CBF', '$CompanyID', '$ReelSize');
 EOF;
 $ret = $db->exec($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records created succssfully<br>";
      }
}

//----------------------------------------DB - check record (Commodity Table)----------------------------------------//

function dbcheckcommodityrecord(&$db, $tablename, $Cname, $CSname, $CGSM, $CBF, &$CompanyID, $ReelSize, &$found, &$text) {
  $CompanyID = "6100";
  $dbtabdata = array(array());
  $i = 0;
  $res = $db->query("SELECT * FROM $tablename WHERE NAME='$Cname' and SUPPLIERNAME='$CSname' and GSM='$CGSM' and BF='$CBF' and COMPANYID ='$CompanyID' and REELSIZEinCM = '$ReelSize'");
  while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
  array_push($dbtabdata,$row);
  $i = $i+1;
  }
  $found = ($i>0);
  if ($found) {
   $text .= "Record Already Exists <br>";
  }
  $ret = $db->exec($sql);
   if(!$ret) {
      $err = $db->lastErrorMsg();
      $text .= $err;
      $text .= "<br>";
   } else {
      $text .= "DB check completed<br>";
    }
} 

//----------------------------------------DB - Create Table (Suppliers)----------------------------------------//

function dbcreatesuppliertable(&$db, $tablename, &$text) {
   $text .= "welcome to create supplier table if not exists";

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
      $err = $db->lastErrorMsg();
      $text .= $err;
      $text .= "<br>";
   } else {
      $text .= "Table created successfully<br>";
   }
}

//----------------------------------------DB - Create Table (Commodities)----------------------------------------//

function dbcreatecommoditytable(&$db, $tablename, &$text) {
 $text .= "welcome to create commodity table if not exists\n";
 $sql =<<<EOF
   CREATE TABLE if not exists $tablename (
   ID           INTEGER     NOT NULL    PRIMARY KEY AUTOINCREMENT  UNIQUE,
   NAME         TEXT        NOT NULL,
   SUPPLIERNAME TEXT        NOT NULL,
   GSM          INTEGER     NOT NULL,
   BF           INTEGER     NOT NULL,
   COMPANYID    INTEGER     NOT NULL,
   REELSIZEinCM   INTEGER  NOT NULL
);
EOF;
$ret = $db->exec($sql);
    if(!$ret){
        $err = $db->lastErrorMsg();
        $text .= $err;
        $text .= "<br>";
    } else {
        $text .= "Commodity Table created successfully<br>";
    }
}
//----------------------------------------DB - Create Table (Stock)----------------------------------------//

function dbcreatestocktable(&$db, &$tablename, &$text) {
   $text .= "welcome to create stock table if not exists<br>";
$sql =<<<EOF
   CREATE TABLE if not exists $tablename(
   ID INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
   DATE                 TEXT        NOT NULL,
   INVNUM               TEXT        NOT NULL,
   SUPPLIERNAME         TEXT        NOT NULL,
   COMMODITYNAME        TEXT        NOT NULL,
   REELNUMBER           INTEGER     NOT NULL,
   REELWEIGHT           INTEGER     NOT NULL,
   RATE                 INTEGER,
   SGST                 INTEGER,
   CGST                 INTEGER,
   IGST                 INTEGER,
   TOTAL                INTEGER,
   COMPANYID            INTEGER     NOT NULL
);
EOF;
   $ret = $db->exec($sql);
   if(!$ret){
      $err = $db->lastErrorMsg();
      $text .= $err;
      $text .= "<br>";
   } else {
      $text .= "Stock table created successfully<br>";
   }
}

//----------------------------------------DB - Get Column Values----------------------------------------//

function dbgetcolumnname(&$db, $tablename, $columnname, &$dbcolvalues, &$text) {
  $res = $db->query("SELECT $columnname FROM $tablename ORDER BY ID DESC");
  $dbcolvalues = array();
  while (($value = $res->fetcharray(SQLITE3_ASSOC))) {
      array_push($dbcolvalues,$value);
      }
    $ret = $db->exec($sql);
    if(!$ret) {
        $err = $db->lastErrorMsg();
        $text .= $err;
        $text .= "<br>";
    } else {
        $text .= "Column Read Successfully<br>";
    }
}

//----------------------------------------DB - Get Single Value----------------------------------------//
function dbgetvalue(&$db, $tablename, $columnname, $paramname, $paramvalue, &$outputvalue, &$text) {
  $res = $db->query("SELECT $columnname FROM $tablename WHERE $paramname = '$paramvalue'");
  //$res = $db->query("SELECT IGST FROM TEST_SUPPLIER_4");
  $outputvalue = array();
  while (($value = $res->fetcharray(SQLITE3_ASSOC))) {
      array_push($outputvalue,$value);
      }
  $ret = $db->exec($sql);
    if(!$ret) {
        $err = $db->lastErrorMsg();
        $text .= $err;
        $text .= "<br>";
    } else {
        $text .= "Data Read Successfully<br>";
    }
}

?>