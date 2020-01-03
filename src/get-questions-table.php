<?php

include_once('functions.php');
$questions = searchQuestions($_GET['q']);

while ($question = $questions->fetch(PDO::FETCH_ASSOC)) {
  printCard($question['question'], $question['answer']);
}






function printCard($question, $answer) {
  echo '<div class="card card-question">';
  echo '<div class="card-header">';
  echo "<h5>$question</5>";
  echo '</div><div class="card-body">';
  echo "<pre>$answer</pre>";
  echo '</div></div>';
}


?>
