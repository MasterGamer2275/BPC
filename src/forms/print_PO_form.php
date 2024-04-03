<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.image1 {
  position: relative;
  top: 0;
  left: 0;
  width: 100%;
  height: 101px;
  //border: 1px solid #000000;
  border: none
}
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
  border-right: 1px solid #000;
}

th, td {
  text-align: left;
  padding: 0px;
  border: 1px solid #000;
  border-right: 1px solid #000;
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
<style> 
 .container {
            display: flex;
            justify-content: center; /* Horizontal center alignment */
            align-items: center; /* Vertical center alignment */
            height: auto; /* Height of the container */
            width: 100%;
            border: none; /* Border for visualization */
            flex-direction: row;
            margin-bottom: 0;
        }

.textbox {
            border: 1px solid #000; /* Border of the text box */
            padding: 10px; /* Padding inside the text box */
            height: auto;
            margin-right: 0px; /* Spacing between rectangles */
            width: 100%; /* Width of the text box */
            font-size: 12px;
            margin-bottom: 0;
            text-align: center; /* Align text to the center */
        }
.form-group {
            display: flex;
            align-items: center;
        }
.input-box {
            margin-bottom: 0; /* Remove margin bottom */
            width: calc(100% - 20px); /* Full width minus padding */
            height: auto;
            box-sizing: border-box; /* Include padding and border in the width */
            border: none;
            margin-left: -28px;
        }
 .title-box {
            margin-bottom: 0; /* Remove margin bottom */
            width: calc(100% - 20px); /* Full width minus padding */
            height: auto;
            box-sizing: border-box; /* Include padding and border in the width */
            border: none;
            text-align: center; /* Align text to the center */
            font-weight: bold; /* Make the text bold */
        }
.form-group label {
            /* Your general styles for labels */
            margin-right: 40px; /* Adjust spacing between label and input */
            font-size: 12px;
            color: #333;
            text-align: left;
            vertical-align: left;
            font-weight: bold; 
            width:25%;
}

.form-group1 {
            display: flex;
            align-items: center;
        }

.form-group1 label {
            /* Your general styles for labels */
            color: white;
            margin-right: 40px; /* Adjust spacing between label and input */
            font-size: 12px;
            text-align: left;
            vertical-align: left;
            font-weight: bold; 
            width:25%;

}
</style> 
 
 
 <div id="id02">
  <form action="forms_action_page.php" method="post" id = "form2">
    <input type="hidden" id="tableData" name="tableData">
    <label for="PSubmit"><b>Verify the below table and click on Generate PO :</label>
    <input type = "submit" id = "POSubmit" name = "POSubmit" value = "Generate PO" disabled><br><br>
    <img class="image1" src="/Images/Letterhead1.png">
    <div id="id04">
        <div class="container">
            <div class="textbox">
                <input type="text" style="font-size:18px" class="title-box" value = "PURCHASE ORDER" disabled >
            </div>
        </div>
        <div class="container">
            <div class="textbox">
                <input type="text" class="input-box" placeholder="Company Name">
                <input type="text" class="input-box" placeholder="GST">
                <input type="text" class="input-box" placeholder="Address Line 1, City">
                <input type="text" class="input-box" placeholder="State, Pincode">
                <input type="text" class="input-box" placeholder="Phone, Email">
                <input type="text" class="input-box" placeholder="Phone">
            </div>
            <div class="textbox">
                <input type="text" class="input-box" placeholder="Supplier Name">
                <input type="text" class="input-box" placeholder="Address line 1">
                <input type="text" class="input-box" placeholder="City, State, Pincode">
                <input type="text" class="input-box" placeholder="Mobile, Email">
                <input type="text" class="input-box" placeholder="GST">
                <input type="text" class="input-box" placeholder="PAN">
            </div>
        </div>
        <div class="container">
            <div class="textbox">
                <div class="form-group">
                  <label for="PONumber" class="label">PO No:</label>
                  <input type="text" id ="PONumber" class="input-box"  placeholder="Enter text 1">
                  <label for="PODate" class="label">PO Date:</label>
                  <input type="date" id ="PODate" class="input-box"  placeholder="Enter text 1">
                </div>
            <div class="form-group">
                  <label for="CtPerson" class="label">Contact Person:</label>
                  <input type="text" id ="CtPerson" class="input-box"  placeholder="Enter text 1">
                  <label for="PONumber" class="label"></label>
                  <input type="text" id ="PONumber" class="input-box"  placeholder="">
            </div>
            <div class="form-group">
                  <label for="CtMethod" class="label">Contact Method:</label>
                  <input type="text" id ="CtMethod" class="input-box"  placeholder="Enter text 1">
                  <label for="PONumber" class="label"></label>
                  <input type="text" id ="PONumber" class="input-box"  placeholder="">
             </div>
             <div class="form-group">
                  <label for="Dto" class="label">Dispatch to:</label>
                  <input type="text" id ="Dto" class="input-box"  placeholder="Enter text 1">
                  <label for="SContact" class="label">Site Contact:</label>
                  <input type="text" id ="SContact" class="input-box"  placeholder="Enter text 1">
             </div>
             <div class="form-group">
                  <label for="M" class="label">Mode of Pay:</label>
                  <input type="text" id ="Dto" class="input-box"  value="Cheque">
                  <label for="SContact" class="label">Mobile/Ph:</label>
                  <input type="text" id ="SContact" class="input-box"  placeholder="Enter text 1">
             </div>
         </div>
            <div class="textbox">
                <div class="form-group">
                  <label for="Scont" class="label">Supplier Contact:</label>
                  <input type="text" id ="Scont" class="input-box"  placeholder="Enter text 1">
                  <label for="PONumber" class="label"></label>
                  <input type="text" id ="PONumber" class="input-box"  placeholder="">
                </div>
            <div class="form-group">
                  <label for="SPh" class="label">Mobile/Tel.No:</label>
                  <input type="text" id ="SPh" class="input-box"  placeholder="xxxxxxxxxx">
                  <label for="PONumber" class="label"></label>
                  <input type="text" id ="PONumber" class="input-box"  placeholder="">
            </div>
                    <div class="form-group1">
                  <label for="CtMethod" class="label">Contact Method:</label>
                  <input type="text" id ="CtMethod" class="input-box"  placeholder="">
                  <label for="PONumber" class="label"></label>
                  <input type="text" id ="PONumber" class="input-box"  placeholder="">
             </div>
             <div class="form-group1">
                  <label for="Dto" class="label">Dispatch to:</label>
                  <input type="text" id ="Dto" class="input-box"  placeholder="">
                  <label for="SContact" class="label">Site Contact:</label>
                  <input type="text" id ="SContact" class="input-box"  placeholder="">
             </div>
             <div class="form-group1">
                  <label for="M" class="label">Mode of Pay:</label>
                  <input type="text" id ="Dto" class="input-box"  placeholder="">
                  <label for="SContact" class="label">Site Contact:</label>
                  <input type="text" id ="SContact" class="input-box"  placeholder="">
             </div>
     </div>
    </div>
    <table id= "myTable">
      <tr>
        <th>S No:</th>
        <th>!</th>
        <th>Particulars</th>
        <th>No. Of Reels</th>
        <th>Rate Per</th> 
        <th>Qnty</th>     
        <th>Rate</th>
        <th>Dis%</th>
        <th>Amount</th>
        <th>Delivery Date From</th>
        <th>Delivery Date To</th>      
    </tr>
    </table>
  </form>
</div>