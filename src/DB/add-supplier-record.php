<?php
 //$root = $_SERVER('DOCUMENT_ROOT');
 include ("/DB/constantsfile.php");
 $tablename = "TEST_SUPPLIER_4";
 //validate record
 //include ($root."/DB/db-setup.php");
 $sql =<<<EOF
 INSERT INTO $tablename (NAME,GSTIN,ADDRESS,CITY,STATE,PINCODE,PHONE,EMAIL,COMPANYID)
 VALUES ('$Sname', '$SuGST', '$SAddr', '$SCity', '$SState', '$SPcode', '$SPh', '$SEmail', '$CompanyID');
 EOF;
 $ret = $db->exec($sql);
     if(!$ret) {
          echo $db->lastErrorMsg();
        } else { 
          echo "Records created succssfully\n";
      }
 //include ($root."/DB/db-close.php");
 ?>
