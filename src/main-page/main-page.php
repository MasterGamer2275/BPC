 <?php
// If the request is made from our space preview functionality then turn on PHP error reporting
if (isset($_SERVER['HTTP_X_FORWARDED_URL']) && strpos($_SERVER['HTTP_X_FORWARDED_URL'], '.w3spaces-preview.com/') !== false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}
?>
<?php
/*
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
session_start();
*/
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Echo session variables that were set on previous page
//echo "Favorite color is " . $_SESSION["companyID"] . ".<br>";
//echo "Favorite animal is " . $_SESSION["companyID"] . ".";
//$cId = $_SESSION["companyID"];
//echo $cId;
?>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="google-adsense-account" content="ca-pub-1687735452309402">
    <!--<title>InfiPackaging</title> -->
    <link rel="stylesheet" type="text/css" href="/main-page/main-page.css" />
    <!-- Link the default CSS file -->
    <link rel="stylesheet" href="/main-page/default.css">

    <!-- Use media queries to link specific CSS file based on screen size -->
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="/main-page/small-screen.css">
    <link rel="stylesheet" media="screen and (min-width: 601px) and (max-width: 1200px)" href="/main-page/medium-screen.css">
    <link rel="stylesheet" media="screen and (min-width: 1900px)" href="/main-page/large-screen.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>MES Portal</title>
    <!--<link rel="icon" type="image/x-icon" href="/Images/usericon.ico">-->
</head>
<body>
     <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1687735452309402"
        crossorigin="anonymous"></script>
    <!-- Ad1 -->
    <ins class="adsbygoogle"
        style="display:inline-block;width:235px;height:220px;position:absolute;left:84%;top:10px;"
        data-ad-client="ca-pub-1687735452309402"
        data-ad-slot="7565856526"></ins>
    <!-- ad2 -->
    <ins class="adsbygoogle"
        style="display:inline-block;width:235px;height:220px;position:absolute;left:84%;top:240px;"
        data-ad-client="ca-pub-1687735452309402"
        data-ad-slot="5510221597"></ins>
    <ins class="adsbygoogle"
        style="display:inline-block;width:235px;height:220px;position:absolute;left:84%;top:470px;"
        data-ad-client="ca-pub-1687735452309402"
        data-ad-slot="1933405832"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

<!--<div class="rectangle1" id="rect1"></div> -->
   <div class="iframe">
     <iframe class="rectangle1" src="/main-page/home.php" id = "rect1" name = "rect1"></iframe>
    </div>
<header>
<!-- Running quotes -->
  <h1>Welcome to Online Manufacturing Execution System</h1>
  <img class="image2" src="Images/Website_Logo.png" />
  <img class="image3" src="Images/Company_Logo.png" />
</header>
<header2>
<!-- Running quotes -->
<div class="runningquotes">
<?php include 'runningquotes.php'; ?>
</div>
   <!-- Hamburger menu -->
  <div class="hamburger-menu">
      <i class="fa fa-bars" style="font-size:24px;color:white"></i>
      <p>Menu</p>
  </div>
