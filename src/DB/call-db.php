 <?php
// If the request is made from our space preview functionality then turn on PHP error reporting
if (isset($_SERVER['HTTP_X_FORWARDED_URL']) && strpos($_SERVER['HTTP_X_FORWARDED_URL'], '.w3spaces-preview.com/') !== false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  }
?>
<?php
//session_start();
?>

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
  //$db = $_SESSION["DBRef"];
}

//----------------------------------------DB - Close----------------------------------------//

function dbclose(&$db, &$text) {

}


//----------------------------------------DB - Read Table----------------------------------------//

function dbreadtable(&$db, $tablename, &$dbtabdata, &$text) {
    $text .= "Reading table<br>";
    
    // Get company ID from session (make sure session is started before calling this function)
    $CompanyID = $_SESSION["companyID"];
    
    // Prepare and execute query using prepared statement
    $stmt = $db->prepare("SELECT * FROM `$tablename` WHERE CompanyID = ?");
    $stmt->bind_param("i", $CompanyID); // Assuming CompanyID is an integer
    $stmt->execute();
    
    // Get result
    $result = $stmt->get_result();
    
    // Fetch rows
    while ($row = $result->fetch_assoc()) {
        $dbtabdata[] = $row;
    }
    
    // Check for errors
    if ($stmt->errno) {
        $err = $stmt->error;
        $text .= "Error reading table: $err<br>";
    } else {
        $text .= "Table read successfully<br>";
    }
    
    // Close statement
    $stmt->close();
}

//----------------------------------------DB - Read Stock Table----------------------------------------//

function dbreadsttable(&$db, $tablename, &$dbtabdata, &$text) {
    $text .= "Reading table<br>";
    
    // Get company ID from session (make sure session is started before calling this function)
    $CompanyID = $_SESSION["companyID"];
    
    // Prepare and execute query using prepared statement
    $stmt = $db->prepare("SELECT * FROM `$tablename` WHERE CompanyID = ? AND STATUS != 'finished'");
    $stmt->bind_param("i", $CompanyID); // Assuming CompanyID is an integer
    $stmt->execute();
    
    // Get result
    $result = $stmt->get_result();
    
    // Fetch rows
    while ($row = $result->fetch_assoc()) {
        $dbtabdata[] = $row;
    }
    
    // Check for errors
    if ($stmt->errno) {
        $err = $stmt->error;
        $text .= "Error reading table: $err<br>";
    } else {
        $text .= "Table read successfully<br>";
    }
    
    // Close statement
    $stmt->close();
}
//----------------------------------------DB - Read Table(wdate filter)----------------------------------------//

function dbreadtablewdatefilter(&$db, $tablename, $fromDate, $toDate, &$dbtabdata, &$text) {
  $CompanyID = $_SESSION["companyID"];
  //echo "<script>alert('" . "Hello!" . "');</script>";
  $res = $db->query("SELECT * FROM `$tablename` WHERE DATE BETWEEN $fromDate AND $toDate AND CompanyID = '$CompanyID' ORDER BY ID DESC");
  while (($row = $res->fetch_assoc())) {
  array_push($dbtabdata,$row);
  }
} 

//----------------------------------------DB - Read table 2----------------------------------------//

function dbreadtable2(&$db, $tablename, &$dbtabdata, &$text) {
    $text .= "Reading table<br>";
    
    // Get company ID from session (make sure session is started before calling this function)
    $CompanyID = $_SESSION["companyID"];
    
    // Prepare and execute query using prepared statement
    $stmt = $db->prepare("SELECT * FROM `$tablename` WHERE CompanyID = ? ORDER BY ID DESC");
    $stmt->bind_param("i", $CompanyID); // Assuming CompanyID is an integer
    $stmt->execute();
    
    // Get result
    $result = $stmt->get_result();
    
    // Fetch rows
    while ($row = $result->fetch_assoc()) {
        $dbtabdata[] = $row;
    }
    
    // Check for errors
    if ($stmt->errno) {
        $err = $stmt->error;
        $text .= "Error reading table: $err<br>";
    } else {
        $text .= "Table read successfully<br>";
    }
    
    // Close statement
    $stmt->close();
}

//----------------------------------------DB - Get unique column values----------------------------------------//

