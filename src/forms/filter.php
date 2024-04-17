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
$dbtabheader = ["Stock ID", "Date", "Invoice No.", "SupplierName", "Commodity/Desc", "ReelNo.", "TotalWeight(kg)", "CurrentPrice(₹) breakup", "SGST(%) breakup", "CGST(%) breakup", "IGST(%) breakup","Total(₹)", "Location", "Actual Price(₹/Kg)", "Purchase Price(₹/Kg)", "Tax Savings(₹/Kg)", "Total Tax Savings(₹)"];
$fromDate = $_POST['fromDate'];
$toDate = $_POST['toDate'];

// Sanitize and validate input (this is important to prevent SQL injection)
//$fromDate = mysqli_real_escape_string($dbConnection, $fromDate);
//$toDate = mysqli_real_escape_string($dbConnection, $toDate);

// Perform SQL query
$res = $db->query("SELECT ID, DATE, INVNUM, SUPPLIERNAME, COMMODITYNAME, REELNUMBER, REELWEIGHT, GROUP_CONCAT(RATE, ';') as Rates, GROUP_CONCAT(SGST, ';') as Sgsts, GROUP_CONCAT(CGST, ';') as Cgsts, GROUP_CONCAT(IGST, ';') as Igsts, SUM(TOTAL) as Total, GODOWNNAME, CAST(((SUM(RATE) * REELWEIGHT) + (SUM(RATE) * REELWEIGHT * (CAST(SUM(CGST) + SUM(SGST) + SUM(IGST) AS REAL) / 100.0))) AS REAL) / REELWEIGHT AS ACTUALPRICE, (SUM(TOTAL)/REELWEIGHT) as BUYINGPRICE, ((CAST(((SUM(RATE) * REELWEIGHT) + (SUM(RATE) * REELWEIGHT * (CAST(SUM(CGST) + SUM(SGST) + SUM(IGST) AS REAL) / 100.0))) AS REAL) / REELWEIGHT) - (SUM(TOTAL)/REELWEIGHT)) AS TaxSavings, ((CAST(((SUM(RATE) * REELWEIGHT) + (SUM(RATE) * REELWEIGHT * (CAST(SUM(CGST) + SUM(SGST) + SUM(IGST) AS REAL) / 100.0))) AS REAL) / REELWEIGHT) - (SUM(TOTAL)/REELWEIGHT)) * REELWEIGHT AS TOTALSAV FROM $tablename WHERE $colname BETWEEN '$fromDate' AND '$toDate' AND COMPANYID = '$companyId' GROUP BY REELNUMBER");
// Output data
while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
  array_push($dbtabdata,$row);
}
$columnIndex = 15;
$sum = 0;
foreach ($dbtabdata as $row) {
    // Check if the column index is within the row's range
    if (isset($row[$columnIndex])) {
        // Add the value from the specified column to the columnValues array
        $sum = $sum + $row[$columnIndex];
    } else {
        // Handle the case where the column index is out of range for some rows
        // You can choose to ignore or handle this as per your requirement
    }
}

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
    echo $db->lastErrorMsg();
    echo "<br>";
} else {
    echo "Tabe Read Successfully<br>";
}

// Close connection
dbclose($db, $text);
?>