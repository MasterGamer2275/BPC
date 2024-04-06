 <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    /* Style the tab buttons */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: rgb(89, 220, 238);
        display: flex; /* Use flexbox layout */
        flex-direction: column; /* Arrange tabs vertically */
        width: 100%;
        height: 100%;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        //float: left;
        width: 100%;
        height: 100%;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: rgb(126, 208, 162);
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: rgb(146, 208, 162);
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: none;
        border-top: none;
    }
    .flex-container {
    display: flex; /* Use flexbox layout */
    border: 1px solid #ccc;
    flex-direction: row;
    height: 60%;
}

.flex-container input[type=text], .flex-container select, .flex-container input[type=password], .flex-container input[type=email], .flex-container input[type=date], .flex-container input[type=number], .flex-container input[type=button], .flex-container input[type=submit]{
    /* Styling for each item */
    border: 1px solid #ccc;
    padding: 10px;
    margin: 5px;
    width: 96%;
    -moz-appearance: textfield;
}
</style>
</head>
<body>
<h3>Manufacturing Process Control Portal:</h3>
  <form id="myForm">
        <div class="tab">
          <button class="tablinks" onclick="openTab(event, 'Job1')">Create New Work Order</button>
          <button class="tablinks" onclick="openTab(event, 'SWO')">Select Work Order</button>
          <button class="tablinks" onclick="openTab(event, 'Load')">Enter Material(Raw) Info</button>
          <button class="tablinks" onclick="openTab(event, 'Output')">Review Work Order</button>
          <button class="tablinks" onclick="openTab(event, 'Complete')">Update Work Order Status</button>
      </div>
   <div class="flex-container">

      <div id="Job1" class="tabcontent">
            <h3>WorkOrder:</h3>
            <label for="pRDate"><b>Date</label>
            <input type ="date"  name="pRDate" id="pRDate">
            <label for="Machine"><b>Machine: *</label>
            <select name="Machine" id="Machine" required min = "1">
              <option value="0">Select</option>
              <option value="1">Machine1</option>
              <option value="2">Machine2</option>
              <option value="3">Machine3</option>
              <option value="4">Machine4</option>
              <option value="5">Machine5</option>
            </select>
            <label for="pRC-P-CName"><b>Client Name: *</label>
            <select name="pRC-P-CName" id="pRC-P-CName">
              <option value="0">Select</option>
            </select>
            <label for="pRC-P-Target"><b>Target</label>
            <input type = "number" id = "pRC-P-Target" name = "pRC-P-Target" required min = "1" step = "1">
            <label for="pRC-P-Size"><b>Cover Size: *</label>
            <select name="pRC-P-Size" id="pRC-P-Size">
              <option value="0">Select</option>
            </select>
            <label for="pR-P-CUnit"><b>Unit: *</label>
            <input type = "text" id = "pR-P-CUnit" name = "pR-P-CUnit" required size="5" disabled>
            <label for="pRC-P-GSM"><b>GSM: *</label>
            <input type = "text" id = "pRC-P-GSM" name = "pRC-P-GSM" required size="5" disabled>
     </div>
     <div id="Load" class="tabcontent">
        <h3>Material Info:</h3>
        <label for="pRCRN"><b>Reel Number: *</label>
        <select name="pRCRN" id="pRCRN">
           <option value="0">Select</option>
        </select>
        <label for="pRCMT"><b>Material: *</label>
        <input type = "text" id = "pRCMT" name = "pRCMT" required size="15" disabled>
        <label for="pRC-RM-GSM"><b>GSM: *</label>
        <input type = "text" id = "pRC-RM-GSM" name = "pRC-RM-GSM" required size="5" disabled>
        <label for="pRC-RM-RW"><b>Reel Weight (Kg): *</label>
        <input type = "text" id = "pRC-RM-RW" name = "pRC-RM-RW" required size="5" disabled>
        <label for="pRC-RM-RS"><b>Reel Size: *</label>
        <input type = "text" id = "pRC-RM-RS" name = "pRC-RM-RS" required size="10" disabled>
        <label for="pRC-ReelWidth"><b>Reel Width(cm): *</label>
        <input type = "number" id = "pRC-ReelWidth" name = "pRC-ReelWidth" required min = "1" step = "0.01">
        <label for="pRC-ReelLength"><b>Reel Length(cm): *</label>
        <input type = "number" id = "pRC-ReelLength" name = "pRC-ReelLength" required min = "1" step = "0.01">
        <label for="pRC-Est.WeightPK"><b>Estimated Weight(Kg/1000): *</label>
        <input type = "number" id = "pRC-TotalWeight" name = "pRC-TotalWeight" required min = "1" step = "0.01" disabled>
     </div>
     <div id="Output" class="tabcontent">
        <h3>Material Info:</h3>
        <label for="pRc-Wastage"><b>Wastage:</label>
        <input type = "number" id = "pRc-Wastage" name = "pRc-Wastage" required step = "0.01">
        <label for="pRC-UsedW"><b>Used Reel Weight:</label>
        <input type = "number" id = "pRC-EstW" name = "pRC-EstW" step = "0.01" disabled>
        <label for="pRC-Est-Prod"><b>Estimated Production:</label>
        <input type = "number" id = "pRC-Est-ProdW" name = "pRC-Est-ProdW" step = "0.01" disabled>
        <label for="pRC-Act-Prod"><b>Actual Production: </label>
        <input type = "number" id = "pRC-Act-Prod" name = "pRC-Act-Prod" required step = "0.01" disabled>
        <label for="pRC-Loss"><b>Loss: </label>
        <input type = "number" id = "pRC-Loss" name = "pRC-Loss" step = "0.01" disabled>
        <label for="pRC-PerCLoss"><b>PerCoverLoss:</label>
        <input type = "number" id = "pRC-PerCLoss" name = "pRC-PerCLoss" step = "0.01" disabled>
        <label for="pRC-ExtraWaste"><b>Extra Watse:</label>
        <input type = "number" id = "pRC-ExtraWaste" name = "pRC-ExtraWaste" step = "0.01" disabled>
        <label for="pRC-TotalWaste"><b>Total Waste:</label>
        <input type = "number" id = "pRC-TotalWaste" name = "pRC-TotalWaste" step = "0.01" disabled>
     </div>
     <div id="Complete" class="tabcontent">
        <h3>Work Order Status:</h3>
        <select name="wOStatus" id="wOStatus" required min = "1">
              <option value="0">Select</option>
              <option value="1">In Milling</option>
              <option value="2">Hold</option>
              <option value="3">Material Loaded</option>
              <option value="4">Finished/Close</option>
         </select>
         <label for="pRC-P-Actual"><b>Actual Production:</label>
         <input type = "number" id = "pRC-P-Actual" name = "pRC-P-Actual" required min = "1" step = "1">

        <input type = "submit" id = "WOSave" name = "WOSave" value = "Save">
        <input type = "button" id = "WOCancel" name = "WOCancel" value = "Cancel">



  </div>
</form>  
<script>
    // Function to switch between tabs
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Open the first tab by default
    document.getElementsByClassName("tablinks")[0].click

</script>

</body>
</html>