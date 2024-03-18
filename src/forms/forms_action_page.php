
<?php
// If the request is made from our space preview functionality then turn on PHP error reporting
if (isset($_SERVER['HTTP_X_FORWARDED_URL']) && strpos($_SERVER['HTTP_X_FORWARDED_URL'], '.w3spaces-preview.com/') !== false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}
?>
<html>
<body>
<!-- define variables and set to empty values*-->
Welcome  <?php echo $_POST["Sname"]; ?><br>
<?php $Sname = $_POST["Sname"]; ?>
<?php $SuGST = $_POST["SuGST"]; ?>
<?php $SAddr = $_POST["SAddr"]; ?>
<?php $SCity = $_POST["SCity"]; ?>
<?php $SState = $_POST["SState"]; ?>
<?php $SPcode = $_POST["Pcode"]; ?>
<?php $SPh = $_POST["SPh"]; ?>
<?php $SEmail= $_POST["SEmail"]; ?>
<?php $SAdd = $_POST["SAdd"]; ?>
<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
<?php include ($root."/DB/db-setup.php"); ?>
<?php if ($SAdd != "") {  ?>
  <?php echo "welcome to add to supplier record<br>"; ?>
  <?php /*validate record */ ?>  
  <?php include ($root."/DB/add-supplier-record.php"); ?>
<?php } ?>
<?php include ($root."/DB/db-close.php"); ?>

</body>
</html>
