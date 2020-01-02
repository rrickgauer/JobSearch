<?php

include_once('functions.php');



$companies = getAllCompaniesPositionsCountFilter($_GET['q']);

echo '<div class="card-deck">';

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

    echo
    "<div class=\"card\" onclick=\"gotoCompany($companyID)\">
      <div class=\"card-header\">
        <h4 class=\"card-title\">$companyName</h4>
      </div>
      <div class=\"card-body\">
        <p class=\"card-text\"><span class=\"badge badge-secondary outer\">Postions <span class=\"badge badge-pill badge-info\"> $count</span></span></p>
        <p class=\"card-date\"><span class=\"badge badge-primary outer\">Activity <span class=\"badge badge-pill badge-light\"> $date</span></span></p>
      </div>
      <div class=\"card-footer\">
        <a href=\"company.php?companyID=$companyID\">View</a>
      </div>
    </div>";

    $counter++;

  }

  echo '</div>';

?>
