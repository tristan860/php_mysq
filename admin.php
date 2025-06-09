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
    <form action="logout.php" method="post">
	<input type="submit" value="Logi välja" name="logout">
</form>
    <?php
      session_start();
      include("config.php");
      // var_dump($_SESSION);
      if (!isset($_SESSION['tuvastamine'])) {
      header('Location: logout.php');
      exit();
      }
    ?>

    <div class="container">
        <h1>HKHK Spordipäev 2025</h1>
    <?php

        if(isset($_GET["muuda"]) && isset($_GET["id"])){
                $id = $_GET["id"];
                $kuvaparing = "SELECT * FROM sport2025 WHERE id=".$id."";
                $saada_paring = mysqli_query($yhendus, $kuvaparing);
                $rida = mysqli_fetch_assoc($saada_paring);
                }
    ?>
                <?php
                if(isset($_GET["salvesta_muudatus"]) && isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $fullname = $_GET["full_name"];
                    $email = $_GET["email"];
                    $age = $_GET["age"];
                    $gender = $_GET["gender"];
                    $category = $_GET["category"];

                    $muuda_paring="UPDATE sport2025 SET full_name='".$fullname."',
                    email='".$email."',age='".$age."',gender='".$gender."',category='".$category."' Where id = ".$id."";

                    $saada_paring = mysqli_query($yhendus, $muuda_paring);
                    $tulemus = mysqli_affected_rows($yhendus);
	                if ($tulemus == 1) {
		                header('Location: admin.php?msg=Andmed uuendatud');
	                } else {
		                echo "Andmeid ei uuendatud";
	                }
                }
            ?>
        <form action="admin.php" method="get">
            <input type=hidden name="id" value="<?php !empty($rida['id']) ? print_r($rida['id']) : '' ?>" ><br>
            Nimi: <input type="text" name="full_name" required value="<?php !empty($rida['full_name']) ? print_r($rida['full_name']) : '' ?>" ><br>
            Email: <input type="email" name="email" required value="<?php !empty($rida['email']) ? print_r($rida['email']) : '' ?>"  ><br>
            Vanus: <input type="number" name="age" min="16" max="88" step="1" required value="<?php !empty($rida['age']) ? print_r($rida['age']) : '' ?>"  ><br>
            Sugu: <input type="text" name="gender"  required value="<?php !empty($rida['gender']) ? print_r($rida['gender']) : '' ?>"  ><br>
            Spordiala: <input type="text" name="category"  required value="<?php !empty($rida['category']) ? print_r($rida['category']) : '' ?>"  ><br>
            <?php if(isset($_GET["muuda"]) && isset($_GET["id"])){ ?>
                <input type="submit" value="Salvesta_muudatus" name="salvesta_muudatus" class="btn btn-success"><br>
            <?php }  else { ?>
                <input type="submit" value="Salvesta" name="salvesta" class="btn btn-primary"><br>
            <?php } ?>
            

    <!-- $muuda_paring="UPDATE sport2025 SET full_name='Tommy Welbandd',
    email='uus@sadf.ee',age="11",gender="apach",category="uisutamine" Where id = 3"; -->
            
        </form>

        <?php

        if (isset($_GET["salvesta"]) && !empty($_GET["full_name"])) {
            // INSERT INTO `sport2025` (`id`, `full_name`, `email`, `age`, `gender`, `category`, `reg_time`) VALUES (NULL, 'karineegreid', 'asdioasjhd@gmail.com', '27', 'Female', 'jooks', current_timestamp());
            $fullname = $_GET["full_name"];
            $email = $_GET["email"];
            $age = $_GET["age"];
            $gender = $_GET["gender"];
            $category = $_GET["category"];
            $lisa_paring = "INSERT INTO sport2025 (full_name,email,age,gender,category)
            VALUES ('".$fullname."','".$email."','".$age."','".$gender."','".$category."')";

            // print_r($lisa_paring);

            $saada_paring = mysqli_query($yhendus, $lisa_paring);

            $tulemus = mysqli_affected_rows($yhendus);
	        if ($tulemus == 1) {
		        echo "Kirje edukalt lisatud";
	        } else {
		        echo "Kirjet ei lisatud";
	        }
        }
        ?>

        <form action="admin.php" method="get" class="py-4">
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
                if(isset($_GET['msg'])){
                    echo "<tr><td><div class='alert alert-success'>".$_GET['msg']."</div></td></tr>";
                }
                if(isset($_GET['kustuta']) && isset($_GET['id'])){
                $id = $_GET["id"];
                $kparing = "DELETE FROM sport2025 WHERE id=".$id."";
                $saada_paring = mysqli_query($yhendus, $kparing);
                $tulemus = mysqli_affected_rows($yhendus);
                    if($tulemus == 1){
                        header('Location: admin.php?msg=Rida Kustutatud');
                    } else {
                        echo "kirjet ei kustutatud";
                    }
                }

                

                
                
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
                    echo "<td><a class='btn btn-success' href='?muuda&id=".$rida['id']."'>Muuda</a></td>";
                    echo "<td><a class='btn btn-danger' href='?kustuta=jah&id=".$rida['id']."'>Kustuta</a></td>";
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
<!-- if (!empty($_POST['user']) && !empty($_POST['password'])) {
$login = $_POST['user'];
$pass = $_POST['password'];

$paring = "SELECT * FROM users";
$saada_paring = mysqli_query($yhendus, $paring);
$rida = mysqli_fetch_assoc($saada_paring);
print_r($rida);
$s = $rida["password"];
}
echo password_hash('admin', PASSWORD_DEFAULT);
session_start();
if (!isset($_SESSION['tuvastamine'])) {
  header('Location: index.php');
  exit();
  } -->

  </body>
  </html>