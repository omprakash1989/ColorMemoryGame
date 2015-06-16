<?php
if (isset($_POST)) {
  $servername = trim($_POST['host']);
  $username = trim($_POST['user']);
  $password = trim($_POST['password']);

// Create connection
  try {
    $conn = new mysqli($servername, $username, $password);
  // Check connection
    if ($conn->connect_error) {
      header('location: installer.php?msg=credentials looks inappropriate. Please try again with correct credentials.');
    }
  } catch (Exception $e) {
    header('location: installer.php?msg=' . $e->getMessage());
  }

// Create database
  $db = 'memory_game';
  $sql = "CREATE DATABASE IF NOT EXISTS " . $db;
  if ($conn->query($sql) === TRUE) {
    $conn = new mysqli($servername, $username, $password, $db);
    $create_tbl = 'CREATE TABLE IF NOT EXISTS `cmg_score` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `email` varchar(225) NOT NULL,
      `name` varchar(225) NOT NULL,
      `score` int(11) NOT NULL,
      `timestamp` int(11) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
    $res = $conn->query($create_tbl);
    if ($res) {
      $content = '<?php
        define("DBHOST", "' . $servername . '");
        define("DBUSER", "' . $username . '");
        define("DBPASSWORD", "' . $password . '");
        define("DBNAME", "' . $db . '");
        ?>';
      $d = file_put_contents('../getConfig.php', $content);
      if ($d) {
        header('location: ../index.php');
      }
    }
  } else {
     header('location: installer.php?msg=' . $conn->error);
  }
  $conn->close();
}
