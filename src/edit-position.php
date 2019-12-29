<?php
include_once('functions.php');
$companyID = getCompanyID($_POST['company']);
updatePosition($_GET['positionID'], $companyID, $_POST);
header('Location: position.php?positionID=' . $_GET['positionID']);
exit;
?>
