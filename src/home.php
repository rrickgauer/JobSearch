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
			<div class="card">
				<div class="card-body">
					<h3><i class='bx bx-detail'></i> <?php echo $data['positionsCount']; ?></h3>
					<p>Positions</p>
				</div>
			</div>

      <!-- companies count -->
			<div class="card">
				<div class="card-body">
					<h3><i class='bx bx-buildings'></i> <?php echo $data['companiesCount']; ?></h3>
					<p>Companies</p>
				</div>
			</div>

      <!-- recent date -->
			<div class="card">
				<div class="card-body">
					<h3><i class='bx bx-calendar-event'></i> <?php echo $data['recentDate']; ?></h3>
					<p>Last application</p>
				</div>
			</div>



		</div>










	</div>
</body>

</html>
