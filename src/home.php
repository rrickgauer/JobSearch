<?php
include('functions.php');
$data = getHomePageData();
$data = $data->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<?php include('header.php'); ?>
	<title>Job Search</title>
</head>

<body>
	<?php include('navbar.php'); ?>
	<div class="container">
		<h1>Home</h1>

		<div class="card-deck">

			<!-- positions count -->
			<div class="card card-summary">
				<div class="card-body">
					<div class="row">
						<div class="col-3">
							<i class='bx bx-detail'></i>
						</div>
						<div class="col-9">
							<h3><?php echo $data['positionsCount']; ?></h3>
							<p>Positions</p>
						</div>

					</div>
				</div>
			</div>

			<!-- companies count -->
			<div class="card card-summary">
				<div class="card-body">
					<div class="row">
						<div class="col-3">
							<i class='bx bx-buildings'></i>
						</div>
						<div class="col-9">
							<h3><?php echo $data['companiesCount']; ?></h3>
							<p>Companies</p>
						</div>
					</div>
				</div>
			</div>

			<!-- recent date -->
			<div class="card card-summary">
				<div class="card-body">
					<div class="row">
						<div class="col-3">
							<i class='bx bx-calendar-event'></i>
						</div>
						<div class="col-9">
							<h5><?php echo $data['recentDate']; ?></h5>
							<p>Last application</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">

				<div class="card card-home">

					<div class="card-header">
						<h3>Top companies</h3>
					</div>

					<div class="card-body">
						<table class="table table-sm">
							<tbody>
								<?php
                $topCompanies = getTopCompanyCount();
                while ($company = $topCompanies->fetch(PDO::FETCH_ASSOC)) {
                  $id = $company['id'];
                  $name = $company['name'];
                  $count = $company['count'];
                  echo '<tr>';
                  echo "<td><a href=\"company.php?companyID=$id\">$name</a></td>";
                  echo '<td><span class="badge badge-secondary">' . $company['count'] . '</span></td>';
                  echo '</tr>';
                }
                ?>
							</tbody>

						</table>
					</div>
				</div>

			</div>

		</div>

	</div>

	<script>
		$(document).ready(function() {

			$("#home-navbar-link").addClass('selected');

		});
	</script>



</body>

</html>
