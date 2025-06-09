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
        <a href="login.php" class="btn btn-success">Login</a>
        <h1>HKHK Spordipäev 2025</h1>


    <!-- $muuda_paring="UPDATE sport2025 SET full_name='Tommy Welbandd',
    email='uus@sadf.ee',age="11",gender="apach",category="uisutamine" Where id = 3"; -->
            
        </form>

   
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

                // $paring = "SELECT * FROM sport2025 LIMIT 50";
            $saada_paring = mysqli_query($yhendus, $paring);
            // võtab kõik read
            $kasutajad_lehel = 50;
            $kasutajad_kokku_paring = "SELECT COUNT('id') FROM sport2025";
            $lehtede_vastus = mysqli_query($yhendus, $kasutajad_kokku_paring);
            $kasutajad_kokku = mysqli_fetch_array($lehtede_vastus);
            $lehti_kokku = $kasutajad_kokku[0];
            $lehti_kokku = ceil($lehti_kokku/$kasutajad_lehel);

        

        
        $saada_paring = mysqli_query($yhendus, $paring);

        

                if (isset($_GET['page'])) {
                    $leht = $_GET['page'];
                } else {
                    $leht = 1;
                }
                //millest näitamist alustatakse
                $start = ($leht-1)*$kasutajad_lehel;

                if (isset($_GET["otsi"]) && !empty($_GET["otsi"])){
                    $s = $_GET["otsi"];
                    echo "Otsing: " .$s;?><br><?php
                    $cat = $_GET["cat"];
    
                    $paring = "SELECT * FROM sport2025 WHERE $cat LIKE '%$s%' LIMIT $start, $kasutajad_lehel";
     
                    $kasutajad_kokku_paring = "SELECT COUNT('id') FROM sport2025 WHERE $cat LIKE '%$s%'";
                    $lehtede_vastus = mysqli_query($yhendus, $kasutajad_kokku_paring);
                    $kasutajad_kokku = mysqli_fetch_array($lehtede_vastus);
                    $lehti_kokku = ceil($kasutajad_kokku[0] / $kasutajad_lehel);
                } else {
                    // Default query with pagination
                    $paring = "SELECT * FROM sport2025 LIMIT $start, $kasutajad_lehel";
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
                    echo "</tr>";
                    
                }

                //kuvame lingid
                $eelmine = $leht - 1;
                $jargmine = $leht + 1;
        

                if ($leht > 1) {
                    echo "<a href='?page=$eelmine'>←</a> ";
                }
                if ($lehti_kokku >= 1) {
                    for ($i = 1; $i <= $lehti_kokku; $i++) {
                        if ($i == $leht) {
                            echo "<b><a href='?page=$i'>$i</a></b> ";
                        } else {
                            echo "<a href='?page=$i'>$i</a> ";
                        }
                    }
                }
                if ($leht < $lehti_kokku) {
                    echo "<a href='?page=$jargmine'>→</a> ";
                    
                }
            ?>  
            </table>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</body>
    
</html>

