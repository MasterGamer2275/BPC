<html>
<body>
<!-- define variables and set to empty values*-->
echo $_POST["Sname"];<br> 
<!--
Password  echo $_POST["pwd"];<br>
Login  echo $_POST["login"];<br>
Signup  echo $_POST["signup"];<br>
-->
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Sname = $_POST["Sname"];
    $SAddr = $_POST["SAddr"];
    $SCity = $_POST["SCity"];
    $SState = $_POST["SState"];
    $Pcode = $_POST["Pcode"];
    $SPh = $_POST["SPh"];
    $SEmail= $_POST["SEmail"];
    $SAdd = $_POST["SAdd"];
    }
if $SAdd = "SAdd" {
//validate record
$sql =<<<EOF
      ALTER TABLE TEST_SUPPLIER AUTO_INCREMENT = 100;
      INSERT INTO TEST_SUPPLIER (NAME,ADDRESS,CITY,STATE,PINCODE,PHONE,EMAIL)
      VALUES ($Sname, $SAddr, $SCity, $SState, $Pcode, $SPh, $SEmail);
EOF;
   $ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
   } else {
      echo "Records created successfully\n";
   }
}

//      INSERT INTO TEST_COMMODITY (ID,NAME,SUPPLIERID,GSM,BF)
//      VALUES (2, 'GYS', 1, 70, 8);

?>
</body>
</html>