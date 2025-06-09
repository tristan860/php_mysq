<?php
//sinu andmed
$db_server = 'localhost';
$db_andmebaas = 'sport';
$db_kasutaja = 'Tristan';
$db_salasona = 'Passw0rd';
$yhendus = mysqli_connect($db_server, $db_kasutaja, $db_salasona, $db_andmebaas)
?>
<?php setcookie("nimi", 0);?>