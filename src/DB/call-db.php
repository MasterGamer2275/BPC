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
session_start();
$_SESSION["companyID"] = "6100";
$_SESSION["SListTabName"] = "TEST_SUPPLIER_4";
$_SESSION["ComListTabName"] = "TEST_COMMODITY_3";
$_SESSION["StListTabName"] = "TEST_STOCK_4";
$_SESSION["POListTabName"] = "TEST_PO_LIST_1";
$_SESSION["CoListTabName"] = "TEST_COMPANY_LIST_2";
$_SESSION["ClListTabName"] = "TEST_CUSTOMER_3";
$_SESSION["PListTabName"] = "TEST_PRODUCT_1";
}

//----------------------------------------DB - Close----------------------------------------//

function dbclose (&$db, &$text) {
   $db->close();
   $text .= "Closed database successfully<br>";
   //echo $text;
   session_destroy();
}

//----------------------------------------DB - Read Table----------------------------------------//

function dbreadtable(&$db, $tablename, &$dbtabdata, &$text) {
  $CompanyID = $_SESSION["companyID"];
  //echo "<script>alert('" . "Hello!" . "');</script>";
  $res = $db->query("SELECT * FROM $tablename WHERE CompanyID = '$CompanyID' ORDER BY ID DESC");
  while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
  array_push($dbtabdata,$row);
  }
  $ret = $db->exec($sql);
   if(!$ret) {
      $err = $db->lastErrorMsg();
      $text .= $err;
      $text .= "<br>";
      echo "<script>alert('" . $err . "');</script>";
   } else {
      $text .= "Table Read Successfully<br>";
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
          echo "<script>alert('" . $err . "');</script>";
        } else { 
          $text .= "Records created succssfully<br>";
      }
}
//----------------------------------------DB - Add record (Customer Table)----------------------------------------//

function dbaddcustomerrecord(&$db, $tablename, $Cname, $CGST, $CAddr, $CCity, $CState, $CPcode, $CPh, $CEmail, $CSAddr, $CACode, $CACPh, &$CompanyID, &$text) { 
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
          echo "<script>alert('" . $err . "');</script>";
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
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
          echo "<script>alert('" . $err . "');</script>";
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
          echo "<script>alert('" . $err . "');</script>";
        } else { 
          $text .= "Records updated successfully<br>";
      }
}

//----------------------------------------DB - Update record (CompanyList Table)----------------------------------------//

