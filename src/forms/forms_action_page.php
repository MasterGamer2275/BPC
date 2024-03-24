
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
<?php $CompanyID = "6100"; ?>
<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
<?php require $root.'/DB/call-db.php'; ?>
Welcome  <?php echo $_POST["Sname"]; ?><br>
Welcome  <?php echo $_POST["CSname"]; ?><br>
<?php $SAdd = $_POST["SAdd"]; ?>
<?php $CAdd = $_POST["CAdd"]; ?>
<?php $S2Save = $_POST["S2Save"]; ?>
<?php $InvNum= $_POST["PSInumber"]; ?>
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
  <?php echo "welcome to add to supplier record<br>"; ?>
  <?php $tablename = "TEST_SUPPLIER_4"; ?>
  <?php dbsetup($db); ?>
  <?php dbaddsupplierrecord($db, $tablename, $Sname, $SuGST, $SAddr, $SCity, $SState, $SPcode, $SPh, $SEmail, $CompanyID, $SIGST); ?>
  <?php dbclose($db); ?>
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
  <?php echo "welcome to add to commodity record<br>"; ?>
  <?php $tablename = "TEST_COMMODITY_3"; ?>
  <?php dbsetup($db); ?>
  <?php dbaddcommodityrecord($db, $tablename, $Cname, $CSname, $CGSM, $CBF, $CompanyID); ?>
  <?php dbclose($db); ?>
  <?php //header("Location: commodity.php"); ?>
  <?php //exit; ?>
<?php } ?>
<?php /*form - update supplier record-------------------------------------------------- */ ?>
<?php if ($S2Save != "") {  ?>
  <?php $ID= $_POST["SID"]; ?>
  <?php $SuGST = $_POST["SuGST2"]; ?>
  <?php $SIGST = $_POST["SIGST2"]; ?>
  <?php echo $SIGST; ?>
  <?php $SAddr = $_POST["SAddr2"]; ?>
  <?php $SCity = $_POST["SCity2"]; ?>
  <?php $SState = $_POST["Sstate2"]; ?>
  <?php $SPcode = $_POST["SPcode2"]; ?>
  <?php $SPh = $_POST["SPh2"]; ?>
  <?php $SEmail= $_POST["SEmail2"]; ?>
  <?php echo "welcome to update supplier record<br>"; ?>
  <?php $tablename = "TEST_SUPPLIER_4"; ?>
  <?php dbsetup($db); ?>
  <?php dbeditsupplierrecord($db, $tablename, $ID, $SuGST, $SAddr, $SCity, $SState, $SPcode, $SPh, $SEmail,$SIGST); ?>
  <?php dbclose($db); ?>
<?php } ?>
<?php /*form - stock-------------------------------------------------- */ ?>
<?php /*PSubmit not returned in script submit mode ------------------- */ ?>
<?php if ($InvNum != "") {  ?>
  <?php echo "welcome to add stock to record<br>"; ?>
  <?php $InvNum= $_POST["PSInumber"]; ?>
  <?php $tableDataJSON = $_POST['tableData']; ?>
  <?php $tableData = json_decode($tableDataJSON, true); ?>
  <?php $tablename = "TEST_STOCK_3"; ?>
  <?php dbsetup($db); ?>
  <?php dbcreatestocktable($db, $tablename); ?>
  <?php $i = 0; ?>
  <?php foreach ($tableData as $row) { ?>
        <?php if ($i >= 1) { ?>
        <?php $rowstr = json_encode($row); ?>
        <?php $word1 = str_replace("]","",$rowstr); ?>
        <?php $word2 = str_replace("[","", $word1); ?>
        <?php $word3 = str_replace('"', '',$word2); ?>
        <?php $myArray = explode(",", $word3); ?>
        <?php dbaddstockrecord($db, $tablename, $myArray[2], $InvNum, $myArray[3], $myArray[4], $myArray[5], $myArray[6], $myArray[7], $myArray[8],$myArray[9], $myArray[10],$myArray[11], $myArray[12]); ?>
        <?php  } ?>
      <?php $i = $i+1; ?>
  <?php } ?>
  <?php dbclose($db); ?>
<?php } ?>
</body>
</html>
