<?php

include_once('functions.php');

$pdo = dbConnect();

$sql = $pdo->prepare('SELECT * FROM States');
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

?>
