<?php include("config.php")?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>document</title>
  </head>
  <body>

        <?php
  //         if (!empty($_POST['user']) && !empty($_POST['password'])) {
  //   $login = $_POST['user'];
  //   $pass = $_POST['password'];

  //   $paring = "SELECT * FROM users";
  //   $saada_paring = mysqli_query($yhendus, $paring);
  //   $rida = mysqli_fetch_assoc($saada_paring);
  //   print_r($rida);
  //   // $s = $rida["password"];
  // }
          // echo password_hash('admin', PASSWORD_DEFAULT);
session_start();
if (!isset($_SESSION['tuvastamine'])) {
  header('Location: login.php');
  exit();
  }

?>
<h1>Salajane info</h1>
<p>Salainfo</p>
<form action="logout.php" method="post">
	<input type="submit" value="Logi välja" name="logout">
</form>
  </body>
  </html>