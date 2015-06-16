<?php
/**
 * @file index.php
 *
 * This is the landing page of the game.
 * @author Om Prakash <omprakash@incaendo.com>
 */

if (!file_exists('getConfig.php')) {
  header('location: helpers/installer.php');
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
  "http://www.w3.org/TR/html4/strict.dtd">

<html>
  <head>
    <title>Color Memory Game</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <h1>Color Memory Game</h1>
    <div style="color: red; font-size: 20px;">
      Score: <span id="game-score" style="font-weight: bold;"> 0</span>
    </div>
    <div id="playfield-wrapper">&nbsp;<div class="win-text">Win</div></div>
    <div id="openModal" class="modalDialog">
      <div>
        <a href="javascript:void(0)" title="Close" class="close">X</a>
        <h2>Save Score</h2>
        <p id="score-form-error" style="color: red; display: none;"></p>
        <div id="score-info" style="display: none;"></div>
        <p>Name: <input type="text" placeholder="Name" id="user-name" /></p>
        <p>Email: <input type="text" placeholder="Email" id="user-email" /></p>
        <p><input type="button" class="button" value="Save" id="save-score" /></p>
      </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/EventHandler.js"></script>
    <script type="text/javascript" src="js/scoreHandler.js"></script>
    <script type="text/javascript" src="js/MemoryGame.js"></script>
    <script type="text/javascript">
    </script>
  </body>
</html>
