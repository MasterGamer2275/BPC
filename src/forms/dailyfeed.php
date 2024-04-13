<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  dbsetup($db, $text);
  $tablename = $_SESSION["ClListTabName"];
  $columnname = "NAME";
  $dbcolvalues = array(array());
  dbgetcolumnname($db, $tablename, $columnname, $dbcolvalues, $text);
  $tablename = $_SESSION["PListTabName"];
  $dbtabdata = array(array());
  dbreadtable($db, $tablename, $dbtabdata, $text);
  $tablename = $_SESSION["CoListTabName"];
  $paramname = "ID";
  $paramvalue = "6100";
  $mycompanyvalues = array();
  dbreadrecord($db, $tablename, $paramname, $paramvalue, $mycompanyvalues, $text);
  $tempArray = explode(",\r\n", $mycompanyvalues[14]);
  $templist = json_encode($tempArray );
  $val = str_replace("]", "", $templist);
  $val = str_replace("[", "", $val);
  $val = str_replace("\"", "", $val);
  $machinelist = explode(",", $val);
  //add filter by unfinished stock.
  $tablename = $_SESSION["StListTabName"];
  $dbrnvalues = array();
  $columnname = "REELNUMBER";
  dblistuniquecolvalues($db, $tablename, $columnname, $dbrnvalues, $text);
  $dbtabdata2 = array(array());
  dbreadstocktable($db, $tablename, $dbtabdata2, $text);
  dbclose($db, $text);
  // Convert the array of objects to a JSON array
  $jsonArray_1 = json_encode($dbtabdata2);
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
width: 10%;
/* width: 120px;*/
height: 20px;
}

</style>
</head>
 
<body>
<div id="id01">
  <form onsubmit="reorderid();addtotable();checkDuplicates();handleSubmit(event);saveTableDataToConsole();">
  <h3>Manufacturing Process Control Portal:</h3>
  <label for="Machine"><b>Machine: *</label>
  <select name="Machine" id="Machine" required min = "1">
    <option value="0">Select</option>
      <?php
        // Loop through the array to generate list items
      foreach ($machinelist as $value) {
            echo "<option value='$value'>$value</option>";
          }
      ?>
  </select>
  <label for="pRC-P-CName"><b>Client Name: *</label>
  <select name="pRC-P-CName" id="pRC-P-CName" onchange="getsizelist();">
    <option value="0">Select</option>
     <?php
     // Loop through the array to generate list items
      foreach ($dbcolvalues as $row) {
          foreach ($row as $value) {
            echo "<option value='$value'>$value</option>";
          }
      }
      ?>
  <label for="pRC-P-Size"><b>Size: *</label>
  <select name="pRC-P-Size" id="pRC-P-Size" onchange="updateval();">
    <option value="0">Select</option>
  </select>
          <label for="pRCMT"><b>   </label>
          <label for="pRCMT">Material: *</label>
          <input type = "text" id = "pRCMT" name = "pRCMT" required disabled>
          <label for="pRC-RM-GSM">GSM: *</label>
          <input type = "number" id = "pRC-RM-GSM" name = "pRC-RM-GSM" required disabled>
          <label for="pRC-RM-RW">ReelWeight(Kg): *</label>
          <input type = "number" id = "pRC-RM-RW" name = "pRC-RM-RW" required disabled>
          <label for="pRC-RM-RS">ReelSize: *</label>
          <input type = "number" id = "pRC-RM-RS" name = "pRC-RM-RS" required disabled>
        <label for="pRC-ReelWidth"><b>Reel Width(cm): *</label>
        <input type = "number" id = "pRC-ReelWidth" name = "pRC-ReelWidth" required min = "1" step = "0.01" onchange = "calculateval();">
        <label for="pRC-ReelLength"><b>Reel Length(cm): *</label>
        <input type = "number" id = "pRC-ReelLength" name = "pRC-ReelLength" required min = "1" step = "0.01" onchange = "calculateval();">
        <label for="pRC-Est.WeightPK"><b>Estimated Weight(Kg/1000): *</label>
        <input type = "number" id = "pRC-TotalWeight" name = "pRC-TotalWeight" required min = "1" step = "0.01" disabled>
                <label for="pRc-Wastage"><b>Wastage:</label>
        <input type = "number" id = "pRc-Wastage" name = "pRc-Wastage" required step = "0.01" onchange = "calculateval();">
                <label for="pRC-UsedW"><b>Used Reel Weight:</label>
        <input type = "number" id = "pRC-UsedW" name = "pRC-UsedW" step = "0.01" disabled>
        <label for="pRC-Est-ProdW"><b>Estimated Production:</label>
        <input type = "number" id = "pRC-Est-ProdW" name = "pRC-Est-ProdW" step = "0.01" disabled>
        <label for="pRC-Act-Prod"><b>Actual Production: </label>
        <input type = "number" id = "pRC-Act-Prod" name = "pRC-Act-Prod" step = "0.01" disabled>
        <label for="pRC-PerCLoss"><b>PerCoverLoss:</label>
        <input type = "number" id = "pRC-PerCLoss" name = "pRC-PerCLoss" step = "0.01" disabled>
        <label for="pRC-ExtraWaste"><b>Extra Watse:</label>
        <input type = "number" id = "pRC-ExtraWaste" name = "pRC-ExtraWaste" step = "0.01" disabled>
        <label for="pRC-TotalWaste"><b>Total Waste:</label>
        <input type = "number" id = "pRC-TotalWaste" name = "pRC-TotalWaste" step = "0.01" disabled>
        <select name="wOStatus" id="wOStatus" required min = "1">
              <option value="0">Select</option>
              <option value="1">Not Started</option>
              <option value="2">In Milling</option>
              <option value="3">Hold</option>
              <option value="4">Finished/Close</option>
         </select>
         <label for="pRC-P-Actual"><b>Actual Production:</label>
         <input type = "number" id = "pRC-P-Actual" name = "pRC-P-Actual" required min = "1" step = "1" onchange = "calculateval();">
         <input type = "submit" id = "CAdd" name = "CAdd" value = "Add Record">
