  <?php
// Assuming you have a database connection established
// Connect to database
$root = $_SERVER['DOCUMENT_ROOT'];
//---add the DB API file
require $root."/DB/call-db.php";
$colname = "DATE";
$dbtabdata = array(array());
dbsetup($db, $text);
$tablename = $_SESSION["SListTabName"];
$suppliername = $_POST['suppliername'];

// Sanitize and validate input (this is important to prevent SQL injection)
//$fromDate = mysqli_real_escape_string($dbConnection, $fromDate);
//$toDate = mysqli_real_escape_string($dbConnection, $toDate);

// Perform SQL query
$res = $db->query("SELECT * FROM $tablename WHERE NAME = '$suppliername'");
// Output data
while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
  array_push($dataarray1,$row);
}
echo "<tr>";
foreach ($dataarray1 as $cell) {
    echo "<th>$cell</th>";
         }      
echo "</tr>";
$sql =<<<EOF
EOF;
$ret = $db->exec($sql);
if(!$ret) {
    echo $db->lastErrorMsg();
    echo "<br>";
} else {
    echo "Record Read Successfully<br>";
}

// Close connection
dbclose($db, $text);
?>