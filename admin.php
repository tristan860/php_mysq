<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>document</title>
  </head>
  <body>
        <h1>Salajane</h1>

        <?php
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