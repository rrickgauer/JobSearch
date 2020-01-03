<?php

include_once('functions.php');
$questions = searchQuestions($_GET['q']);

while ($question = $questions->fetch(PDO::FETCH_ASSOC)) {
  printCard($question['id'], $question['question'], $question['answer']);
}


function printCard($id, $question, $answer) {
  echo '<div class="card card-question">';
  echo '<div class="card-header">';
  echo "<h5>$question</h5>";
  echo '</div><div class="card-body">';
  echo "<pre>$answer</pre>";
  echo '</div>';
  echo '<div class="card-footer">';
  echo "<a href=\"edit-question.php?questionID=$id\"><i class=\"bx bx-edit\"></i></a>";
  echo '</div></div>';
}


?>
