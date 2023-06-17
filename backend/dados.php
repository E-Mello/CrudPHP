<?php
require_once '../session.php';

// check if user is logged in
if (isset($_SESSION['username'])) {

  // check if table parameter is set
  if (isset($_GET['table'])) {

    // get table name from query parameter
    $table = $_GET['table'];
    
    // validate table name to prevent SQL injection
    if (!in_array($table, ['usuarios'])) {
      echo json_encode(['error' => 'Invalid table name']);
      exit;
    }

    // fetch data from table
    require_once 'db.php';
    $sql = "SELECT * FROM $table";
    $result = $connection->query($sql);
    echo json_encode($result->fetch_all());

  } else {
    echo json_encode(['error' => 'Table parameter missing']);
  }

} else {
  echo json_encode(['error' => 'Unauthorized']);
}