</heade2>
<div class="tabs">
    <div class="tab">
      <button class="tablinks" onclick="openphp(event, '/forms/home.php', '/main-page/frame1.php', 'Home')" id="defaultOpen"><i class="fas fa-home"></i> Home</button>
      <button class="tablinks" onclick="opensubtab(this, 'Purchase >', '1')">Purchase ></button>
      <button class="tablinks" onclick="opensubtab(this, 'Sales >', '2')">Sales ></button>
      <button class="tablinks" onclick="opensubtab(this, 'Inventory >', '3')">Inventory ></button>
      <button class="tablinks" onclick="opensubtab(this, 'Production >', '4')">Production ></button>
      <!--<buttonDisabled class="tablinks"></buttonDisabled>
      <buttonDisabled class="tablinks"></buttonDisabled>-->
      <button class="tablinks" onclick="opensubtab(this, 'Dispatch >', '5')">Dispatch ></button>
      <buttonDisabled class="tablinks"></buttonDisabled>
      <buttonDisabled class="tablinks"></buttonDisabled>
      <button class="tablinks" onclick="exporttoexcel();"><i class="fas fa-file-excel"></i> Export</button>
      <button class="tablinks" onclick="openphp(event, '/forms/company1.php', '/main-page/frame1.php', 'My Comapny')"><i class="fas fa-building"></i> My Company</button>
      <button class="tablinks"><i class="fas fa-user"></i> My Account</button>
      <buttonDisabled class="tablinks"></buttonDisabled>
    </div>

    <div class="sub-tab" id = "Purchase >">
      <button class="subtablinks1" onclick="openphp(event, '/forms/supplier.php', '/main-page/frame1.php')">Add/Edit Suppliers</button>
      <button class="subtablinks1" onclick="openphp(event, '/forms/commodity.php', '/main-page/frame1.php')">Raw Material Master</button>
      <button class="subtablinks1" onclick="openphp(event, '/forms/stock.php', '/main-page/frame1.php')">Stock Feed</button>
      <button class="subtablinks1" onclick="openphp(event, '/forms/edit-stock-table.php', '/main-page/frame1.php')">Edit/Review Stock</button>
      <button class="subtablinks1" onclick="openphp(event, '/forms/stockstatistics.php', '/main-page/frame1.php')">Stock Statistics</button>
      <button class="subtablinks1" onclick="openphp(event, '/forms/purchaseorders.php', '/main-page/frame1.php')">Generate PO</button>
      <button class="subtablinks1" onclick="openphp(event, '/forms/default.php', '/main-page/frame1.php')">Purchase Orders</button>
   </div>

    <div class="sub-tab" id = "Sales >">
      <button class="subtablinks2" onclick="openphp(event, '/forms/customer.php', '/main-page/frame1.php')">Add/Edit Clients</button>
      <button class="subtablinks2" onclick="openphp(event, '/forms/product.php', '/main-page/frame1.php')">Client Master</button>
      <button class="subtablinks2" onclick="openphp(event, '/forms/default.php', '/main-page/frame1.php')">Sales Invoice</button>
      <button class="subtablinks2" onclick="openphp(event, '/forms/default.php', '/main-page/frame1.php')">Quotations</button>
    </div>
    <div class="sub-tab" id = "Inventory >">
      <button class="subtablinks3" onclick="openphp(event, '/forms/stockinventory.php', '/main-page/frame1.php')">Raw Material</button>
      <button class="subtablinks3" onclick="openphp(event, '/forms/finishedgoods.php', '/main-page/frame1.php')">Finished Goods</button>
      <button class="subtablinks3" onclick="openphp(event, '/forms/finishedgoods2.php', '/main-page/frame1.php')">Finished Goods(Manual Feed)</button> 
    </div>
    <div class="sub-tab" id = "Production >">
      <button class="subtablinks4" onclick="openphp(event, '/forms/productionfeed.php', '/main-page/frame1.php')">Production Feed</button>
      <button class="subtablinks4" onclick="openphp(event, '/forms/default.php', '/main-page/frame1.php')">Finished Goods</button>
    </div>
    <div class="sub-tab" id = "Dispatch >">
      <button class="subtablinks5" onclick="openphp(event, '/forms/dispatch2.php', '/main-page/frame1.php')">Dispatch Feed</button>
      <button class="subtablinks5" onclick="openphp(event, '/forms/default.php', '/main-page/frame1.php')">Dispatched Goods</button>
    </div>
</div>
<footer>
<?php
// Define the file paths and their display names
$links = [
    'About' => '/main-page/about.php',
    'Disclaimer' => '/main-page/disclaimer.php',
    'Privacy Policy' => '/main-page/privacypolicy.php',
    'Terms of Service' => '/main-page/termsofservice.php',
    'Help' => '/main-page/help.php'
];

function generateLink($href, $text) {
    $safeHref = htmlspecialchars($href, ENT_QUOTES, 'UTF-8');
    $safeText = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    return "<a href='$safeHref' style='color: white;'>$safeText</a>";
}
?>

<p>Copyright 2021-2024 by Infi Bee Solutions Pvt. Ltd. All Rights Reserved.
<?php
// Generate the links dynamically
foreach ($links as $text => $href) {
    echo '&emsp;' . generateLink($href, $text);
}
?>
</p>
</footer>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

<script>


function openphp(event, filename, framename, tabname) {
  var i, subtablinks1, subtablinks2, subtablinks3, subtablinks4, subtablinks5, tablinks, framerect1;
  var tabs = document.getElementsByClassName("tab");
  tablinks = document.getElementsByClassName("tablinks");
  subtablinks1 = document.getElementsByClassName("subtablinks1");
  subtablinks2 = document.getElementsByClassName("subtablinks2");
  subtablinks3 = document.getElementsByClassName("subtablinks3");
  subtablinks4 = document.getElementsByClassName("subtablinks4");
  subtablinks5 = document.getElementsByClassName("subtablinks5");
  framerect1 = document.getElementById("rect1");
  document.getElementById('rect1').style.left = "0%";
  document.getElementById('rect1').style.width = "100%";
  framerect1.src = filename;
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
  for (i = 0; i < subtablinks4.length; i++) {
    subtablinks4[i].style.display = "none";
   }
     for (i = 0; i < subtablinks5.length; i++) {
    subtablinks5[i].style.display = "none";
   }
// Clear all tabs display
  for (var i = 0; i < tabs.length; i++) {
    // Set the display property of the current tab to "block"
    tabs[i].style.display = "none";
  }
}

