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
	if (isset($_SESSION['tuvastamine'])) {
	  header('Location: admin.php');
	  exit();
	  }
	if (!empty($_POST['login']) && !empty($_POST['pass'])) {
		$login = $_POST['login'];
		$pass = $_POST['pass'];
		if ($login=='admin' && $pass=='admin') {
			$_SESSION['tuvastamine'] = 'misiganes';
			header('Location: admin.php');
		}
	}

		if (!empty($_POST['user']) && !empty($_POST['password'])) {
		var_dump("mingi jama");

			$paring = "SELECT * FROM users";
			$saada_paring = mysqli_query($yhendus, $paring);
			$rida = mysqli_fetch_assoc($saada_paring);
    		print_r($rida);
    		$s = $rida["password"];
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