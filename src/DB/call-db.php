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
     $err = "Db Error:";
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
   //add delete stock 4, 5, 6, 7 & 8
session_start();
$_SESSION["companyID"] = "6100";
$_SESSION["SListTabName"] = "TEST_SUPPLIER_4";
$_SESSION["ComListTabName"] = "TEST_COMMODITY_3";
$_SESSION["StListTabName"] = "TEST_STOCK_8";
$_SESSION["PRNumTabName"] = "TEST_PRNUM_1";
$_SESSION["CoListTabName"] = "TEST_COMPANY_LIST_2";
$_SESSION["ClListTabName"] = "TEST_CUSTOMER_3";
$_SESSION["PListTabName"] = "TEST_PRODUCT_1";
$_SESSION["PRTabName"] = "TEST_PURCHASE_3";
$_SESSION["ProdTabName"] = "TEST_PRODUCTION_3";
$_SESSION["InitPONum"] = "610000";
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
  $res = $db->query("SELECT * FROM $tablename WHERE CompanyID = ' $CompanyID' ORDER BY ID DESC");
  while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
  array_push($dbtabdata,$row);
  }
  $ret = $db->exec($sql);
   if(!$ret) {
      $err = $db->lastErrorMsg();
      $text .= $err;
      $text .= "<br>";
   } else {
      $text .= "Table Read Successfully<br>";
    }
}  
//----------------------------------------DB - Get unique column values----------------------------------------//