function dbeditcompanylistrecord(&$db, $tablename, $ID, $Coname, $CoAddr, $CoCity, $Costate, $CoPcode, $CoPh, $CoEmail, $CoGST, $CoAcode, $CoAPh, $fileToUpload1, $fileToUpload2, $fileToUpload3, &$text) { 
    $sql =<<<EOF
    UPDATE $tablename SET 
    NAME = '$Coname',
    GSTIN = '$CoGST',
    ADDRESS = '$CoAddr',
    CITY= '$CoCity',
    STATE= '$Costate',
    PINCODE= '$CoPcode',
    PHONE= '$CoPh',
    EMAIL= '$CoEmail',
    ADMINPHONEAREACODE = '$CoAcode',
    ADMINPHONE = '$CoAPh',
    COMPANYLOGO = '$fileToUpload1',
    DIGISIG = '$fileToUpload2',
    LETTERHEAD = '$fileToUpload3'  WHERE ID = '$ID';
  EOF;
  $ret = $db->exec($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
          echo "<script>alert('" . $err . "');</script>";
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
          echo "<script>alert('" . $err . "');</script>";
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
          echo "<script>alert('" . $err . "');</script>";
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
   PINCODE        TEXT(6),
   PHONE          TEXT(10),
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

//----------------------------------------DB - Create Table (Company)----------------------------------------//

function dbcreatecompanylisttable(&$db, &$tablename, &$text) {
   $text .= "welcome to create companies list table if not exists<br>";
$sql =<<<EOF
   CREATE TABLE if not exists $tablename(
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
      $err = $db->lastErrorMsg();
      $text .= $err;
      $text .= "<br>";
   } else {
      $text .= "companies list table created successfully<br>";
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

//----------------------------------------DB - Read db record----------------------------------------//

function dbreadrecord(&$db, $tablename, $paramname, $paramvalue, &$dbrowvalues, &$text) {
  $res = $db->query("SELECT * FROM $tablename WHERE ID = '6100'");
  while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
          foreach($row as $key  => $value) {
             array_push($dbrowvalues,$value);
         }
    }
    $ret = $db->exec($sql);
    if(!$ret) {
        $err = $db->lastErrorMsg();
        $text .= $err;
        $text .= "<br>";
    } else {
        $text .= "Record Read Successfully<br>";
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

//----------------------------------------DB - Create Table (Customers)----------------------------------------//

function dbcreatecustomertable(&$db, $tablename, &$text) {
   $text .= "welcome to create customer table if not exists";

$sql =<<<EOF
   CREATE TABLE if not exists $tablename(
   ID INTEGER  PRIMARY KEY AUTOINCREMENT  UNIQUE,
   NAME           TEXT  NOT NULL UNIQUE,
   CLIENTNAME     TEXT,
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
   COMPANYID      INTEGER		   NOT NULL   
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

//----------------------------------------DB - Delete record (Customer Table)----------------------------------------//

function dbdeletecustomerrecord(&$db, $tablename, $ID, &$text) { 
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

//----------------------------------------DB - Add record (Customer Table)----------------------------------------//

function dbaddcustomersrecord(&$db, $tablename, $Cname, $Clname, $CGST, $CAddr, $CCity, $CState, $CPcode, $CPh, $CEmail, $CSAddr, $CACode, $CACPh, &$text) {
  $CompanyID = "6100";
  $sql =<<<EOF
    INSERT INTO $tablename (NAME,CLIENTNAME,GSTIN,ADDRESS,CITY,STATE,PINCODE,PHONE,EMAIL,SECADDRESS,AREACODE,ADMINPHONE,COMPANYID)
    VALUES ('$Cname', '$Clname', '$CGST', '$CAddr', '$CCity', '$CState', '$CPcode', '$CPh', '$CEmail', '$CSAddr', '$CACode', '$CACPh', '$CompanyID');
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

//----------------------------------------DB - Update record (Customer Table)----------------------------------------//
function dbeditcustomer(&$db, $tablename, $ID, $Cname, $Clname, $CGST, $CAddr, $CCity, $CState, $CPcode, $CPh, $CEmail, $CSAddr, $CACode, $CACPh, &$text) { 
   $sql =<<<EOF
   UPDATE $tablename SET
   NAME = '$Cname',
   CLIENTNAME = '$Clname',
   GSTIN = '$CGST',
   ADDRESS = '$CAddr',
   CITY= '$CCity',
   STATE= '$CState',
   PINCODE= '$CPcode',
   PHONE= '$CPh',
   EMAIL= '$CEmail',
   SECADDRESS = '$CSAddr',
   AREACODE = '$CACode',
   ADMINPHONE = '$CACPh' WHERE ID = '$ID';
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

//----------------------------------------DB - Create Table (Products)----------------------------------------//

function dbcreateproducttable(&$db, $tablename, &$text) {
   $text .= "welcome to create product table if not exists";

$sql =<<<EOF
   CREATE TABLE if not exists $tablename(
   ID INTEGER  PRIMARY KEY    AUTOINCREMENT  UNIQUE,
   CUSTOMERNAME   TEXT        NOT NULL,
   DESCRIPTION    TEXT        NOT NULL,
   SPEC           TEXT		   NOT NULL,
   GSM            TEXT		   NOT NULL,
   SIZE           TEXT		   NOT NULL,
   UNIT           TEXT		   NOT NULL,
   RATE           TEXT		   NOT NULL,
   COMPANYID      INTEGER		NOT NULL
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

//----------------------------------------DB - Add record (Product Table)----------------------------------------//

function dbaddproductrecord(&$db, $tablename, $PCName, $PDes, $PSpec, $PGSM, $PSize, $Punit, $PRate, &$text) {
  $CompanyID = "6100";
  $sql =<<<EOF
    INSERT INTO $tablename (CUSTOMERNAME,DESCRIPTION,SPEC,GSM,SIZE,UNIT,RATE,COMPANYID)
    VALUES ('$PCName', '$PDes', '$PSpec', '$PGSM', '$PSize', '$Punit', '$PRate', '$CompanyID');
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

//----------------------------------------DB - check record (Product Table)----------------------------------------//

function dbcheckproductrecord(&$db, $tablename, $PCName, $PSpec, $PSize, $Punit, $CompanyID, $found, &$text) {
  $CompanyID = "6100";
  $dbtabdata = array(array());
  $i = 0;
  $res = $db->query("SELECT * FROM $tablename WHERE NAME='$PCName' and SPEC='$PSpec' and SIZE='$PSize' and UNIT='$Punit' and COMPANYID ='$CompanyID'");
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

?>