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

function getDistinctPositionNames() {
  $pdo = dbConnect();
  $sql = $pdo->prepare('SELECT Distinct title FROM Positions ORDER BY title asc');
  $sql->execute();
  return $sql;
}

function doesCompanyExist($companyName) {
  $pdo = dbConnect();
  $sql = $pdo->prepare('SELECT id FROM Companies WHERE name=:name LIMIT 1');

  $companyName = filter_var($companyName, FILTER_SANITIZE_STRING);
  $sql->bindParam(':name', $companyName, PDO::PARAM_STR);

  $sql->execute();

  echo $sql->rowCount();

  if ($sql->rowCount() == 1) {
    return true;
  } else {
    return false;
  }
}

function insertCompany($companyName) {
  $pdo = dbConnect();
  $sql = $pdo->prepare('INSERT INTO Companies (name) VALUES (:name)');
  $companyName = filter_var($companyName, FILTER_SANITIZE_STRING);
  $sql->bindParam(':name', $companyName, PDO::PARAM_STR);
  $sql->execute();

  $sql = null;
  $pdo = null;
}

function getNewestCompanyID() {
  $pdo = dbConnect();
  $sql = $pdo->prepare('SELECT id FROM Companies ORDER BY id DESC LIMIT 1');
  $sql->execute();
  $result = $sql->fetch(PDO::FETCH_ASSOC);
  return $result['id'];
}

function getCompanyID($companyName) {
  $pdo = dbConnect();
  $sql = $pdo->prepare('select id from Companies where name = :name');
  $companyName = filter_var($companyName, FILTER_SANITIZE_STRING);
  $sql->bindParam(':name', $companyName, PDO::PARAM_STR);
  $sql->execute();
  $row = $sql->fetch(PDO::FETCH_ASSOC);
  return $row['id'];
}

// cmd, ctrl, a to align
function insertPosition($companyID, $positionTitle, $date, $address1, $address2, $city, $state, $zip, $phone, $source, $notes) {
  $pdo = dbConnect();
  $sql = $pdo->prepare('INSERT INTO Positions(company_id, title, date_applied, address1, address2, city, state, zip, phone, source_found, notes) VALUES (:company_id, :title, :date_applied, :address1, :address2, :city, :state, :zip, :phone, :source_found, :notes)');

  $companyID     = filter_var($companyID, FILTER_SANITIZE_NUMBER_INT);
  $positionTitle = filter_var($positionTitle, FILTER_SANITIZE_STRING); 
  $date          = filter_var($date, FILTER_SANITIZE_STRING);
  $address1      = filter_var($address1, FILTER_SANITIZE_STRING);
  $address2      = filter_var($address2, FILTER_SANITIZE_STRING);
  $city          = filter_var($city, FILTER_SANITIZE_STRING);
  $state         = filter_var($state, FILTER_SANITIZE_STRING);
  $zip           = filter_var($zip, FILTER_SANITIZE_NUMBER_INT);
  $phone         = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
  $source        = filter_var($source, FILTER_SANITIZE_STRING);
  $notes         = filter_var($notes, FILTER_SANITIZE_STRING);

  $sql->bindParam(':company_id', $companyID, PDO::PARAM_INT);
  $sql->bindParam(':title', $positionTitle, PDO::PARAM_STR);
  $sql->bindParam(':date_applied', $date, PDO::PARAM_STR);
  $sql->bindParam(':address1', $address1, PDO::PARAM_STR);
  $sql->bindParam(':address2', $address2, PDO::PARAM_STR);
  $sql->bindParam(':city', $city, PDO::PARAM_STR);
  $sql->bindParam(':state', $state, PDO::PARAM_STR);
  $sql->bindParam(':zip', $zip, PDO::PARAM_INT);
  $sql->bindParam(':phone', $phone, PDO::PARAM_INT);
  $sql->bindParam(':source_found', $source, PDO::PARAM_STR);
  $sql->bindParam(':notes', $notes, PDO::PARAM_STR);

  $sql->execute();
}

function getNewestPositionID() {
  $pdo = dbConnect();
  $sql = $pdo->prepare('SELECT id FROM Positions ORDER BY id DESC LIMIT 1');
  $sql->execute();
  $result = $sql->fetch(PDO::FETCH_ASSOC);
  return $result['id'];
}

function doesPositionExist($positionID) {
  $position = getPositionData($positionID);

  if ($position->rowCount() == 1) {
    return true;
  } else {
    return false;
  }
}

function getPositionData($positionID) {
  $pdo = dbConnect();
  $sql = $pdo->prepare('SELECT * FROM Positions WHERE id=:positionID LIMIT 1');
  $positionID = filter_var($positionID, FILTER_SANITIZE_NUMBER_INT);
  $sql->bindParam(':positionID', $positionID, PDO::PARAM_INT);
  $sql->execute();
  return $sql;
}

function getFormattedPositionData($positionID) {
  $pdo = dbConnect();

  $sql = $pdo->prepare('SELECT Positions.*, Companies.name as "company_name", date_format(Positions.date_applied, "%W, %M %D, %Y") as "date_applied_display" FROM Positions LEFT JOIN Companies ON Positions.company_id = Companies.id WHERE Positions.id=:positionID GROUP BY Positions.id LIMIT 1');


  $positionID = filter_var($positionID, FILTER_SANITIZE_NUMBER_INT);
  $sql->bindParam(':positionID', $positionID, PDO::PARAM_INT);
  $sql->execute();
  return $sql;
}









?>
