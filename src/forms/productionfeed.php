<?php
// If the request is made from our space preview functionality then turn on PHP error reporting
if (isset($_SERVER['HTTP_X_FORWARDED_URL']) && strpos($_SERVER['HTTP_X_FORWARDED_URL'], '.w3spaces-preview.com/') !== false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  }
?>
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
  dbcreatestocktable($db, $tablename, $text);
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
  width: 50%;
}
tr:nth-child(even) {
  background-color: #f2f2f2
}

/* Hide the fifth column by default */
  th:nth-child(14),
  td:nth-child(14) {
  display: none;
}

  th:nth-child(3),
  td:nth-child(3) {
    width: 100%;
  }

  th:nth-child(2),
  td:nth-child(2) {
    width: 100%;
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


/* Full-width input fields */
input[type=text], input[type=date], input[type=number]{
  width: 75px;
}

select type1{
width: 16%;
/* width: 120px;*/
height: 20px;
}

select {
width: 12%;
/* width: 120px;*/
height: 20px;
}
.checkbox-custom {
  display: inline-block;
  width: 20px;
  height: 20px;
  background-color: #007bff; /* Default background color */
}

/* Style the checkbox when it's checked */
.checkbox-custom:checked {
  background-color: #007bff; /* Change background color when checked */
}

/* Style the checkbox when it's disabled */
.checkbox-custom:disabled {
  background-color: #007bff; /* Change background color when disabled */
  cursor: not-allowed; /* Change cursor to not-allowed */
}


</style>
</head>
 
<body>
<div id="id01">
  <form action="forms_action_page.php" method="post">
  <h3>Manufacturing Process Control Portal:</h3>
  <label for="Machine"><b>Machine: *</label>
  <select name="Machine" id="Machine" required min = "1">
    <option value="0">Select</option>
      <?php
        // Loop through the array to generate list items
      foreach ($machinelist as $value) {
            echo "<option value=$value>$value</option>";
          }
      ?>
  </select>
  <label for="pRC-P-CName"><b>Client Name: *</label>
  <select name="pRC-P-CName" id="pRC-P-CName" class = "type1" onchange="getsizelist();">
    <option value="0">Select</option>
     <?php
     // Loop through the array to generate list items
      foreach ($dbcolvalues as $row) {
          foreach ($row as $value) {
            echo "<option value=$value>$value</option>";
          }
      }
      ?>
      </select>
  <label for="pRC-P-Size"><b>Size: *</label>
  <select name="pRC-P-Size" id="pRC-P-Size" onchange="updatereelinfo();">
    <option value="0">Select</option>
  </select>          
                 <label for="pRCRN"><b>Reel Number: *</label>
        <select name="pRCRN" id="pRCRN" onchange = "updatereelinfo();calculateval();">
           <option value="0">Select</option>
                 <?php
      foreach ($dbrnvalues as $value) {
            echo "<option value=$value>$value</option>";
          }
      ?>
        </select>
          <label for="pRCMT">Material: *</label>
          <input type = "text" id = "pRCMT" name = "pRCMT" required disabled><br><br>
          <label for="pRC-RM-GSM">GSM: *</label>
          <input type = "number" id = "pRC-RM-GSM" name = "pRC-RM-GSM" required disabled>
          <label for="pRC-RM-RW">ReelWeight(Kg): *</label>
          <input type = "number" id = "pRC-RM-RW" name = "pRC-RM-RW" required disabled>
          <label for="pRC-RM-RS">ReelSize: *</label>
          <input type = "number" id = "pRC-RM-RS" name = "pRC-RM-RS" required disabled>
        <label for="pRC-ReelWidth"><b>Reel Width(cm): *</label>
        <input type = "number" id = "pRC-ReelWidth" name = "pRC-ReelWidth" required min = "1" step = "0.01" onchange = "calculateval();">
        <label for="pRC-ReelLength"><b>Reel Length(cm): *</label>
        <input type = "number" id = "pRC-ReelLength" name = "pRC-ReelLength" required min = "1" step = "0.01" onchange = "calculateval();"><br><br>
        <label for="pRC-Est.WeightPK"><b>Est. Weight(Kg/1000): *</label>
        <input type = "number" id = "pRC-Est.WeightPK" name = "pRC-Est.WeightPK" required min = "1" step = "0.01" disabled>
        <label for="pRC-Est-Prod"><b>Est. Production:</label>
        <input type = "number" id = "pRC-Est-Prod" name = "pRC-Est-Prod" step = "0.01" disabled>
        <label for="pRC-P-Actual"><b>Act. Production:</label>
         <input type = "number" id = "pRC-P-Actual" name = "pRC-P-Actual" step = "1" value = "0" onchange = "calculateval();">
         <label for="pRC-Uw"><b>Used Weight:</label>
         <input type = "number" id = "pRC-Uw" name = "pRC-Uw" disabled><br><br>
        <label for="pRc-Est-Wastage"><b>Est Wastage:</label>
        <input type = "number" id = "pRc-Est-Wastage" name = "pRc-Est-Wastage" required step = "0.01" value = "0" disabled>
        <label for="pRc-Wastage"><b>Act. Wastage:</label>
        <input type = "number" id = "pRc-Wastage" name = "pRc-Wastage" step = "0.01" value = "0" onchange = "calculateval();">
        <input type = "checkbox" id = "pRC-CutReel" name = "pRC-CutReel" hidden>
        <label for="wOStatus"><b>Status:</label>
        <select name="wOStatus" id="wOStatus" required min = "1">
              <option value="0">active</option>
              <option value="1">active(cont.)</option>
              <option value="2">hold</option>
              <option value="3">finished</option>
         </select>

         <input type = "submit" id = "pRC-Add" name = "pRC-Add" value = "Add Record">
<br><br>
<table id = "myTable">
  <tr>
    <th>Job ID<br>
      <input type="text" id="idFilter" class="filter-input" placeholder="Filter by name">
      <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('idFilter')"></i>
      </th>
    <th>Date<br>
      <input type="text" id="dateFilter" class="filter-input" placeholder="Filter by name">
      <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('dateFilter')"></i>
      
      </th>
    <th>Time</th>
    <th style="width: 50%;">Machine<br>
      <input type="text" id="machineFilter" class="filter-input" placeholder="Filter by name">
      <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('machineFilter')"></i>
    </th>
    <th style="width: 50%;">Customer Name<br>
      <input type="text" id="nameFilter" class="filter-input" placeholder="Filter by name">
      <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('nameFilter')"></i>
    </th>
    <th style="width: 50%;">Size<br>
      <input type="text" id="sizeFilter" class="filter-input" placeholder="Filter by name">
      <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('sizeFilter')"></i>
    </th>
    <th>Reel Number<br>
      <input type="text" id="rnFilter" class="filter-input" placeholder="Filter by name">
      <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('rnFilter')"></i>
    </th>
    <th>Reel Width(cm)</th>
    <th>Reel Length(cm)</th>
    <th>Est.Target</th>
    <th>Actual</th>
    <th>UsedWeight(Kg)</th>
    <th>Wastage</th>
    <th>Cut/Excess Reel</th>
    <th style="width: 50%;">Status<br>
      <input type="text" id="statusFilter" class="filter-input" value = "A">
      <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('statusFilter')"></i>
    </th>
    <th>CompanyID</th>
  </tr>
  <?php
  // Loop through the array to generate table rows
  foreach ($dbpdtabdata as $row) {
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


function updatereelinfo(){
var reelsizestr = document.getElementById("pRCRN").value;
document.getElementById("pRCMT").value = "Not Found";
document.getElementById("pRC-RM-GSM").value = "Not Found";
document.getElementById("pRC-RM-RW").value = "Not Found";
document.getElementById("pRC-RM-RS").value = "Not Found";
var tr = "REELNUMBER:" +  reelsizestr + ",";
  for (let i = 1; i < jsArray_1.length; i++) {
    let c = JSON.stringify(jsArray_1[i]);
    let cstr = c.replaceAll("\"", "");
    let position = cstr.search(tr);
    let found = (position>0);
    if (found) {
    const myArray= cstr.split(",");
          let smt1 = myArray[4];
          let sgsm1 = myArray[5];
          let srw1 = myArray[9];
          let sbf1 = myArray[6];
          let srs1 = myArray[7];
          const myArray1= smt1.split(":");
          let mattype1 = myArray1[1];
          const myArray2= sgsm1.split(":");
          let pgsm1 = myArray2[1];
          const myArray3= srw1.split(":");
          let srw2 = myArray3[1];
          let srw3 = srw2.replaceAll("}", "");
          const myArray4 = srs1.split(":");
          let srs2 = myArray4[1];
          const myArray5 = sbf1.split(":");
          let sbf2 = myArray5[1];
    document.getElementById("pRCMT").value = mattype1;
    document.getElementById("pRC-RM-GSM").value = pgsm1;
    document.getElementById("pRC-RM-RW").value = srw3;
    document.getElementById("pRC-RM-RS").value = srs2;
    document.getElementById("pRC-ReelWidth").value = srs2;
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
var fullusedweight = 0;
var uw1 = 0;
var totalestw = ((reelw * reell * gsm)/10000);
document.getElementById("pRC-Est.WeightPK").value = parseFloat(totalestw).toFixed(2);
var estprod = (rw/totalestw) * 1000;
document.getElementById("pRC-Est-Prod").value = parseFloat(estprod).toFixed(2);
var fullusedweight = (act/1000 * totalestw);
var estwaste = rw - fullusedweight;
document.getElementById("pRc-Est-Wastage").value = parseFloat(estwaste).toFixed(2);
var uw = fullusedweight;
document.getElementById("pRC-Uw").value = parseFloat(uw).toFixed(2);
var num1 = parseFloat(uw);
var num2 = parseFloat(document.getElementById('pRc-Wastage').value);
var sum = num1 + num2;
if (rw != sum) {
document.getElementById("pRC-CutReel").checked = true;
} else {
document.getElementById("pRC-CutReel").checked = false;
}
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