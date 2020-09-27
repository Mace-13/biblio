<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header("LOCATION:403.php");
    }

    if(isset($_GET['id'])){
        $id=htmlspecialchars($_GET['id']);
        require "../connexion.php";
      
        $req=$bdd->prepare("SELECT * FROM manga WHERE id=?");
        $req->execute([$id]);
     
        if(!$don=$req->fetch()){
            header("LOCATION:admin.php"); 
        }

        $req->closeCursor();

    }else{
        header("LOCATION:admin.php");
    }

    
    if(isset($_GET['delete'])){
       
        if(!empty($don['image'])){
            unlink("../images/".$don['image']);
            unlink("../images/mini_".$don['image']);
        }
        
        $delete=$bdd->prepare("DELETE FROM manga WHERE id=?");
        $delete->execute([$id]);
        $delete->closeCursor();
        header("LOCATION:admin.php?delete=success");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <h1>Supprimer? <?= $don['titre'] ?></h1>
  
    <h2><a href="deleteManga.php?id=<?= $don['id'] ?>&delete=accept" class="btn btn-success">Oui</a></h2>
    <h2><a href="admin.php" class="btn btn-danger">Non</a></h2>


</body>
</html>