function opensubtab(evt, tabname, tabindex) {
  //define all the variables used
  var i, subtablinks1, subtablinks2, subtablinks3, subtablinks4, subtablinks5, tablinks;
  tabs = document.getElementsByClassName("tab");
  tablinks = document.getElementsByClassName("tablinks");
  subtablinks1 = document.getElementsByClassName("subtablinks1");
  subtablinks2 = document.getElementsByClassName("subtablinks2");
  subtablinks3 = document.getElementsByClassName("subtablinks3");
  subtablinks4 = document.getElementsByClassName("subtablinks4");
  subtablinks5 = document.getElementsByClassName("subtablinks5");

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
  for (i = 0; i < subtablinks4.length; i++) {
    subtablinks4[i].style.display = "none";
   }
     for (i = 0; i < subtablinks5.length; i++) {
    subtablinks5[i].style.display = "none";
   }
   //enable the sub tab for the selected tab
  for (i = 0; i < subtablinks1.length; i++) {
    if (tabindex==1) {
    subtablinks1[i].style.display = "block";
    }
   }
  for (i = 0; i < subtablinks2.length; i++) {
    if (tabindex==2) {
    subtablinks2[i].style.display = "block";
    //subtablinks2[i].style.left = tabs[2].style.left;
    //subtablinks2[i].style.top = tabs[2].style.top;
    }
   }
  for (i = 0; i < subtablinks3.length; i++) {
    if (tabindex==3) {
    subtablinks3[i].style.display = "block";
    //subtablinks3[i].style.left = tabs[3].style.left;
    //subtablinks3[i].style.top = tabs[3].style.top;
    }
   }
  for (i = 0; i < subtablinks4.length; i++) {
    if (tabindex==4) {
    subtablinks4[i].style.display = "block";
    //subtablinks4[i].style.left = tabs[4].style.left;
    //subtablinks4[i].style.top = tabs[4].style.top;
    }
   }
     for (i = 0; i < subtablinks5.length; i++) {
    if (tabindex==5) {
    subtablinks5[i].style.display = "block";
    //subtablinks4[i].style.left = tabs[4].style.left;
    //subtablinks4[i].style.top = tabs[4].style.top;
    }
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
// Function to show tabs when hamburger menu is clicked
var hamburgerMenu = document.getElementsByClassName("hamburger-menu")[0];
hamburgerMenu.addEventListener("click", function()  {
var tabs = document.getElementsByClassName("tab");
document.getElementById('rect1').style.left = "10%";
document.getElementById('rect1').style.width = "90%";
// Loop through each tab element
for (var i = 0; i < tabs.length; i++) {
    // Set the display property of the current tab to "block"
    tabs[i].style.display = "block";
}

});
function exporttoexcel() {
//javascript:void(window.open('data:application/vnd.ms-excel,' + encodeURIComponent(document.getElementById('myTable').outerHTML)));
// Access the iframe content
            var iframe = document.getElementById('rect1');
            var iframeDocument = iframe.contentDocument || iframe.contentWindow.document;

            // Access the table within the iframe
            var table = iframeDocument.getElementById('myTable');

            // Check if table exists
            if (table) {
                // Create a new Excel file
                var excelContent = '<html><head><meta charset="UTF-8"></head><body>' + table.outerHTML + '</body></html>';

                // Create a Blob with the Excel content
                var blob = new Blob([excelContent], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8'
                });

                // Create a temporary link element
                var a = document.createElement('a');
                a.href = window.URL.createObjectURL(blob);
                a.download = 'table.xls';
                
                // Append the link to the body and click it programmatically
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            } else {
                alert('Table not found within the iframe.');
            }
}


function printpage() {
            var iframe = document.getElementById('rect1');
            var iframeWindow = iframe.contentWindow;

            if (iframeWindow) {
                iframeWindow.print();
            } else {
                alert('Iframe content could not be accessed.');
            }
}


</script>
</body>
</html>
