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

function getAllCompaniesData() {
  $pdo = dbConnect();
  $sql = $pdo->prepare('SELECT * FROM Companies ORDER BY name ASC');
  $sql->execute();
  return $sql;
}

function getSelectOption($value, $display) {
  return "<option value=\"$value\">$display</option>";
}







?>
