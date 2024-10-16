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
require "/home/app/src/Reset.php";
$dbtabdata = array(array());
dbsetup($db, $text);
$tablename = $_SESSION["StListTabName"];
$companyId = $_SESSION["companyID"];
dbgenfginvrep($db, $tablename, $dbtabdata, $text);
/*
foreach ($dbtabdata as $row) {
   foreach ($row as $cell) {
     echo $cell;
   }
   echo "<br>";
}
*/
dbclose($db, $text);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Finished Goods Stock Inventory:</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 75%;
  border: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
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
  white-space: wrap;
}

th input[type=text] {
width: 50%;
}

tr, td {
  text-align: left;
  padding: 1px;
  font-size: 15px;
  font-weight: normal;
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
  .filter-icon {
    color: #555555;
    cursor: pointer;
    margin-left: 4px;
  }
    .hide {
    display: none;
  }
      .highlighted-text1 {
        color: red;
        font-weight: bold;
    }
        .highlighted-text1::before {
        content: "\2193"; /* Unicode character for a red down arrow */
        display: inline-block;
        margin-right: 5px; /* Adjust spacing between icon and text */
        color: red; /* Color of the arrow */
    }
        .highlighted-text2 {
        color: blue;
        font-weight: bold;
    }
          .highlighted-text3 {
        color: green;
        font-weight: bold;
    }
        .highlighted-text3::before {
        content: "\2191"; /* Unicode character for a red down arrow */
        display: inline-block;
        margin-right: 5px; /* Adjust spacing between icon and text */
        color: green; /* Color of the arrow */
    }
              .highlighted-text4 {
        color: orange;
    }
</style>
<body>
  <h3> Finished Goods Inventory</h3>

  <form action="forms_action_page.php" class="form-container" method="post" enctype="multipart/form-data">
        <input type="hidden" id="fgtableData" name="fgtableData">
        <input type="hidden" id="cName" name="cName">   
        <input type="submit" id="fGSave" value="Save 💾" style="display:none;"><br><br>    
</form>

  <table id="myTable" oninput = "calculate();">
    <tr>
      <td onclick="expandtable()">[+/-]</td>
      <th>Customer Name / Size<br><i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('cnameFilter')"></i>      
        <input type="text" id="typeFilter" class="filter-input" placeholder="Filter by name">
        
      </th>
      <th>OpeningStcok</th>
      <th>Produtcion</th>
      <th>ClosingStock</th>
      <th>Rate (₹)<br><i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('rateFilter')"></i> 
        <input type="text" id="statFilter" class="filter-input" placeholder="Filter by name"></th>
      <th>TotalValue (₹)</th>
      <th>GST (₹)</th>
      <th>💰Stock Value (₹)</th>
    </tr>
    <!-- Table body will be populated dynamically -->
<?php
// Loop through the array to generate table rows
foreach ($dbtabdata as $row) {
    $i = 0;
    $parent = false; // Initialize parent flag
    
    foreach ($row as $cell) {      
        if(!$i) {
            $parent = ($cell != ""); // Check if the cell is a parent
            if ($parent) {
                echo "<tr class=\"parent\"><td onclick=\"hideunhiderows(this);\">[+]</td>";
            } else {
                echo "<tr class=\"child hide\">";
            }               
        }
            if (!$parent) {
                // Making the Opening Stock editable
                if ($i == 2) {
                    echo "<td contenteditable='true' oninput='updateCell(this)'>$cell</td>";
                } else {
                    echo "<td>$cell</td>";
                }
            } else {
                echo "<td>$cell</td>"; // Hide child rows by default
            }
        $i++; // Increment the cell counter
    }
    echo "</tr>";
}
?>
</table>

<script>
function calculate(){
            var table = document.getElementById('myTable');
            const parentRows = table.getElementsByClassName('parent');
            var rows = table.getElementsByTagName('tr');
            var caption = table.getElementsByTagName('caption');
            var totalsum = 0;
            var tableData = [];
            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName('td');
                var resultCell = cells[4]; // Third cell for result (Closing stock)
                var resultCell2 = cells[6]; // Fifth cell for result (Total Value)
                var resultCell3 = cells[7]; // Fifth cell for result (Total GST)
                if (cells.length >= 2) {
                    var value1 = parseInt(cells[2].textContent); // Value from first column (Opening Stock)
                    var value2 = parseInt(cells[3].textContent);// Value from second column (Production Stock)
                    var value3 = parseFloat(cells[5].textContent); // Value from fourth column(Stock Price)
                    if (!isNaN(value1) && !isNaN(value2) && !isNaN(value3)) {
                        resultCell.textContent = value1 + value2; // Multiply values and write to result cell
                        resultCell2.textContent = (resultCell.textContent * value3); // Multiply values and write to result cell
                        resultCell3.textContent = (resultCell.textContent * value3 * 12 / 100);
                        var val = parseFloat((resultCell.textContent * value3) + (resultCell.textContent * value3 * 12 / 100));
                        totalsum += val;
                    var rowData = [];
                    // Loop through table cells
                    for (var j = 0; j < rows[i].cells.length; j++) {
                            var cell = rows[i].cells[j];
                            rowData.push(cell.textContent);
                            }
                    tableData.push(rowData);
                    }
                }
            }
    document.getElementById('fGSave').style.display = "block";
    //var formattedTotalSum = totalsum.toLocaleString();
    //caption[0].textContent = document.getElementById('cName').value + ":-💰Stock Value: ₹" + formattedTotalSum;
    document.getElementById('fgtableData').value = JSON.stringify(tableData);
    //document.getElementById('cName').value = document.getElementById('fG_cName').value;
    }




function expandtable() {
  var table = document.getElementById("myTable");
  var tr = table.getElementsByTagName("tr");
  for (var i = 1; i < tr.length; i++) {
    if (tr[i] && tr[i].classList.contains('parent')){
    var element = tr[i].getElementsByTagName("td")[0];
      var row = tr[i];
      row.style.display = "";
      
    }
    else {
      var row = tr[i];
      if (row.classList.contains('hide')) {
          row.classList.remove('hide');
          element.innerHTML = "[-]";
          } else {
          row.classList.add('hide');
          element.innerHTML = "[+]";
      }
    }
  }
}


function hideunhiderows(element) {
    var iconClass = element.classList;
    var childRow = element.parentElement.nextElementSibling;
    while (childRow && childRow.classList.contains('child')) {
        if (childRow.classList.contains('hide')) {
            childRow.classList.remove('hide');
            element.innerHTML = "[-]";
        } else {
            childRow.classList.add('hide');
            element.innerHTML = "[+]";
        }
        childRow = childRow.nextElementSibling;
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
        var filteredrows = [];
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
                    filteredrows.push(row);
                  } else {
                  row.style.display = "none";
                }
        }
    for (var k = 0; k < filteredrows.length; k++) {
       var child = filteredrows[k].nextElementSibling;
       var element = filteredrows[k].getElementsByTagName("td")[0];
        while (child && child.classList.contains('child')) {
            if (child.classList.contains('hide')) {
                child.classList.remove('hide');
                element.innerHTML = "[-]";
            }
            child.style.display = "";
            child = child.nextElementSibling;
        }
  }
}

    // Attach input event listeners to filter inputs
    var filterInputs = document.getElementsByClassName("filter-input");
    for (var i = 0; i < filterInputs.length; i++) {
        filterInputs[i].addEventListener("input", filterTable);
}

</script>
</body>
</html>