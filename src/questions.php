<?php include('functions.php'); ?>

<?php

if (isset($_POST['question']) && isset($_POST['answer'])) {
  insertQuestion($_POST['question'], $_POST['answer']);
}

$questions = getQuestions();



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <?php include('header.php'); ?>
  <title>Questions</title>
</head>

<body>
  <?php include('navbar.php'); ?>

  <div class="container">

    <div class="row">

      <div class="col-md-6">
        <h2>Questions</h2>


        <input type="text" class="form-control" placeholder="Search"> <br>

        <table class="table table-sm table-striped">
          <thead>
            <tr>
              <th>Question</th>
              <th>Answer</th>
            </tr>
          </thead>

          <tbody>

            <?php

            while ($question = $questions->fetch(PDO::FETCH_ASSOC)) {
              echo '<tr>';
              echo '<td>' . $question['question'] . '</td>';
              echo '<td>' . $question['answer'] . '</td>';
              echo '</tr>';
            }
            ?>

          </tbody>
        </table>











      </div>


      <div class="col-md-6">
        <h2>New Question</h2>
        <form class="form" method="post">
          <input type="text" name="question" class="form-control" placeholder="Question">
          <textarea name="answer" rows="12" class="form-control" placeholder="Answer"></textarea>
          <input type="submit" value="Submit" class="btn btn-primary">
        </form>
      </div>


    </div>


  </div>

</body>

</html>
