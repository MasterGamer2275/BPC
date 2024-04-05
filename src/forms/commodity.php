
<?php
  //---define all variables and constants used
  //---read a table
  //find the root path to calling the php filles by path
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  $tablename = "TEST_COMMODITY_3";
  dbsetup($db, $text);
  dbcreatecommoditytable($db, $tablename, $text);
  $dbtabdata = array(array());
  dbreadtable($db, $tablename, $dbtabdata, $text);
  $tablename = "TEST_SUPPLIER_4";
  $columnname = "NAME";
  $dbcolvalues = array(array());
  dbgetcolumnname($db, $tablename, $columnname, $dbcolvalues, $text);
  dbclose($db, $text);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Source Sans Pro", "sans-serif";
  //font-family: "Trebuchet MS", sans-serif;
}
label {
  /* Your general styles for labels */
  font-size: 16px;
  color: #333;
}
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
  font-size: 15px;
  font-weight: normal;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
}
tr:nth-child(even) {
  background-color: rgb(255, 208, 162);
}

/* Hide the fifth column by default */
  th:nth-child(6),
  td:nth-child(6) {
  display: none;
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

select {
width: 25%;
/* width: 120px;*/
height: 20px;
}

</style>

<form action="forms_action_page.php" method="post">
<h3>Create/Add Raw Material Master:</p>
<label for="Cname"><b>Material Type: *</label>
<input type = "text" id = "Cname" name = "Cname" required>
<label for="CSname"><b>Supplier Name: *</label>
<select name="CSname" id="CSname">
<option value="Default">Default</option>
  <?php
  
  // Loop through the array to generate list items
  foreach ($dbcolvalues as $row) {
      foreach ($row as $value) {
  echo "<option value='$value'>$value</option>";
      }
  }
  ?>
</select>
<br><br>
<label for="CGSM"><b>GSM: *</label>
<input type = "number" id = "CGSM" name = "CGSM" required min = "1" step=".01">
<label for="CBF"><b>BF: *</label>
<input type = "number" id = "CBF" name = "CBF" required min = "1" step=".01">
<label for="CRS"><b>ReelSize(Cm): *</label>
<input type = "number" id = "CRS" name = "CRS" required min = "1" step="0.01">
<input type = "submit" id = "CAdd" name = "CAdd" value = "Add Record">
<br><br>

<table>
  <tr>
    <th>Commodity ID</th>
    <th>Material Type</th>
    <th>Supplier Name</th>
    <th>GSM</th>
    <th>BF</th>
    <th>COMPANYID</th>
    <th>REELSize(Cm)</th>
  </tr>
  <?php
  // Loop through the array to generate table rows
  foreach ($dbtabdata as $row) {
      echo "<tr>";
      foreach ($row as $cell) {
                echo "<td>$cell</td>";
              }
      echo "</tr>";
  }
  ?>
</table>

</body>
</html> 