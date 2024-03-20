 <?php
 //$root = $_SERVER('DOCUMENT_ROOT');
 include ("/DB/constantsfile.php");
 $CompanyID = "6100";
 $tablename = "TEST_COMMODITY_3";
 //validate record
 //include ($root."/DB/db-setup.php");
 $sql =<<<EOF
 INSERT INTO $tablename (NAME,SUPPLIERNAME,GSM,BF,COMPANYID)
 VALUES ('$Cname', '$CSname', '$CGSM', '$CBF', '$CompanyID');
 EOF;
 $ret = $db->exec($sql);
     if(!$ret) {
          echo $db->lastErrorMsg();
        } else { 
          echo "Records created succssfully\n";
      }
 //include ($root."/DB/db-close.php");
 ?>
