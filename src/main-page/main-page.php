 <?php
// If the request is made from our space preview functionality then turn on PHP error reporting
if (isset($_SERVER['HTTP_X_FORWARDED_URL']) && strpos($_SERVER['HTTP_X_FORWARDED_URL'], '.w3spaces-preview.com/') !== false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}
?>

<!DOCTYPE html>
<html lang="en">
<header>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="google-adsense-account" content="ca-pub-1687735452309402">
    <!--<title>InfiPackaging</title> -->
    <link rel="stylesheet" type="text/css" href="/main-page/main-page.css" />
    <title>MES Portal</title>
    <!--<link rel="icon" type="image/x-icon" href="/Images/usericon.ico">-->
    <div class="parent" >
    <img class="image1" src="Images/Title_Block.PNG" />
    <img class="image2" src="Images/Website_Logo.png" />
    <img class="image3" src="Images/Company_Logo.png" />
    <h1 class="header1_title" >Welcome to the Manufacturing Execution System Portal</h1><br>
    <iframe class="runningquotes" src="/main-page/runningquotest.php"></iframe>\\HOME.html.docx
    </div>
  </header>
  <body>
    <div class="iframe">
     <iframe class="rectangle1" src="/main-page/home.php" id = "rect1" name = "rect1"></iframe>
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
    <!--
     <iframe class="rectangle2" src="i.php" id = "rect2" name = "rect2"></iframe>
     <iframe class="rectangle3" src="i.php" id = "rect3" name = "rect3"></iframe>
     <iframe class="rectangle4" src="i.php" id = "rect4" name = "rect4"></iframe>-->
    </div>
    <div class="tab">
      <button class="tablinks" onclick="openphp(event, '/main-page/home.php', '/main-page/frame1.php', 'Home')" Style="font-size:15px;color:white;" id="defaultOpen">HOME</button>
      <button class="tablinks" onclick="opensubtab(event, 'Inventory >', '1')">Inventory ></button>
      <button class="tablinks" onclick="opensubtab(event, 'Sales >', '2')">Sales ></button>
      <button class="tablinks" onclick="opensubtab(event, 'Production >', '3')">Production ></button>
      <button class="tablinks" onclick="openphp(event, '/forms/company1.php', '/main-page/frame1.php', 'My Comapny')">My Company</button>
      <buttonDisabled class="tablinks"></buttonDisabled>
      <buttonDisabled class="tablinks"></buttonDisabled>
      <buttonDisabled class="tablinks"></buttonDisabled>
      <buttonDisabled class="tablinks"></buttonDisabled>
      <buttonDisabled class="tablinks"></buttonDisabled>
      <buttonDisabled class="tablinks"></buttonDisabled>
      <button class="tablinks">My Account</button>
      <buttonDisabled class="tablinks"></buttonDisabled>
    </div>

    <div class="sub-tab" id = "Inventory >">
      <button class="subtablinks1" onclick="openphp(event, '/forms/supplier.php', '/main-page/frame1.php')">Suppliers</button>
      <button class="subtablinks1" onclick="openphp(event, '/forms/commodity.php', '/main-page/frame1.php')">Commodities</button>
      <button class="subtablinks1" onclick="openphp(event, '/forms/stock.php', '/main-page/frame1.php')">Stock Feed</button>
      <button class="subtablinks1" onclick="openphp(event, '/forms/stockstatistics.php', '/main-page/frame1.php')">Stock Statistics</button>
      <button class="subtablinks1" onclick="openphp(event, '/forms/purchaseorders.php', '/main-page/frame1.php')">Purchase Orders</button>
   </div>

    <div class="sub-tab" id = "Sales >">
      <button class="subtablinks2" onclick="openphp(event, '/forms/customer.php', '/main-page/frame1.php')">Customers</button>
      <button class="subtablinks2" onclick="openphp(event, '/forms/product.php', '/main-page/frame1.php')">Prodcuts</button>
      <button class="subtablinks2" onclick="openphp(event, '/forms/salesinvoice.php', '/main-page/frame1.php')">Sales Invoice</button>
      <button class="subtablinks2" onclick="openphp(event, '/forms/quotes.php', '/main-page/frame1.php')">Quotations</button>
    </div>

    <div class="sub-tab" id = "Production >">
      <button class="subtablinks3" onclick="openphp(event, '/forms/dailyfeed.php', '/main-page/frame1.php')">Production Feed</button>
      <button class="subtablinks3" onclick="openphp(event, '/forms/dispatch.php', '/main-page/frame1.php')">Dispatch Status</button>
      <button class="subtablinks3" onclick="openphp(event, '/forms/finishedgoods.php', '/main-page/frame1.php')">Finished Goods</button>
    </div>

<footer>
    <p>Copyright 2021-2024 by Infi Packaging. All Rights Reserved.</p>
    <p style="color: white;font-size: 14px;display: inline;margin-right: 8px;"><a href="#" style="color: white;">About</a></p>
    <p style="color: white;font-size: 14px;display: inline;margin-right: 8px;"><a href="#" style="color: white;">Disclaimer</a></p>
    <p style="color: white;font-size: 14px;display: inline;margin-right: 8px;"><a href="#" style="color: white;">Privacy Policy</a></p>
    <p style="color: white;font-size: 14px;display: inline;margin-right: 8px;"><a href="#" style="color: white;">Terms of Service</a></p>
    <p style="color: white;font-size: 14px;display: inline;margin-right: 8px;"><a href="#" style="color: white;">Help</a></p>
</footer>
</body>

<script>

function openphp(evt, filename, framename, tabname) {
  var i, subtablinks1, subtablinks2, subtablinks3, tablinks, framerect1;
  tablinks = document.getElementsByClassName("tablinks");
  subtablinks1 = document.getElementsByClassName("subtablinks1");
  subtablinks2 = document.getElementsByClassName("subtablinks2");
  subtablinks3 = document.getElementsByClassName("subtablinks3");
  framerect1 = document.getElementById("rect1");
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
}

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
