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
  dbclose($db, $text);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Finished Goods:</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

tr, td {
  text-align: left;
  padding: 1px;
  font-size: 15px;
  font-weight: normal;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
  white-space: wrap;
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

tr:nth-child(even) {
  background-color: #f2f2f2
}

/* Optional: Add some margin to the input for spacing */
#fGSave {
  margin-top: 10px; /* Adjust as needed */
  position: absolute;
  display: none;
}
</style>
<h3>FinishedGoods Feed:</h3>
        <label for="fG_cName"><b>Customer Name:</label>
        <select name="fG_cName" id="fG_cName">
        <option value="0">Select</option>
            <?php
            // Loop through the array to generate list items
                foreach ($dbcolvalues as $row) {
                    foreach ($row as $value) {
                    echo "<option value='$value'>$value</option>";
                    }
                }
                ?>

        </select>
<form action="forms_action_page.php" class="form-container" method="post" enctype="multipart/form-data">
        <input type="hidden" id="fgtableData" name="fgtableData">
        <input type="hidden" id="cName" name="cName">   
        <table id = "myTable" name = "myTable" oninput = "calculate();">
        </table>
        <input type="submit" id="fGSave" value="Save 💾">
</form>
<script src="fGscript.js"></script>
<script>

function calculate(){
            var table = document.getElementById('myTable');
            var rows = table.getElementsByTagName('tr');
            var caption = table.getElementsByTagName('caption');
            var totalsum = 0;
            var tableData = [];
            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName('td');
                var resultCell = cells[3]; // Third cell for result (Closing stock)
                var resultCell2 = cells[5]; // Fifth cell for result (Total Stock Price)
                if (cells.length >= 2) {
                    var value1 = parseInt(cells[1].textContent); // Value from first column (Opening Stock)
                    var value2 = parseInt(cells[2].textContent);// Value from second column (Production Stock)
                    var value3 = parseFloat(cells[4].textContent); // Value from fourth column(Stock Price)
                    if (!isNaN(value1) && !isNaN(value2)) {
                        resultCell.textContent = value1 + value2; // Multiply values and write to result cell
                    }
                    if (!isNaN(value1) && !isNaN(value2) && !isNaN(value3)) {
                        resultCell2.textContent = resultCell.textContent * value3; // Multiply values and write to result cell
                    }
                    var val = parseFloat(cells[5].textContent);
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
    var formattedTotalSum = totalsum.toLocaleString();
    caption[0].textContent = "💰tock Maintained Value: ₹" + formattedTotalSum;
    document.getElementById('fgtableData').value = JSON.stringify(tableData);
    document.getElementById('cName').value = document.getElementById('fG_cName').value;
    }

</script>

</html>