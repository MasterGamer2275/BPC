<?php
 echo "welcome to create supplier table if not exists";
 $sql =<<<EOF
 CREATE TABLE if not exists $tablename (
 ID INTEGER  PRIMARY KEY AUTOINCREMENT  UNIQUE,
 NAME           TEXT  NOT NULL UNIQUE,
 GSTIN          VARCHAR(15)  NOT NULL,
 ADDRESS        TEXT,
 CITY           TEXT,
 STATE          TEXT,
 PINCODE        INTEGER(6),
 PHONE          INTEGER(10),
 EMAIL          TEXT,
 COMPANYID   INTEGER
);
EOF;
$ret = $db->exec($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        echo "Table created successfully\n";
    }
?>