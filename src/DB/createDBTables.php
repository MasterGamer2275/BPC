 <?php
 //----------------------------------------DB - Create Table (Suppliers)----------------------------------------//
    $text .= "Welcome to create supplier table if not exists<br>";
    $tablename = $_SESSION["SListTabName"];
    $sql = "
        CREATE TABLE IF NOT EXISTS `$tablename` (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            NAME VARCHAR(255) NOT NULL UNIQUE,
            GSTIN VARCHAR(15) NOT NULL,
            ADDRESS TEXT,
            CITY TEXT,
            STATE TEXT,
            PINCODE VARCHAR(6),
            PHONE VARCHAR(10),
            EMAIL TEXT,
            COMPANYID INT,
            IGST TEXT
        );
    ";
    
    if ($db->query($sql) === TRUE) {
        $text .= "Table created successfully<br>";
    } else {
        $text .= "Error creating table: " . $db->error . "<br>";
    }

//----------------------------------------DB - Create Table (Commodities)----------------------------------------//

    $text .= "Welcome to create commodity table if not exists<br>";
    $tablename = $_SESSION["ComListTabName"];
    // Define the SQL query
    $sql = "
        CREATE TABLE IF NOT EXISTS `$tablename` (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            NAME VARCHAR(255) NOT NULL,
            SUPPLIERNAME VARCHAR(255) NOT NULL,
            GSM INT NOT NULL,
            BF INT NOT NULL,
            COMPANYID INT NOT NULL,
            REELSIZEinCM DECIMAL(20,2) NOT NULL
        )
    ";
    
    // Execute the SQL query
    if ($db->query($sql) === TRUE) {
        $text .= "Commodity Table created successfully<br>";
    } else {
        $text .= "Error creating commodity table: " . $db->error . "<br>";
    }

//----------------------------------------DB - Create Table (Stock)----------------------------------------//

    $text .= "Welcome to create stock table if not exists<br>";
    $tablename = $_SESSION["StListTabName"];
    // SQL query to create table
    $sql = "
    CREATE TABLE IF NOT EXISTS `$tablename` (
        ID INT AUTO_INCREMENT PRIMARY KEY,
        DATE TEXT NOT NULL,
        INVNUM TEXT NOT NULL,
        SUPPLIERNAME TEXT NOT NULL,
        COMMODITYNAME TEXT NOT NULL,
        GSM INT NOT NULL,
        BF INT NOT NULL,
        REELSIZE DECIMAL(20,2) NOT NULL,
        REELNUMBER INT NOT NULL,
        REELWEIGHT DECIMAL(20,2) NOT NULL,
        RATE DECIMAL(20,2),
        SGST DECIMAL(20,2),
        CGST DECIMAL(20,2),
        IGST DECIMAL(20,2),
        TOTAL DECIMAL(20,2),
        GODOWNNAME TEXT NOT NULL,
        USEDWEIGHT TEXT NOT NULL,
        STATUS TEXT NOT NULL,
        COMPANYID INT NOT NULL
    );";

    // Execute the query
    if ($db->query($sql) === TRUE) {
        $text .= "Stock table created successfully<br>";
    } else {
        $text .= "Error creating table: " . $db->error . "<br>";
    }

//----------------------------------------DB - Create Table (Company)----------------------------------------//

   $text .= "welcome to create companies list table if not exists<br>";
   $tablename = $_SESSION["CoListTabName"];
$sql ="
   CREATE TABLE IF NOT EXISTS `$tablename`(
   ID INT AUTO_INCREMENT PRIMARY KEY,
   NAME VARCHAR(255) NOT NULL UNIQUE,
   GSTIN VARCHAR(15) NOT NULL UNIQUE,
   ADDRESS TEXT NOT NULL,
   CITY TEXT NOT NULL,
   STATE TEXT NOT NULL,
   PINCODE TEXT NOT NULL,
   PHONE TEXT NOT NULL,
   EMAIL TEXT NOT NULL,
   ADMINPHONEAREACODE TEXT,
   ADMINPHONE TEXT,
   COMPANYLOGO TEXT NOT NULL,
   DIGISIG TEXT NOT NULL,
   LETTERHEAD TEXT NOT NULL,
   MACHINELIST TEXT NOT NULL,
   GODOWNLIST TEXT NOT NULL
);";
    // Execute the query
    if ($db->query($sql) === TRUE) {
        $text .= "clist table created successfully<br>";
    } else {
        $text .= "Error creating table: " . $db->error . "<br>";
    }

