 <?php
// If the request is made from our space preview functionality then turn on PHP error reporting
if (isset($_SERVER['HTTP_X_FORWARDED_URL']) && strpos($_SERVER['HTTP_X_FORWARDED_URL'], '.w3spaces-preview.com/') !== false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  }
?>
<?php
// Assuming you have a database connection established
// Connect to database
$root = $_SERVER['DOCUMENT_ROOT'];
//---add the DB API file
require $root."/DB/call-db.php";
dbsetup($db, $text);
$tablename = $_SESSION["StListTabName"];
$companyId = $_SESSION["companyID"];
$dbtabdata2 = array(array());
dbreadtable($db, $tablename, $dbtabdata2, $text);
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
$dbtabheader = ["StockID", "Date", "InvoiceNo.", "SupplierName", "Commodity", "GSM", "BF","ReelSize", "ReelNo.", "Weight(kg)", "Price(₹)", "SGST(%)", "CGST(%)", "IGST(%)","Total(₹)", "Location", "UsedWeight(Kg)", "Status", "Company ID"];
dbclose($db, $text);
  // Convert the array of objects to a JSON array
  $jsonArray_1 = json_encode($igstlist);
  $jsonArray_2 = json_encode($dbtabdata);
  $jsonArray_3 = json_encode($dbcolvalues);
  //echo '<script>alert("Hello!");</script>';
  // Echo the JSON array
  echo '<script>';
  echo 'var jsArray_1 = ' . $jsonArray_1 . ';';
  echo 'console.log(jsArray_1);'; // Output the array in the browser console
  echo 'var jsArray_2 = ' . $jsonArray_2 . ';';
  echo 'console.log(jsArray_2);'; // Output the array in the browser console
  echo 'var jsArray_3 = ' . $jsonArray_3 . ';';
  echo 'console.log(jsArray_3);'; // Output the array in the browser console
  echo '</script>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Stock Inventory:</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: auto;
  border: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
}
table tr td:nth-child(2),
table tr th:nth-child(2) {
    width: 70px; /* Set your desired width */
}
table tr td:nth-child(4),
table tr th:nth-child(4) {
    width: 385px; /* Set your desired width */
}
table tr td:nth-child(5),
table tr th:nth-child(5) {
    width: 110px; /* Set your desired width */
}

th, td {
  text-align: left;
  padding: 8px;
  font-size: 15px;
  font-weight: bold;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
  position: relative;
  overflow: hidden; /* Optional: hides content that overflows the cell */
  white-space: wrap; /* Corrected value to wrap text */
}

th input[type=text]{
width: 100%;
}

tr, td {
  text-align: left;
  padding: 1px;
  font-size: 15px;
  font-weight: normal;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
  white-space: wrap;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}
