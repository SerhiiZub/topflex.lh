<?php
namespace reflectionUtil\logger\sqllite;
/**
 * Created by PhpStorm.
 * User: Серега
 * Date: 13.06.2017
 * Time: 19:31
 */

/*CREATE TABLE log (
    -> timestamp DATETIME,
    -> logger VARCHAR(256),
    -> level VARCHAR(32),
    -> message VARCHAR(4000),
    -> thread INTEGER,
    -> file VARCHAR(255),
    -> line VARCHAR(10)
    -> );*/

//class Db
//{
//
//}
class Db extends \SQLite3
{
    function __construct()
    {
        $this->open('log.db') ;
        $this->init();
    }

    function __destruct()
    {
       $this->close();
    }

    function init(){
        $this->createTable();
    }

    private function createTable(){
        $sql = "
            CREATE TABLE IF NOT EXISTS LOG
            (
              id INT PRIMARY KEY     NOT NULL,
              timestamp DATETIME,
              logger VARCHAR(256),
              level VARCHAR(32),
              message VARCHAR(4000),
              thread INTEGER,
              file VARCHAR(255),
              line VARCHAR(10)
            )
        ";
        $ret = $this->exec($sql);
        if(!$ret) {
            echo $this->lastErrorMsg() ;
        } else {
            echo "Table created successfully\n";
        }
    }
}
//$db = new Db() ;
/*if(!$db) {
    echo $db->lastErrorMsg() ;
} else {
    echo "Opened database successfully\n";
}


$sql =<<<EOF
      CREATE TABLE IF NOT EXISTS COMPANY
      (ID INT PRIMARY KEY     NOT NULL,
      NAME           TEXT    NOT NULL,
      AGE            INT     NOT NULL,
      ADDRESS        CHAR(50) ,
      SALARY         REAL);
EOF;

$ret = $db->exec($sql) ;
if(!$ret) {
    echo $db->lastErrorMsg() ;
} else {
    echo "Table created successfully\n";
}
$db->close() ;*/