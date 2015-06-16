<?php

/**
 * Class QueryHandler.
 *
 * This is the mysql query library for this application.
 *
 * @author Om Prakash <oppradhan2011@gmail.com>
 * @copyright (c) 2015, Om Prakash
 */

class QueryHandler {

  public function createConnection($dbHost, $dbUser, $dbPass, $dbName) {
    mysql_connect($dbHost, $dbUser, $dbPass) or die('MySQL connect failed. ' . mysql_error());
    mysql_select_db($dbName) or die('Cannot select database. ' . mysql_error());
  }

  public function dbQuery($sql) {
    $fp = fopen('/tmp/data.txt', 'a+');
    fwrite($fp, $sql . '$$$');
    fclose($fp);
    $result = mysql_query($sql) or die(mysql_error());
    return $result;
  }

  public function dbAffectedRows() {
    global $dbConn;
    return mysql_affected_rows($dbConn);
  }

  public function dbFetchArray($result, $resultType = MYSQL_NUM) {
    return mysql_fetch_array($result, $resultType);
  }

  public function dbFetchAssoc($result) {
    if ($result != null) {
      return mysql_fetch_assoc($result);
    }
  }

  public function dbFetchRow($result) {
    return mysql_fetch_row($result);
  }

  public function dbFreeResult($result) {
    return mysql_free_result($result);
  }

  public function dbNumRows($result) {
    return mysql_num_rows($result);
  }

  public function dbSelect($dbName) {
    return mysql_select_db($dbName);
  }

  public function dbInsertId() {
    return mysql_insert_id();
  }

}

