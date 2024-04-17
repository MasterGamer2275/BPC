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
  $igstlist = array();
  $columnname = "IGST";
  dbgetcolumnname($db, $tablename, $columnname, $igstlist, $text);
  $tablename = $_SESSION["ComListTabName"];
  $dbtabdata = array(array());
  dbreadtable($db, $tablename, $dbtabdata, $text);
  $tablename = $_SESSION["CoListTabName"];
  $paramname = "ID";
  $paramvalue = "6100";
  $mycompanyvalues = array();
  dbreadrecord($db, $tablename, $paramname, $paramvalue, $mycompanyvalues, $text);
  $tempArray = explode(",\r\n", $mycompanyvalues[15]);
  $templist = json_encode($tempArray );
  $val = str_replace("]", "", $templist);
  $val = str_replace("[", "", $val);
  $val = str_replace("\"", "", $val);
  $locationlist = explode(",", $val);
  dbclose($db, $text);
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
  bottom: 94%;
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
/* Hide the fifth column by default */
  th:nth-child(14),
  td:nth-child(14) {
  display: none;
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
.numeric-input1 {
  -moz-appearance: textfield;
  width: 90px; 
}
.numeric-input2 {
  -moz-appearance: textfield;
  width: 35px; 
}
/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  max-width: 500px;
  width: 320px;
  top: 10px;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
  color: black;
}
/* Add styles to the form container */
.form-container {
  width: 320px;
  padding: 10px;
  background-color: white;
  font: inherit; 
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password], .form-container input[type=email], .form-container input[type=date], .form-container input[type=number]{
  width: 55%;
  height: 0px;
  padding: 15px;
  margin: 5px 0 2px 0;
  border: none;
  font-size: 15px;
  background: #f2f2f2;
  text-align: left;
}
.form-container label {
  /* Your general styles for labels */
  font-size: 16px;
  color: #333;
  text-align: right;
}

