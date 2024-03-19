<?php
// If the request is made from our space preview functionality then turn on PHP error reporting
if (isset($_SERVER['HTTP_X_FORWARDED_URL']) && strpos($_SERVER['HTTP_X_FORWARDED_URL'], '.w3spaces-preview.com/') !== false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}
?>
<?php

include 'main-page/main-page.php';

 /*
 Add ui scaling
 position sub tab position
 fix quotes dsipaly
 create iframes to call different html form files
 structure forms
 add db table oprations
 filter date and time
 read and update file
 save/print file
*/
?>

<script>




</script>

