<?php include('functions.php'); ?>
<?php $companies = getAllCompaniesPositionsCount(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include('header.php'); ?>
    <title>Companies</title>
  </head>
  <body>
    <?php include('navbar.php'); ?>
    <div class="container">
      <h1>Companies</h1>

      <div class="card-deck">
        <?php
        $counter = 0;

          while ($company = $companies->fetch(PDO::FETCH_ASSOC)) {

            if ($counter == 3) {
              echo '</div>';
              echo '<div class="card-deck">';

              $counter = 0;
            }

            $companyName = $company['name'];
            $date = $company['last_date'];
            $count = $company['count'];
            $companyID = $company['c'];

            echo "<div class=\"card\">
              <div class=\"card-body\">
                <h4 class=\"card-title\">$companyName</h4>
                <p class=\"card-date\">$date</p>
                <p class=\"card-text\">Postions <span class=\"badge badge-primary\">$count</span></p>
                <a href=\"company.php?companyID=$companyID\">View</a>
              </div>
            </div>";

            $counter++;

          }
        ?>

      </div>

    </div>

  </body>
</html>
