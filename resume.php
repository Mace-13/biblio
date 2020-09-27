<?php

if(isset($_GET['id'])){
    require ('connexion.php');

    $id=htmlspecialchars($_GET['id']);

    $req = $bdd->prepare('SELECT * FROM manga WHERE id=?');
   

     $req->execute([$id]);

    if(!$don = $req->fetch()){
        header ('LOCATION:404.php');
    }
    $req->closeCursor();
}else{
    header ('LOCATION:index.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
   
    <title>Resume</title>
</head>
<body class='h-100'>
   <div class="container">
        <div class="row d-flex flex-column ">

            <?php
                if(empty($don['image'])){
                    echo "pas d'image";
                }else{
                    echo "<img class='d-flex h-100 align-self-center mt-5' src='images/".$don['image']."' style='width:350px;height:450px;'>";
                }  
            ?>

            <h1 class="mt-3"><?= $don['titre'] ?></h1>
            <h2>Edition : <?= $don['edition'] ?></h2>
            <h4>Genre : <?= $don['genre'] ?></h4>
            <p class="d-flex h-100 mt-3 text-justify"><?= nl2br($don['description']) ?></p>
            <a href="index.php" class="btn btn-info" style="width:200px;height:40px;">Retour</a>
        </div>
   </div>
</body>
</html>