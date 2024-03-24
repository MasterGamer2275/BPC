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
  $igstlist = array();
  $columnname = "IGST";
  dbgetcolumnname($db, $tablename, $columnname, $igstlist);
  $tablename = "TEST_COMMODITY_3";
  $dbtabdata = array(array());
  dbreadtable($db, $tablename, $dbtabdata);
  dbclose($db);
  // Convert the array of objects to a JSON array
  $jsonArray_1 = json_encode($igstlist);
  $jsonArray_2 = json_encode($dbtabdata);
  // Echo the JSON array
  echo '<script>';
  echo 'var jsArray_1 = ' . $jsonArray_1 . ';';
  echo 'console.log(jsArray_1);'; // Output the array in the browser console
  echo 'var jsArray_2 = ' . $jsonArray_2 . ';';
  echo 'console.log(jsArray_2);'; // Output the array in the browser console
  echo '</script>';
?>
 
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
button {
  padding: 1px 6px 1px 6px;
  position: absolute;
  left: 90%;
  bottom: 46.5%;
}
button img {
  width: 22px;
  height: 22px;
}

button > img,
button > span {
  vertical-align: middle;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
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
tr > img {
        width: 20px; /* Adjust the width as needed */
        height: 20px; /* Maintain aspect ratio */
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
width: 18%;
/* width: 120px;*/
height: 20px;
}

</style>
</head>
 
<body>
<div id="id01">
  <form onsubmit="addtotable();checkDuplicates();handleSubmit(event);saveTableDataToConsole();">
    <h3>Stock Feed:</h3>
    <label for="Pdate"><b>Purchase Date:</label>
    <input type = "date" id = "Pdate" name = "Pdate" size="0" value="<?php echo date('Y-m-d'); ?>" required>
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
    <label for="PCname"><b>Commodity</label>
    <select name="PCname" id="PCname" onchange = "updateval();">
    <option value="">Select</option>
    </select>
    <label for="PGSM"><b>GSM: *</label>
    <input type = "text" id = "PGSM" name = "PGSM" required size="5" disabled>
    <label for="PBF"><b>BF: *</label>
    <input type = "text" id = "PBF" name = "PBF" required size="5" disabled><br><br>
    <label for="PRS"><b>Reel Size (Cm): *</label>
    <input type = "number" id = "PRS" name = "PRS" required width="5px" min = "1" max= "1000" step="0.01">
    <label for="PRN"><b>Reel Number :*</label>
    <input type = "number" id = "PRN" name = "PRN" required width="4px" min = "5" max= "9999999" step="1">
    <label for="PRW"><b>Reel Weight (Kg) : *</label>
    <input type = "number" id = "PRW" name = "PRW" required width="4px" min = "1" max= "500" step=".01" onchange = "calculatetotal()">
    <label for="PRate"><b>Rate(Rs.): *</label>
    <input type = "number" id = "PRate" name = "PRate" required width="5px" min = "0.01" max= "200" step=".01" onchange = "calculatetotal()">
    <br><br>
    <label for="PSGST"><b>SGST(%): *</label>
    <input type = "number" id = "PSGST" name = "PSGST" required width="2px" min = "0" max= "15" value = "0" step=".01" onchange = "calculatetotal()">
    <label for="PCGST"><b>CGST(%): *</label>
    <input type = "number" id = "PCGST" name = "PCGST" required width="2px" min = "0" max= "15" value = "0" step=".01" onchange= "calculatetotal()">
    <label for="PIGST"><b>IGST(%): *</label>
    <input type = "number" id = "PIGST" name = "PIGST" required width="2px" min = "0" max= "15" value = "0" step=".01" disabled onchange = "calculatetotal()">
    <label for="PTotal"><b>Total(Rs.): *</label>
    <input type = "number" id = "PTotal" name = "PTotal" required width="15px" min = "1" max= "100000" disabled step=".01">
    <input type = "number" id = "tableindex" name = "tableindex" hidden step="1" value = "1">
    <input type = "submit" id = "PAdd" name = "PAdd" value = "Add to Table" disabled>
    <br><br>
  </form>
</div>
<div id="id02">
  <form action="forms_action_page.php" method="post" id = "form2">
    <label for="PSInumber"><b>Enter Supplier Invoice Number for Reference : *</label>
    <input type = "text" id = "PSInumber" name = "PSInumber" maxlength = "50" size = "52" required><br><br>
    <input type="hidden" id="tableData" name="tableData">
    <label for="PSubmit"><b>Verify the below table and click on Save Record to log the stock data in to the MES system : </label>
    <input type = "submit" id = "PSubmit" name = "PSubmit" value = "Save Record" disabled><br><br>
    <table id= "myTable">
      <tr>
        <th>S No:</th>
        <th>!</th>
        <th>Date</th>
        <th>SupplierName</th>
        <th>Commodity(Desc)</th>
        <th>ReelSize(Cm)</th>
        <th>ReelNumber</th> 
        <th>ReelWeight(Kg)</th>     
        <th>Rate(Rs.)</th>    
        <th>SGST(%)</th>    
        <th>CGST(%)</th>  
        <th>IGST(%)</th>   
        <th>Total(Rs.)</th>
    </tr>
    </table>
  </form>
</div>
<div id="id03">
    <form action="#">
      <button id = "PExpEx" name = "PExpEx" onclick = "exporttoexcel();handleSubmit(event);">
        <span>Export to</span>
        <img src="/icons/icons8-excel-48.png" alt="excelpng" />
      </button>
    </form>
</div>

</body>

<script>
function setformstate() {
  document.getElementById("PIGST").value = 0;
  document.getElementById("PSGST").value = 0;
  document.getElementById("PCGST").value = 0;
  var index = document.getElementById("PSname").selectedIndex;
  // Encode the PHP array to JSON
  str = jsArray_1[index-1];
  var stringData = JSON.stringify(str);
  var contains = stringData.includes("on");
  if (contains) {
  document.getElementById("PIGST").disabled = false;
  document.getElementById("PSGST").disabled = true;
  document.getElementById("PCGST").disabled = true;
    } else {
  document.getElementById("PIGST").disabled = true;
  document.getElementById("PSGST").disabled = false;
  document.getElementById("PCGST").disabled = false;
        }
}


function getcommoditylist() {
  var select = document.getElementById("PCname");
  var numberOfOptions = select.options.length;
  for (let i = 1; i < numberOfOptions; i++) {
  select.remove(1);
    }
  select.selectedIndex = 0;
  //update commodity list
  var supplierstr = document.getElementById("PSname").value;
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
      } else {
      select.selectedIndex = 0;
      }
  }
}


function calculatetotal() {
  t1 = document.getElementById("PIGST").value;
  t2 = document.getElementById("PSGST").value;
  t3 = document.getElementById("PCGST").value;
  rsize = document.getElementById("PRS").value;
  rweight = document.getElementById("PRW").value;
  rate = document.getElementById("PRate").value;
  taxsum = 0;
  taxsum = (parseInt(t1) + parseInt(t2)+ parseInt(t3)) /100;
  document.getElementById("PTotal").value = (rweight * rate) + taxsum;
}
function updateval() {
  var button = document.getElementById("PAdd");
  var selectElement = document.getElementById("PCname");
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
    document.getElementById("PGSM").value = myArray1[1];
    document.getElementById("PBF").value = myArray2[1];
  } else {
    button.disabled = true;
    document.getElementById("PGSM").value = 0;
    document.getElementById("PBF").value = 0;
  }
}
function addtotable() {
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
  document.getElementById("PSubmit").disabled = false;
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

</script>

</body>
</html>
