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

    <div class="input-group input-group-lg">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class='bx bx-search'></i></span>
      </div>
      <input id="searchInput" type="text" class="form-control" placeholder="Search" autofocus>
    </div>

    <div id="company-cards">

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

  </div>

  <script>
    $(document).ready(function() {

      $('#searchInput').on('keyup', function() {
        updateCompanyCards($('#searchInput').val());
      });
    });


    function updateCompanyCards(query) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var e = this.responseText;
          $("#company-cards").html(e);
        }
      };

      xhttp.open("GET", "get-company-cards.php?q=" + query, true);
      xhttp.send();
    }
  </script>

</body>

</html>
