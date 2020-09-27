<?php
    session_start();

    require "../connexion.php"; 

    if(!isset($_SESSION['login'])){
        header ('LOCATION:403.php');
    }

    if(isset($_GET['deco'])){
        session_destroy();
        header('LOCATION:index.php');
    }

    if(isset($_GET['delete'])){
       
        if(!empty($don['image'])){
            unlink("../images/".$don['image']);
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
    
    <title>Administration</title>
</head>
<body>
    <div class="container">
        
            <h1>Administration</h1>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Titre</th>
                        <th>Edition</th>
                        <th>Genre</th>
                        <th>Image</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        
                        $req = $bdd->query("SELECT * FROM manga");

                        while($don = $req->fetch()){
                            
                            $id = $don['id'];
                            $title = $don['titre'];
                            $editor = $don['edition'];
                            $type = $don['genre'];
                            $img = $don['image'];
                            $descri = $don['description'];
                    
                            echo "<tr>
                                <td>$id</td>
                                <td>$title</td>
                                <td>$editor</td>
                                <td>$type</td>
                                <td>$img</td>
                                <td class=\"d-inline-block text-truncate\" style=\"max-width:300px;max-height:100px;\">$descri</td>
                                <td>
                                    <a href=\"updateManga.php?id=$id\" class=\"btn btn-warning\">Modifier</a>
                                    <a href=\"deleteManga.php?delete=$id\" class=\"btn btn-danger\">Supprimer</a>
                                </td>
                            
                            </tr>";
                        }    
                    ?>
                </tbody>
            </table>


            <a href="addManga.php" class="btn btn-success">Ajouter un manga</a>
            <a href="../index.php" class="btn btn-info">Retour au site</a>
            <a href="admin.php?deco=ok" class="btn btn-secondary">Deconnexion</a>  
       
       
    </div>

    
</body>
</html>