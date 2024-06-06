 <?php
// Assuming you have a database connection established
// Connect to database
$root = $_SERVER['DOCUMENT_ROOT'];
//---add the DB API file
require $root."/DB/call-db.php";
require "/home/app/src/Reset.php";
$colname = "DATE";
$dbtabdata = array(array());
$sum = array(array());
dbsetup($db, $text);
$tablename = $_SESSION["StListTabName"];
$companyId = $_SESSION["companyID"];
$dbtabheader = ["Stock ID", "Date", "Invoice No.", "SupplierName", "Commodity/Desc", "GSM", "BF","ReelSize", "ReelNo.", "TotalWeight(kg)", "CurrentPrice(₹) breakup", "SGST(%) breakup", "CGST(%) breakup", "IGST(%) breakup","Total(₹)", "Actual Price(₹/Kg)", "Purchase Price(₹/Kg)", "Tax Savings(₹/Kg)", "Total Tax Savings(₹)"];
$fromDate = $_POST['fromDate'];
echo $fromDate;
$toDate = $_POST['toDate'];
$repnum = $_POST['repnum'];
// Sanitize and validate input (this is important to prevent SQL injection)
//$fromDate = mysqli_DECIMAL_escape_string($dbConnection, $fromDate);
//$toDate = mysqli_DECIMAL_escape_string($dbConnection, $toDate);

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
      CAST(((SUM(RATE) * REELWEIGHT) + (SUM(RATE) * REELWEIGHT * (CAST(SUM(CGST) + SUM(SGST) + SUM(IGST) AS DECIMAL) / 100.0))) AS DECIMAL) / REELWEIGHT AS ACTUALPRICE, (SUM(TOTAL)/REELWEIGHT) as BUYINGPRICE, ROUND((SUM(TOTAL)/REELWEIGHT) - ((CAST(((SUM(RATE) * REELWEIGHT) + (SUM(RATE) * REELWEIGHT * (CAST(SUM(CGST) + SUM(SGST) + SUM(IGST) AS DECIMAL) / 100.0))) AS DECIMAL) / REELWEIGHT)), 2) as TaxSavings,
      ROUND(((SUM(TOTAL)/REELWEIGHT) - (CAST(((SUM(RATE) * REELWEIGHT) + (SUM(RATE) * REELWEIGHT * (CAST(SUM(CGST) + SUM(SGST) + SUM(IGST) AS DECIMAL) / 100.0))) AS DECIMAL) / REELWEIGHT)) * REELWEIGHT, 2) as Totalsavings
    FROM 
      $tablename 
    WHERE 
      $colname BETWEEN '$fromDate' AND '$toDate' 
      AND COMPANYID = '$companyId' 
    GROUP BY 
      REELNUMBER;
");
// Output data
$sum = 0;
while (($row = $res->fetch_assoc())) {
  array_push($dbtabdata,$row);
  $sum = $row['Totalsavings'] + $sum;
}

echo "<caption>Total Savings: ₹";
echo number_format($sum, 2);
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
dbclose($db, $text);
?>