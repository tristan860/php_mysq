<?php include("config.php")?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spordipäev 2025</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">
        <h1>HKHK Spordipäev 2025</h1>

        <form action="index.php" method="get">
            Nimi: <input type="text" name="full_name"><br>
            Email: <input type="email" name="email"><br>
            Vanus: <input type="number" name="age" min="16" max="88" step="1"><br>
            Sugu: <input type="text" name="gender" limit="5"><br>
            Spordiala: <input type="text" name="category" limit="20"><br>
            <input type="submit" value="Salvesta" class="btn btn-primary"><br>
        </form>
        <?php
        if (isset($_GET["full_name"]) && !empty($_GET["full_name"])) {
            // INSERT INTO `sport2025` (`id`, `full_name`, `email`, `age`, `gender`, `category`, `reg_time`) VALUES (NULL, 'karineegreid', 'asdioasjhd@gmail.com', '27', 'Female', 'jooks', current_timestamp());
            $lisa_paring = "INSERT INTO sport2025 (full_name,email,age,gender,category)
            VALUES ('karin eegreid','asdiasdasdadssdaoasjhd@gmail.com','27','Female','jooks')";
            $saada_paring = mysqli_query($yhendus, $lisa_paring);

            $tulemus = mysqli_affected_rows($yhendus);
	        if ($tulemus == 1) {
		        echo "Kirje edukalt lisatud";
	        } else {
		        echo "Kirjet ei lisatud";
	        }
        }
        ?>

        <form action="index.php" method="get" class="py-4">
            <input type="text" name="otsi">
            <select name="cat">
                <option value="full_name">Nimi</option>
                <option value="category">Spordiala</option>
            </select>
            <input type="submit" value="Otsi...">
        </form> 
        <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>full_name</th>
            <th>email</th>
            <th>age</th>
            <th>gender</th>
            <th>category</th>
            <th>reg_time</th>
            <th>Muuda</th>
            <th>Kustuta</th>
        </tr>
            <?php
                if(isset($_GET["otsi"]) && !empty($_GET["otsi"])) {
                    $s = $_GET["otsi"];
                    $cat = $_GET["cat"];
                    echo "Otsing: ".$s;
                    $paring = 'SELECT * FROM sport2025 WHERE '.$cat.' LIKE "%'.$s.'%"';
                    // var_dump($paring);
                } else {
                    $paring = "SELECT * FROM sport2025 Limit 50";

                }
                $saada_paring = mysqli_query($yhendus, $paring);
                //võtab KÕIK read
                //assoc annab nimelised väljad
                while($rida = mysqli_fetch_assoc($saada_paring)){
                    // print_r($rida["full_name"]);
                    echo "<tr>";
                    echo "<td>".$rida['id']."</td>";
                    echo "<td>".$rida['full_name']."</td>";
                    echo "<td>".$rida['email']."</td>";
                    echo "<td>".$rida['age']."</td>";
                    echo "<td>".$rida['gender']."</td>";
                    echo "<td>".$rida['category']."</td>";
                    echo "<td>".$rida['reg_time']."</td>";
                    echo "<td><a class='btn btn-success' href=''>Muuda</a></td>";
                    echo "<td><a class='btn btn-danger' href=''>Muuda</a></td>";
                    echo "</tr>";
                    
                }
            ?>  
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>