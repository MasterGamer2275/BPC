<?php
// Assuming you have a database connection established
// Connect to database
$root = $_SERVER['DOCUMENT_ROOT'];
//---add the DB API file
require $root."/DB/call-db.php";

$sum = array(array());
dbsetup($db, $text);
$tablename = $_SESSION["PListTabName"];
dbcreateproducttable($db, $tablename, $text);
$dbtabdata = array(array());
$colname = "CUSTOMERNAME";
$companyId = $_SESSION["companyID"];
$cName = $_POST['cName'];
$dbtabheader = ["Size", "Opening Stock", "Production", "Closing Stock", "Stock Price(₹perc)", "Total Stock Price(₹)"];
// Sanitize and validate input (this is important to prevent SQL injection)
//$fromDate = mysqli_real_escape_string($dbConnection, $fromDate);
//$toDate = mysqli_real_escape_string($dbConnection, $toDate);

// Perform SQL query
$res = $db->query("
    SELECT 
      SIZE,
      OPENINGSTOCK,
      PRODUCTION,
      CLOSINGSTOCK,
      RATE,
      (RATE * CLOSINGSTOCK) as TotalValue
    FROM 
      $tablename 
    WHERE 
      $colname = '$cName' 
      AND COMPANYID = '$companyId' 
    ORDER BY 
      SIZE;
");
// Output data
$sum = 0;
while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
  array_push($dbtabdata,$row);
  $sum = $row['TotalValue'] + $sum;
}
echo "<caption>💰Stock Maintained Value: ₹";
echo number_format($sum, 2);
echo "</caption>";
echo "<tr>";
foreach ($dbtabheader as $cell) {
        echo "<th>$cell</th>";
        }      
    echo "</tr>";
foreach ($dbtabdata as $row) {
        echo "<tr>";
        $i = 0;
            foreach ($row as $cell) {
              if ($i === 1 || $i === 2){
                echo "<td><div input type = \"number\" contenteditable>$cell</div></td>";
              } else {
                echo "<td>$cell</td>";
              }
              $i++;
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
?>