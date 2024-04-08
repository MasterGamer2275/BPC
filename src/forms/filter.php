 <?php
// Assuming you have a database connection established
// Connect to database
$root = $_SERVER['DOCUMENT_ROOT'];
//---add the DB API file
require $root."/DB/call-db.php";
$colname = "DATE";
$dbtabdata = array(array());
dbsetup($db, $text);
$tablename = $_SESSION["StListTabName"];
dbcreatestocktable($db, $tablename, $text);
$dbtabheader = ["Stock ID", "Date", "Invoice No.", "SupplierName", "Commodity/Desc", "ReelNo.", "TotalWeight(kg)", "CurrentPrice(Rs.)", "SGST(%)", "CGST(%)", "IGST(%)","Total(Rs.)", "CompanyID", "Location", "Avg.Price(Rs.)"];
$fromDate = $_POST['fromDate'];
$toDate = $_POST['toDate'];

// Sanitize and validate input (this is important to prevent SQL injection)
//$fromDate = mysqli_real_escape_string($dbConnection, $fromDate);
//$toDate = mysqli_real_escape_string($dbConnection, $toDate);

// Perform SQL query
$res = $db->query("SELECT * FROM $tablename WHERE $colname BETWEEN '$fromDate' AND '$toDate'");
// Output data
while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
  array_push($dbtabdata,$row);
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