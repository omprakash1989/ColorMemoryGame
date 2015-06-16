<?php
/**
 * installer.php
 *
 * This class handles the installation of the application.
 *
 * @author Om Prakash <oppradhan2011@gmail.com>
 * @copyright (c) 2015, Om Prakash
 *
 */

$msg = '';
if (isset($_GET['msg']) && $_GET['msg'] != '') {
  $msg = $_GET['msg'];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
  "http://www.w3.org/TR/html4/strict.dtd">

<html>
  <head>
    <title>Color Memory Game Installer</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="../style.css">
  </head>
  <body>
    <h1>Color Memory Game Installer</h1>
    <?php if ($msg != '') { ?>
    <p style="color: red"> <?php echo stripcslashes($msg); ?></p>
    <?php } ?>
    <div>
      <h2>Fill Details</h2>
      <form action="install.php" method="post">
        <p>Database host: <input type="text" value="localhost" name="host" placeholder="Host" style="margin-left: 5px;" /></p>
        <p>Database user: <input type="text" placeholder="usename"  name="user" id="user-email" /></p>
        <p>Database pass: <input type="text" placeholder="password"  name="password" id="user-email" /></p>
        <p><input type="submit" class="button" value="Go" id="save-score" /></p>
      </form>
    </div>
  </body>
</html>