function dblistuniquecolvalues(&$db, $tablename, $columnname, &$dbcolvalues, &$text) { 
$dbtabdata = array(array());
$CompanyID = $_SESSION["companyID"];
$res = $db->query("SELECT DISTINCT `$columnname` FROM `$tablename` WHERE CompanyID = '$CompanyID'");
     while (($val = $res->fetch_assoc())) {
      array_push($dbtabdata,$val);
  }
$dbcolvalues = array();
   foreach ($dbtabdata as $row) {
      foreach ($row as $cell) {
                array_push($dbcolvalues,$cell);
              }
  }
}


//----------------------------------------DB - Add record (Supplier Table)----------------------------------------//

function dbaddsupplierrecord(&$db, $tablename, $Sname, $SuGST, $SAddr, $SCity, $SState, $SPcode, $SPh, $SEmail, &$CompanyID, $SIGST, &$text) { 
    // Get company ID from session (make sure session is started before calling this function)
    $CompanyID = $_SESSION["companyID"];
    
    // Prepare statement
    $stmt = $db->prepare("
        INSERT INTO $tablename (NAME, GSTIN, ADDRESS, CITY, STATE, PINCODE, PHONE, EMAIL, COMPANYID, IGST)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    // Bind parameters
    $stmt->bind_param("ssssssssis", $Sname, $SuGST, $SAddr, $SCity, $SState, $SPcode, $SPh, $SEmail, $CompanyID, $SIGST);
    
    // Execute statement
    if ($stmt->execute()) {
        $text .= "Records created successfully<br>";
    } else {
        $text .= "Error creating records: " . $stmt->error . "<br>";
    }
    
    // Close statement
    $stmt->close();
}
//----------------------------------------DB - Add record (Customer Table)----------------------------------------//

function dbaddcustomerrecord(&$db, $tablename, $Cname, $CGST, $CAddr, $CCity, $CState, $CPcode, $CPh, $CEmail, $CSAddr, $CACode, $CACPh, &$CompanyID, &$text) { 
  $CompanyID = $_SESSION["companyID"];
  $sql ="
    INSERT INTO $tablename (NAME,GSTIN,ADDRESS,CITY,STATE,PINCODE,PHONE,EMAIL,COMPANYID,IGST)
    VALUES ('$Sname', '$SuGST', '$SAddr', '$SCity', '$SState', '$SPcode', '$SPh', '$SEmail', '$CompanyID','$SIGST')";
  $ret = $db->query($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records created successfully<br>";
      }
}

//----------------------------------------DB - Add record (Stock Table)----------------------------------------//

function dbaddstockrecord(&$db, $tablename, $date, $invnum, $name, $mattype, $gsm, $bf, $rs, $rn, $rw, $rate, $sgst, $cgst, $igst, $total, $godownname, &$text) {

    $CompanyID = $_SESSION["companyID"];
    $status = "in-stock";
    $usedweight = 0;

    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO `$tablename` (DATE, INVNUM, SUPPLIERNAME, COMMODITYNAME, GSM, BF, REELSIZE, REELNUMBER, REELWEIGHT, RATE, SGST, CGST, IGST, TOTAL, GODOWNNAME, USEDWEIGHT, STATUS, COMPANYID)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $db->prepare($sql);

    if (!$stmt) {
        $text .= "Error preparing statement: " . $db->error . "<br>";
        return;
    }

    // Bind the parameters
    $stmt->bind_param("ssssiididdddddsdsi", $date, $invnum, $name, $mattype, $gsm, $bf, $rs, $rn, $rw, $rate, $sgst, $cgst, $igst, $total, $godownname, $usedweight, $status, $CompanyID);

    // Execute the statement
    $ret = $stmt->execute();

    if ($ret) {
        $text .= "Records created successfully<br>";
    } else {
        $err = $stmt->error;
        $text .= "Error creating record: " . $err . "<br>";
    }

    // Close the statement
    $stmt->close();
}

//----------------------------------------DB - Update record (Supplier Table)----------------------------------------//

function dbeditsupplierrecord(&$db, $tablename, $ID, $SuGST, $SAddr, $SCity, $SState, $SPcode, $SPh, $SEmail, $SIGST, &$text) { 
$stmt = $db->prepare("UPDATE $tablename SET 
                    GSTIN = ?, 
                    ADDRESS = ?, 
                    CITY = ?, 
                    STATE = ?, 
                    PINCODE = ?, 
                    PHONE = ?, 
                    EMAIL = ?, 
                    IGST = ? 
                WHERE ID = ?");
        if (!$stmt) {
            throw new Exception("Statement preparation failed: " . $db->error);
        }

                // Bind parameters to statement
        $stmt->bind_param("ssssssssi", $SuGST, $SAddr, $SCity, $SState, $SPcode, $SPh, $SEmail, $SIGST, $ID);
                // Execute the statement
        $ret = $stmt->execute();

        if ($ret) {
            $text .= "Records updated successfully<br>";
        } else {
            $err = $stmt->error;
            $text .= "Error updating record: " . $err . "<br>";
        }
}

//----------------------------------------DB - Update record (CompanyList Table)----------------------------------------//

function dbeditcompanylistrecord(&$db, $tablename, $ID, $Coname, $CoAddr, $CoCity, $Costate, $CoPcode, $CoPh, $CoEmail, $CoGST, $CoAcode, $CoAPh, $fileToUpload1, $fileToUpload2, $fileToUpload3, $machinelist, $godownlist, &$text) { 
    $sql =("
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
    GODOWNLIST= '$godownlist' WHERE ID = '$ID'");
  $ret = $db->query($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
        } else { 
          $text .= "Records updated successfully<br>";
      }
}

//----------------------------------------DB - Delete record (Supplier Table)----------------------------------------//

function dbdeletesupplierrecord(&$db, $tablename, $ID, &$text) {
    // Ensure $tablename and $ID are properly escaped or sanitized
    // Prepare the DELETE statement
    $sql = "DELETE FROM `$tablename` WHERE ID = ?";
    $stmt = $db->prepare($sql);

    if (!$stmt) {
        $text .= "Error preparing statement: " . $db->error . "<br>";
        return;
    }

    // Bind the ID parameter
    $stmt->bind_param("i", $ID);

    // Execute the statement
    $ret = $stmt->execute();

    if ($ret) {
        $text .= "Records deleted successfully<br>";
    } else {
        $err = $stmt->error;
        $text .= "Error deleting record: " . $err . "<br>";
    }

    // Close the statement
    $stmt->close();
}

//----------------------------------------DB - Delete record----------------------------------------//

function dbdelrecord(&$db, $tablename, $ID, &$text) { 
  $sql ="DELETE FROM $tablename WHERE ID = '$ID'";
  $ret = $db->query($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records deleted successfully<br>";
      }
}

//----------------------------------------DB - Add record (Commodity Table)----------------------------------------//

function dbaddcommodityrecord(&$db, $tablename, $Cname, $CSname, $CGSM, $CBF, $CRS, &$text) {
    $CompanyID = $_SESSION["companyID"];

    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO `$tablename` (NAME, SUPPLIERNAME, GSM, BF, REELSIZEinCM, COMPANYID)
            VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $db->prepare($sql);

    if (!$stmt) {
        $text .= "Error preparing statement: " . $db->error . "<br>";
        return;
    }

    // Bind the parameters
    $stmt->bind_param("ssiidi", $Cname, $CSname, $CGSM, $CBF, $CRS, $CompanyID);

    // Execute the statement
    $ret = $stmt->execute();

    if ($ret) {
        $text .= "Records created successfully<br>";
    } else {
        $err = $stmt->error;
        $text .= "Error creating record: " . $err . "<br>";
    }

    // Close the statement
    $stmt->close();
}

//----------------------------------------DB - check record (Commodity Table)----------------------------------------//

function dbcheckcommodityrecord(&$db, $tablename, $Cname, $CSname, $CGSM, $CBF, &$CompanyID, $ReelSize, &$found, &$text) {
  $CompanyID = $_SESSION["companyID"];
    // Prepare the SQL statement
    $sql = "SELECT * FROM `$tablename` WHERE NAME=? AND SUPPLIERNAME=? AND GSM=? AND BF=? AND COMPANYID=? AND REELSIZEinCM=?";

    // Prepare the statement
    $stmt = $db->prepare($sql);

    if (!$stmt) {
        $text .= "Error preparing statement: " . $db->error . "<br>";
        return;
    }

    // Bind the parameters
    $stmt->bind_param("ssiiid", $Cname, $CSname, $CGSM, $CBF, $CompanyID, $ReelSize);

    // Execute the statement
    $stmt->execute();

    // Store the result
    $result = $stmt->get_result();

    // Check if the record exists
    $found = $result->num_rows > 0;
    // Close the statement
    $stmt->close();

    if ($found) {
        $text .= "Record Already Exists <br>";
        return "Record Already Exists";
    } else {
        $text .= "DB check completed<br>";
        return "DB check completed";
    }
} 

//----------------------------------------DB - Get Column Values----------------------------------------//

function dbgetcolumnname($db, $tablename, $columnname, &$dbcolvalues, &$text) {
    $CompanyID = $_SESSION["companyID"];
    // Assuming $db is a valid MySQLi database connection object

    // Prepare and execute the query
    $stmt = $db->prepare("SELECT  `$columnname` FROM  `$tablename` WHERE CompanyID = ? ORDER BY ID DESC");
    $stmt->bind_param("i", $CompanyID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch column values and store them in $dbcolvalues
    $dbcolvalues = array();
    while ($row = $result->fetch_assoc()) {
        $dbcolvalues[] = $row;
    }

    // Check for errors
    if ($stmt->errno) {
        $err = $stmt->error;
        $text .= "Error: $err<br>";
    } else {
        $text .= "Column Read Successfully<br>";
    }
}
//----------------------------------------DB - Read db record----------------------------------------//

function dbreadrecord(&$db, $tablename, $paramname, $paramvalue, &$dbrowvalues, &$text) {
  $CompanyID = $_SESSION["companyID"];
    $stmt = $db->prepare("SELECT * FROM `$tablename` WHERE $paramname = '$paramvalue'");
    $stmt->execute();
    $result = $stmt->get_result();
  while (($row = $result->fetch_assoc())) {
          foreach($row as $key  => $value) {
             array_push($dbrowvalues,$value);
         }
    }
    // Check for errors
    if ($stmt->errno) {
        $err = $stmt->error;
        $text .= "Error: $err<br>";
    } else {
        $text .= "Record Read Successfully<br>";
    }
}

//----------------------------------------DB - Get Single Value----------------------------------------//
function dbgetvalue(&$db, $tablename, $paramname, $filter1, $value1, $filter2, $value2, &$outputvalue, &$rowdata, &$text) {
  $CompanyID = $_SESSION["companyID"];
  $res = $db->query("SELECT 
                       $paramname as output 
                     FROM `$tablename` 
                     WHERE $filter1 = '$value1' 
                       AND $filter2 = '$value2' 
                       AND CompanyID = '$CompanyID'
                       ");
  $rowdata = array(array());
  $outputvalue = 0;
  while (($row = $res->fetch_assoc())) {
      array_push($rowdata,$row);
      $outputvalue = $row['output'];
      }
}

//----------------------------------------DB - Read Stock Table values----------------------------------------//

function dbreadstocktable(&$db, $tablename, &$dbtabdata, &$text) { 
$dbtabdata = array(array());
$companyId = $_SESSION["companyID"];
$tablename = $_SESSION["StListTabName"];
  $res = $db->query("SELECT ID, DATE, INVNUM, SUPPLIERNAME, COMMODITYNAME, GSM, BF, REELSIZE, REELNUMBER, REELWEIGHT FROM `$tablename` WHERE COMPANYID = '$companyId' GROUP BY REELNUMBER");
     while (($row = $res->fetch_assoc())) {
             array_push($dbtabdata,$row);
         }
}

//----------------------------------------DB - Delete record (Customer Table)----------------------------------------//

function dbdeletecustomerrecord(&$db, $tablename, $ID, &$text) { 
  $sql ="DELETE FROM `$tablename` WHERE ID = '$ID'";
  $ret = $db->query($sql);
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
  $sql ="INSERT INTO `$tablename` (NAME,CLIENTNAME,GSTIN,ADDRESS,CITY,STATE,PINCODE,PHONE,EMAIL,SECADDRESS,AREACODE,ADMINPHONE,COMPANYID)
    VALUES ('$Cname', '$Clname', '$CGST', '$CAddr', '$CCity', '$CState', '$CPcode', '$CPh', '$CEmail', '$CSAddr', '$CACode', '$CACPh', '$CompanyID')";
  $ret = $db->query($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records created successfully<br>";
      }
}

//----------------------------------------DB - Update record (Customer Table)----------------------------------------//
function dbeditcustomer(&$db, $tablename, $ID, $Cname, $Clname, $CGST, $CAddr, $CCity, $CState, $CPcode, $CPh, $CEmail, $CSAddr, $CACode, $CACPh, &$text) { 
   $sql ="UPDATE $tablename SET
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
   ADMINPHONE = '$CACPh' WHERE ID = '$ID'";
  $ret = $db->query($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records updated successfully<br>";
      }
}

//----------------------------------------DB - Add record (Product Table)----------------------------------------//

function dbaddproductrecord(&$db, $tablename, $PCName, $PDes, $PSpec, $PGSM, $PSize, $Punit, $PRate, &$text) {
  $CompanyID = $_SESSION["companyID"];
  $sql ="INSERT INTO `$tablename` (CUSTOMERNAME,DESCRIPTION,SPEC,GSM,SIZE,UNIT,RATE,COMPANYID)
    VALUES ('$PCName', '$PDes', '$PSpec', '$PGSM', '$PSize', '$Punit', '$PRate', '$CompanyID')";
  $ret = $db->query($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records created successfully<br>";
      }
}
//----------------------------------------DB - check record (Product Table)----------------------------------------//

function dbcheckprrecord (&$db, $tablename, $PCName, $PSpec, $PDes, $PGSM, $PSize, $Punit, &$found, &$text) {
  $CompanyID = $_SESSION["companyID"];
  $dbtabdata = array(array());
  $i = 0;
  $res = $db->query("SELECT * FROM `$tablename` WHERE CUSTOMERNAME='$PCName' and SPEC='$PSpec'and DESCRIPTION = '$PDes' and GSM = '$PGSM' and SIZE='$PSize' and UNIT='$Punit' and COMPANYID ='$CompanyID'");
  while (($row = $res->fetch_assoc())) {
  array_push($dbtabdata,$row);
  $i = $i+1;
  }
  $found = ($i>0);
  if ($found) {
   $text .= "Record Already Exists <br>";
  }
}

//----------------------------------------DB - Add record (Purchase Table)----------------------------------------//

function dbaddpurchaserecord(&$db, $tablename, $pONum, $pODate, $pOTime, $pOSname, $pOSnum, $pODes, $pONR, $pORPer, $pOQnty, $pORate, $pODiscount, $pOAmount, $pODdfrom, $pODdto, &$text) {
  $CompanyID = $_SESSION["companyID"];
  $sql =("
    INSERT INTO `$tablename` (PONUM,PORELEASEDATE,PORELEASETIME,SUPPLIERNAME,SERIALNUMBER,PARTICULARS,NUMBEROFREELS,RATEPER,QNTY,RATE,DISCOUNT,AMOUNT,DDFROM,DDTO,COMPANYID)
    VALUES ('$pONum', '$pODate', '$pOTime', '$pOSname', '$pOSnum', '$pODes', '$pONR', '$pORPer', '$pOQnty', '$pORate', '$pODiscount', '$pOAmount', '$pODdfrom', '$pODdto', '$CompanyID')");
  $ret = $db->query($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records created successfully<br>";
      }
}

//----------------------------------------DB - Update record (Purchase Table)----------------------------------------//
function dbeditpurchase(&$db, $tablename, $ID, $pONum, $pODate, $pOTime, $pOSnum, $pODes, $pONR, $pORPer, $pOQnty, $pORate, $pODiscount, $pOAmount, $pODdfrom, $pODdto, &$text) { 
   $sql =("
   UPDATE `$tablename` SET
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
   DDTO = '$pODdto' WHERE ID = '$ID'");
  $ret = $db->query($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records updated successfully<br>";
      }
}

//----------------------------------------DB - Add record (PRNumber Table)----------------------------------------//

function dbaddprnumrecord(&$db, $tablename, $PRNum, $PRDes, &$text) {
  $CompanyID = $_SESSION["companyID"];
  $sql =("
    INSERT INTO `$tablename` (PRNUMBER,DESCRIPTION,COMPANYID)
    VALUES ('$PRNum', '$PRDes', '$CompanyID')");
  $ret = $db->query($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records created successfully<br>";
      }
}

//----------------------------------------DB - Update record (PRNumber Table)----------------------------------------//
function dbeditprnumrecord(&$db, $tablename, $ID, $PRNum, $PRDes, &$text) { 
   $CompanyID = $_SESSION["companyID"];
   $sql ="UPDATE `$tablename` SET
   DESCRIPTION = '$PRDes' WHERE PRNUMBER = '$PRNum'";
  $ret = $db->query($sql);
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
   $sql ="DELETE FROM `$tablename` WHERE PRNUMBER = '$PRNum'";
	  $ret = $db->query($sql);
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
$res = $db->query("SELECT MAX(`$paramname`) As PRNum FROM `$tablename`"); 
     while (($val = $res->fetch_assoc())) {
      array_push($dbtabdata,$val);
  }
$PRNum = 0;
   foreach ($dbtabdata as $row) {
      foreach ($row as $cell) {
                $PRNum = intval($cell) + 1;
              }
  }
}

//----------------------------------------DB - Add record (Purchase Table)----------------------------------------//

function dbaddprodfeedrecord(&$db, $tablename, $pDate, $pTime, $pMname, $pCnum, $pSize, $pReelNumber, $pReelWidth, $pReelLength, $pEstProd, $pActual, $pStatus, $pCutReel, $pUsedweight, $pEstWastage, $pActWastage, &$text) {
  $CompanyID = $_SESSION["companyID"];
  $sql =("
    INSERT INTO `$tablename` (DATE,TIME,MACHINENUM,CUSTOMERNAME,SIZE,REELNUMBER,REELWIDTH,REELLENGTH,ESTPRODUCTION,ACTUAL,STATUS,CUTREEL,USEDWEIGHT,ESTWASTAGE,ACTWASTAGE,COMPANYID)
    VALUES ('$pDate', '$pTime', '$pMname', '$pCnum', '$pSize', '$pReelNumber', '$pReelWidth', '$pReelLength', '$pEstProd', '$pActual', '$pStatus', '$pCutReel', '$pUsedweight', '$pEstWastage', '$pActWastage', '$CompanyID')");
  $ret = $db->query($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records created successfully<br>";
      }
}

//----------------------------------------DB - Update record (Purchase Table)----------------------------------------//
function dbeditprodfeed(&$db, $tablename, $ID, $pDate, $pTime, $pMname, $pCnum, $pSize, $pReelNumber, $pReelLength, $pReelWidth, $pEstProd, $pActual, $pStatus, $pCutReel, $pUsedweight, $pEstWastage, $pActWastage, &$text) { 
   $sql =("
   UPDATE `$tablename` SET
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
      ACTWASTAGE = '$pActWastage' WHERE ID = '$ID'");
  $ret = $db->query($sql);
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
  $sql =("
    UPDATE `$tablename` SET
    USEDWEIGHT = '$uw',
    STATUS = '$stat' WHERE COMPANYID = '$CompanyID' AND REELNUMBER = '$rn'");
  $ret = $db->query($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records edited successfully<br>";
      }
}

//----------------------------------------DB - Edit record (Product Table)----------------------------------------//

function dbeditproductrecord(&$db, $tablename, $cname, $size, $os, $prod, $cs, $val, &$text) { 
  $CompanyID = $_SESSION["companyID"];
  $sql ="UPDATE `$tablename` SET
    OPENINGSTOCK = '$os',
    PRODUCTION = '$prod',
    CLOSINGSTOCK = '$cs',
    TOTALVAL = '$val'
    WHERE COMPANYID = '$CompanyID' AND CUSTOMERNAME = '$cname' AND SIZE = '$size'";
  $ret = $db->query($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records edited successfully<br>";
      }
}

//----------------------------------------DB - Edit record2 (Stock Table)----------------------------------------//

function dbeditstockrecord2(&$db, $tablename,$Id, $date, $invnum, $sname, $cname, $gsm, $bf, $rs, $rn, $rw, $rate, $sgst, $cgst, $igst, $total, $loc, &$text) { 
  $CompanyID = $_SESSION["companyID"];
  $sql =("
    UPDATE `$tablename` SET
    DATE = '$date',
    INVNUM  = '$invnum',
    SUPPLIERNAME = '$sname',
    COMMODITYNAME = '$cname',
    GSM = '$gsm',
    BF = '$bf',
    REELSIZE = '$rs',
    REELNUMBER = '$rn',
    REELWEIGHT = '$rw',
    RATE = '$rate',
    SGST = '$sgst',
    CGST = '$cgst',
    IGST = '$igst',
    TOTAL = '$total',
    GODOWNNAME = '$loc' WHERE COMPANYID = '$CompanyID' AND ID = '$Id'");
  $ret = $db->query($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records edited successfully<br>";
      }
}


//----------------------------------------DB - check record (Production feed Table)----------------------------------------//

function dbcheckprodfeedrecord (&$db, $tablename, $ID, &$found, &$text) {
  $CompanyID = $_SESSION["companyID"];
  $dbtabdata = array(array());
  $i = 0;
  $res = $db->query("SELECT * FROM `$tablename` WHERE ID = '$ID' and COMPANYID ='$CompanyID'");
  while (($row = $res->fetch_assoc())) {
  array_push($dbtabdata,$row);
  $i = $i+1;
  }
  $found = ($i>0);
  if ($found) {
   $text .= "Record Already Exists <br>";
  }
} 

//----------------------------------------DB - get inventory report (Raw Material)----------------------------------------//
function dbgeninvrep(&$db, $tablename, &$dbtabdata, &$text) {
$CompanyID = $_SESSION["companyID"];
$dbtabdata = array(array());
$res_query1 = $db->query("
SELECT 
    COMMODITYNAME,
    GSM,
    BF,
    REELSIZE,
    COUNT(Reelnumber) AS NumOfReels,
    CAST(ROUND(SUM(NetReelWeight), 2) AS DECIMAL) AS TotalNetReelWeight,
    GODOWNNAME,
    STATUS 
FROM (
    SELECT 
        COMMODITYNAME,
        GSM,
        BF,
        REELSIZE,
        REELNUMBER As Reelnumber,
        REELWEIGHT - USEDWEIGHT AS NetReelWeight,
        GODOWNNAME,
        STATUS 
    FROM 
        `$tablename` 
    WHERE 
        COMPANYID = '$CompanyID'
    GROUP BY 
        COMMODITYNAME, GSM, BF, REELSIZE, REELNUMBER
) AS subquery

GROUP BY 
    COMMODITYNAME, GSM, BF, REELSIZE
ORDER BY
    COMMODITYNAME, REELSIZE;
");

    // Loop through each row
    while (($row = $res_query1->fetch_assoc())) {
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
                CAST(ROUND(REELWEIGHT - USEDWEIGHT, 2) AS DECIMAL),
                GODOWNNAME,
                STATUS 
            FROM 
                `$tablename`
            WHERE 
                COMPANYID = '$CompanyID' 
                AND COMMODITYNAME = '$commodityName'
                AND GSM = '$gsm'
                AND BF = '$bf'
                AND REELSIZE = '$reelSize'
            GROUP BY
                REELNUMBER;
");
    while (($row = $res_query2->fetch_assoc())) {
       array_push($dbtabdata,$row);
    }
    }
}
//----------------------------------------DB - get inventory report (Raw Material)----------------------------------------//
function dbgenfginvrep(&$db, $tablename, &$dbtabdata, &$text) {
    $CompanyID = $_SESSION["companyID"];
    $tablename = $_SESSION["PListTabName"];
    $dbtabdata = array();
    
    $res_query1 = $db->query("
         SELECT
            CUSTOMERNAME,
            FORMAT(SUM(TOTALVAL), 2) AS StockVal
        FROM 
            `$tablename`
        WHERE 
            COMPANYID = '$CompanyID'
        GROUP BY 
            CUSTOMERNAME"
            );
    
    // Check if the query was successful
    if ($res_query1 === false) {
        $text = "Error in first query: " . $db->error;
        return;
    }
    // Loop through each row from the first query
    while ($row1 = $res_query1->fetch_assoc()) {
        $cName = $row1['CUSTOMERNAME'];
        $Stval = $row1['StockVal'];
        $addline = [$cName, '', '', '', '', '', '', $Stval];
        // Add the row to the dbtabdata array
        array_push($dbtabdata,$addline);

        $res_query2 = $db->query("
            SELECT
                  '' AS NA,
                  SIZE,
                  CLOSINGSTOCK AS Openingst,
                  '0' AS Production,
                  CLOSINGSTOCK AS ClosingSt,
                  RATE,
                  FORMAT(ROUND((RATE * CLOSINGSTOCK), 2), 2) AS val,
                  FORMAT(ROUND((RATE * CLOSINGSTOCK * 12 / 100), 2), 2) AS GST,
                  '' AS TOTALVAL
            FROM 
                `$tablename`
            WHERE 
                COMPANYID = '$CompanyID'
                AND CUSTOMERNAME = '$cName'
            ORDER BY
                CUSTOMERNAME, SIZE;
        ");

        // Check if the second query was successful
        if ($res_query2 === false) {
            $text = "Error in second query: " . $db->error;
            return;
        }

        // Loop through each row from the second query
        while ($row2 = $res_query2->fetch_assoc()) {
            // Add the row to the dbtabdata array
            array_push($dbtabdata,$row2);
        }
    }
}
//----------------------------------------DB - Add record (Document ID Table)----------------------------------------//

function dbadddocidrecord(&$db, $tablename, $diType, $diD, &$text) { 
$text .= "welcome to add record to document id table";
  $CompanyID = $_SESSION["companyID"];
  $date = date("Y-m-d");
  $time = date("h:i:s a");
  $dStat = "free";
  $sql ="
    INSERT INTO `$tablename` (DATE,TIME,TYPE,DOCID,STATUS,COMPANYID)
    VALUES ('$date', '$time', '$diType', '$diD', '$dStat', '$CompanyID')";
  $ret = $db->query($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records created successfully<br>";
      }
}
//----------------------------------------DB - Get ID (Document ID Table)----------------------------------------//

function dbgetdocid(&$db, $tablename, $diType, &$DOCID, &$text) {
/*$text .= "welcome clear document id";
$sql = "DELETE FROM DOCID_TABLE
WHERE TIME < NOW() - INTERVAL 3 HOUR
      AND STATUS = 'alloted'";
$res = $db->query($sql);
*/
$text .= "welcome to get document id table";
$CompanyID = $_SESSION["companyID"];
$sql = "SELECT MIN(DOCID) FROM `$tablename`
        WHERE TYPE = '$diType'
        AND STATUS = 'free'
        AND COMPANYID = '$CompanyID'";
$res = $db->query($sql);
$DOCID = 0;
if (!$res) {
    $err = $db->lastErrorMsg();
    $text .= $err;
    $text .= "<br>";
} else {
    $row = $res->fetch_assoc(); // Fetch the result as an associative array
    $minDocID = $row['MIN(DOCID)']; // Access the minimum DOCID value
    $DOCID  =$minDocID;
}
}
//----------------------------------------DB - Edit record (Document ID Table)----------------------------------------//

function dbeditdocidrecord($db, $tablename, $diType, $diD, $dStat, &$text) { 
    $text .= "Welcome to edit record to document id table";
    $CompanyID = $_SESSION["companyID"];
    $date = date("Y-m-d");
    $time = date("h:i:s a");

    // Prepare the SQL statement
    $sql = ("UPDATE `$tablename` SET 
            STATUS = '$dStat',
            DATE = '$date',
            TIME = '$time'
            WHERE DOCID = '$diD'
            AND TYPE = '$diType'
            AND COMPANYID = '$CompanyID'");

    // Prepare the query
    $ret = $db->query($sql);
    // Check if query executed successfully
    if (!$ret) {
        $err =  $db->lastErrorMsg();
        $text .= $err;
        $text .= "<br>";
    } else {
        $text .= "Done!";
    }
}

//----------------------------------------DB - cleanup document id table ----------------------------------------//
// Type - PurchaseOrder, Dispatch, Invoice, Quotation
// Status - alloted, used, free
//----------------------------------------DB - Add record (Dispatch Table)----------------------------------------//

function dbadddispatchrecord(&$db, $tablename, $DSnum, $DiD, $DDate, $DCname, $DCname2, $DSize, $Rate, $DCount, $DWeight, $totRate, $DCPoNum, &$text) { 
  $CompanyID = $_SESSION["companyID"];
  $sql ="INSERT INTO `$tablename` (SNUM,DISPATCHID,DATE,CUSTOMERNAME,CUSTOMERNAME2,SIZE,RATE,COUNT,WEIGHT,TOTALRATE,PONUMBER,COMPANYID)
    VALUES ('$DiD', '$DSnum', '$DDate', '$DCname', '$DCname2', '$DSize', '$Rate', '$DCount', '$DWeight', '$totRate', '$DCPoNum', '$CompanyID')";
  $ret = $db->query($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records created successfully<br>";
      }
}
?>
