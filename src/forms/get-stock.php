  <?php
// Assuming you have a database connection established
// Connect to database
$root = $_SERVER['DOCUMENT_ROOT'];
//---add the DB API file
require $root."/DB/call-db.php";
$dbtabdata = array(array());
dbsetup($db, $text);
$tablename = $_SESSION["StListTabName"];
dbcreatestocktable($db, $tablename, $text);
dbreadstocktable($db, $tablename, $dbtabdata, $text);
dbclose($db, $text);

foreach ($dbtabdata as $row) {
        echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>$cell</td>";
            }      
    echo "</tr>";
    }
?>