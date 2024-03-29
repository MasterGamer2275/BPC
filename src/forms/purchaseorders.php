<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  dbsetup($db, $text);
  $tablename = "TEST_SUPPLIER_4";
  $columnname = "NAME";
  $dbcolvalues = array(array());
  dbgetcolumnname($db, $tablename, $columnname, $dbcolvalues, $text);
  $igstlist = array();
  $columnname = "IGST";
  dbgetcolumnname($db, $tablename, $columnname, $igstlist, $text);
  $tablename = "TEST_COMMODITY_3";
  $dbtabdata = array(array());
  dbreadtable($db, $tablename, $dbtabdata, $text);
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
input[type=number] {
  -moz-appearance: textfield;
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
  max-width: 500px;
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
  font-family: "Source Sans Pro", "sans-serif";
  font-size: 15px;
  background: #f2f2f2;
  text-align: right;
}
.form-container label {
  /* Your general styles for labels */
  font-size: 16px;
  color: #333;
  text-align: left;
}
.form-container select{
  width: 90%;
  padding: auto;
  border: none;
  background: #f2f2f2;
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
width: 18%;
/* width: 120px;*/
height: 20px;
}

</style>
</head>
 
<body>
<div id="id01">
  <form id = "form1">
    <!--addtotable();checkDuplicates();handleSubmit(event);saveTableDataToConsole();-->
    <h3>Generate Purchase Order:</h3>
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
    <input type = "number" id = "PRS" name = "PRS" required width="5px" min = "1" step="0.01" disabled>
    <label for="PRN"><b>No. Of Reels: *</label>
    <input type = "number" id = "PRN" name = "PRN" required width="4px" min = "5" step="1">
    <label for="PRW"><b>Weight (Kg) : *</label>
    <input type = "number" id = "PRW" name = "PRW" required width="4px" min = "1" step=".01">
    <label for="PRate"><b>RatePerKg(Rs.):</label>
    <input type = "number" id = "PRate" name = "PRate" width="5px" min = "0.01" step=".01">
    <br><br>
    <input type = "number" id = "tableindex" name = "tableindex" hidden step="1" value = "1">
    <input type = "button" id = "POAdd" name = "POAdd" value = "Add to Table" disabled onclick="addtotable();checkDuplicates();">
    <br><br>
  </form>
</div>
<div id="id02">
  <form action="forms_action_page.php" method="post" id = "form2">
    <input type="hidden" id="tableData" name="tableData">
    <label for="PSubmit"><b>Verify the below table and click on Generate PO :</label>
    <input type = "submit" id = "POSubmit" name = "POSubmit" value = "Generate PO" disabled><br><br>
    <table id= "myTable">
      <tr>
        <th>S No:</th>
        <th>!</th>
        <th>Date</th>
        <th>SupplierName</th>
        <th>Commodity(Desc)</th>
        <th>ReelSize(Cm)</th>
        <th>No. Of Reels</th>
        <th>Weight(Kg)</th>     
        <th>RatePerKg(Rs.)</th>    
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
    <input type = "number" id = "PRS2" name = "PRS2" hidden>
    <label for="PRN2"><b>No. Of Reels: *</label>
    <input type = "number" id = "PRN2" name = "PRN2" required width="4px" min = "5"step="1"><br>
    <label for="PRW2"><b>Weight(Kg) : *</label>
    <input type = "number" id = "PRW2" name = "PRW2" required width="4px" min = "1" step=".01" ><br>
    <label for="PRate2"><b>RatePerKg(Rs.):</label>
    <input type = "number" id = "PRate2" name = "PRate2" width="5px" min = "0" step=".01" ><br>
    <input type = "button" style="font-size:18px" class = "updatebtn" id = "S2Save2" name = "S2Save2" value = "V" onclick = "edittable('V')">
    <input type = "button" style="font-size:18px" class = "delete" id = "Sdelete2" name = "Sdelete2" value = "Del" onclick = "edittable('Del')">
    <input type = "button" style="font-size:18px" class = "cancel" id = "Scancel2" name = "Scancel2" value = "X" onclick= "closeForm()">
  </form>
</div>
</body>

<script>
document.getElementById("myForm").style.display = "none";
// Get the table element
var table = document.getElementById("myTable");
  
function closeForm() {
    document.getElementById("myForm").style.display = "none";
}

  // Attach a click event listener to the table
table.addEventListener("click", function(event) {
    // Check if the clicked element is a table row
    if (event.target.tagName === "TD") {
      document.getElementById("myForm").style.display = "block";
      // Get the data of the clicked row
      var row = event.target.parentNode; // Get the parent row (<tr>)
      var cells = row.getElementsByTagName("td"); // Get all cells (<td>) in the row
      // Extract the data from 
      var id= cells[0].innerText;
      var warning= cells[1].innerText;
      var date = cells[2].innerText;
      var sname = cells[3].innerText;
      var cname = cells[4].innerText;
      var rs= cells[5].innerText;
      var rn= cells[6].innerText;
      var rw = cells[7].innerText;
      var rate= cells[8].innerText;
      // Set the values of the form fields
      document.getElementById("id2").value = id;
      document.getElementById("Pdate2").value = date;
      document.getElementById("!").value = warning;
      document.getElementById("PSname2").value = sname;
      document.getElementById("PCname2").value = cname;
      document.getElementById("PRS2").value = rs;
      document.getElementById("PRN2").value = rn;
      document.getElementById("PRW2").value = rw;
      document.getElementById("PRate2").value = rate;
      }
  });


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
          document.getElementById("PSname").disabled = true;
      } else {
      select.selectedIndex = 0;
      }
  }
}


function updateval() {
  var button = document.getElementById("POAdd");
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
function addtotable() {
  var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
  var newRow = table.insertRow(table.rows.length);
  const selectElement = document.getElementById("PCname");
  const selectValue= selectElement.options[selectElement.selectedIndex].text;
  const tableindex = parseInt(document.getElementById("tableindex").value);
  const myArray = [tableindex, "", document.getElementById("Pdate").value, document.getElementById("PSname").value, selectValue, document.getElementById("PRS").value, document.getElementById("PRN").value, document.getElementById("PRW").value, document.getElementById("PRate").value];
        for (let i = 0; i < myArray.length; i++) {
        var cell = newRow.insertCell(i);
        cell.innerHTML = myArray[i];
         }
  document.getElementById("tableindex").value= tableindex +1;
  document.getElementById("POSubmit").disabled = false;
}

function edittable(buttonText) {
var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
const rowIndex = (document.getElementById("id2").value);
var row = table.rows[rowIndex];
var cells = row.getElementsByTagName("td");
var edit = (buttonText == "V");
var ddel = (buttonText == "Del");
if (edit) {
  const myArray = [rowIndex, "", document.getElementById("Pdate2").value, document.getElementById("PSname2").value, document.getElementById("PCname2").value, document.getElementById("PRS2").value, document.getElementById("PRN2").value, document.getElementById("PRW2").value, document.getElementById("PRate2").value];
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