//----------------------------------------DB - Create Table (Customers)----------------------------------------//

   $text .= "welcome to create customer table if not exists";
$tablename = $_SESSION["ClListTabName"];
$sql =("
   CREATE TABLE if not exists `$tablename`(
   ID INT AUTO_INCREMENT PRIMARY KEY,
   NAME VARCHAR(255) NOT NULL UNIQUE,
   CLIENTNAME TEXT,
   GSTIN  VARCHAR(15) NOT NULL,
   ADDRESS TEXT NOT NULL,
   CITY TEXT NOT NULL,
   STATE TEXT NOT NULL,
   PINCODE TEXT NOT NULL,
   PHONE TEXT NOT NULL,
   EMAIL TEXT NOT NULL,
   SECADDRESS TEXT,
   AREACODE TEXT,
   ADMINPHONE TEXT,
   COMPANYID INT NOT NULL   
);
");
   $ret = $db->query($sql);
   if(!$ret){
      $err = $db->lastErrorMsg();
      $text .= $err;
      $text .= "<br>";
   } else {
      $text .= "Table created successfully<br>";
   }


//----------------------------------------DB - Create Table (Products)----------------------------------------//


   $text .= "welcome to create product table if not exists";
$tablename = $_SESSION["PListTabName"];
$sql =("
   CREATE TABLE if not exists `$tablename`(
   ID INT AUTO_INCREMENT PRIMARY KEY,
   CUSTOMERNAME TEXT NOT NULL,
   DESCRIPTION TEXT NOT NULL,
   SPEC TEXT NOT NULL,
   GSM INT NOT NULL,
   SIZE TEXT NOT NULL,
   UNIT TEXT NOT NULL,
   RATE  DECIMAL(20,2) NOT NULL,
   OPENINGSTOCK INT NOT NULL,
   PRODUCTION INT NOT NULL,
   CLOSINGSTOCk INT NOT NULL,
   TOTALVAL DECIMAL(20,2) NOT NULL,
   COMPANYID INT NOT NULL
);
");
   $ret = $db->query($sql);
   if(!$ret){
      $err = $db->lastErrorMsg();
      $text .= $err;
      $text .= "<br>";
   } else {
      $text .= "Table created successfully<br>";
   }

//----------------------------------------DB - Create table (Purchase Table)----------------------------------------//

$text .= "welcome to create purchase req table if not exists";
$tablename = $_SESSION["PRTabName"];
$sql ="
   CREATE TABLE IF NOT EXISTS `$tablename`(
      ID INT AUTO_INCREMENT PRIMARY KEY,
      PONUM INT NOT NULL,
      PORELEASEDATE TEXT NOT NULL,
      PORELEASETIME TEXT NOT NULL,
      SUPPLIERNAME TEXT NOT NULL,
      SERIALNUMBER INT NOT NULL,
      PARTICULARS  TEXT NOT NULL,
      NUMBEROFREELS INT NOT NULL,
      RATEPER DECIMAL(20,2) NOT NULL,
      QNTY INT NOT NULL,
      RATE DECIMAL(20,2) NOT NULL,
      DISCOUNT DECIMAL(20,2),
      AMOUNT DECIMAL(20,2) NOT NULL,
      DDFROM TEXT,
      DDTO TEXT,
      COMPANYID INT	NOT NULL
        );
    ";
    
$ret = $db->query($sql);
   if(!$ret){
      $err = $db->lastErrorMsg();
      $text .= $err;
      $text .= "<br>";
   } else {
      $text .= "Table created successfully<br>";
   }

//----------------------------------------DB - Create Table (PRNumber)----------------------------------------//


$text .= "welcome to create pr num table if not exists";
$tablename = $_SESSION["PRNumTabName"];
$sql ="
   CREATE TABLE IF NOT EXISTS `$tablename`(
   ID INT AUTO_INCREMENT PRIMARY KEY,
   PRNUMBER VARCHAR(20) NOT NULL UNIQUE,
   DESCRIPTION TEXT NOT NULL,
   COMPANYID INT NOT NULL
        );
    ";
   $ret = $db->query($sql);
   if(!$ret){
      $err = $db->lastErrorMsg();
      $text .= $err;
      $text .= "<br>";
   } else {
      $text .= "Table created successfully<br>";
   }

//----------------------------------------DB - Create table (Production feed Table)----------------------------------------//

    $text .= "Welcome to create production feed req table if not exists";
    $tablename = $_SESSION["ProdTabName"];
    $sql =("
    CREATE TABLE IF NOT EXISTS `$tablename`(
        ID INT AUTO_INCREMENT PRIMARY KEY,
        DATE TEXT NOT NULL,
        TIME TEXT NOT NULL,
        MACHINENUM TEXT NOT NULL,
        CUSTOMERNAME TEXT NOT NULL,
        SIZE TEXT NOT NULL,
        REELNUMBER INTEGER NOT NULL,
        REELWIDTH DECIMAL(20,2)NOT NULL,
        REELLENGTH DECIMAL(20,2) NOT NULL,
        ESTPRODUCTION INTEGER NOT NULL,
        ACTUAL INTEGER,
        STATUS TEXT NOT NULL,
        CUTREEL TEXT,
        USEDWEIGHT DECIMAL(20,2),
        ESTWASTAGE DECIMAL(20,2),
        ACTWASTAGE DECIMAL(20,2),
        COMPANYID  INTEGER NOT NULL
    );
");
    $ret = $db->query($sql);
    if(!$ret) {
        $err = $db->lastErrorMsg();
        $text .= $err;
        $text .= "<br>";
    } else {
            $text .= "Table created successfully<br>";
        }
//----------------------------------------DB - Create Table (Document ID)----------------------------------------//
// Type - PurchaseOrder, Dispatch, Invoice, Quotation//
// Status - alloted, used, free//

  $text .= "welcome to create document id table if not exists";
  $tablename = $_SESSION["DocIdTabName"];
  $sql =("
   CREATE TABLE if not exists `$tablename`(
   ID INT AUTO_INCREMENT PRIMARY KEY,
   DATE TEXT NOT NULL,
   TIME TEXT NOT NULL,
   TYPE TEXT NOT NULL,
   DOCID INTEGER NOT NULL UNIQUE,
   STATUS TEXT,
   COMPANYID INTEGER);
");
   $ret = $db->query($sql);
   if(!$ret){
      $err = $db->lastErrorMsg();
      $text .= $err;
      $text .= "<br>";
   } else {
      $text .= "Table created successfully<br>";
   }

//----------------------------------------DB - Create Table (Dispatch)----------------------------------------//

   $text .= "welcome to create dispatch table if not exists";
 $tablename = $_SESSION["DispTabName"];
  $sql =("
   CREATE TABLE if not exists `$tablename`(
   ID INT AUTO_INCREMENT PRIMARY KEY,
   DISPATCHID INTEGER NOT NULL,
   SNUM INTEGER NOT NULL,
   DATE TEXT NOT NULL,
   CUSTOMERNAME TEXT NOT NULL,
   CUSTOMERNAME2 TEXT NOT NULL,
   SIZE TEXT NOT NULL,
   RATE DECIMAL(20,2) NOT NULL,
   COUNT INTEGER NOT NULL,
   WEIGHT DECIMAL(20,2) NOT NULL,
   TOTALRATE DECIMAL(20,2) NOT NULL,
   PONUMBER VARCHAR(15)	NOT NULL,
   COMMENT TEXT,
   COMPANYID INTEGER NOT NULL
);
");
   $ret = $db->query($sql);
   if(!$ret){
      $err = $db->lastErrorMsg();
      $text .= $err;
      $text .= "<br>";
   } else {
      $text .= "Table created successfully<br>";
   }
//echo $text;
?>