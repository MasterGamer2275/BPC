<?php

// Assuming you have a database connection established
// Connect to database
$root = $_SERVER['DOCUMENT_ROOT'];
//---add the DB API file
require $root."/DB/call-db.php";
$colname = "DATE";
$dbtabdata = array(array());
$sum = array(array());
dbsetup($db, $text);
$tablename = $_SESSION["StListTabName"];
$companyId = $_SESSION["companyID"];
dbcreatestocktable($db, $tablename, $text);
$dbtabheader = ["Stock ID", "Date", "Invoice No.", "SupplierName", "Commodity/Desc", "GSM", "BF","ReelSize", "ReelNo.", "TotalWeight(kg)", "CurrentPrice(₹) breakup", "SGST(%) breakup", "CGST(%) breakup", "IGST(%) breakup","Total(₹)", "Actual Price(₹/Kg)", "Purchase Price(₹/Kg)", "Tax Savings(₹/Kg)", "Total Tax Savings(₹)"];
//$fromDate = "2024-04-01";
$fromDate = "04/01/2024";
$fdate = DateTime::createFromFormat('m/d/Y', $fromDate);
$formattedfDate = $fdate->format('Y-m-d');
echo $formattedfDate;
//$toDate = "2024-04-21";
$toDate = "04/21/2024";
$tdate = DateTime::createFromFormat('m/d/Y', $toDate);
$formattedtDate = $tdate->format('Y-m-d');
echo $formattedtDate;
$repnum = "1";
// Sanitize and validate input (this is important to prevent SQL injection)
//$fromDate = mysqli_real_escape_string($dbConnection, $fromDate);
//$toDate = mysqli_real_escape_string($dbConnection, $toDate);

// Perform SQL query
$res = $db->query("
    SELECT 
      ID,
      DATE,
      INVNUM,
      SUPPLIERNAME,
      COMMODITYNAME,
      GSM,
      BF,
      REELSIZE,
      REELNUMBER,
      REELWEIGHT,
      GROUP_CONCAT(RATE, ';') as Rates,
      GROUP_CONCAT(SGST, ';') as Sgsts,
      GROUP_CONCAT(CGST, ';') as Cgsts,
      GROUP_CONCAT(IGST, ';') as Igsts,
      SUM(TOTAL) as Total,
      CAST(((SUM(RATE) * REELWEIGHT) + (SUM(RATE) * REELWEIGHT * (CAST(SUM(CGST) + SUM(SGST) + SUM(IGST) AS REAL) / 100.0))) AS REAL) / REELWEIGHT AS ACTUALPRICE, (SUM(TOTAL)/REELWEIGHT) as BUYINGPRICE, ROUND(((CAST(((SUM(RATE) * REELWEIGHT) + (SUM(RATE) * REELWEIGHT * (CAST(SUM(CGST) + SUM(SGST) + SUM(IGST) AS REAL) / 100.0))) AS REAL) / REELWEIGHT) - (SUM(TOTAL)/REELWEIGHT)), 2) as TaxSavings,
      ROUND(((CAST(((SUM(RATE) * REELWEIGHT) + (SUM(RATE) * REELWEIGHT * (CAST(SUM(CGST) + SUM(SGST) + SUM(IGST) AS REAL) / 100.0))) AS REAL) / REELWEIGHT) - (SUM(TOTAL)/REELWEIGHT)) * REELWEIGHT, 2) as Totalsavings
    FROM 
      $tablename 
    WHERE 
      $colname BETWEEN '$formattedfDate' AND '$formattedtDate' 
      AND COMPANYID = '$companyId' 
    GROUP BY 
      REELNUMBER;
");
// Output data
$sum = 0;
while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
  array_push($dbtabdata,$row);
  $sum = $row['Totalsavings'] + $sum;
}
echo "<caption>Total Savings: ₹";
echo $sum;
echo "</caption>";
echo "<tr>";
foreach ($dbtabheader as $cell) {
        echo "<th>$cell</th>";
        }      
    echo "</tr>";
foreach ($dbtabdata as $row) {
        echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>$cell</td>";
            }      
    echo "</tr>";
    }
$sql =<<<EOF
EOF;
$ret = $db->exec($sql);
if(!$ret) {
    //echo $db->lastErrorMsg();
   // echo "<br>";
} else {
    //echo "Tabe Read Successfully<br>";
}

// Close connection
dbclose($db, $text);
echo $text;

?>
<?php
/*
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  $dbtabdata = array(array());
  dbsetup($db, $text);
  $tablename = $_SESSION["StListTabName"];
  $companyId = $_SESSION["companyID"];
  dbcreatestocktable($db, $tablename, $text);
  $res = $db->query("
    SELECT 
      INVNUM,
      SUPPLIERNAME,
      COUNT(REELNUMBER) As NumofReels,
      SUM(REELWEIGHT) As TotalWeight,
      SUM(TOTAL) as Total
    FROM 
      $tablename 
    WHERE 
      COMPANYID = '$companyId' 
    GROUP BY 
      INVNUM;
");
// Output data
while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
  array_push($dbtabdata,$row);
}
                    foreach ($dbtabdata as $row) {
                        echo "<tr>";
                            foreach ($row as $cell) {
                                echo "<td>$cell</td>&emsp;";
                            }      
                    echo "</tr><br>";
                    }
  dbclose($db, $text);
  echo $text;
  */
?>