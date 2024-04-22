<?php
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
      SUM(TOTAL) as TotalPrice
    FROM 
      $tablename 
    WHERE 
      COMPANYID = '$companyId' 
    GROUP BY 
      INVNUM
    ORDER BY
      TotalPrice DESC;
");
// Output data
while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
  array_push($dbtabdata,$row);
}

  dbclose($db, $text);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Sample Dashboard Boxes</title>
</head>
<style>
body {
    //font-family: Arial, Helvetica, sans-serif;
    font-family: "Trebuchet MS", sans-serif;
    margin: 0;
    padding: 0;
}
.dashboard {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    padding: 20px;
}
.box {
    background-color: #f0f0f0;
    border-radius: 5px;
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.1);
    padding: 20px;
    flex: 1 1 300px; /* Adjust the width of boxes as needed */
}
.box h2 {
    margin-top: 0;
    font-size : 18px;
    position: relative;
    left: 30%;
    top: 0%;
}

.box p {
    margin-bottom: 0;
    font-size : 15px;
    font-weight: normal;
    position: relative;
    left: 30%;
    top: 0%;
}

.box img {
    position: relative;
    top: -20%;
    left: 10%;
    transform: translate(-50%, -50%);
    z-index: 1;
    /* You can adjust the size of the overlay image */
    width: 100px; /* Adjust width as needed */
    height: 100px; /* Adjust height as needed */
    /* You can add additional styles for the overlay image */
}
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 20%;
  border: none;
  border-bottom: 1px solid none;
  border-right: 1px solid none;
}

th, td {
  text-align: left;
  padding: 8px;
  font-size: 15px;
  font-weight: bold;
  border-bottom: none;
  border-right: none;
  position: relative;
  overflow: hidden; /* Optional: hides content that overflows the cell */
  white-space: wrap;
}

tr, td {
  text-align: left;
  padding: 16px;
  font-size: 15px;
  font-weight: normal;
  border-bottom: none;
  border-right: none;
}
</style>

<body>
<h3>👋 Welcome User!<h3>
    <div class="dashboard">
        <div class="box">
            <h2>Items Low in Stock:</h2>
            <p>SDLX GSM 60 30%</p>
            <p>KY GSM 80 20%</p>
            <i class='fa fa-stock' style='font-size:48px;color:red'></i>
        </div>
        <div class="box">
            <h2 style="left:0%;">Dispatch Status:</h2>
            <p style="left:0%;">Job _____ done on 8/10</p>
        </div>
        <div class="box">
            <h2 style="left:0%;">Recent Activity:</h2>
            <p style="left:0%;">PO no:6184 sent through whats app to supplier BlueMount 03/24/2024</p>
            <p style="left:0%;">Order No: 4567 received from customer Chennai Silks</p>
        </div>
    </div>
    <div class="dashboard">
            <div class="box">
            </div>
            <div class="box">
               <i class='fa fa-cart-plus' style='font-size:48px;color:red'></i>
               <h2 style="left:0%;">Purchase Summary:</h2>
               <table id = "myTable">
                    <tr>
                        <th>Invoice No:</th>
                        <th>Supplier Name:</th>
                        <th>Reels:</th>
                        <th>Weight(Kg):</th>
                        <th>Price(₹):</th>
                    </tr>
                <?php
                    foreach ($dbtabdata as $row) {
                        echo "<tr>";
                        $i = 0;
                            foreach ($row as $cell) {
                                If ($i <2) {
                                  echo "<td><a href=\"/forms/edit-stock-table.php?clickedValue=$cell\">$cell</a></td>";
                                  } else {
                                      echo "<td>$cell</td>";                   
                                  }
                                  $i++;
                            }      
                    echo "</tr>";
                    }
                ?>
                </table>

            </div>
    </div>
</body>

<script>


</script>
</html>