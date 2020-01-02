<?php

include_once('functions.php');

$questions = searchQuestions($_GET['q']);

while ($question = $questions->fetch(PDO::FETCH_ASSOC)) {
	echo '<tr>';
	echo '<td>' . $question['question'] . '</td>';
	echo '<td><textarea class="form-control" rows="5">' . $question['answer'] . '</textarea></td>';
	echo '</tr>';
}











?>
