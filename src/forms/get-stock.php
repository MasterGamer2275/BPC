  <?php
// Assuming you have a database connection established
// Connect to database
$root = $_SERVER['DOCUMENT_ROOT'];
//---add the DB API file
require $root."/DB/call-db.php";
$dbtabdataparent = array(array());
dbsetup($db, $text);
$tablename = $_SESSION["StListTabName"];
$companyId = $_SESSION["companyID"];
$dbtabheader = ["Commodity/Desc", "GSM", "BF","ReelSize", "Num of Reels/ReelNo.", "TotalWeight(kg)/Weight", "Location", "Status"];
echo "<tr>";
foreach ($dbtabheader as $cell) {
        echo "<th>$cell</th>";
        }      
    echo "</tr>";
$res_query1 = $db->query("
    SELECT 
        COMMODITYNAME,
        GSM,
        BF,
        REELSIZE,
        SUM(REELNUMBER) AS NumOfReels,
        CAST(ROUND(SUM(REELWEIGHT) - SUM(USEDWEIGHT), 2) AS REAL),
        GODOWNNAME,
        STATUS 
    FROM 
        $tablename 
    WHERE 
        COMPANYID = '$companyId' 
    GROUP BY 
        COMMODITYNAME, GSM, BF, REELSIZE
");

    // Loop through each row
    while (($row = $res_query1->fetchArray(SQLITE3_ASSOC))) {
        // Access individual values from the current row
        $commodityName = $row['COMMODITYNAME'];
        $gsm = $row['GSM'];
        $bf = $row['BF'];
        $reelSize = $row['REELSIZE'];
        $numOfReels = $row['NumOfReels'];
        $totalWeight = $row['TotalWeight'];
        $godownName = $row['GODOWNNAME'];
        $status = $row['STATUS'];
        array_push($dbtabdataparent,$row);
                echo "<tr>";
                    foreach ($row as $cell) {
                        echo "<td>$cell</td>";
                    }      
              echo "</tr>";
        $res_query2 = $db->query("
            SELECT 
                '' AS COMMODITYNAME,
                '' AS GSM,
                '' AS BF,
                '' AS REELSIZE,
                REELNUMBER,
                CAST(ROUND(REELWEIGHT - USEDWEIGHT, 2) AS REAL),
                GODOWNNAME,
                STATUS 
            FROM 
                $tablename
            WHERE 
                COMPANYID = '$companyId' 
                AND COMMODITYNAME = '$commodityName'
                AND GSM = '$gsm'
                AND BF = '$bf'
                AND REELSIZE = '$reelSize'
            GROUP BY
                REELNUMBER
");
$dbtabdatachild = array(array());
    while (($row = $res_query2->fetchArray(SQLITE3_ASSOC))) {
       array_push($dbtabdatachild,$row);
    }
    foreach ($dbtabdatachild as $row) {
        echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>$cell</td>";
            }      
    echo "</tr>";
    }
}

dbclose($db, $text);

?>