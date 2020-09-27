
<?php
    session_start();

    require ('../connexion.php');

    if(!isset($_SESSION['login'])){
        header("LOCATION:index.php");
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Gestion - Ajouter</title>
</head>
<body>
    <div class="container">
        <h1>Ajouter un manga</h1>

        <form action="treatmentAddManga.php" method="POST" enctype="multipart/form-data">
           
            <div class="form-group">
                <label for="titre">Titre: </label>
                <input type="texte" id="titre" name="titre" class="form-control">
            </div>
            <div class="form-group">
                <label for="edition">Edition: </label>
                <input type="texte" id="edition" name="edition" class="form-control">
            </div>
            <div class="form-group">
                <label for="genre">Genre: </label>
                <input type="texte" id="genre" name="genre" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description: </label>
                <textarea name="description" id="description" name="description" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image: </label>
                <input type="file" name="image" id="image" name="image" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="Ajouter" class="btn btn-primary my-3">
                <a href="admin.php" class="btn btn-secondary my-3 mx-1">Retour</a>
            </div>
    
        </form>
    </div>
</body>
</html>