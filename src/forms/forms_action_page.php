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
<script>
function setMouseCursorToBusy() {
    document.body.style.cursor = 'wait'; // Change mouse cursor to 'wait' or 'progress'
}
setMouseCursorToBusy();
</script>
<!-- define variables and set to empty values*-->
<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
<?php require $root.'/DB/call-db.php'; ?>
<?php require "/home/app/src/Reset.php"; ?>
<?php date_default_timezone_set('Asia/Kolkata'); ?>
<?php /* Debug strings------------------------------------------------- */ ?>
<!--
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
  <?php dbsetup($db, $text); ?>
  <?php $tablename = $_SESSION["SListTabName"]; ?>
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
  <?php dbsetup($db, $text); ?>
  <?php $tablename = $_SESSION["ComListTabName"]; ?>
  <?php dbcheckcommodityrecord($db, $tablename, $Cname, $CSname, $CGSM, $CBF, $CompanyID, $CRS, $found, $text); ?>
  <?php if ($found == 0) {  ?>
  <?php dbaddcommodityrecord($db, $tablename, $Cname, $CSname, $CGSM, $CBF, $CRS, $text); ?>
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
  <?php dbsetup($db, $text); ?>
  <?php $tablename = $_SESSION["SListTabName"]; ?>
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
  <?php dbsetup($db, $text); ?>
  <?php $tablename = $_SESSION["SListTabName"]; ?>
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
  <?php dbsetup($db, $text); ?>
  <?php $tablename = $_SESSION["StListTabName"]; ?>
  <?php //dbcreatestocktable($db, $tablename, $text); ?>
  <?php $i = 0; ?>
  <?php foreach ($tableData as $row) { ?>
        <?php if ($i >= 1) { ?>
        <?php $rowstr = json_encode($row); ?>
        <?php $word1 = str_replace("]","",$rowstr); ?>
        <?php $word2 = str_replace("[","", $word1); ?>
        <?php $word3 = str_replace('"', '',$word2); ?>
        <?php $myArray = explode(",", $word3); ?>
        <?php $allowed_characters = '/[^\d\/\\\\]/'; // Keep digits, forward slashes, and backslashes ?>
        <?php $wrn= preg_replace($allowed_characters, '', $myArray[8]); ?>
        <?php $expected_string1 = str_replace("\\/", "/", $wrn); ?>
        <?php $expected_string2 = str_replace("\\\\", "\\", $expected_string1); ?>
        <?php $wrn = $expected_string2; ?>
        <?php dbaddstockrecord($db, $tablename, $myArray[2], $InvNum, $myArray[3], $myArray[4], $myArray[5], $myArray[6], $myArray[7], $wrn, $myArray[9], $myArray[10], $myArray[11], $myArray[12], $myArray[13], $myArray[14], $myArray[16], $text); ?>
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
  <?php //echo "welcome to add po to record<br>"; ?>
  <?php $tableDataJSON = $_POST['tableData']; ?>
  <?php $tableData = json_decode($tableDataJSON, true); ?>
  <?php $tablename = "TEST_PO_1"; ?>
<?php } ?>
<?php /*form - update company list record-------------------------------------------------- */ ?>
<?php if ($_POST["CoSave"] != "") {  ?>
  <?php $ID= '6100'; ?>
  <?php $Coname = $_POST["Coname"]; ?>
  <?php $CoGST = $_POST["CoGST"]; ?>
  <?php $CoAddr = $_POST["CoAddr"]; ?>
  <?php $CoCity = $_POST["CoCity"]; ?>
  <?php $Costate = $_POST["Costate"]; ?>
  <?php $CoPcode = $_POST["CoPcode"]; ?>
  <?php $CoPh = $_POST["CoPh"]; ?>
  <?php $CoEmail= $_POST["CoEmail"]; ?>
  <?php $CoAcode= $_POST["CoAcode"]; ?>
  <?php $CoAPh= $_POST["CoAPh"]; ?>
  <?php $machinelist= $_POST["mList"]; ?>
  <?php $godownlist= $_POST["gList"]; ?>
  <?php $upload1 = $_POST["file1-name-hidden"]; ?>
  <?php echo $upload1; ?>
  <?php $upload2 = $_POST["file2-name-hidden"]; ?>
  <?php $upload3 = $_POST["file3-name-hidden"]; ?>
  <?php echo "welcome to update company list record<br>"; ?>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file1"]) &&  isset($_FILES["file2"]) &&  isset($_FILES["file3"])) { ?>
        <?php $targetDirectory = $root."/uploads/company/"; ?>
        <?php $targetFile1 = $targetDirectory . basename($_FILES["file1"]["name"]); ?>
        <?php if (move_uploaded_file($_FILES["file1"]["tmp_name"], $targetFile1)) { ?>
            <?php echo "The file " . htmlspecialchars(basename($_FILES["file1"]["name"])) . " has been uploaded."; ?>
        <?php } else { ?>
            <?php echo "Sorry, there was an error uploading your file."; ?>
        <?php } ?>
                <?php $targetFile2 = $targetDirectory . basename($_FILES["file2"]["name"]); ?>
        <?php if (move_uploaded_file($_FILES["file2"]["tmp_name"], $targetFile2)) { ?>
            <?php echo "The file " . htmlspecialchars(basename($_FILES["file2"]["name"])) . " has been uploaded."; ?>
        <?php } else { ?>
            <?php echo "Sorry, there was an error uploading your file."; ?>
        <?php } ?>
                <?php $targetFile3 = $targetDirectory . basename($_FILES["file3"]["name"]); ?>
        <?php if (move_uploaded_file($_FILES["file3"]["tmp_name"], $targetFile1)) { ?>
            <?php echo "The file " . htmlspecialchars(basename($_FILES["file3"]["name"])) . " has been uploaded."; ?>
        <?php } else { ?>
            <?php echo "Sorry, there was an error uploading your file."; ?>
        <?php } ?>
   <?php  } ?>

  <!--
  Additionally, consider implementing security measures such as checking file types, file size limits, 
  and preventing file overwrites if necessary.
   -->
  <?php dbsetup($db, $text); ?>
  <?php $tablename = $_SESSION["CoListTabName"]; ?>
  <?php //dbeditcompanylistrecord($db, $tablename, $ID, $Coname, $CoAddr, $CoCity, $Costate, $CoPcode, $CoPh, $CoEmail, $CoGST, $CoAcode, $CoAPh, $fileToUpload1, $fileToUpload2, $fileToUpload3, $text); ?>
  <?php dbeditcompanylistrecord($db, $tablename, $ID, $Coname, $CoAddr, $CoCity, $Costate, $CoPcode, $CoPh, $CoEmail, $CoGST, $CoAcode, $CoAPh, 'Company Logo.png', 'DigitalSignature.png', 'Letterhead1.png', $machinelist, $godownlist, $text); ?>
  <?php dbclose($db, $text); ?>
  <?php echo "Record Updated.<br>"; ?>
  <?php //header("Location: company1.php"); ?>
  <?php //exit; ?>
<?php } ?>
<?php /* ---------------------------------------------------------------- */ ?>
<?php /*form - customer-------------------------------------------------- */ ?>
<?php if ($_POST["ClAdd"] != "") {  ?>
  <?php $Cname = $_POST["Cname"]; ?>
  <?php $Clname = $_POST["Clname"]; ?>
  <?php $CGST = $_POST["CGST"]; ?>
  <?php $CAddr = $_POST["CAddr"]; ?>
  <?php $CCity = $_POST["CCity"]; ?>
  <?php $CState = $_POST["Cstate"]; ?>
  <?php $CPcode = $_POST["CPcode"]; ?>
  <?php $CPh = $_POST["CPh"]; ?>
  <?php $CEmail= $_POST["CEmail"]; ?>
  <?php $CSAddr = $_POST["CSAddr"]; ?>
  <?php $CACode = $_POST["CACode"]; ?>
  <?php $CAPh = $_POST["CAPh"]; ?>
  <?php //echo "welcome to add to customer record<br>"; ?>
  <?php dbsetup($db, $text); ?>
  <?php $tablename = $_SESSION["ClListTabName"]; ?>
  <?php dbaddcustomersrecord($db, $tablename, $Cname, $Clname, $CGST, $CAddr, $CCity, $CState, $CPcode, $CPh, $CEmail, $CSAddr, $CACode, $CAPh, $CompanyID, $text); ?>
  <?php dbclose($db, $text); ?>
  <?php //echo "Record Added.<br>"; ?>
  <?php header("Location: customer.php"); ?>
  <?php exit; ?>
<?php } ?>
<?php /* ---------------------------------------------------------------- */ ?>
<?php /*form - update customer record-------------------------------------------------- */ ?>
<?php if ($_POST["C2Save"] != "") {  ?>
  <?php $ID= $_POST["CID2"]; ?>
  <?php $Cname = $_POST["CN2"]; ?>
  <?php $Clname = $_POST["ClName2"]; ?>
  <?php $CGST = $_POST["CGST2"]; ?>
  <?php $CAddr = $_POST["CAddr2"]; ?>
  <?php $CCity = $_POST["CCity2"]; ?>
  <?php $CState = $_POST["Cstate2"]; ?>
  <?php $CPcode = $_POST["CPcode2"]; ?>
  <?php $CPh = $_POST["CPh2"]; ?>
  <?php $CEmail= $_POST["CEmail2"]; ?>
  <?php $CSAddr = $_POST["CSAddr2"]; ?>
  <?php $CACode = $_POST["CAPhAc2"]; ?>
  <?php $CACPh = $_POST["CAPh2"]; ?>
  <?php //echo "welcome to update cusotmer record<br>"; ?>
  <?php dbsetup($db, $text); ?>
  <?php $tablename = $_SESSION["ClListTabName"]; ?>
  <?php dbeditcustomer($db, $tablename, $ID, $Cname, $Clname, $CGST, $CAddr, $CCity, $CState, $CPcode, $CPh, $CEmail, $CSAddr, $CACode, $CACPh, $text); ?>
  <?php dbclose($db, $text); ?>
  <?php echo "Record Updated.<br>"; ?>
  <?php header("Location: customer.php"); ?>
  <?php exit; ?>
<?php } ?>
<?php /* ---------------------------------------------------------------- */ ?>
<?php /*form - delete supplier record-------------------------------------------------- */ ?>
<?php if ($_POST["Cdelete"] != "") {  ?>
  <?php $ID= $_POST["CID2"]; ?>
  <?php //echo "welcome to delete customer record<br>"; ?>
  <?php dbsetup($db, $text); ?>
  <?php $tablename = $_SESSION["ClListTabName"]; ?>
  <?php dbdeletecustomerrecord($db, $tablename, $ID, $text); ?>
  <?php dbclose($db, $text); ?>
  <?php //echo "Record Deleted.<br>"; ?>
  <?php header("Location: customer.php"); ?>
  <?php exit; ?>
<?php } ?>
<?php /* ---------------------------------------------------------------- */ ?>
<?php /*form - products-------------------------------------------------- */ ?>
<?php if ($_POST["PAdd"] != "") {  ?>
  <?php $PCName = $_POST["pCus"]; ?>
  <?php $PDes = $_POST["pDes"]; ?>
  <?php $PSpec = $_POST["pSpec"]; ?>
  <?php $PGSM= $_POST["pGSM"]; ?>
  <?php $Str = ""; ?>
  <?php for ($i = 1; $i < 4; $i++) {; ?>
     <?php $Str1 = $_POST["pSize" . $i]; ?>
     <?php if ($Str1 == "") {  ?>
        <?php } else { ?>
            <?php $Str = $Str . "x" . $Str1; ?>
        <?php } ?>
  <?php } ?>
  <?php $PSize = substr($Str, 1); ?>
  <?php $Punit = $_POST["pUnit"]; ?>
  <?php $PRate= $_POST["pRate"]; ?>
  <?php $found= 0; ?>
  <?php //echo "welcome to add to product record<br>"; ?>
  <?php dbsetup($db, $text); ?>
  <?php $tablename = $_SESSION["PListTabName"]; ?>
  <?php dbcheckprrecord($db, $tablename, $PCName, $PSpec, $PDes, $PGSM, $PSize, $Punit, $found, $text); ?>
  <?php if ($found == 0) {  ?>
  <?php dbaddproductrecord($db, $tablename, $PCName, $PDes, $PSpec, $PGSM, $PSize, $Punit, $PRate, $text); ?>
  <?php  }  ?>
  <?php dbclose($db, $text); ?>
  <?php echo "Record Added.<br>"; ?>
  <?php header("Location: product.php"); ?>
  <?php exit; ?>
<?php } ?>
<?php /*form - Edit Stock record------------------------------------------------- */ ?>
<?php if ($_POST["sttableData"] != "") {  ?>
<?php //echo "welcome to edit stock record<br>"; ?>
<?php $ID= $_POST["id2"]; ?>
<?php $date= $_POST["Pdate2"]; ?>
<?php $InvNum= $_POST["PInv2"]; ?>
<?php $rn= $_POST["PRN2"]; ?>
<?php $rw= $_POST["PRW2"]; ?>
<?php $sname= $_POST["PSname2"]; ?>
<?php $rate= $_POST["PRate2"]; ?>
<?php $sttableData = $_POST["sttableData"]; ?>
    <?php $myArr = array(); ?>
    <?php $str1 = json_encode($sttableData); ?>
    <?php $word1 = str_replace("]","",$str1); ?>
    <?php $word2 = str_replace("[","", $word1); ?>
    <?php $word3 = str_replace('\"', '',$word2); ?>
    <?php $word4 = str_replace('"', '',$word3); ?>
    <?php $myArr = explode(",", $word4); ?>
<?php $total = $myArr[0]; ?>
<?php $location = $myArr[1]; ?>
<?php $sgst= $myArr[2]; ?>
<?php $cgst= $myArr[3]; ?>
<?php $igst= $myArr[4]; ?>
<?php $cname= $myArr[5]; ?>
<?php $gsm= $myArr[6]; ?>
<?php $bf= $myArr[7]; ?>
<?php $rs= $myArr[8]; ?>
<?php dbsetup($db, $text); ?>
<?php $tablename = $_SESSION["StListTabName"]; ?>
<?php dbeditstockrecord2($db, $tablename,$ID, $date, $InvNum, $sname, $cname, $gsm, $bf, $rs, $rn, $rw, $rate, $sgst, $cgst, $igst, $total, $location, $text); ?>
<?php dbclose($db, $text); ?>
<?php //echo $text; ?>
<?php header("Location: edit-stock-table.php"); ?>
<?php exit; ?>
<?php }?>
<?php /*form - Delete Stock record------------------------------------------------- */ ?>
<?php if ($_POST["SEdelete2"] != "") {  ?>
<?php echo $_POST["SEdelete2"]; ?>
<?php $ID= $_POST["id2"]; ?>
<?php echo $ID; ?>
<?php dbsetup($db, $text); ?>
<?php $tablename = $_SESSION["StListTabName"]; ?>
<?php dbdeletestockrecord($db, $tablename, $ID, $text); ?>
<?php dbclose($db, $text); ?>
<?php header("Location: edit-stock-table.php"); ?>
<?php exit; ?>
<?php } ?>
<?php /*form - finished goods----------------------------------------- */ ?>
<?php /* ------------------- */ ?>
<?php if ($_POST["fgtableData"] != "") {  ?>
  <?php echo "welcome to edit product record<br>"; ?>
  <?php $cName= $_POST["cName"]; ?>
  <?php $tableDataJSON = $_POST['fgtableData']; ?>
  <?php $tableData = json_decode($tableDataJSON, true); ?>
  <?php dbsetup($db, $text); ?>
  <?php $tablename = $_SESSION["PListTabName"]; ?>
  <?php //dbcreateproducttable($db, $tablename, $text); ?>
  <?php $i = 0; ?>
  <?php foreach ($tableData as $row) { ?>
        <?php if ($i <= (count($tableData) - 1)) { ?>
        <?php $rowstr = json_encode($row); ?>
        <?php $word1 = str_replace("]","",$rowstr); ?>
        <?php $word2 = str_replace("[","", $word1); ?>
        <?php $word3 = str_replace('"', '',$word2); ?>
        <?php $myArray = explode(",", $word3); ?>
        <?php dbeditproductrecord($db, $tablename, $cName, $myArray[1], $myArray[2], $myArray[3], $myArray[4], $myArray[6], $text); ?>
        <?php echo $text; ?>
        <?php  } ?>
      <?php $i = $i+1; ?>
  <?php } ?>
  <?php echo "Records Edited.<br>"; ?>
  <?php dbclose($db, $text); ?>
  <?php header("Location: finishedgoods.php"); ?>
  <?php exit; ?>
<?php } ?>
<?php /*form - production feed- ($_POST["pRC-Add"] not working)------------------------------------------------- */ ?>
<?php if ($_POST["tableData"] != "") {  ?>
    <?php $pDate = $_POST["pRC-Date"]; ?>
   	<?php $pTime = date("h:i:s a"); ?>
	  <?php $pMname = $_POST["pRC-Machine"]; ?>
	  <?php $pCnum = $_POST["pRC-P-CName"]; ?>
	  <?php $pSize = $_POST["pRC-P-Size"]; ?>
	  <?php $pReelNumber = $_POST["pRCRN"]; ?>
    <?php //$pActual = $_POST["pRC-P-Actual"]; ?>
    <?php //$pActWastage = $_POST["pRc-Wastage"]; ?>
    <?php $pStatus = $_POST["wOStatus"]; ?>
    <?php $tableDataJSON = $_POST['tableData']; ?>
    <?php $tableData = json_decode($tableDataJSON, true); ?>
    <?php $myArray = array(); ?>
    <?php $str = json_encode($tableData); ?>
    <?php $word1 = str_replace("]","",$str); ?>
    <?php $word2 = str_replace("[","", $word1); ?>
    <?php $word3 = str_replace('"', '',$word2); ?>
    <?php $myArray = explode(",", $word3); ?>
    <!--
	  <?php $pReelWidth = $_POST["pRC-ReelWidth"]; ?>
	  <?php $pReelLength = $_POST["pRC-ReelLength"]; ?>
	  <?php $pEstProd = $_POST["pRC-Est-Prod"]; ?>
	  <?php $pCutReel = $_POST["pRC-CutReel"]; ?>
	  <?php $pUsedweight = $_POST["pRC-Uw"]; ?>
	  <?php $pEstWastage = $_POST["pRc-Est-Wastage"]; ?>
	  -->
    <?php $ID = $myArray[6]; ?>
    <?php $pActual = $myArray[7]; ?>
    <?php $pActWastage = $myArray[8]; ?>
    <?php $pReelWidth = $myArray[1]; ?>
	  <?php $pReelLength = $myArray[2]; ?>
	  <?php $pEstProd = $myArray[3]; ?>
	  <?php $pCutReel = $myArray[0]; ?>
	  <?php $pUsedweight = $myArray[4]; ?>
	  <?php $pEstWastage = $myArray[5]; ?>
    <?php dbsetup($db, $text); ?>
    <?php $tablename = $_SESSION["PListTabName"]; ?>
    <?php //dbcreateproducttable($db, $tablename, $text); ?>
    <?php $paramname = "CLOSINGSTOCK"; ?>
    <?php $filter1 = "CUSTOMERNAME"; ?>
    <?php $filter2 = "SIZE"; ?>
    <?php dbgetvalue($db, $tablename, $paramname, $filter1, $pCnum, $filter2, $pSize, $outputvalue, $rowdata, $text); ?>
    <?php $openingStock = $outputvalue; ?>
    <?php $tablename = $_SESSION["ProdTabName"]; ?>
    <?php dbcheckprodfeedrecord ($db, $tablename, $ID, $found, $text); ?>
    <?php if ($found) {  ?>
    <?php $tablename = $_SESSION["ProdTabName"]; ?>
    <?php $paramname = "ACTUAL"; ?>
    <?php $filter1 = "CUSTOMERNAME"; ?>
    <?php $filter2 = "SIZE"; ?>
    <?php dbgetvalue($db, $tablename, $paramname, $filter1, $pCnum, $filter2, $pSize, $outputvalue, $rowdata, $text); ?>
    <?php $oldActualval = $outputvalue; ?>
    <?php dbeditprodfeed($db, $tablename, $ID, $pDate, $pTime, $pMname, $pCnum, $pSize, $pReelNumber, $pReelLength, $pReelWidth, $pEstProd, $pActual, $pStatus, $pCutReel, $pUsedweight, $pEstWastage, $pActWastage, $text); ?>
    <?php $tablename = $_SESSION["StListTabName"]; ?>
    <?php $pUsedweight = $pUsedweight + $pActWastage; ?>
    <?php dbeditstockrecord($db, $tablename, $pReelNumber, $pUsedweight, $pStatus, $text); ?>
    <?php $tablename = $_SESSION["PListTabName"]; ?>
    <?php $openingStock = $openingStock - $oldActualval; ?>
    <?php $newStock = $openingStock + $pActual; ?>
    <?php echo $newStock; ?>
    <?php dbeditproductrecord($db, $tablename, $pCnum, $pSize, $openingStock, $pActual, $newStock, "0", $text); ?>
    <?php echo $text; ?><br>
    <?php echo "Record Edited.<br>"; ?>
    <?php } else { ?>
    <?php $tablename = $_SESSION["ProdTabName"]; ?>
    <?php dbaddprodfeedrecord($db, $tablename, $pDate, $pTime, $pMname, $pCnum, $pSize, $pReelNumber, $pReelWidth, $pReelLength, $pEstProd, $pActual, $pStatus, $pCutReel, $pUsedweight, $pEstWastage, $pActWastage, $text); ?>
    <?php $tablename = $_SESSION["StListTabName"]; ?>
    <?php $pUsedweight = $pUsedweight + $pActWastage; ?>
    <?php echo $pUsedweight; ?>
    <?php dbeditstockrecord($db, $tablename, $pReelNumber, $pUsedweight, $pStatus, $text); ?>
    <?php $tablename = $_SESSION["PListTabName"]; ?>
    <?php $newStock = $openingStock + $pActual; ?>
    <?php echo $newStock; ?>
    <?php dbeditproductrecord($db, $tablename, $pCnum, $pSize, $openingStock, $pActual, $newStock, "0", $text); ?>
    <?php echo $text; ?><br>
    <?php echo "Record Added.<br>"; ?>
    <?php } ?>
    <?php dbclose($db, $text); ?>
    <?php header("Location: productionfeed.php"); ?>
    <?php exit; ?>
<?php } ?>

</body>
</html>
