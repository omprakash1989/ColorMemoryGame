<?php

/**
 * ScoreHandler
 *
 * This class handles all the score manipulation.
 *
 * @author Om Prakash <oppradhan2011@gmail.com>
 * @copyright (c) 2015, Om Prakash
 *
 */

class ScoreHandler {

  public $name;
  public $email;
  public $score;
  public $handler;

  public function __construct() {
    
  }

  public function saveScore() {
    $saved = FALSE;
    try {
      $select = 'SELECT * FROM cmg_score WHERE email = "' . $this->email . '"';
      $query_obj = new QueryHandler();
      $result = $query_obj->dbQuery($select);
      if ($query_obj->dbNumRows($result) == 0) {
        $insert = 'INSERT INTO cmg_score (email, name, score, timestamp) VALUES ( "' . $this->email . '", "' . $this->name . '", ' . $this->score . ', ' . time() . ' )';
        $inserted = $query_obj->dbQuery($insert);
        if ($inserted) {
          $saved = TRUE;
        }
      } else {
        $data = $query_obj->dbFetchAssoc($result);
        if (isset($data['score']) && $data['score'] < $this->score) {
          $update = 'UPDATE cmg_score SET score = ' . $this->score . ', timestamp = ' . time() . ' WHERE email = "' . $this->email . '"';
          $updated = $query_obj->dbQuery($update);
          if ($updated) {
            $saved = TRUE;
          }
        } else {
          $saved = TRUE;
        }
      }
    } catch (Exception $e) {
      log('Error in saveScore function in ScoreHandler', $e->getMessage());
    }
    return $saved;
  }

  public function getScoreRanking() {
    $data = array(); 
    try {
      $query_obj = new QueryHandler();
      $select = 'SELECT score, FIND_IN_SET(score, (SELECT GROUP_CONCAT(score ORDER BY timestamp ASC) FROM cmg_score)) AS rank FROM cmg_score WHERE email =  "' . $this->email . '"';
      $result = $query_obj->dbQuery($select);
      $data = $query_obj->dbFetchAssoc($result);
      $select1 = 'SELECT max(score) as max FROM cmg_score';
      $result1 = $query_obj->dbQuery($select1);
      $max_score = $query_obj->dbFetchAssoc($result1);
      $data['max_score'] = $max_score['max'];
    } catch (Exception $e) {
      log('Error in saveScore function in getScoreRanking', $e->getMessage());
    }
    return $data;
  }

}

?>
