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
$dbtabdata = array(array());
dbsetup($db, $text);
$tablename = $_SESSION["StListTabName"];
$companyId = $_SESSION["companyID"];
dbgeninvrep($db, $tablename, $dbtabdata, $text);
dbclose($db, $text);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Stock Statistics:</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
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
  padding: 8px;
  font-size: 15px;
  font-weight: bold;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
  position: relative;
  overflow: hidden; /* Optional: hides content that overflows the cell */
  white-space: nowrap;
}

tr, td {
  text-align: left;
  padding: 16px;
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
</style>
<body>
  <h2>Stock Inventory</h2>
  <table id="myTable">
    <tr>
      <th>Commodity/Desc<br>      
        <input type="text" id="typeFilter" class="filter-input" placeholder="Filter by name">
        <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('typeFilter')"></i>
      </th>
      <th>GSM<br>      
        <input type="text" id="gsmFilter" class="filter-input" placeholder="Filter by name">
        <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('gsmFilter')"></i>
      </th>
      <th>BF<br>      
        <input type="text" id="bfFilter" class="filter-input" placeholder="Filter by name">
        <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('bfFilter')"></i>
      </th>
      <th>ReelSize(Cm)<br>      
        <input type="text" id="szFilter" class="filter-input" placeholder="Filter by name">
        <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('szFilter')"></i>
      </th>
      <th>Num of Reels/ReelNo.<br>      
        <input type="text" id="numFilter" class="filter-input" placeholder="Filter by name">
        <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('numFilter')"></i>
      </th>
      <th>TotalWeight(kg)/Weight<br>      
        <input type="text" id="kgFilter" class="filter-input" placeholder="Filter by name">
        <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('kgFilter')"></i>
      </th>
      <th>Location<br>      
        <input type="text" id="locFilter" class="filter-input" placeholder="Filter by name">
        <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('locFilter')"></i>
      </th>
      <th>Status<br>      
        <input type="text" id="statFilter" class="filter-input" placeholder="Filter by name">
        <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('statFilter')"></i>
      </th>
    </tr>
    <!-- Table body will be populated dynamically -->
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

<script>
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
</script>
</body>
</html>