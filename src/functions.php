<?php
function dbConnect() {
  include('db-info.php');

  try {
    // connect to database
    $pdo = new PDO("mysql:host=$host;dbname=$dbName",$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;

  } catch(PDOexception $e) {
      return 0;
  }
}

function getAllTableData($tableName, $sortColumn) {
  $pdo = dbConnect();
  $sql = $pdo->prepare('SELECT * FROM :table ORDER BY :column');

  $tableName = filter_var($tableName, FILTER_SANITIZE_STRING);
  $sortColumn = filter_var($sortColumn, FILTER_SANITIZE_STRING);

  $sql->bindParam(':table', $tableName, PDO::PARAM_STR);
  $sql->bindParam(':column', $sortColumn, PDO::PARAM_STR);

  $sql->execute();

  return $sql;
}


?>
