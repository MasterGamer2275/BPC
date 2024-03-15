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
    <!--<title>InfiPackaging</title> -->
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <title>MES Portal</title>
    <!--<link rel="icon" type="image/x-icon" href="/Images/usericon.ico">-->
    <div class="parent" >
    <img class="image1" src="Images/Title_Block.PNG" />
    <img class="image2" src="Images/Website_Logo.png" />
    <img class="image3" src="Images/Company_Logo.png" />
    <h1 class="header1_title" >Welcome to the Manufacturing Execution System Portal</h1><br>
    <iframe class="runningquotes" src="runningquotest.php"></iframe>
    </div>
</header>