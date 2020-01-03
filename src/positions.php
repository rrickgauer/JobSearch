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

			<!-- position search input -->
			<input type="text" class="form-control" placeholder="Search" autofocus id="position-search-input">

			<!-- dropdown menu -->
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='bx bx-dots-horizontal-rounded'></i></button>
				<div class="dropdown-menu">
					<a href="add-position-page.php" class="dropdown-item"><i class='bx bx-plus'></i> New</a>
					<div role="separator" class="dropdown-divider"></div>
					<a class="dropdown-item" onclick="setView('table')"><i class='bx bx-table'></i> Table view</a>
					<a class="dropdown-item" onclick="setView('card')"><i class='bx bxs-collection'></i> Card view</a>
				</div>
			</div>

		</div>

		<!-- see get-positions.php -->
		<div id="position-cards">


		</div>

	</div>

	<script>

	var displayView = 'card';

		$(document).ready(function() {

			// set the positions navbar page to active
			$("#positions-navbar-link").addClass('selected');

			// search for all positions
			searchPositions('');

			// search for positions when user enters text into search input
			$("#position-search-input").on('keyup', function() {
				var query = $("#position-search-input").val();
				searchPositions(query);
			});
		});

		function searchPositions(query) {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var e = this.responseText;
					$("#position-cards").html(e);
				}
			};

			var link = 'get-positions.php?query=' + query + '&display=' + displayView;
			xhttp.open("GET", link, true);
			xhttp.send();
		}

		function gotoPositionPage(positionID) {
			window.location.href = 'position.php?positionID=' + positionID;
		}

		function setView(type) {
			displayView = type;
			searchPositions($("#position-search-input").val());
		}

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
