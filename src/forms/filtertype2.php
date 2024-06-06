<?php
// Assuming you have a database connection established
// Connect to database
$root = $_SERVER['DOCUMENT_ROOT'];
//---add the DB API file
require $root."/DB/call-db.php";
require "/home/app/src/Reset.php";
$sum = array(array());
dbsetup($db, $text);
$tablename = $_SESSION["PListTabName"];
$dbtabdata = array(array());
$colname = "CUSTOMERNAME";
$companyId = $_SESSION["companyID"];
$cName = $_POST['cName'];
$dbtabheader = ["S.No:", "Size", "Opening Stock", "Production", "Closing Stock", "Stock Price(₹perc)", "Total Stock Price(₹)", "GST(₹)"];
// Sanitize and validate input (this is important to prevent SQL injection)
//$fromDate = mysqli_real_escape_string($dbConnection, $fromDate);
//$toDate = mysqli_real_escape_string($dbConnection, $toDate);

// Perform SQL query
$res = $db->query("
    SELECT 
      SIZE,
      CLOSINGSTOCK AS Openingst,
      '0' AS Production,
      CLOSINGSTOCK AS ClosingSt,
      RATE,
      (RATE * CLOSINGSTOCK) AS TotalValue,
      (RATE * CLOSINGSTOCK * 12 / 100) AS GST
    FROM 
      `$tablename`
    WHERE 
      $colname = '$cName' 
      AND COMPANYID = '$companyId' 
    ORDER BY
      SIZE;
");
// Output data
$sum = 0;
$gst = 0;
$totalval = 0;
$i = 1;
while (($row = $res->fetch_assoc())) {
  array_unshift($row,$i);
  array_push($dbtabdata,$row);
  $sum = $row['TotalValue'] + $row['GST'] + $sum;
  $gst = $gst + $row['GST'];
  $totalval = $totalval + $row['TotalValue'];
  $i++;
}
$totalval = number_format($totalval, 2);
$gst = number_format($gst, 2);
$lastrow = ['', '', '', '', '', '', $totalval, $gst];
array_push($dbtabdata,$lastrow);
echo "<caption>$cName   :-💰Stock Value: ₹";
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
              if ($i === 3){
                echo "<td><div input type = \"number\" contenteditable>$cell</div></td>";
              } else {
                echo "<td>$cell</td>";
              }
              $i++;
            }      
    echo "</tr>";
    }
// Close connection
dbclose($db, $text);
?>