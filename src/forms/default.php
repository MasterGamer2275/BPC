 <?php echo "Site is under construction!" ?>
<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  dbsetup($db, $text);
  $tablename = $_SESSION["PListTabName"];
  dbcreateproducttable($db, $tablename, $text);
  $columnname = "CUSTOMERNAME";
  $dbcolvalues2 = array(array());
  dblistuniquecolvalues($db, $tablename, $columnname, $dbcolvalues2, $text);
        // Loop through the array to generate list items

            foreach ($dbcolvalues2 as $value) {
              echo $value;
            }

  $dbtabdata = array(array());
  dbreadtable($db, $tablename, $dbtabdata, $text);
  dbclose($db, $text);
 ?>
