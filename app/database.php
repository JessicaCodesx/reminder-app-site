<?php

/* database connection stuff here
 * 
 */

// creating a PDO connection to the db
function db_connect() {
  try {
    // the version I made before with the dsn string being constructed within the pdo constructor was throwing an error. 
    // fixed by constructing the dsn string outside of the constructor, then passing it in with user and pass. collected     // this profound wisdom from https://www.php.net/manual/en/pdo.construct.php 

    // construct dsn string
    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_DATABASE;

    // create new PDO instance passing dsn, user and pass
    $dbh = new PDO($dsn, DB_USER, DB_PASS);

    // return db connection if successful 
    return $dbh;
  } catch (PDOException $e) {
    // global var to indiciate db is down
    global $db_down;
    $db_down = true;

    //log error msg
    error_log("Database connection failed :( : " . $e->getMessage());

    // return false to indicate connection failed
    return false;
  }
}