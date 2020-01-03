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

  if ($sql->rowCount() == 1) {
    return true;
  } else {
    return false;
  }
}

function doesCompanyIDExist($companyID) {
  $pdo = dbConnect();
  $sql = $pdo->prepare('SELECT id FROM Companies WHERE id=:companyID LIMIT 1');

  $companyID = filter_var($companyID, FILTER_SANITIZE_NUMBER_INT);
  $sql->bindParam(':companyID', $companyID, PDO::PARAM_INT);

  $sql->execute();

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

function getCompanyData($companyID) {
  $pdo = dbConnect();
  $sql = $pdo->prepare('SELECT * FROM Companies WHERE id=:companyID');
  $companyID = filter_var($companyID, FILTER_SANITIZE_NUMBER_INT);
  $sql->bindParam(':companyID', $companyID, PDO::PARAM_INT);
  $sql->execute();
  return $sql->fetch(PDO::FETCH_ASSOC);
}

function getPositionsTableData() {
  $pdo = dbConnect();
  $sql = $pdo->prepare('SELECT Positions.id, Positions.title, Positions.company_id, DATE_FORMAT(Positions.date_applied, "%m-%d-%Y") as "date_applied", Companies.name as "company_name" FROM Positions LEFT JOIN Companies ON Positions.company_id=Companies.id GROUP BY Positions.id');
  $sql->execute();

  return $sql;
}

function getCompanyPositions($companyID) {
  $pdo = dbConnect();
  $sql = $pdo->prepare('SELECT Positions.id, Positions.title, Positions.company_id, DATE_FORMAT(Positions.date_applied, "%m-%d-%Y") as date_applied_format, Positions.date_applied FROM Positions WHERE Positions.company_id=:companyID ORDER BY date_applied desc');
  $companyID = filter_var($companyID, FILTER_SANITIZE_NUMBER_INT);
  $sql->bindParam(':companyID', $companyID, PDO::PARAM_INT);
  $sql->execute();
  return $sql;
}

function getAllCompaniesPositionsCount() {
  $pdo = dbConnect();
  $sql = $pdo->prepare('SELECT Companies.id as c, Companies.name, COUNT(Positions.id) as count, (SELECT Positions.date_applied from Positions where Positions.company_id=c order by Positions.date_applied desc LIMIT 1) as last_date FROM Companies LEFT JOIN Positions on Companies.id=Positions.company_id GROUP BY Companies.id ORDER BY count DESC');
  $sql->execute();
  return $sql;
}

function getAllCompaniesPositionsCountFilter($query) {
  $pdo = dbConnect();

  $sql = $pdo->prepare('SELECT Companies.id as c, Companies.name, COUNT(Positions.id) as count, (SELECT Positions.date_applied from Positions where Positions.company_id=c order by Positions.date_applied desc LIMIT 1) as last_date FROM Companies LEFT JOIN Positions on Companies.id=Positions.company_id WHERE Companies.name like :query GROUP BY Companies.id ORDER BY count DESC');

  $query = "$query%";
  $query = filter_var($query, FILTER_SANITIZE_STRING);
  $sql->bindValue(':query', $query, PDO::PARAM_STR);
  $sql->execute();
  return $sql;
}

function printStatesSelection($selectedState) {
  $pdo = dbConnect();
  $sql = $pdo->prepare('SELECT * FROM States ORDER BY abbreviation asc');
  $sql->execute();

  while ($state = $sql->fetch(PDO::FETCH_ASSOC)) {

    $abbreviation = $state['abbreviation'];
    $name = $state['name'];

    if ($selectedState == $abbreviation) {
      echo "<option value=\"$abbreviation\" selected>$name</option>";
    } else {
      echo "<option value=\"$abbreviation\">$name</option>";
    }
  }
}

function updatePosition($positionID, $companyID, $data) {
  $pdo = dbConnect();
  // $sql = $pdo->prepare('INSERT INTO Positions(company_id, title, date_applied, address1, address2, city, state, zip, phone, source_found, notes) VALUES (:company_id, :title, :date_applied, :address1, :address2, :city, :state, :zip, :phone, :source_found, :notes)');

  $sql = $pdo->prepare('UPDATE Positions SET title=:title, company_id=:company_id, date_applied=:date_applied, address1=:address1, address2=:address2, city=:city, state=:state, zip=:zip, phone=:phone, source_found=:source_found, notes=:notes WHERE id=:positionID');

  $companyID     = filter_var($companyID, FILTER_SANITIZE_NUMBER_INT);
  $positionTitle = filter_var($data['position'], FILTER_SANITIZE_STRING);
  $date          = filter_var($data['date'], FILTER_SANITIZE_STRING);
  $address1      = filter_var($data['address1'], FILTER_SANITIZE_STRING);
  $address2      = filter_var($data['address2'], FILTER_SANITIZE_STRING);
  $city          = filter_var($data['city'], FILTER_SANITIZE_STRING);
  $state         = filter_var($data['state'], FILTER_SANITIZE_STRING);
  $zip           = filter_var($data['zip'], FILTER_SANITIZE_STRING);
  $phone         = filter_var($data['phone'], FILTER_SANITIZE_STRING);
  $source        = filter_var($data['source'], FILTER_SANITIZE_STRING);
  $notes         = filter_var($data['notes'], FILTER_SANITIZE_STRING);
  $positionID    = filter_var($positionID, FILTER_SANITIZE_NUMBER_INT);


  $sql->bindParam(':company_id', $companyID, PDO::PARAM_INT);
  $sql->bindParam(':title', $positionTitle, PDO::PARAM_STR);
  $sql->bindParam(':date_applied', $date, PDO::PARAM_STR);
  $sql->bindParam(':address1', $address1, PDO::PARAM_STR);
  $sql->bindParam(':address2', $address2, PDO::PARAM_STR);
  $sql->bindParam(':city', $city, PDO::PARAM_STR);
  $sql->bindParam(':state', $state, PDO::PARAM_STR);
  $sql->bindParam(':zip', $zip, PDO::PARAM_STR);
  $sql->bindParam(':phone', $phone, PDO::PARAM_STR);
  $sql->bindParam(':source_found', $source, PDO::PARAM_STR);
  $sql->bindParam(':notes', $notes, PDO::PARAM_STR);
  $sql->bindParam(':positionID', $positionID, PDO::PARAM_INT);

  $sql->execute();
}

function insertQuestion($question, $answer) {
  $pdo = dbConnect();
  // $sql = $pdo->prepare('UPDATE ListItems SET completed=:completed WHERE id=:id');
  $sql = $pdo->prepare('INSERT INTO Questions (question, answer) VALUES (:question, :answer)');

  // filter variables
  $question = filter_var($question, FILTER_SANITIZE_STRING);
  $answer = filter_var($answer, FILTER_SANITIZE_STRING);

  // bind the parameters
  $sql->bindParam(':question', $question, PDO::PARAM_STR);
  $sql->bindParam(':answer', $answer, PDO::PARAM_STR);

  // execute sql statement
  return $sql->execute();
}

function getQuestions() {
  $pdo = dbConnect();
  $sql = $pdo->prepare('SELECT * FROM Questions ORDER BY question asc');
  $sql->execute();
  return $sql;
}

function searchQuestions($query) {
  $pdo = dbConnect();

  $sql = $pdo->prepare('SELECT * FROM Questions WHERE question LIKE :query ORDER BY Question ASC');

  $query = "%$query%";
  $query = filter_var($query, FILTER_SANITIZE_STRING);
  $sql->bindValue(':query', $query, PDO::PARAM_STR);
  $sql->execute();
  return $sql;
}

function getHomePageData() {
  $pdo = dbConnect();
  $sql = $pdo->prepare('SELECT * FROM View_HomePage');
  $sql->execute();
  return $sql;
}

function getTopCompanyCount() {
  $pdo = dbConnect();
  $sql = $pdo->prepare('select Companies.id, Companies.name, count(Positions.id) as count from Companies, Positions where Companies.id=Positions.company_id GROUP by Companies.id ORDER by count desc limit 5');
  $sql->execute();
  return $sql;
}

function getAllPositions() {
  $pdo = dbConnect();
  $sql = $pdo->prepare('select Positions.id, Positions.title, date_format(Positions.date_applied, "%m-%d-%Y") as date_applied, Companies.name as company_name from Positions left join Companies on Positions.company_id=Companies.id group by Positions.id  ORDER BY `date_applied` DESC');
  $sql->execute();
  return $sql;
}

function getPositionsFromQuery($query) {
  $pdo = dbConnect();

  $sql = $pdo->prepare('select Positions.id, Positions.title, date_format(Positions.date_applied, "%m-%d-%Y") as date_applied, Companies.name as company_name from Positions left join Companies on Positions.company_id=Companies.id WHERE Positions.title like :query group by Positions.id ORDER BY `date_applied` DESC');

  $query = "$query%";
  $query = filter_var($query, FILTER_SANITIZE_STRING);
  $sql->bindValue(':query', $query, PDO::PARAM_STR);
  $sql->execute();
  return $sql;
}









?>
