<?php
 //validate record
 //$root = $_SERVER('DOCUMENT_ROOT');
 //include ($root."/DB/db-setup.php");
 $sql =<<<EOF
 INSERT INTO TEST_SUPPLIER_2 (NAME,GSTIN,ADDRESS,CITY,STATE,PINCODE,PHONE,EMAIL)
 VALUES ('$Sname', '$SuGST', '$SAddr', '$SCity', '$SState', '$SPcode', '$SPh', '$SEmail');
 EOF;
 $ret = $db->exec($sql);
     if(!$ret) {
         echo $db->lastErrorMsg(); 
       } else { 
          echo "Records created successfully\n";
        }
 //include ($root."/DB/db-close.php");
 ?>