<br><br>
<table id = "myTable">
  <tr>
    <th>Job ID</th>
    <th>Machine<br>
      <input type="text" id="machineFilter" class="filter-input" placeholder="Filter by name">
      <i class="filter-icon fas fa-filter" onclick="toggleFilter('machineFilter')"></i>
    </th>
    <th>Customer Name<br>
      <input type="text" id="nameFilter" class="filter-input" placeholder="Filter by name">
      <i class="filter-icon fas fa-filter" onclick="toggleFilter('nameFilter')"></i>
    </th>
    <th>Size<br>
      <input type="text" id="sizeFilter" class="filter-input" placeholder="Filter by name">
      <i class="filter-icon fas fa-filter" onclick="toggleFilter('sizeFilter')"></i>
    </th>
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

 function getsizelist() {
  var select = document.getElementById("pRC-P-Size");
  var numberOfOptions = select.options.length;
  for (let i = 1; i < numberOfOptions; i++) {
  select.remove(1);
    }
  select.selectedIndex = 0;
  //update size list
  var clnamestr = document.getElementById("pRC-P-CName").value;
  var tr = "\"" + clnamestr + "\"";
  for (let i = 1; i < jsArray_2.length; i++) {
    let c = JSON.stringify(jsArray_2[i]);
    let position = c.search(tr);
    let found = (position>0);
    if (found) {
          const myArray = c.split(",");
          let s1= myArray[6];
          const myArray3 = s1.split(":");
          let s2 = myArray3[1];
          let s3 = s2.replaceAll("\"", "");
          var option = document.createElement("option");
          option.text = s3;
          option.value = s3;
          select.appendChild(option);
      } else {
      select.selectedIndex = 0;
      }
  }
}

function updateval() {
var sizestr = document.getElementById("pRC-P-Size").value;
document.getElementById("pR-P-CUnit").value = "Not Found";
document.getElementById("pR-P-CGSM").value = "Not Found";
var tr = "\"SIZE\":" + "\"" + sizestr + "\"";
  for (let i = 1; i < jsArray_2.length; i++) {
    let c = JSON.stringify(jsArray_2[i]);
    let position = c.search(tr);
    let found = (position>0);
    if (found) {
          const myArray = c.split(",");
          let su1 = myArray[7];
          let sgsm1 = myArray[5];
          const myArray4 = su1.split(":");
          let su2 = myArray4[1];
          let su3 = su2.replaceAll("\"", "");
          const myArray5 = sgsm1.split(":");
          let sgsm2 = myArray5[1];
          let sgsm3 = sgsm2.replaceAll("\"", "");
          document.getElementById("pR-P-CUnit").value = su3;
          document.getElementById("pR-P-CGSM").value = sgsm3;
      }
  }
}
function updatereelinfo(){
var reelsizestr = document.getElementById("pRCRN").value;
document.getElementById("pRCMT").value = "Not Found";
document.getElementById("pRC-RM-GSM").value = "Not Found";
document.getElementById("pRC-RM-RW").value = "Not Found";
document.getElementById("pRC-RM-RS").value = "Not Found";
var tr = "REELNUMBER:" +  reelsizestr;
  for (let i = 1; i < jsArray_1.length; i++) {
    let c = JSON.stringify(jsArray_1[i]);
    let cstr = c.replaceAll("\"", "");
    let position = cstr.search(tr);
    let found = (position>0);
    if (found) {
          const myArray = c.split(",");
          let sd1 = myArray[4];
          let srw1 = myArray[6];
          let sd3 = sd1.replaceAll("\"", "");
          const myArray6 = sd3.split("-");
          let mattype1 = myArray6[0];
          let mattype2 = mattype1.split(":");
          let mattype3 = mattype2[1];
          let pgsm1 = myArray6[1];
          let pgsm2 = pgsm1.split(":");
          let pgsm3 = pgsm2[1];
          let srs1 = myArray6[3];
          let srs2 = srs1.split(":");
          let srs3 = srs2[1];
          const myArray5 = srw1.split(":");
          let srw2 = myArray5[1];
          let srw3 = srw2.replaceAll("\"", "");
          document.getElementById("pRCMT").value = mattype3;
          document.getElementById("pRC-RM-GSM").value = pgsm3;
          document.getElementById("pRC-RM-RW").value = srw3;
          document.getElementById("pRC-RM-RS").value = srs3;
      }
  }

}

