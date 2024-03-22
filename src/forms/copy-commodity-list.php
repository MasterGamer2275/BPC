function getcommoditylist() {
  //the tax input boxes id and set the init value to 0
  document.getElementById("PIGST").value = 0;
  document.getElementById("PSGST").value = 0;
  document.getElementById("PCGST").value = 0;
  //get commodity list box value id
  var select = document.getElementById("PCname");
  //reset all commodity list box options except the default
  //var numberOfOptions = select.options.length;
  /*
  for (let i = 1; i < numberOfOptions; i++) {
  select.remove(1);
    }
    */
  // Encode the PHP igst list array to JSON
  str = jsArray_1[index-1];
  // convert json object to string
  var stringData = JSON.stringify(str);
  // check if igst is on enable/disable the tax input boxes respectively
  var contains = stringData.includes("on");
  if (contains) {
  document.getElementById("PIGST").disabled = false;
  document.getElementById("PSGST").disabled = true;
  document.getElementById("PCGST").disabled = true;
    } else {
  document.getElementById("PIGST").disabled = true;
  document.getElementById("PSGST").disabled = false;
  document.getElementById("PCGST").disabled = false;
        }
        /*
  //update commodity list
  var supplierstr = document.getElementById("PSname").value;
  var tr = "\"" + supplierstr + "\"";
  for (let i = 1; i < jsArray_2.length; i++) {
    let c = JSON.stringify(jsArray_2[i]);
    let position = c.search(tr);
    let found = (position>0);
    const myArray = c.split(",");
    let word1 = myArray[1];
    let gsm1 = myArray[3];
    let bf1 = myArray[4];
    const myArray2 = word1.split(":");
    let word2 = myArray2[1];
    const myArray3 = gsm1.split(":");
    let gsm2 = myArray3[1];
    const myArray4 = bf1.split(":");
    let bf2 = myArray4[1];
    var option = document.createElement("option");
    option.text = word2 + "GSM:" + gsm2 + "BF:" + bf2;
    option.value = i;
    select.appendChild(option);
  }
  */
}