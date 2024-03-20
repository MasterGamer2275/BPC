
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
<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
<?php require $root.'/DB/call-db.php'; ?>
Welcome  <?php @echo $_POST["Sname"]; ?><br>
Welcome  <?php @echo $_POST["CSname"]; ?><br>
<?php @$SAdd = $_POST["SAdd"]; ?>
<?php @$CAdd = $_POST["CAdd"]; ?>
<?php /*form - supplier-------------------------------------------------- */ ?>
<?php if ($SAdd != "") {  ?>
  <?php $Sname = $_POST["Sname"]; ?>
  <?php $SuGST = $_POST["SuGST"]; ?>
  <?php $SIGST = $_POST["SIGST"]; ?>
  <?php $SAddr = $_POST["SAddr"]; ?>
  <?php $SCity = $_POST["SCity"]; ?>
  <?php $SState = $_POST["Sstate"]; ?>
  <?php $SPcode = $_POST["Pcode"]; ?>
  <?php $SPh = $_POST["SPh"]; ?>
  <?php $SEmail= $_POST["SEmail"]; ?>
  <?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
  <?php //include ($root."/DB/db-setup.php"); ?>
  <?php dbsetup(); ?>
  <?php echo "welcome to add to supplier record<br>"; ?>
  <?php dbaddsupplierrecord($tablename, $Sname, $SuGST, $SAddr, $SCity, $SState, $SPcode, $SPh, $SEmail, $CompanyID, $SIGST); ?>
  <?php //include ($root."/DB/add-supplier-record.php"); ?>
  <?php dbclose(); ?>
  <?php //include ($root."/DB/db-close.php"); ?>
  <?php //header("Location: supplier.php"); ?>
  <?php //exit; ?>
<?php } ?>
<?php /*form - commodity-------------------------------------------------- */ ?>
<?php if ($CAdd != "") {  ?>
  <?php $Cname = $_POST["Cname"]; ?>
  <?php $CSname = $_POST["CSname"]; ?>
  <?php $CGSM = $_POST["CGSM"]; ?>
  <?php $CBF = $_POST["CBF"]; ?>
  <?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
  <?php //include ($root."/DB/db-setup.php"); ?>
  <?php dbsetup(); ?>
  <?php echo "welcome to add to commodity record<br>"; ?>
  <?php //include ($root."/DB/add-commodity-record.php"); ?>
  <?php dbaddcommodityrecord($tablename, $Cname, $CSname, $CGSM, $CBF, $CompanyID); ?>
  <?php dbclose(); ?>
  <?php //include ($root."/DB/db-close.php"); ?>
  <?php //header("Location: commodity.php"); ?>
  <?php //exit; ?>
<?php } ?>

</body>
</html>
