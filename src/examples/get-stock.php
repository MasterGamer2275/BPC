<?php
// Assuming you have a database connection established
// Connect to database
$root = $_SERVER['DOCUMENT_ROOT'];
//---add the DB API file
require $root."/DB/call-db.php";
$dbtabdata = array(array());
dbsetup($db, $text);
$tablename = $_SESSION["StListTabName"];
$companyId = $_SESSION["companyID"];
$res_query1 = $db->query("
SELECT 
    COMMODITYNAME,
    GSM,
    BF,
    REELSIZE,
    SUM(NumOfReels) AS TotalNumOfReels,
    CAST(ROUND(SUM(NetReelWeight), 2) AS REAL) AS TotalNetReelWeight,
    GODOWNNAME,
    STATUS 
FROM (
    SELECT 
        COMMODITYNAME,
        GSM,
        BF,
        REELSIZE,
        REELNUMBER AS NumOfReels,
        REELWEIGHT - USEDWEIGHT AS NetReelWeight,
        GODOWNNAME,
        STATUS 
    FROM 
        $tablename 
    WHERE 
        COMPANYID = '$companyId'
    GROUP BY 
        COMMODITYNAME, GSM, BF, REELSIZE, REELNUMBER
) AS subquery
GROUP BY 
    COMMODITYNAME, GSM, BF, REELSIZE;
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
        array_push($dbtabdata,$row);
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
                REELNUMBER;
");
array_push($dbtabdata,$row);
    }
dbclose($db, $text);
$strout = JSON.stringify($dbtabdata);
echo $strout
?>