/* Hide the fifth column by default */
  th:nth-child(17),
  td:nth-child(17) {
  display: none;
}
/* Hide the fifth column by default */
  th:nth-child(18),
  td:nth-child(18) {
  display: none;
}
/* Hide the fifth column by default */
  th:nth-child(19),
  td:nth-child(19) {
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
  .filter-icon {
    color: #555555;
    cursor: pointer;
    margin-left: 4px;
  }
/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  max-width: 500px;
  width: 320px;
  top: 0px;
  height: auto;
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
  padding: 12px;
  margin: 3px 0 2px 0;
  border: none;
  font-size: 12px;
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

.form-container select{
font-size: 12px;
}
</style>
<body>
  <h3>Edit/View Raw Material Stock:</h3>
  <p id="clickedValueDisplay"></p>
  <table id = "myTable">
  <?php
  echo "<tr>";
  $i = 0;
  foreach ($dbtabheader as $cell) {
        echo "<th>$cell<br>
      <i class=\"fa fa-search\" style=\"font-size:14px;color:grey\" onclick=\"toggleFilter('$i')\"></i>
      <input type=\"text\" id=\"$i\" class=\"filter-input\" placeholder=\"Filter by name\"></th>";
      $i++;
        }      
    echo "</tr>";
  // Loop through the array to generate table rows
  foreach ($dbtabdata2 as $row) {
      echo "<tr>";
      foreach ($row as $cell) {
                echo "<td>$cell</td>";
      }
      echo "</tr>";
  }
  ?>
</table>
<div class="form-popup" id="myForm">
  <form action="forms_action_page.php" class="form-container" method="post" enctype="multipart/form-data">
    <input type = "button" style="font-size:18px" class = "updatebtn" id = "SE2Save2" name = "SE2Save2" value = "V" onclick = "createSubmitevent();">
    <input type = "button" style="font-size:18px" class = "delete" id = "SEdelete2" name = "SEdelete2" value = "Del">
    <input type = "button" style="font-size:18px" class = "cancel" id = "SEcancel2" name = "SEcancel2" value = "X" onclick= "closeForm()"><br>
    <label for="Pdate2"><b>Purchase Date:</label>
    <input type = "date" id = "Pdate2" name = "Pdate2" size="10"  required>    
    <input type = "number" id = "id2" name = "id2" hidden>
    <label for="PInv2"><b>InvNum: *</label>
    <input type = "text" id = "PInv2" name = "PInv2" required width="4px" min = "1"step="1"><br>
    <label for="PSname"><b>Supplier: *</label>
    <select name= = "PSname" id = "PSname"onchange="getcommoditylist();updateval();setformstate();">
    <option value="">Select</option>
      <?php
        // Loop through the array to generate list items
      foreach ($dbcolvalues as $row) {
          foreach ($row as $value) {
            echo "<option value='$value'>$value</option>";
          }
      }
      ?>
    </select><br>
    <input type = "text" id = "PSname2" name = "PSname2" style = "display:none">
    <label for="PCname"><b>Commodity</label>
    <select name="PCname" id="PCname" onchange = "updateval();">
    <option value="">Select</option>
    </select><br>
    <input type = "text" id = "PCname2" name = "PCname2" style = "display:none">
    <label for="PCname3"><b>MaterialType:</label>
    <input type = "text" id="PCname3" name="PCname3" disabled>
    <label for="PGSM2"><b>GSM:</label>
    <input type = "number" id = "PGSM2" disabled><br>
    <label for="PBF2"><b>BF:</label>
    <input type = "number" id = "PBF2" disabled><br>
    <label for="PRS2"><b>ReelSize:</label>
    <input type = "number" id = "PRS2" disabled><br>
    <label for="PRN2"><b>ReelNumber: *</label>
    <input type = "number" id = "PRN2" name = "PRN2" required width="4px" min = "5"step="1"><br>
    <label for="PRW2"><b>RWeight(Kg): *</label>
    <input type = "number" id = "PRW2" name = "PRW2" required width="4px" min = "1" step=".01" onchange="calculatetotal2();" ><br>
    <label for="PRate2"><b>Rate(Rs.):</label>
    <input type = "number" id = "PRate2" name = "PRate2" width="5px" min = "0" step=".01" onchange="calculatetotal2();" ><br>
    <label for="PSGST2"><b>SGST(%):</label>
    <input type = "number" id = "PSGST2" name = "PSGST2" width="2px" min = "0" step=".01" onchange="calculatetotal2();" ><br>
    <label for="PCGST2"><b>CGST(%):</label>
    <input type = "number" id = "PCGST2" name = "PCGST2" width="2px" min = "0" step=".01" onchange="calculatetotal2();" ><br>
    <label for="PIGST2"><b>IGST(%):</label>
    <input type = "number" id = "PIGST2" name = "PIGST2" width="2px" min = "0" step=".01" disabled onchange="calculatetotal2();" ><br>
    <label for="PTotal2"><b>Total(Rs.):</label>
    <input type = "number" id = "PTotal2" name = "PTotal2" width="15px" min = "0" step=".01" disabled><br>
    <input type="hidden" id="sttableData" name="sttableData">
    <label for="PSLoc2"><b>Location:</label>
    <select name= = "PSLoc2" id = "PSLoc2" name = "PSLoc2">
    <option value="">Select</option>
      <?php
        // Loop through the array to generate list items
      foreach ($locationlist as $value) {
            echo "<option value='$value'>$value</option>";
          }
      ?>
    </select>
    <input type = "submit" id = "SE2Save" value = "SE2Save" style="display: none;">

  </form>
</div>
</body>
<script>
  getcommoditylist();
  document.getElementById("myForm").style.display = "none";
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
      var date = cells[1].innerText;
      var invnum = cells[2].innerText;
      var sname = cells[3].innerText.trim();
      var cname = cells[4].innerText.trim();
      var gsm = cells[5].innerText;
      var bf = cells[6].innerText;
      var rs = cells[7].innerText;
      var rn = cells[8].innerText;
      var rw = cells[9].innerText;
      var rate = cells[10].innerText;
      var sgst = cells[11].innerText;
      var cgst = cells[12].innerText;
      var igst = cells[13].innerText;
      var total = cells[14].innerText;
      var location = cells[15].innerText;
      // Set the values of the form fields
      document.getElementById("PCname").value = "";
      document.getElementById("PSname").value = "";
      document.getElementById("id2").value = id;
      document.getElementById("Pdate2").value = date;
      document.getElementById("PInv2").value = invnum;
      document.getElementById("PSname2").value = sname;
      var supselect = document.getElementById("PSname");
      var sindex = -1;
      var soptions = supselect.options;
      for (var i = 0; i < soptions.length; i++) {
          let sstr = soptions[i].text;
          let sposition = sstr.search(sname);
          let srfound = (sposition !== -1); // Check if sname is found in sstr
          if (srfound) {
              sindex = i; // Assign the index to the outer sindex variable
              break;
          }
      }

      // Set the selected index of "PSname" outside the loop
      document.getElementById("PSname").selectedIndex = sindex;
      getcommoditylist();
      var cstr = cname + "-" + "GSM:" + gsm + "-" + "BF:" + bf + "-" + "RS:" + rs;
      var cselect = document.getElementById("PCname");
      var cindex = -1;
      var coptions = cselect.options;
      for (var j = 0; j < coptions.length; j++) {
          let str1 = coptions[j].text;
          let cposition = str1.search(cstr);
          let cfound = (cposition !== -1); // Check if cstr is found in str1
          if (cfound) {
              cindex = j; // Assign the index to the outer cindex variable
              break;
          }
      }
      // Set the selected index of "PCname" outside the loop
      document.getElementById("PCname").selectedIndex = cindex;
      document.getElementById("PCname3").value = cname;
      document.getElementById("PCname2").value = cstr;
      document.getElementById("PGSM2").value = gsm;
      document.getElementById("PBF2").value = bf;   
      document.getElementById("PRS2").value = rs;
      document.getElementById("PRN2").value = rn;
      document.getElementById("PRW2").value = rw;
      document.getElementById("PRate2").value = rate;
      if (sgst == "") var sgst = 0;
      if (cgst == "") var cgst = 0;
      if (igst == "") var igst = 0;
      document.getElementById("PSGST2").value = sgst;
      document.getElementById("PCGST2").value = cgst;
      document.getElementById("PIGST2").value = igst;
      document.getElementById("PTotal2").value = total;
      document.getElementById("PSLoc2").value = location;
      setformstate2();
      }
  });

