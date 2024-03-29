<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  dbsetup($db);
  $tablename = "TEST_SUPPLIER_4";
  $columnname = "NAME";
  $dbcolvalues = array(array());
  dbgetcolumnname($db, $tablename, $columnname, $dbcolvalues);
  $tablename = "TEST_COMMODITY_3";
  $dbtabdata = array(array());
  dbreadtable($db, $tablename, $dbtabdata);
  dbclose($db);
  // Convert the array of objects to a JSON array
  $jsonArray_2 = json_encode($dbtabdata);
  // Echo the JSON array
  echo '<script>';
  echo 'var jsArray_2 = ' . $jsonArray_2 . ';';
  echo 'console.log(jsArray_2);'; // Output the array in the browser console
  echo '</script>';
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
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
  border: 1px solid #ddd;
  border-right: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
  border: 1px solid #ddd;
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
select {
width: 15%;
/* width: 120px;*/
height: 20px;
}
</style>
<div id="id01">
  <form onsubmit="addtotable();checkDuplicates();handleSubmit(event);saveTableDataToConsole();">
      <h3>Generate Purchase Order:</h3>
      <label for="POdate"><b>Purchase Date:</label>
      <input type = "date" id = "POdate" name = "POdate" size="0" value="" required>
      <label for="POSname"><b>Supplier: *</label>
        <select name= = "POSname" id = "POSname" onchange="getcommoditylist();updateval();">
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
      <label for="POCname"><b>Commodity</label>
        <select name="POCname" id="POCname" onchange = "updateval();">
          <option value="">Select</option>
        </select>
      <label for="POGSM"><b>GSM: *</label>
      <input type = "text" id = "POGSM" name = "POGSM" required size="5" disabled>
      <label for="POBF"><b>BF: *</label>
      <input type = "text" id = "POBF" name = "POBF" required size="5" disabled><br><br>
      <label for="POSize"><b>Size(Cm):*</label>
      <input type = "number" id = "POSize" name = "POSize" required width="5px" min = "01" max= "10000">
      <label for="PONReels"><b>No. of Reel: *</label>
      <input type = "number" id = "PONReels" name = "PONReels" required width="5px" min = "1" max= "1000000">
      <label for="POWeight"><b>Weight(perKg): *</label>
      <input type = "number" id = "POWeight" name = "POWeight" required width="5px" min = "1" max= "10000">
      <input type = "submit" id = "POAdd" name = "POAdd" value = "Add to table" disable>
  </form>
</div>
<div id="id02">
  <form action="forms_action_page.php" method="post" id = "form2">
        <input type = "submit" id = "GeneratePO" name = "GeneratePO" value = "GeneratePO" disabled>
        <br><br>
        <table id="myTable">
          <tr>    
            <th>S No:</th>    
            <th>!</th>    
            <th>Commodity/Desc</th>
            <th>Size(m)</th>    
            <th>No.of Reel</th>    
            <th>Weight(kg)</th> 
            <th>PerKgRate</th> 
          </tr>

        </table>
  </form>
</div>

<script>

function getcommoditylist() {
  var select = document.getElementById("POCname");
  var numberOfOptions = select.options.length;
  for (let i = 1; i < numberOfOptions; i++) {
  select.remove(1);
    }
  select.selectedIndex = 0;
  //update commodity list
  var supplierstr = document.getElementById("POSname").value;
  var tr = "\"" + supplierstr + "\"";
  for (let i = 1; i < jsArray_2.length; i++) {
    let c = JSON.stringify(jsArray_2[i]);
    let position = c.search(tr);
    let found = (position>0);
    if (found) {
          const myArray = c.split(",");
          let word1 = myArray[1];
          let gsm1 = myArray[3];
          let bf1 = myArray[4];
          const myArray2 = word1.split(":");
          let word2 = myArray2[1];
          let word3 = word2. replaceAll("\"", "");
          const myArray3 = gsm1.split(":");
          let gsm2 = myArray3[1];
          const myArray4 = bf1.split(":");
          let bf2 = myArray4[1];
          var option = document.createElement("option");
          option.text = word3 +"-" + "GSM:" + gsm2 + "-" + "BF:" + bf2;
          option.value = i;
          select.appendChild(option);
          document.getElementById("POSname").disabled = true;
      } else {
      select.selectedIndex = 0;
      }
  }
}

