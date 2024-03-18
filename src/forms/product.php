<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
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
</style>

<form action="/forms_action_page.php" method="post">
<p>Products: Please feed the new product name and correspoding spec. in to the MES System.
<br><br>
<label for="PCus"><b>Customer Name: *</label>
<select name="PCus" id="PCus">
</select><table>
<label for="PDes"><b>Description: *</label>
<input type = "text" id = "PDes" name = "PDes" required size="25" placeholder = "Brown Cover GY">
<label for="PSpec"><b>Spec: *</label>
<input type = "text" id = "PSpec" name = "PSpec" required size="10">
<label for="PGSM"><b>GSM: *</label>
<input type = "number" id = "PGSM" name = "PGSM" required width="5px" min = "10" max= "500" step = "0.01">
<label for="PSize"><b>Size: *</label>
<input type = "number" id = "PSize" name = "PSize" required maxlength="5" size="5" min = "1" max = "1000" step = "1">x
<input type = "number" id = "PSize2" name = "PSize2" required maxlength="5" size="5" min = "1" max = "1000" step = "1">
<label for="Punit"><b>Unit: *</label>
<input type = "text" id = "Punit" name = "Punit" required size="4" maxlength="4">
<br><br>
<label for="PRate"><b>Rate:*</label>
<input type = "number" id = "PRate" name = "PRate" required width="5px" min = "1" max= "10000" step = "0.01">
<input type = "submit" id = "PAdd" name = "PAdd" value = "Add">
<br><br>
<table>
  <tr>    
        <th>Customer ID</th>
        <th>Product ID</th>    
        <th>Spec</th>    
        <th>GSM</th>    
        <th>Size</th>    
        <th>Rate</th>  
  </tr>
</table>
</form>