function dblistuniquecolvalues(&$db, $tablename, $columnname, &$dbcolvalues, &$text) { 
$dbtabdata = array(array());
$res = $db->query("SELECT DISTINCT $columnname FROM $tablename"); 
     while (($val = $res->fetchArray(SQLITE3_ASSOC))) {
      array_push($dbtabdata,$val);
  }
$sql =<<<EOF
EOF;
$dbcolvalues = array();
   foreach ($dbtabdata as $row) {
      foreach ($row as $cell) {
                array_push($dbcolvalues,$cell);
              }
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


//----------------------------------------DB - Add record (Supplier Table)----------------------------------------//

function dbaddsupplierrecord(&$db, $tablename, $Sname, $SuGST, $SAddr, $SCity, $SState, $SPcode, $SPh, $SEmail, &$CompanyID, $SIGST, &$text) { 
  $CompanyID = $_SESSION["companyID"];
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
//----------------------------------------DB - Add record (Customer Table)----------------------------------------//

function dbaddcustomerrecord(&$db, $tablename, $Cname, $CGST, $CAddr, $CCity, $CState, $CPcode, $CPh, $CEmail, $CSAddr, $CACode, $CACPh, &$CompanyID, &$text) { 
  $CompanyID = $_SESSION["companyID"];
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

function dbaddstockrecord(&$db, $tablename, $date, $invnum, $name, $mattype, $gsm, $bf, $rs, $rn, $rw, $rate, $sgst, $cgst, $igst, $total, $godownname, &$text) { 
  $CompanyID = $_SESSION["companyID"];
  $status = "in-stock";
  $sql =<<<EOF
    INSERT INTO $tablename (DATE,INVNUM,SUPPLIERNAME,COMMODITYNAME,GSM,BF,REELSIZE,REELNUMBER,REELWEIGHT,RATE,SGST,CGST,IGST,TOTAL,GODOWNNAME,USEDWEIGHT,STATUS,COMPANYID)
    VALUES ('$date', '$invnum', '$name', '$mattype', '$gsm', '$bf', '$rs', '$rn', '$rw', '$rate', '$sgst', '$cgst', '$igst', '$total', '$godownname', '0', '$status', '$CompanyID');
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

//----------------------------------------DB - Update record (CompanyList Table)----------------------------------------//

function dbeditcompanylistrecord(&$db, $tablename, $ID, $Coname, $CoAddr, $CoCity, $Costate, $CoPcode, $CoPh, $CoEmail, $CoGST, $CoAcode, $CoAPh, $fileToUpload1, $fileToUpload2, $fileToUpload3, $machinelist, $godownlist, &$text) { 
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
    LETTERHEAD = '$fileToUpload3', 
    MACHINELIST = '$machinelist',
    GODOWNLIST= '$godownlist' WHERE ID = '$ID';
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
        } else { 
          $text .= "Records deleted successfully<br>";
      }
}

//----------------------------------------DB - Delete record----------------------------------------//

function dbdelrecord(&$db, $tablename, $ID, &$text) { 
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
  $CompanyID = $_SESSION["companyID"];
  $sql =<<<EOF
    INSERT INTO $tablename (NAME,SUPPLIERNAME,GSM,BF,COMPANYID,REELSIZEinCM)
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
  $CompanyID = $_SESSION["companyID"];
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
      echo "<script>alert('" . $err . "');</script>";
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
   ID INTEGER PRIMARY KEY AUTOINCREMENT         UNIQUE,
   DATE                 TEXT        NOT NULL,
   INVNUM               TEXT        NOT NULL,
   SUPPLIERNAME         TEXT        NOT NULL,
   COMMODITYNAME        TEXT        NOT NULL,
   GSM                  INTEGER     NOT NULL,
   BF                   INTEGER     NOT NULL,
   REELSIZE             INTEGER     NOT NULL,
   REELNUMBER           INTEGER     NOT NULL,
   REELWEIGHT           INTEGER     NOT NULL,
   RATE                 INTEGER,
   SGST                 INTEGER,
   CGST                 INTEGER,
   IGST                 INTEGER,
   TOTAL                INTEGER,
   GODOWNNAME           TEXT        NOT NULL,
   USEDWEIGHT           TEXT        NOT NULL,
   STATUS               TEXT        NOT NULL,
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
   LETTERHEAD              TEXT              NOT NULL,
   MACHINELIST             TEXT              NOT NULL,
   GODOWNLIST              TEXT              NOT NULL
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
  $CompanyID = $_SESSION["companyID"];
  $res = $db->query("SELECT $columnname FROM $tablename WHERE CompanyID = '$CompanyID' ORDER BY ID DESC");
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
  $CompanyID = $_SESSION["companyID"];
  $res = $db->query("SELECT * FROM $tablename WHERE $paramname = '$paramvalue'");
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
  $CompanyID = $_SESSION["companyID"];
  $res = $db->query("SELECT $columnname FROM $tablename WHERE $paramname = '$paramvalue' and WHERE ID = '$CompanyID'");
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

//----------------------------------------DB - Read Stock Table values----------------------------------------//

function dbreadstocktable(&$db, $tablename, &$dbtabdata, &$text) { 
$dbtabdata = array(array());
$companyId = $_SESSION["companyID"];
$tablename = $_SESSION["StListTabName"];
  $res = $db->query("SELECT ID, DATE, INVNUM, SUPPLIERNAME, COMMODITYNAME, GSM, BF, REELSIZE, REELNUMBER, REELWEIGHT FROM $tablename WHERE COMPANYID = '$companyId' GROUP BY REELNUMBER");
     while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
             array_push($dbtabdata,$row);
         }
$sql =<<<EOF
EOF;
  $ret = $db->exec($sql);
   if(!$ret) {
      $err = $db->lastErrorMsg();
      $text .= $err;
      $text .= "<br>";
   } else {
      $text .= "Stock Table Read Successfully<br>";
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
  $CompanyID = $_SESSION["companyID"];
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
  $CompanyID = $_SESSION["companyID"];
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

function dbcheckprrecord (&$db, $tablename, $PCName, $PSpec, $PDes, $PGSM, $PSize, $Punit, &$found, &$text) {
  $CompanyID = $_SESSION["companyID"];
  $dbtabdata = array(array());
  $i = 0;
  $res = $db->query("SELECT * FROM $tablename WHERE CUSTOMERNAME='$PCName' and SPEC='$PSpec'and DESCRIPTION = '$PDes' and GSM = '$PGSM' and SIZE='$PSize' and UNIT='$Punit' and COMPANYID ='$CompanyID'");
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

//----------------------------------------DB - Create table (Purchase Table)----------------------------------------//

function dbcreatePRtable(&$db, $tablename, &$text) {
$text .= "welcome to create purchase req table if not exists";
$sql =<<<EOF
   CREATE TABLE if not exists $tablename(
      ID             INTEGER    PRIMARY KEY    AUTOINCREMENT  UNIQUE,
      PONUM          INTEGER    NOT NULL,
      PORELEASEDATE  TEXT		  NOT NULL,
      PORELEASETIME  TEXT		  NOT NULL,
      SUPPLIERNAME   TEXT       NOT NULL,
      SERIALNUMBER   TEXT       NOT NULL,
      PARTICULARS    TEXT       NOT NULL,
      NUMBEROFREELS  TEXT		  NOT NULL,
      RATEPER        TEXT		  NOT NULL,
      QNTY           TEXT		  NOT NULL,
      RATE           TEXT		  NOT NULL,
      DISCOUNT       TEXT		  NOT NULL,
      AMOUNT         TEXT		  NOT NULL,
      DDFROM         TEXT		  NOT NULL,
      DDTO           TEXT		  NOT NULL,
      COMPANYID      INTEGER	  NOT NULL
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

//----------------------------------------DB - Add record (Purchase Table)----------------------------------------//

function dbaddpurchaserecord(&$db, $tablename, $pONum, $pODate, $pOTime, $pOSname, $pOSnum, $pODes, $pONR, $pORPer, $pOQnty, $pORate, $pODiscount, $pOAmount, $pODdfrom, $pODdto, &$text) {
  $CompanyID = $_SESSION["companyID"];
  $sql =<<<EOF
    INSERT INTO $tablename (PONUM,PORELEASEDATE,PORELEASETIME,SUPPLIERNAME,SERIALNUMBER,PARTICULARS,NUMBEROFREELS,RATEPER,QNTY,RATE,DISCOUNT,AMOUNT,DDFROM,DDTO,COMPANYID)
    VALUES ('$pONum', '$pODate', '$pOTime', '$pOSname', '$pOSnum', '$pODes', '$pONR', '$pORPer', '$pOQnty', '$pORate', '$pODiscount', '$pOAmount', '$pODdfrom', '$pODdto', '$CompanyID');
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

//----------------------------------------DB - Update record (Purchase Table)----------------------------------------//
function dbeditpurchase(&$db, $tablename, $ID, $pONum, $pODate, $pOTime, $pOSnum, $pODes, $pONR, $pORPer, $pOQnty, $pORate, $pODiscount, $pOAmount, $pODdfrom, $pODdto, &$text) { 
   $sql =<<<EOF
   UPDATE $tablename SET
   PONUM = '$pONum',
   PORELEASEDATE = '$pODate',
   PORELEASETIME = '$pOTime',
   SERIALNUMBER = '$pOSnum',
   PARTICULARS = '$pODes',
   NUMBEROFREELS = '$pONR',
   RATEPER = '$pORPer',
   QNTY = '$pOQnty',
   RATE = '$pORate',
   DISCOUNT = '$pODiscount',
   AMOUNT = '$pOAmount',
   DDFROM = '$pODdfrom',
   DDTO = '$pODdto' WHERE ID = '$ID';
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

//----------------------------------------DB - Create Table (PRNumber)----------------------------------------//

function dbcreateprnumtable(&$db, $tablename, &$text) {
$text .= "welcome to create pr num table if not exists";
$sql =<<<EOF
   CREATE TABLE if not exists $tablename(
   ID             INTEGER     PRIMARY KEY    AUTOINCREMENT  UNIQUE,
   PRNUMBER			TEXT        NOT NULL UNIQUE,
   DESCRIPTION    TEXT        NOT NULL,
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

//----------------------------------------DB - Add record (PRNumber Table)----------------------------------------//

function dbaddprnumrecord(&$db, $tablename, $PRNum, $PRDes, &$text) {
  $CompanyID = $_SESSION["companyID"];
  $sql =<<<EOF
    INSERT INTO $tablename (PRNUMBER,DESCRIPTION,COMPANYID)
    VALUES ('$PRNum', '$PRDes', '$CompanyID');
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

//----------------------------------------DB - Update record (PRNumber Table)----------------------------------------//
function dbeditprnumrecord(&$db, $tablename, $ID, $PRNum, $PRDes, &$text) { 
   $CompanyID = $_SESSION["companyID"];
   $sql =<<<EOF
   UPDATE $tablename SET
   DESCRIPTION = '$PRDes' WHERE PRNUMBER = '$PRNum';
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

//----------------------------------------DB - Delete record (PRNumber Table)----------------------------------------//

function dbdeleteprnumrecord(&$db, $tablename, $PRNum, &$text) {
   $CompanyID = $_SESSION["companyID"];
   $sql =<<<EOF
     DELETE FROM $tablename WHERE PRNUMBER = '$PRNum';
   EOF;
	  $ret = $db->exec($sql);
		 if(!$ret) {
			  $err = $db->lastErrorMsg();
			  $text .= $err;
			  $text .= "<br>";
			} else { 
			  $text .= "Record Deleted Successfully<br>";
		  }
}

//----------------------------------------DB - Get PRNum(PRNumber Table)----------------------------------------//

function dbreadprnumrecord(&$db, $tablename, $paramname, &$PRNum, &$text){ 
$dbtabdata = array(array());
$res = $db->query("SELECT MAX($paramname) As PRNum FROM $tablename"); 
     while (($val = $res->fetchArray(SQLITE3_ASSOC))) {
      array_push($dbtabdata,$val);
  }
$sql =<<<EOF
EOF;
$PRNum = 0;
   foreach ($dbtabdata as $row) {
      foreach ($row as $cell) {
                $PRNum = intval($cell) + 1;
              }
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
//----------------------------------------DB - Create table (Purchase Table)----------------------------------------//

function dbcreateProdfeedtable(&$db, $tablename, &$text) {
    $text .= "Welcome to create production feed req table if not exists";
    $sql =<<<EOF
    CREATE TABLE IF NOT EXISTS $tablename(
        ID             INTEGER    PRIMARY KEY    AUTOINCREMENT  UNIQUE,
        DATE           TEXT       NOT NULL,
        TIME           TEXT       NOT NULL,
        MACHINENUM     TEXT       NOT NULL,
        CUSTOMERNAME   TEXT       NOT NULL,
        SIZE           TEXT       NOT NULL,
        REELNUMBER     INTEGER    NOT NULL,
        REELWIDTH      INTEGER    NOT NULL,
        REELLENGTH     INTEGER    NOT NULL,
        ESTPRODUCTION  INTEGER    NOT NULL,
        ACTUAL         INTEGER,
        STATUS         TEXT       NOT NULL,
        CUTREEL        TEXT,
        USEDWEIGHT     INTEGER,
        ESTWASTAGE     INTEGER,
        ACTWASTAGE     INTEGER,
        COMPANYID      INTEGER    NOT NULL
    );
EOF;
    $ret = $db->exec($sql);
    if(!$ret) {
        $err = $db->lastErrorMsg();
        $text .= $err;
        $text .= "<br>";
    } else {
            $text .= "Table created successfully<br>";
        }
    }

//----------------------------------------DB - Add record (Purchase Table)----------------------------------------//

function dbaddprodfeedrecord(&$db, $tablename, $pDate, $pTime, $pMname, $pCnum, $pSize, $pReelNumber, $pReelWidth, $pReelLength, $pEstProd, $pActual, $pStatus, $pCutReel, $pUsedweight, $pEstWastage, $pActWastage, &$text) {
  $CompanyID = $_SESSION["companyID"];
  $sql =<<<EOF
    INSERT INTO $tablename (DATE,TIME,MACHINENUM,CUSTOMERNAME,SIZE,REELNUMBER,REELWIDTH,REELLENGTH,ESTPRODUCTION,ACTUAL,STATUS,CUTREEL,USEDWEIGHT,ESTWASTAGE,ACTWASTAGE,COMPANYID)
    VALUES ('$pDate', '$pTime', '$pMname', '$pCnum', '$pSize', '$pReelNumber', '$pReelWidth', '$pReelLength', '$pEstProd', '$pActual', '$pStatus', '$pCutReel', '$pUsedweight', '$pEstWastage', '$pActWastage', '$CompanyID');
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

//----------------------------------------DB - Update record (Purchase Table)----------------------------------------//
function dbeditprodfeed(&$db, $tablename, $ID, $pDate, $pTime, $pMname, $pCnum, $pSize, $pReelNumber, $pReelLength, $pReelWidth, $pEstProd, $pActual, $pStatus, $pCutReel, $pUsedweight, $pEstWastage, $pActWastage, &$text) { 
   $sql =<<<EOF
   UPDATE $tablename SET
      DATE = '$pDate',
      TIME = '$pTime',
      MACHINENUM = '$pMname',
      CUSTOMERNAME = '$pCnum',
      SIZE = '$pSize',
      REELNUMBER = '$pReelNumber',
      REELWIDTH = '$pReelWidth',
      REELLENGTH = '$pReelLength',
      ESTPRODUCTION = '$pEstProd',
      ACTUAL = '$pActual',
      STATUS = '$pStatus',
      CUTREEL = '$pCutReel',
      USEDWEIGHT = '$pUsedweight',
      ESTWASTAGE = '$pEstWastage',
      ACTWASTAGE = '$pActWastage' WHERE ID = '$ID';
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

//----------------------------------------DB - Edit record (Stock Table)----------------------------------------//

function dbeditstockrecord(&$db, $tablename,$rn, $uw, $stat, &$text) { 
  $CompanyID = $_SESSION["companyID"];
  $status = "active";
  $sql =<<<EOF
    UPDATE $tablename SET
    USEDWEIGHT = '$uw',
    STATUS = '$stat' WHERE COMPANYID = '$CompanyID' AND REELNUMBER = '$rn';
  EOF;
  $ret = $db->exec($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records edited succssfully<br>";
      }
}

//----------------------------------------DB - check record (Production feed Table)----------------------------------------//

function dbcheckprodfeedrecord (&$db, $tablename, $ID, &$found, &$text) {
  $CompanyID = $_SESSION["companyID"];
  $dbtabdata = array(array());
  $i = 0;
  $res = $db->query("SELECT * FROM $tablename WHERE ID = '$ID' and COMPANYID ='$CompanyID'");
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

//----------------------------------------DB - Setup----------------------------------------//
function dbgeninvrep(&$db, $tablename, &$dbtabdata, &$text) {
$CompanyID = $_SESSION["companyID"];
$dbtabdata = array(array());
$res_query1 = $db->query("
SELECT 
    COMMODITYNAME,
    GSM,
    BF,
    REELSIZE,
    NumOfReels AS NumOfReels,
    CAST(ROUND(SUM(NetReelWeight), 2) AS REAL) AS TotalNetReelWeight,
    GODOWNNAME,
    STATUS 
FROM (
    SELECT 
        COMMODITYNAME,
        GSM,
        BF,
        REELSIZE,
        COUNT(REELNUMBER) AS NumOfReels,
        REELWEIGHT - USEDWEIGHT AS NetReelWeight,
        GODOWNNAME,
        STATUS 
    FROM 
        $tablename 
    WHERE 
        COMPANYID = '$CompanyID'
    GROUP BY 
        COMMODITYNAME, GSM, BF, REELSIZE, REELNUMBER
) AS subquery
GROUP BY 
    COMMODITYNAME, GSM, BF, REELSIZE;
");

    // Loop through each row
    while (($row = $res_query1->fetchArray(SQLITE3_ASSOC))) {
        // Access individual values from the current row
        $commodityName = $row['COMMODITYNAME'];
        $gsm = $row['GSM'];
        $bf = $row['BF'];
        $reelSize = $row['REELSIZE'];
        /*
        $numOfReels = $row['NumOfReels'];
        $totalWeight = $row['NetReelWeight'];
        $godownName = $row['GODOWNNAME'];
        $status = $row['STATUS'];
        */
        array_push($dbtabdata,$row);
        $res_query2 = $db->query("
            SELECT 
                '' AS COMMODITYNAME,
                '' AS GSM,
                '' AS BF,
                '' AS REELSIZE,
                '' AS RS,
                REELNUMBER,
                CAST(ROUND(REELWEIGHT - USEDWEIGHT, 2) AS REAL),
                GODOWNNAME,
                STATUS 
            FROM 
                $tablename
            WHERE 
                COMPANYID = '$CompanyID' 
                AND COMMODITYNAME = '$commodityName'
                AND GSM = '$gsm'
                AND BF = '$bf'
                AND REELSIZE = '$reelSize'
            GROUP BY
                REELNUMBER;
");
    while (($row = $res_query2->fetchArray(SQLITE3_ASSOC))) {
       array_push($dbtabdata,$row);
    }
    }
}
?>