.form-container select{
  width: 55%;
  padding: auto;
  margin: 5px 0 2px 0;
  border: none;
  background: #f2f2f2;
  font-size: 15px;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #f2f2f2;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #f2f2f2;
  color: #f2f2f2;
  border: none;
  cursor: pointer;
  margin-bottom:10px;
  opacity: 0.2;
}
/* Add a red background color to the cancel button */
.form-container .updatebtn {
  background-color: #f2f2f2;
  color: Green;
  opacity: 0.7;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: #f2f2f2;
  opacity: 0.5;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
select {
width: 10%;
/* width: 120px;*/
height: 20px;
}

</style>
</head>
 
<body>
<div id="id01">
  <form onsubmit="reorderid();addtotable();checkDuplicates();handleSubmit(event);saveTableDataToConsole();">
    <!--addtotable();checkDuplicates();handleSubmit(event);saveTableDataToConsole();-->
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
    <input type = "text" id = "PGSM" name = "PGSM" required size="3" disabled>
    <label for="PBF"><b>BF: *</label>
    <input type = "text" id = "PBF" name = "PBF" required size="3" disabled>
    <label for="PRS"><b>Reel Size (Cm): *</label>
    <input type = "number" class = "numeric-input1" id = "PRS" name = "PRS" required size="3" min = "1" step="0.01" disabled><br><br>
    <label for="PRN"><b>Reel Number :*</label>
    <input type = "number" class = "numeric-input1" id = "PRN" name = "PRN" required size="7" min = "5" step="1">
    <label for="PRW"><b>Reel Weight (Kg) : *</label>
    <input type = "number" class = "numeric-input1" id = "PRW" name = "PRW" required size="7" min = "1" step=".01" onchange = "calculatetotal()">
    <label for="PRate"><b>Rate(Rs.):</label>
    <input type = "number" class = "numeric-input1" id = "PRate" name = "PRate" size="7" min = "0.01" step=".01" onchange = "calculatetotal()">

    <label for="PSGST"><b>SGST(%):</label>
    <input type = "number" class = "numeric-input2" id = "PSGST" name = "PSGST" size="3" min = "0" value = "0" step=".01" onchange = "calculatetotal()">
    <label for="PCGST"><b>CGST(%):</label>
    <input type = "number" class = "numeric-input2" id = "PCGST" name = "PCGST" size="3" min = "0" value = "0" step=".01" onchange= "calculatetotal()">
    <label for="PIGST"><b>IGST(%):</label>
    <input type = "number" class = "numeric-input2" id = "PIGST" name = "PIGST" size="3" min = "0" value = "0" step=".01" disabled onchange = "calculatetotal()">
        <br><br>
    <label for="PTotal"><b>Total(Rs.):</label>
    <input type = "number" id = "PTotal" name = "PTotal" size="15" min = "1" max= "100000" disabled step=".01">
    <label for="PSLoc"><b>Location: *</label>
    <select name= = "PSLoc" id = "PSLoc">
    <option value="">Select</option>
      <?php
        // Loop through the array to generate list items
      foreach ($locationlist as $value) {
            echo "<option value='$value'>$value</option>";
          }
      ?>
    </select>
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
        <th>GSM</th>
        <th>BF</th>
        <th>ReelSize(Cm)</th>
        <th>ReelNumber</th> 
        <th>ReelWeight(Kg)</th>     
        <th>Rate(Rs.)</th>    
        <th>SGST(%)</th>    
        <th>CGST(%)</th>
        <th>IGST(%)</th> 
        <th>Total(Rs.)</th>
        <th>IGSTDISABLED</th>
        <th>Location</th>
    </tr>
    </table>
  </form>
</div>

<div class="form-popup" id="myForm">
  <form class="form-container" id="form3">
    <label for="Pdate2"><b>Purchase Date: *</label>
    <input type = "date" id = "Pdate2" name = "Pdate2" size="10"  required><br>
    <input type = "number" id = "id2" name = "id2" hidden>
    <label for="!"><b>!:</label>
    <input type = "text" name= "!" id = "!" disabled><br>
    <label for="PSname2"><b>Supplier:</label>
    <input type = "text" name= "PSname2" id = "PSname2" disabled><br>
    <label for="PCname2"><b>Commodity/Desc</label>
    <input type = "text" name="PCname2" id="PCname2" disabled><br>
    <input type = "text" id="PCname3" hidden>
    <input type = "number" id = "PGSM2" hidden>
    <input type = "number" id = "PBF2" hidden>
    <input type = "number" id = "PRS2" hidden>
    <label for="PRN2"><b>Reel Number : *</label>
    <input type = "number" id = "PRN2" name = "PRN2" required width="4px" min = "5"step="1"><br>
    <label for="PRW2"><b>Reel Weight (Kg) : *</label>
    <input type = "number" id = "PRW2" name = "PRW2" required width="4px" min = "1" step=".01" onchange="calculatetotal2()" ><br>
    <label for="PRate2"><b>Rate(Rs.):</label>
    <input type = "number" id = "PRate2" name = "PRate2" width="5px" min = "0" step=".01" onchange="calculatetotal2()" ><br>
    <label for="PSGST2"><b>SGST(%):</label>
    <input type = "number" id = "PSGST2" name = "PSGST2" width="2px" min = "0" step=".01" onchange="calculatetotal2()" ><br>
    <label for="PCGST2"><b>CGST(%):</label>
    <input type = "number" id = "PCGST2" name = "PCGST2" width="2px" min = "0" step=".01" onchange="calculatetotal2()" ><br>
    <label for="PIGST2"><b>IGST(%):</label>
    <input type = "number" id = "PIGST2" name = "PIGST2" width="2px" min = "0" step=".01" disabled onchange="calculatetotal2()" ><br>
    <label for="PTotal2"><b>Total(Rs.):</label>
    <input type = "number" id = "PTotal2" name = "PTotal2" width="15px" min = "0" disabled step=".01"><br>
    <label for="PSLoc2"><b>Location:</label>
    <select name= = "PSLoc2" id = "PSLoc2">
    <option value="">Select</option>
      <?php
        // Loop through the array to generate list items
      foreach ($locationlist as $value) {
            echo "<option value='$value'>$value</option>";
          }
      ?>
    </select><br><br>
    <input type = "button" style="font-size:18px" class = "updatebtn" id = "S2Save2" name = "S2Save2" value = "V" onclick = "edittable('V')">
    <input type = "button" style="font-size:18px" class = "delete" id = "Sdelete2" name = "Sdelete2" value = "Del" onclick = "edittable('Del')">
    <input type = "button" style="font-size:18px" class = "cancel" id = "Scancel2" name = "Scancel2" value = "X" onclick= "closeForm()">
  </form>
</div>
</body>

<script>
  document.getElementById("myForm").style.display = "none";
  /*
  function openForm() {
    document.getElementById("myForm").style.display = "block";
  }
  */
  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }
  // Get the table element
  var table = document.getElementById("myTable");

  // Attach a click event listener to the table
  table.addEventListener("click", function(event) {
    // Check if the clicked element is a table row
    if (event.target.tagName === "TD") {
      document.getElementById("myForm").style.display = "block";
    // Get the data of the clicked row
    var row = event.target.parentNode; // Get the parent row (<tr>)
    // Loop through the rows of the table
      var cells = row.getElementsByTagName("td"); // Get all cells (<td>) in the row
      // Extract the data from cells
      var id = cells[0].innerText;
      var warning= cells[1].innerText;
      var date = cells[2].innerText;
      var sname = cells[3].innerText;
      var cname = cells[4].innerText;
      const myArray = cname.split("-");
      var gsm = cells[5].innerText;
      var bf = cells[6].innerText;
      var rs= cells[7].innerText;
      var rn= cells[8].innerText;
      var rw = cells[9].innerText;
      var rate= cells[10].innerText;
      var sgst = cells[11].innerText;
      var cgst = cells[12].innerText;
      var igst = cells[13].innerText;
      var total = cells[14].innerText;
      var igstdisabled = cells[15].innerText.trim();
      var location = cells[16].innerText;
      // Set the values of the form fields
      document.getElementById("id2").value = id;
      document.getElementById("Pdate2").value = date;
      document.getElementById("!").value = warning;
      document.getElementById("PSname2").value = sname;
		  document.getElementById("PCname2").value = myArray[0] +"-" + "GSM:" + gsm + "-" + "BF:" + bf + "-" + "RS:" + rs;
      document.getElementById("PCname3").value = myArray[0];
      document.getElementById("PGSM2").value = gsm;
      document.getElementById("PBF2").value = bf;   
      document.getElementById("PRS2").value = rs;
      document.getElementById("PRN2").value = rn;
      document.getElementById("PRW2").value = rw;
      document.getElementById("PRate2").value = rate;
      document.getElementById("PSGST2").value = sgst;
      document.getElementById("PCGST2").value = cgst;
      document.getElementById("PIGST2").value = igst;
      document.getElementById("PTotal2").value = total;
      document.getElementById("PSLoc2").value = location;
      if (igstdisabled) {
      document.getElementById("PIGST2").disabled = true;
      document.getElementById("PCGST2").disabled = false;
      document.getElementById("PSGST2").disabled = false;
      } else {
      document.getElementById("PIGST2").disabled = false;
      document.getElementById("PCGST2").disabled = true;
      document.getElementById("PSGST2").disabled = true;
      }
      }
  });

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
          let rs1 = myArray[6];
          const myArray2 = word1.split(":");
          let word2 = myArray2[1];
          let word3 = word2. replaceAll("\"", "");
          const myArray3 = gsm1.split(":");
          let gsm2 = myArray3[1];
          const myArray4 = bf1.split(":");
          let bf2 = myArray4[1];
          const myArray5 = rs1.split(":");
          let rs2 = myArray5[1];
          let rs3 = rs2. replaceAll("}", "");
          var option = document.createElement("option");
          option.text = word3 +"-" + "GSM:" + gsm2 + "-" + "BF:" + bf2 + "-" + "RS:" + rs3;
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
  total= (rweight * rate) * taxsum + (rweight * rate);
  document.getElementById("PTotal").value = parseFloat(total).toFixed(2);
}

