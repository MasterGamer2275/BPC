<html>
<body>
<!-- define variables and set to empty values*-->
<?php $CompanyID = "6100"; ?>
<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
<?php require $root.'/DB/call-db.php'; ?>
<?php /* Debug strings------------------------------------------------- */ ?><!--
Welcome  <?php echo $_POST["Sname"]; ?><br>
Welcome  <?php echo $_POST["CSname"]; ?><br>
-->
<?php //$SAdd = $_POST["SAdd"]; ?>
<?php //$CAdd = $_POST["CAdd"]; ?>
<?php //$S2Save = $_POST["S2Save"]; ?>
<?php //$InvNum= $_POST["PSInumber"]; ?>
<?php /* ---------------------------------------------------------------- */ ?>
<?php /*form - supplier-------------------------------------------------- */ ?>
<?php if ($_POST["SAdd"] != "") {  ?>
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
  <?php //echo "welcome to add to supplier record<br>"; ?>
  <?php $tablename = "TEST_SUPPLIER_4"; ?>
  <?php dbsetup($db, $text); ?>
  <?php dbaddsupplierrecord($db, $tablename, $Sname, $SuGST, $SAddr, $SCity, $SState, $SPcode, $SPh, $SEmail, $CompanyID, $SIGST, $text); ?>
  <?php dbclose($db, $text); ?>
  <?php echo "Record Added.<br>"; ?>
  <?php header("Location: supplier.php"); ?>
  <?php exit; ?>
<?php } ?>
<?php /*form - commodity-------------------------------------------------- */ ?>
<?php if ($_POST["CAdd"] != "") {  ?>
  <?php $Cname = $_POST["Cname"]; ?>
  <?php $CSname = $_POST["CSname"]; ?>
  <?php $CGSM = $_POST["CGSM"]; ?>
  <?php $CBF = $_POST["CBF"]; ?>
  <?php $CRS= $_POST["CRS"]; ?>
  <?php $found= 0; ?>
  <?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
  <?php //echo "welcome to add to commodity record<br>"; ?>
  <?php $tablename = "TEST_COMMODITY_3"; ?>
  <?php dbsetup($db, $text); ?>
  <?php dbcheckcommodityrecord($db, $tablename, $Cname, $CSname, $CGSM, $CBF, $CompanyID, $CRS, $found, $text); ?>
  <?php if ($found == 0) {  ?>
  <?php dbaddcommodityrecord($db, $tablename, $Cname, $CSname, $CGSM, $CBF, $CompanyID, $CRS, $text); ?>
  <?php  }  ?>
  <?php dbclose($db, $text); ?>
  <?php echo "Record Added.<br>"; ?>
  <?php header("Location: commodity.php"); ?>
  <?php exit; ?>
<?php } ?>
<?php /*form - update supplier record-------------------------------------------------- */ ?>
<?php if ($_POST["S2Save"] != "") {  ?>
  <?php $ID= $_POST["SID"]; ?>
  <?php $SuGST = $_POST["SuGST2"]; ?>
  <?php $SIGST = $_POST["SIGST2"]; ?>
  <?php //echo $SIGST; ?>
  <?php $SAddr = $_POST["SAddr2"]; ?>
  <?php $SCity = $_POST["SCity2"]; ?>
  <?php $SState = $_POST["Sstate2"]; ?>
  <?php $SPcode = $_POST["SPcode2"]; ?>
  <?php $SPh = $_POST["SPh2"]; ?>
  <?php $SEmail= $_POST["SEmail2"]; ?>
  <?php //echo "welcome to update supplier record<br>"; ?>
  <?php $tablename = "TEST_SUPPLIER_4"; ?>
  <?php dbsetup($db, $text); ?>
  <?php dbeditsupplierrecord($db, $tablename, $ID, $SuGST, $SAddr, $SCity, $SState, $SPcode, $SPh, $SEmail,$SIGST, $text); ?>
  <?php dbclose($db, $text); ?>
  <?php echo "Record Updated.<br>"; ?>
  <?php header("Location: supplier.php"); ?>
  <?php exit; ?>
<?php } ?>
<?php /*form - delete supplier record-------------------------------------------------- */ ?>
<?php if ($_POST["Sdelete"] != "") {  ?>
  <?php $ID= $_POST["SID"]; ?>
  <?php //echo "welcome to delete supplier record<br>"; ?>
  <?php $tablename = "TEST_SUPPLIER_4"; ?>
  <?php dbsetup($db, $text); ?>
  <?php dbdeletesupplierrecord($db, $tablename, $ID, $text); ?>
  <?php dbclose($db, $text); ?>
  <?php echo "Record Deleted.<br>"; ?>
  <?php header("Location: supplier.php"); ?>
  <?php exit; ?>
<?php } ?>
<?php /*form - stock-------------------------------------------------- */ ?>
<?php /*PSubmit not returned in script submit mode ------------------- */ ?>
<?php if ($_POST["PSInumber"] != "") {  ?>
  <?php //echo "welcome to add stock to record<br>"; ?>
  <?php $InvNum= $_POST["PSInumber"]; ?>
  <?php $tableDataJSON = $_POST['tableData']; ?>
  <?php $tableData = json_decode($tableDataJSON, true); ?>
  <?php $tablename = "TEST_STOCK_4"; ?>
  <?php dbsetup($db, $text); ?>
  <?php dbcreatestocktable($db, $tablename, $text); ?>
  <?php $i = 0; ?>
  <?php foreach ($tableData as $row) { ?>
        <?php if ($i >= 1) { ?>
        <?php $rowstr = json_encode($row); ?>
        <?php $word1 = str_replace("]","",$rowstr); ?>
        <?php $word2 = str_replace("[","", $word1); ?>
        <?php $word3 = str_replace('"', '',$word2); ?>
        <?php $myArray = explode(",", $word3); ?>
        <?php dbaddstockrecord($db, $tablename, $myArray[2], $InvNum, $myArray[3], $myArray[4], $myArray[6], $myArray[7], $myArray[8], $myArray[9], $myArray[10], $myArray[11], $myArray[12], $text); ?>
        <?php  } ?>
      <?php $i = $i+1; ?>
  <?php } ?>
  <?php echo "Records Added.<br>"; ?>
  <?php dbclose($db, $text); ?>
  <?php header("Location: stock.php"); ?>
  <?php exit; ?>
<?php } ?>
<?php /*form - po------------------------------------------------- */ ?>
<?php if ($_POST["POSubmit"] != "") {  ?>
  <?php //echo "welcome to add stock to record<br>"; ?>
  <?php $tableDataJSON = $_POST['tableData']; ?>
  <?php $tableData = json_decode($tableDataJSON, true); ?>
  <?php $tablename = "TEST_PO_1"; ?>
<?php } ?>
</body>
</html>
