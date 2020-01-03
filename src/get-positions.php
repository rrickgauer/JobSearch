<div class="card-deck">

<?php
include_once('functions.php');
$positions = getPositionsFromQuery($_GET['query']);
$count = 0;

while ($position = $positions->fetch(PDO::FETCH_ASSOC)) {
	if ($count == 3) {
		echo '</div><div class="card-deck">';
		$count = 0;
	}

	$positionID = $position['id'];

	echo "<div class=\"card position-card\" onclick=\"gotoPositionPage($positionID)\">";
	echo '<div class="card-body">';
	echo '<h3>' . $position['title'] . '</h3>';
	echo '<p><span class="badge badge-secondary">' . $position['company_name'] . '</span>' . ' <span class="badge badge-light">' . $position['date_applied'] . '</span></p>';
	echo '</div>';
	echo '</div>';
	$count++;
}
?>

</div>