function calculatetotal2() {
  t1 = document.getElementById("PIGST2").value;
  t2 = document.getElementById("PSGST2").value;
  t3 = document.getElementById("PCGST2").value;
  rsize = document.getElementById("PRS2").value;
  rweight = document.getElementById("PRW2").value;
  rate = document.getElementById("PRate2").value;
  taxsum = 0;
  taxsum = (parseInt(t1) + parseInt(t2)+ parseInt(t3)) /100;
  total= (rweight * rate) * taxsum + (rweight * rate);
  document.getElementById("PTotal2").value = parseFloat(total).toFixed(2);
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
    let word3 = myArray[3];
    const myArray1 = word1.split(":");
    const myArray2 = word2.split(":");
    const myArray3 = word3.split(":");
    document.getElementById("PGSM").value = myArray1[1];
    document.getElementById("PBF").value = myArray2[1];
    document.getElementById("PRS").value = myArray3[1];
  } else {
    button.disabled = true;
    document.getElementById("PGSM").value = 0;
    document.getElementById("PBF").value = 0;
    document.getElementById("PRS").value = 0;
  }
}
function reorderid() {
  var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
  var rows = table.getElementsByTagName("tr");
    for (var i = 1; i < rows.length; i++) {
      var cells = rows[i].getElementsByTagName("td");
      cells[0].innerText = i;
    }
}

