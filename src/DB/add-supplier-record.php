<?php
// If the request is made from our space preview functionality then turn on PHP error reporting
if (isset($_SERVER['HTTP_X_FORWARDED_URL']) && strpos($_SERVER['HTTP_X_FORWARDED_URL'], '.w3spaces-preview.com/') !== false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}
?>
<?php
 //validate record
 //$root = $_SERVER('DOCUMENT_ROOT');
 //include ($root."/DB/db-setup.php");
 $sql =<<<EOF
 INSERT INTO TEST_SUPPLIER_2 (NAME,GSTIN,ADDRESS,CITY,STATE,PINCODE,PHONE,EMAIL)
 VALUES ($Sname, $SuGST, $SAddr, $SCity, $SState, $SPcode, $SPh, $SEmail);
 EOF;
 $ret = $db->exec($sql);
     if(!$ret) {
         echo $db->lastErrorMsg(); 
       } else { 
          echo "Records created successfully\n";
        }
 //include ($root."/DB/db-close.php");
 ?>
