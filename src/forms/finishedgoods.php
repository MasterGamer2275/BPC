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

select{
width : 20%;
top: -10px;
}

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
caption {
text-align: middle; /* Move the caption text to the right */
border: 1px solid #ddd; /* Add border to the caption */
padding: 5px; /* Add padding to the caption */
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

#fGSave {
  margin-top: 10px; /* Adjust as needed */
  position: relative;
  display: none;
}
</style>
<h3>FinishedGoods Inventory:</h3>
        <label for="fG_cName"><b>Customer Name:</label><br>
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
        </select><br><br>
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
                var resultCell = cells[4]; // Third cell for result (Closing stock)
                var resultCell2 = cells[6]; // Fifth cell for result (Total Stock Price)
                var resultCell3 = cells[7]; // Fifth cell for result (Total Stock Price)
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
    var formattedTotalSum = totalsum.toLocaleString();
    caption[0].textContent = document.getElementById('cName').value + ":-💰Stock Value: ₹" + formattedTotalSum;
    document.getElementById('fgtableData').value = JSON.stringify(tableData);
    document.getElementById('cName').value = document.getElementById('fG_cName').value;
    document.getElementById('fGSave').style.display = "block";
    }

</script>

</html>