function createSubmitevent() {
  var data = [document.getElementById("PTotal2").value, document.getElementById("PSLoc2").value, document.getElementById("PSGST2").value, document.getElementById("PCGST2").value, document.getElementById("PIGST2").value, document.getElementById("PCname3").value, document.getElementById("PGSM2").value, document.getElementById("PBF2").value, document.getElementById("PRS2").value];
    // Set the table data as a JSON string in the hidden input field
  document.getElementById('sttableData').value = JSON.stringify(data);
  document.getElementById("SE2Save").value = "SE2Save";
  document.getElementById("SE2Save").click();
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

        // Function to get URL parameter by name
  function getUrlParameter(name) {
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(window.location.href);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

        // Get the clicked value from the URL
        var clickedValue = getUrlParameter('clickedValue');

        // Display the clicked value on the page
        var clickedValueDisplay = document.getElementById('clickedValueDisplay');
        if(clickedValue !== null) {
            //clickedValueDisplay.textContent = "Clicked Value: " + clickedValue;
            let arr = clickedValue.split('-');
            if (arr[0] == 0) {
            let inputField = document.getElementById("2");
            inputField.value = arr[1];
            inputField.dispatchEvent(new Event('input'));
            }
            if (arr[0] == 1) {
            let inputField = document.getElementById("3");
            inputField.value = arr[1];
            inputField.dispatchEvent(new Event('input'));
            }
        } else {
            //clickedValueDisplay.textContent = "No clicked value found in URL.";
    }

function setformstate() {
  document.getElementById("PIGST2").value = 0;
  document.getElementById("PSGST2").value = 0;
  document.getElementById("PCGST2").value = 0;
  var index = document.getElementById("PSname2").selectedIndex;
  // Encode the PHP array to JSON
  str = jsArray_1[index-1];
  var stringData = JSON.stringify(str);
  var contains = stringData.includes("on");
  if (contains) {
  document.getElementById("PIGST2").disabled = false;
  document.getElementById("PSGST2").disabled = true;
  document.getElementById("PCGST2").disabled = true;
    } else {
  document.getElementById("PIGST2").disabled = true;
  document.getElementById("PSGST2").disabled = false;
  document.getElementById("PCGST2").disabled = false;
        }
}
function setformstate2() {
  var index = document.getElementById("PSname2").selectedIndex;
  // Encode the PHP array to JSON
  str = jsArray_1[index-1];
  var stringData = JSON.stringify(str);
  var contains = stringData.includes("on");
  if (contains) {
  document.getElementById("PIGST2").disabled = false;
  document.getElementById("PSGST2").disabled = true;
  document.getElementById("PCGST2").disabled = true;
    } else {
  document.getElementById("PIGST2").disabled = true;
  document.getElementById("PSGST2").disabled = false;
  document.getElementById("PCGST2").disabled = false;
        }
}

function updateval() {
  var selectElement = document.getElementById("PCname");
  var val = (selectElement.options[selectElement.selectedIndex].value);
  updated = (val >= 1);
  if (updated){
    var c = selectElement.options[selectElement.selectedIndex].text;
    document.getElementById("PCname2").value = c;
    const myArray = c.split("-");
    let word = myArray[0];
    let word1 = myArray[1];
    let word2 = myArray[2];
    let word3 = myArray[3];
    const myArray0 = word.split(":");
    const myArray1 = word1.split(":");
    const myArray2 = word2.split(":");
    const myArray3 = word3.split(":");
    document.getElementById("PCname3").value = myArray0[0];
    document.getElementById("PGSM2").value = myArray1[1];
    document.getElementById("PBF2").value = myArray2[1];
    document.getElementById("PRS2").value = myArray3[1];
  } else {
    document.getElementById("PCname3").value = "";
    document.getElementById("PGSM2").value = 0;
    document.getElementById("PBF2").value = 0;
    document.getElementById("PRS2").value = 0;
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
  document.getElementById("PSname2").value = supplierstr;
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
          var str = word3 +"-" + "GSM:" + gsm2 + "-" + "BF:" + bf2 + "-" + "RS:" + rs3;
          option.text = str;
          option.value = i;
          select.appendChild(option);
      } else {
      select.selectedIndex = 0;
      }
  }
}
</script>
</body>
</html>