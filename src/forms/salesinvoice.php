 <style>
        
table,
  th,
   td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 6px;
        text-align: center;
        }
th, td {
  	padding: 10px;
    text-align: left;
}
th {
  	background-color: #EEEEEE;
    text-align: left;
}
td {
  	width: 50px;
}
#nested {
  	background-color: white;
}
</style>
<table align="center">
<tr>
    <td colspan="6" >Tax Invoice</td>
        
</tr>
<tr>
    <th>Invoice No:</th>
  	<td><div input type = "number" disabled >xxxx</div></td>
    <th >Dated:</th>
  	<td colspan="3"><div input type = "date" disabled>xx/xx/xx</div></td>

  </tr>
 
    <tr>

    <th>Delivery Note: *</th>
  	<td><div input type = "text" contenteditable></div></td>
    <th>Mode/Terms of Payment *</th>
  	<td colspan="3"><div input type = "text" contenteditable></div></td>
  </tr>
  
    <tr>

    <th>Reference: *</th>
  	<td><div input type = "text" contenteditable></div></td>
    <th>Other: *</th>
  	<td><div input type = "text" contenteditable></div></td>
    <th>References: *</th>
  	<td><div input type = "text" contenteditable></div></td>
  </tr>

  <tr>


    <th>Buyer Order No: *</th>
  	<td><div input type = "number" contenteditable>xxxx</div></td>
    <th>Order Date: *</th>
  	<td colspan="3"><div input type = "date" contenteditable>xx/xx/xx</div></td>
  </tr>
</table>