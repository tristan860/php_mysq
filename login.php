<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>document</title>
  </head>
  <body>
  <?php
  	session_start();
	include("config.php");?>
	<?php
	if (isset($_SESSION['tuvastamine'])) {
	  header('Location: admin.php');
	  exit();
	  }
	if (!empty($_POST['login']) && !empty($_POST['pass'])) {


		$login = htmlspecialchars(trim($_POST['login']));
		$pass = htmlspecialchars(trim($_POST['pass']));

		$paring = "SELECT * FROM users WHERE user='$login'";
      	$valjund = mysqli_query($yhendus, $paring);

		if ($valjund && mysqli_num_rows($valjund) == 1) {
			$user = mysqli_fetch_assoc($valjund);
			if (password_verify($pass, $user['password'])) {
				$_SESSION['tuvastamine'] = 'misiganes';
				header('Location: admin.php');
				exit();
			} else {
				echo "kasutaja või parool on vale";
			}
}
}
?>
<h1>Login</h1>
<form action="" method="post">
	Login: <input type="text" name="login"><br>
	Password: <input type="password" name="pass"><br>
	<input type="submit" value="Logi sisse">
</form>
</body>
</html>