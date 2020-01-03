<?php
include_once('functions.php');
$positions = getPositionsFromQuery($_GET['query']);

if (isset($_GET['display']) && $_GET['display'] == 'table') {
	printTable($positions);
} else {
	printCards($positions);
}

?>



<?php

function printCards($positions) {
	echo '<div class="card-deck">';

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

	echo '</div>';
}

function printTable($positions) {
	echo '<table class="table table-sm">
		<thead>
			<tr>
				<th>Position</th>
				<th>Company</th>
				<th>Date Applied</th>
			</tr>
		</thead>
		<tbody>';

		while ($position = $positions->fetch(PDO::FETCH_ASSOC)) {
			$positionID = $position['id'];
			$companyID = $position['company_id'];
			$positionTitle = $position['title'];
			$dateApplied = $position['date_applied'];
			$companyName = $position['company_name'];

			echo '<tr>';
			echo "<td><a href=\"position.php?positionID=$positionID\">$positionTitle</a></td>";
			echo "<td><a href=\"company.php?companyID=$companyID\">$companyName</a></td>";
			echo '<td>' . $position['date_applied'] . '</td>';
			echo '</tr>';
		}



echo '</tbody></table>';

}

?>
