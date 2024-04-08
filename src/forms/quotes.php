<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  dbsetup($db, $text);
  $tablename = $_SESSION["SListTabName"];
  $columnname = "NAME";
  $dbcolvalues = array(array());
  dbgetcolumnname($db, $tablename, $columnname, $dbcolvalues, $text);
  //$tablename = $_SESSION["PRTabName"];
  //dbcreatePRtable($db, $tablename, $text);
  //dbaddprplhrecord($db, $tablename, $text);
  //$ID = "60101";
  //dbdeletePRrecord($db, $tablename, $ID, $text);
  //dbreadPRID($db, $tablename, $PONum, $text);
  //echo $PONum;
  dbclose($db, $text);
  echo $text;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Stock Statistics:</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
}
tr:nth-child(even) {
  background-color: #f2f2f2
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
<body>
  <h2>Filter Stock by Date</h2>
  <label for="fromDate">From:</label>
  <input type="date" id="fromDate" name="fromDate">
  <label for="toDate">To:</label>
  <input type="date" id="toDate" name="toDate">
    <label for="PSname"><b>Supplier: *</label>
    <select name= = "PSname" id = "PSname" onchange="getcommoditylist();updateval();setformstate();">
    <option value="">Select</option>
      <?php
        // Loop through the array to generate list items
      foreach ($dbcolvalues as $row) {
          foreach ($row as $value) {
            echo "<option value='$value'>$value</option>";
          }
      }
      ?>
    </select>
    <label for="PONumL"><b>PO Number: *</label>
    <select name= = "PONumL" id = "PONumL" onchange="">
    <option value="">Select</option>
    </select>
    <button id="filterBtn">Filter</button>

  <table id="dataTable">
    <!-- Table body will be populated dynamically -->

  </table>

  <script src="script.js"></script>
</body>
</html>