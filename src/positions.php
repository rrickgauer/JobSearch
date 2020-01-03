<?php include('functions.php'); ?>
<!DOCTYPE html>
<html>

<head>
	<?php include('header.php'); ?>
	<title>Positions</title>
</head>

<body>
	<?php include('navbar.php'); ?>

	<div class="container">

		<h1 class="custom-font">Positions</h1>


		<div class="input-group input-group-lg">
			<input type="text" class="form-control" placeholder="Search" autofocus>
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='bx bx-dots-horizontal-rounded'></i></button>
				<div class="dropdown-menu">
					<a href="add-position-page.php" class="dropdown-item"><i class='bx bx-plus'></i> New</a>
					<div role="separator" class="dropdown-divider"></div>
					<a class="dropdown-item"><i class='bx bx-table'></i> Table view</a>
					<a class="dropdown-item"><i class='bx bxs-collection'></i> Card view</a>
				</div>
			</div>
		</div>

		<div id="position-cards">

			<div class="card-deck">

				<?php

				$count = 0;

				$positions = getAllPositions();

				while ($position = $positions->fetch(PDO::FETCH_ASSOC)) {
					if ($count == 3) {
						echo '</div><div class="card-deck">';
						$count = 0;
					}

					echo '<div class="card">';
					echo '<div class="card-body">';
					echo '<h3>' . $position['title'] . '</h3>';
					echo '<p>' . $position['company_name'] . '</p>';
					echo '<p><span class="badge badge-primary">' . $position['date_applied'] . '</span></p>';
					echo '</div>';
					echo '</div>';
					$count++;
				}
				?>
			</div>
		</div>

	</div>

	<script>
		$(document).ready(function() {
			$("#positions-navbar-link").addClass('selected');
		});
	</script>
</body>

</html>

<?php

function getTableRow($row) {
  $id = $row['id'];
  $title = $row['title'];
  $date = $row['date_applied'];
  $companyName = $row['company_name'];
  $companyID = $row['company_id'];

  $positionCell = "<td>$title</td>";
  $companyCell =  "<td><a href=\"company.php?companyID=$companyID\">$companyName</a></td>";
  $dateCell = "<td>$date</td>";
  $detailsCell =  "<td><a href=\"position.php?positionID=$id\" target=\"_blank\"><i class='bx bx-link-external'></i></a></td>";

  return '<tr>' . $positionCell . $companyCell . $dateCell . $detailsCell . '</tr>';

}




?>
