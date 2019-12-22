<?php include('functions.php'); ?>

<?php

// go to home.php if get[positionID] is not set
if (!isset($_GET['positionID']) || !doesPositionExist($_GET['positionID'])) {
	header('Location: home.php');
	exit;
} else {
	$position = getFormattedPositionData($_GET['positionID'])->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html>
<head>
	<?php include('header.php'); ?>
	<title>Position</title>
</head>
<body>
	<?php include('navbar.php'); ?>

	<div class="container">

		<h1><?php echo $position['title']; ?></h1>

		<table class="table">

			<tr>
				<th>Position ID</th>
				<td><?php echo $position['id']; ?></td>
			</tr>

			<tr>
				<th>Company</th>
				<td>
					<a href="companies.php?companyID=<?php echo $position['company_id']; ?>">
						<?php echo $position['company_name']; ?>
					</a>
				</td>
			</tr>

			<tr>
				<th>Date Applied</th>
				<td><?php echo $position['date_applied_display']; ?></td>
			</tr>

			<tr>
				<th>Address</th>
				<td>

					<?php

					if (strlen($position['address1']) > 0) {
						echo $position['address1'] . ',<br>';
					}

					if (strlen($position['address2']) > 0) {
						echo $position['address2'] . ',<br>';
					}

					echo $position['city'] . ', ' . $position['state'] . ', ' . $position['zip'];
					?>
					

				</td>
			</tr>

			<tr>
				<th>Phone</th>
				<td><?php echo $position['phone']; ?></td>
			</tr>

			<tr>
				<th>Source</th>
				<td><?php echo $position['source_found']; ?></td>
			</tr>

			<tr>
				<th>Notes</th>
				<td>
					<textarea class="form-control" rows="5"><?php echo $position['notes']; ?></textarea>
						
				</td>
			</tr>
		</table>

	</div>

</body>
</html>

<?php

function getPositionTableRow($header, $value) {
	return "<tr><th>$header</th><td>$value</td></tr>";
}

?>