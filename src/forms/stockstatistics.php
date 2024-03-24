<?php
  //---define all variables and constants used
  //---read a table
  //find the root path to calling the php filles by path
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  $tablename = "TEST_STOCK_3";
  dbsetup($db);
  dbcreatestocktable($db, $tablename);
  $dbtabdata = array(array());
  dbreadtable($db, $tablename, $dbtabdata);
  dbclose($db);
  // Convert the array of objects to a JSON array
  $jsonArray_1 = json_encode($dbtabdata);
  // Echo the JSON array
  echo '<script>';
  echo 'var jsArray_1 = ' . $jsonArray_1 . ';';
  echo 'console.log(jsArray_1);'; // Output the array in the browser console
  echo '</script>';
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
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
<form action="/forms_action_page.php" method="post">
<h3>Stock Statistics</h3>
<label for="Fdate"><b>Filter By Date</label>
<input type = "date" id = "Fdate" name = "Fdate"  size="0" onchange = "sortbydate();">
<br><br>
<table id="myTable">
  <tr>
      <th>Stock ID</th> 
      <th>Date</th>    
      <th>Invoice No.</th> 
      <th>SupplierName</th> 
      <th>Commodity/Desc</th>   
      <th>ReelSize(Cm)</th>    
      <th>ReelNo.</th>    
      <th>TotalWeight (kg)</th>    
      <th>CurrentPrice (Rs.)</th>      
      <th>SGST(%)</th>    
      <th>CGST(%)</th>    
      <th>IGST(%)</th> 
      <th>Total(Rs.)</th>
      <th>CompanyID</th>
      <th>Avg. Price (Rs.)</th>
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
</form>
</body>
<script>
function sortbydate() {
var table = document.getElementById("myTable");
var numberOfRecords = table.rows.length;
for (let i = 1; i < numberOfRecords; i++) {
  table.deleteRow(1);
  }




        var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
        var newRow = table.insertRow(table.rows.length);
        const selectElement = document.getElementById("PCname");
        const selectValue= selectElement.options[selectElement.selectedIndex].text;
        const tableindex = parseInt(document.getElementById("tableindex").value);
        const myArray = [tableindex, "", document.getElementById("Pdate").value, document.getElementById("PSname").value, selectValue, document.getElementById("PRS").value, document.getElementById("PRN").value, document.getElementById("PRW").value, document.getElementById("PRate").value, document.getElementById("PSGST").value, document.getElementById("PCGST").value, document.getElementById("PIGST").value, document.getElementById("PTotal").value];
              for (let i = 0; i < myArray.length; i++) {
              var cell = newRow.insertCell(i);
              cell.innerHTML = myArray[i];
              }
        document.getElementById("tableindex").value= tableindex +1;
}

</script>
</head>
</html> 