function addtotable() {
  var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
  var newRowId = table.rows.length;
  var newRow = table.insertRow(table.rows.length);
  const selectElement = document.getElementById("PCname");
  var selectValue= selectElement.options[selectElement.selectedIndex].text;
  const myArray1 = selectValue.split("-");
  const myArray = [newRowId, "", document.getElementById("Pdate").value, document.getElementById("PSname").value, myArray1[0], document.getElementById("PGSM").value, document.getElementById("PBF").value, document.getElementById("PRS").value, document.getElementById("PRN").value, document.getElementById("PRW").value, document.getElementById("PRate").value, document.getElementById("PSGST").value, document.getElementById("PCGST").value, document.getElementById("PIGST").value, document.getElementById("PTotal").value, document.getElementById("PIGST").disabled, document.getElementById("PSLoc").value];
        for (let i = 0; i < myArray.length; i++) {
        var cell = newRow.insertCell(i);
        cell.innerHTML = myArray[i];
         }
  document.getElementById("PSubmit").disabled = false;
}

function edittable(buttonText) {
var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
var id2 = document.getElementById("id2").value;
var columnValues = [];
var rowIndex = -1;
var rows = table.getElementsByTagName("tr");
    for (var i = 1; i < rows.length; i++) {
      var cells = rows[i].getElementsByTagName("td");
      if (cells[0].innerText == id2) {
        rowIndex = i;
      }
    }
var row = table.rows[rowIndex];
var cells = row.getElementsByTagName("td");
var edit = (buttonText == "V");
var ddel = (buttonText == "Del");
if (edit) {
  const myArray = [id2, "", document.getElementById("Pdate2").value, document.getElementById("PSname2").value, document.getElementById("PCname3").value, document.getElementById("PGSM2").value, document.getElementById("PBF2").value, document.getElementById("PRS2").value, document.getElementById("PRN2").value, document.getElementById("PRW2").value, document.getElementById("PRate2").value, document.getElementById("PSGST2").value, document.getElementById("PCGST2").value, document.getElementById("PIGST2").value, document.getElementById("PTotal2").value, document.getElementById("PIGST2").disabled, document.getElementById("PSLoc2").value];
        for (let i = 0; i < myArray.length; i++) {
        cells[i].innerHTML = myArray[i];
         }
         }else { if (ddel) {
                   table.deleteRow(rowIndex);
                }
}
checkDuplicates();
closeForm();
}


function handleSubmit(event) {
  event.preventDefault(); // Prevent default form submission behavior
  const inputField = document.getElementById('inputField');
  console.log("Input value:", inputField.value);
  // Further processing or form submission logic can go here
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
      var key = currentRow.cells[8].innerText; // Assuming the first cell contains the value to check for duplicates
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
