<?php
class MyDB extends SQLite3 {
      function __construct() {
         $this->open('w3s-dynamic-storage\database.db');
      }
   }
   $db = new MyDB();
   if(!$db) {
      $err = $db->lastErrorMsg();
      $text .= $err;
      $text .= "<br>";
   } else {
     $text .= "Opened database successfully<br>";
   } 
$sql =<<<EOF
   CREATE TABLE if not exists $tablename(
   ID             INTEGER    PRIMARY KEY    AUTOINCREMENT  UNIQUE,
   PORELEASEDATE  TEXT		  NOT NULL,
   PORELEASETIME  TEXT		  NOT NULL,
   SUPPLIERNAME   TEXT       NOT NULL,
   SERIALNUMBER   TEXT       NOT NULL,
   PARTICULARS    TEXT       NOT NULL,
   NUMBEROFREELS  TEXT		  NOT NULL,
   RATEPER        TEXT		  NOT NULL,
   QNTY           TEXT		  NOT NULL,
   RATE           TEXT		  NOT NULL,
   DISCOUNT       TEXT		  NOT NULL,
   AMOUNT         TEXT		  NOT NULL,
   DDFROM         TEXT		  NOT NULL,
   DDTO           TEXT		  NOT NULL,
   COMPANYID      INTEGER	  NOT NULL
);
EOF;
   $ret = $db->exec($sql);
   if(!$ret){
      $err = $db->lastErrorMsg();
      $text .= $err;
      $text .= "<br>";
   } else {
      $text .= "Table created successfully<br>";
   }


   $sql =<<<EOF
    INSERT INTO $tablename (ID, PORELEASEDATE,PORELEASETIME,SUPPLIERNAME,SERIALNUMBER,PARTICULARS,NUMBEROFREELS,RATEPER,QNTY,RATE,DISCOUNT,AMOUNT,DDFROM,DDTO,COMPANYID)
    VALUES ('60100','', '', '', '', '', '', '', '', '', '', '', '', '', '6100');
  EOF;
  $ret = $db->exec($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records created succssfully<br>";
      }
  $res = $db->query("SELECT MAX(ID) FROM $tablename");
  while (($row = $res->fetchArray(SQLITE3_ASSOC))) {
  array_push($dbtabdata,$row);
  }
        foreach ($dbtabdata as $row) {
          foreach ($row as $value) {
              $PONum = $value;;
          }
      }
  echo $PONum;
  $sql =<<<EOF
  EOF;
   $ret = $db->exec($sql);
     if(!$ret) {
          $err = $db->lastErrorMsg();
          $text .= $err;
          $text .= "<br>";
        } else { 
          $text .= "Records read successfully<br>";
      }





   $db->close();
   $text .= "Closed database successfully<br>";
   ?>