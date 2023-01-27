<?php 
require_once 'baglan.php'; 
if(!isset($_SESSION['anasayfadil'])){
    $_SESSION['anasayfadil'] = 1;
}
if(isset($_GET['dildegistir'])){
    $dil = $_GET['dildegistir'];
    $_SESSION['anasayfadil'] = $dil;
    header('Location:'.$_SERVER['HTTP_REFERER']);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Dinamik Dil Uygulaması</title>
  </head>
  <body>
    <div class="container">
        <div class="dropdown mt-5 mb-5">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                Dil Seçin
            </button>
            <div class="dropdown-menu">
                <?php
                    $diller = $db->prepare("SELECT * FROM diller");
                    $diller->execute();
                    if($diller->rowCount()){
                        foreach($diller as $row){
                            ?>
                            <a class="dropdown-item" href="index.php?dildegistir=<?= $row['dil_id'] ?>"><img src="bayrak/<?= $row['dil_bayrak'] ?>" width="10%" alt="logo"> <?= $row['dil_ad'] ?></a>
                            <?php
                        }
                    }else{

                    }
                ?>
                
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <th>ID</th>
                <th>BAŞLIK</th>
                <th>SEF</th>
                <th>İÇERİK</th>
            </thead>
            <tbody>
                <?php
                    $konular = $db->prepare("select * from konular where dil_id=:id");
                    $konular->execute([':id'=>$_SESSION['anasayfadil']]);
                    if($konular->rowCount()){
                        foreach($konular as $row){
                            ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <td><?= $row['baslik']; ?></td>
                                <td><?= $row['sef']; ?></td>
                                <td><?= $row['icerik']; ?></td>
                            </tr>

                            <?php
                        }
                    }else{
                        echo "<div class='alert alert-danger'>Bu Dile Ait İçerik Yok</div>";
                    }
                ?>
            </tbody>
        </table>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>