function updateval() {
  var button = document.getElementById("POAdd");
  var selectElement = document.getElementById("POCname");
  var val = (selectElement.options[selectElement.selectedIndex].value);
  updated = (val >= 1);
  if (updated){
    button.disabled = false;
    var c = selectElement.options[selectElement.selectedIndex].text;
    const myArray = c.split("-");
    let word1 = myArray[1];
    let word2 = myArray[2];
    const myArray1 = word1.split(":");
    const myArray2 = word2.split(":");
    document.getElementById("POGSM").value = myArray1[1];
    document.getElementById("POBF").value = myArray2[1];
  } else {
    button.disabled = true;
    document.getElementById("POGSM").value = 0;
    document.getElementById("POBF").value = 0;
  }
}

function addtotable() {
  var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
  var newRow = table.insertRow(table.rows.length);
  const selectElement = document.getElementById("POCname");
  const selectValue= selectElement.options[selectElement.selectedIndex].text;
  const tableindex = parseInt(document.getElementById("tableindex").value);
  const myArray = [tableindex, "", document.getElementById("POSname").value, selectValue, document.getElementById("PRS").value, document.getElementById("PRN").value, document.getElementById("PRW").value, document.getElementById("PRate").value, document.getElementById("PSGST").value, document.getElementById("PCGST").value, document.getElementById("PIGST").value, document.getElementById("PTotal").value];
        for (let i = 0; i < myArray.length; i++) {
        var cell = newRow.insertCell(i);
        cell.innerHTML = myArray[i];
         }
  document.getElementById("tableindex").value= tableindex +1;
  document.getElementById("GeneratePO").disabled = false;
}
function handleSubmit(event) {
  event.preventDefault(); // Prevent default form submission behavior
  const inputField = document.getElementById('inputField');
  console.log("Input value:", inputField.value);
  // Further processing or form submission logic can go here
    }
function exporttoexcel() {
javascript:void(window.open('data:application/vnd.ms-excel,' + encodeURIComponent(document.getElementById('myTable').outerHTML)));
}

function checkDuplicates() {
  var table = document.getElementById("myTable");
  var seen = {};
  var duplicates = [];
  var er = table.rows.length;
   if (er <= 4) { 
     var sr = 0;
       } else {
         sr = er-4;
               }
  // Iterate over each row of the table (starting from index 1 to skip header row)
    for (let i =sr; i < er; i++) {
      var currentRow = table.rows[i];
      var key = currentRow.cells[6].innerText; // Assuming the first cell contains the value to check for duplicates
      // Check if the value is already seen
        if (seen[key]) {
                duplicates.push(key);
                currentRow.cells[1].innerText = "!!Duplicate Entry!!";
        } else {
                seen[key] = true;
        }
      }

    // Display the duplicate values, if any
    if (duplicates.length > 0 && duplicates.length < 3) {
          alert("Duplicate entries found: " + duplicates.join(", "));
        } else { if (duplicates.length <= 0) {
            //alert("No duplicate entries found.");
        } else {
        var currentRow = table.rows[table.rows.length-1];
        currentRow.parentNode.removeChild(currentRow);
        alert("Number of repeated records exceeded.");
        }
            
    }
}

window.addEventListener('beforeunload', function(event) {
  // Cancel the event
  event.preventDefault();
  // Chrome requires returnValue to be set
  event.returnValue = '';
  // Alert the user
  alert("Are you sure you want to leave this page?");
});

document.getElementById('form2').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission
    var table = document.getElementById('myTable');
    var tableData = [];
    // Loop through table rows
    for (var i = 0; i < table.rows.length; i++) {
        var rowData = [];
        var row = table.rows[i];
        // Loop through table cells
        for (var j = 0; j < row.cells.length; j++) {
            var cell = row.cells[j];
            rowData.push(cell.innerText);
        }

        tableData.push(rowData);
    }

    // Set the table data as a JSON string in the hidden input field
    document.getElementById('tableData').value = JSON.stringify(tableData);
    // Submit the form
    this.submit();
});