function calculateval() {
var reelw = document.getElementById("pRC-ReelWidth").value;
var reell = document.getElementById("pRC-ReelLength").value;
var waste = document.getElementById("pRc-Wastage").value;
var gsm = document.getElementById("pRC-RM-GSM").value;
var rw = document.getElementById("pRC-RM-RW").value;
var act = document.getElementById("pRC-P-Actual").value;
var totalestw = ((reelw * reell * gsm)/10000);
document.getElementById("pRC-TotalWeight").value = parseFloat(totalestw).toFixed(2);
var usedweight = rw-waste;
document.getElementById("pRC-UsedW").value = parseFloat(usedweight).toFixed(2);
var estprod = (usedweight/totalestw) * 1000;
document.getElementById("pRC-Est-ProdW").value = parseFloat(estprod).toFixed(2);
var actprod = act - estprod;
document.getElementById("pRC-Act-Prod").value = parseFloat(actprod).toFixed(2);
var pcloss = totalestw/1000;
document.getElementById("pRC-PerCLoss").value = parseFloat(pcloss).toFixed(2);
var exwaste = (pcloss * actprod);
document.getElementById("pRC-ExtraWaste").value = parseFloat(exwaste).toFixed(2);
var totalwaste = waste - exwaste;
document.getElementById("pRC-TotalWaste").value = parseFloat(totalwaste).toFixed(2);

}

    function toggleFilter(inputId) {
        var input = document.getElementById(inputId);
        input.classList.toggle("active");
        if (input.classList.contains("active")) {
            input.focus();
        } else {
            input.value = "";
            filterTable();
        }
    }

    function filterTable() {
        var filterInputs = document.getElementsByClassName("filter-input");
        var table = document.getElementById("myTable");
        var tr = table.getElementsByTagName("tr");

        // Loop through all rows
        for (var i = 0; i < tr.length; i++) {
            var row = tr[i];
            var display = true;

            // Loop through all filter inputs
            for (var j = 0; j < filterInputs.length; j++) {
                var filterInput = filterInputs[j];
                var columnIndex = filterInput.parentElement.cellIndex;
                var filterValue = filterInput.value.toUpperCase();
                var cell = row.getElementsByTagName("td")[columnIndex];
                if (cell) {
                    var cellValue = cell.textContent || cell.innerText;
                    if (cellValue.toUpperCase().indexOf(filterValue) === -1) {
                        display = false;
                        break;
                    }
                }
            }

            // Set display style for row
            if (display) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        }
    }

    // Attach input event listeners to filter inputs
    var filterInputs = document.getElementsByClassName("filter-input");
    for (var i = 0; i < filterInputs.length; i++) {
        filterInputs[i].addEventListener("input", filterTable);
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
  const selectValue= selectElement.options[selectElement.selectedIndex].text;
  const myArray = [newRowId, "", document.getElementById("Pdate").value, document.getElementById("PSname").value, selectValue, document.getElementById("PRS").value, document.getElementById("PRN").value, document.getElementById("PRW").value, document.getElementById("PRate").value, document.getElementById("PSGST").value, document.getElementById("PCGST").value, document.getElementById("PIGST").value, document.getElementById("PTotal").value, document.getElementById("PIGST").disabled, document.getElementById("PSLoc").value];
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
  const myArray = [id2, "", document.getElementById("Pdate2").value, document.getElementById("PSname2").value, document.getElementById("PCname2").value, document.getElementById("PRS2").value, document.getElementById("PRN2").value, document.getElementById("PRW2").value, document.getElementById("PRate2").value, document.getElementById("PSGST2").value, document.getElementById("PCGST2").value, document.getElementById("PIGST2").value, document.getElementById("PTotal2").value, document.getElementById("PIGST2").disabled, document.getElementById("PSLoc2").value];
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
</html> 