<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box}
body {font-family: "Lato", sans-serif;}

/* Style the tab */
.tab {
  float: left;
  border: 1px solid #ccc;
  background-color: rgb(173, 103, 79);
  position: absolute; 
  top: 101px;
  width: auto;
  height: auto;
  left: -1px;
}

/* Style the sub-tab */
.sub-tab {
  float: left;
  border: 1px solid #ccc;
  background-color: rgb(173, 103, 79);
  position: relative;
  top:0px;
  width: auto;;
  height: auto;
  left: 13%;
}

/* Style the buttons inside the tab */
.tab button {
  display: block;
  background-color: rgb(173, 103, 79);
  color: white;
  padding: 22px 16px;
  width: 100%;
  height: 1.5%;
  line-height: 1%;
  border: none;
  outline: none;
  text-align: left;
  vertical-align: middle;
  cursor: pointer;
  transition: 0.3s;
  font-size: 17px;
}
.tab buttonDisabled
 {
  display: block;
  background-color: rgb(173, 103, 79);
  color: white;
  padding: 22px 16px;
  width: 100%;
  height: 1%;
  line-height: 1%;
  border: none;
  outline: none;
  text-align: left;
  vertical-align: middle;
  cursor: pointer;
  transition: 0s;
  font-size: 17px;
 } 

/* Style the buttons inside the sub-tab */
.sub-tab button {
  display: block;
  background-color: rgb(173, 103, 79);
  color: white;
  padding: 22px 16px;
  width: 100%;
  height: 1%;
  line-height: 1%;
  border: none;
  outline: none;
  text-align: left;
  vertical-align: middle;
  cursor: pointer;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color:rgb(222, 191, 175);
  vertical-align: center;
}

/* Change background color of buttons on hover */
.sub-tab button:hover {
  background-color:rgb(222, 191, 175);
  vertical-align: center;
}

/* Create an active/current "tab button" class */
.tab button.active {
  background-color: rgb(222, 191, 175);
  color: black;
}

/* Create an active/current "sub-tab button" class */
.sub-tab button.active {
  background-color: rgb(222, 191, 175);
  color: black;
}

/* Style the tab content 
.tabcontent {
  float: left;
  padding: 0px 12px;
  border: 1px solid #ccc;
  width: 70%;
  border-left: none;
  height: 300px;
  position: absolute;
}
*/

/* Style the sub-tab content */
.sub-tabcontent {
  float: left;
  padding: 0px 12px;
  border: 1px solid #ccc;
  position: absolute;
  top: 0px;
  width: auto;
  border-left: none;
  height: auto;
}
</style>
</head>
<body>

<div class="tab">
  <button class="tablinks" onclick="opensubtab(event, 'Welcome UN')" Style="font-size:15px;color:black;" id="defaultOpen">Welcome UN</button>
  <button class="tablinks" onclick="opensubtab(event, 'Inventory >', '1')">Inventory ></button>
  <button class="tablinks" onclick="opensubtab(event, 'Sales >', '2')">Sales ></button>
  <button class="tablinks" onclick="opensubtab(event, 'Production >', '3')">Production ></button>
  <buttonDisabled class="tablinks"></buttonDisabled>
  <buttonDisabled class="tablinks"></buttonDisabled>
  <buttonDisabled class="tablinks"></buttonDisabled>
  <buttonDisabled class="tablinks"></buttonDisabled>
  <buttonDisabled class="tablinks"></buttonDisabled>
  <buttonDisabled class="tablinks"></buttonDisabled>
  <buttonDisabled class="tablinks"></buttonDisabled>
  <button class="tablinks">My Account</button>
</div>

<div class="sub-tab" id = "Inventory >">
  <button class="subtablinks1" onclick="#">Commodity</button>
  <button class="subtablinks1" onclick="#">Supplier</button>
  <button class="subtablinks1" onclick="#">Feed Stock</button>
  <button class="subtablinks1" onclick="#">Stock Analysis</button>
  <button class="subtablinks1" onclick="#">Purchase Orders</button>
</div>

<div class="sub-tab" id = "Sales >">
  <button class="subtablinks2" onclick="#">Customers</button>
  <button class="subtablinks2" onclick="#">Prodcuts</button>
  <button class="subtablinks2" onclick="#">Sales Invoice</button>
  <button class="subtablinks2" onclick="#">Quotations</button>
</div>

<div class="sub-tab" id = "Production >">
  <button class="subtablinks3" onclick="#">Daily Report</button>
  <button class="subtablinks3" onclick="#">Dispatch Status</button>
  <button class="subtablinks3" onclick="#">Finished Goods</button>
</div>

<script>

function opensubtab(evt, tabname, tabindex) {
  //define all the variables used
  var i, subtablinks1, subtablinks2, subtablinks3, tablinks;
  tablinks = document.getElementsByClassName("tablinks");
  subtablinks1 = document.getElementsByClassName("subtablinks1");
  subtablinks2 = document.getElementsByClassName("subtablinks2");
  subtablinks3 = document.getElementsByClassName("subtablinks3");
  //find the current cursor position
  let x = event.clientX;
  let y = event.clientY;
  //clear all the sub tab displays
  for (i = 0; i < subtablinks1.length; i++) {
    subtablinks1[i].style.display = "none";
    }
  for (i = 0; i < subtablinks2.length; i++) {
    subtablinks2[i].style.display = "none";
   }
  for (i = 0; i < subtablinks3.length; i++) {
    subtablinks3[i].style.display = "none";
   }
   //enable the sub tab for the selected tab
  for (i = 0; i < subtablinks1.length; i++) {
    if (tabindex==1) subtablinks1[i].style.display = "block";
    subtablinks1[i].style.left = document.getElementById(tabname).style.top;
   }
  for (i = 0; i < subtablinks2.length; i++) {
    if (tabindex==2) subtablinks2[i].style.display = "block";
   }
  for (i = 0; i < subtablinks3.length; i++) {
    if (tabindex==3) subtablinks3[i].style.display = "block";
   }
  //clear all the tab button displays
    for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
   }
   //enable the selected tab
   document.getElementById(tabname).style.display = "block";
   evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

</script>

</body>
</html> 
