<?php
/**
 * score.php
 *
 * This is the file which handles the ajax request for score and rank calculation.
 * It serves for ajax request.
 * @author Om Prakash <oppradhan2011@gmail.com>
 * @copyright (c) 2015, Om Prakash
 */

include_once 'lib/Config.php';
if (isset($_POST) && isset($_POST['email']) && isset($_POST['name'])) {
  $score_obj = new ScoreHandler();
  $score_obj->email = strtolower(trim($_POST['email']));
  $score_obj->name = trim($_POST['name']);
  $score_obj->score = $_POST['score'];
  $saved = $score_obj->saveScore();
  if ($saved) {
    $data = $score_obj->getScoreRanking();
  }
  echo json_encode($data);
  die();
}

