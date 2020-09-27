<?php
 require "connexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    
    <title>Bibliothèque</title>
</head>
<body>
    <nav class="nav">
        <a href="admin/index.php" class="nav-link btn btn-primary mt-4 ml-4">Connexion</a>
    </nav>
    
    <h1 class="col-12 p-5 text-center">Bibliothèque</h1>
    
    <div class="container">
        <div class="row">
       
            <?php

                $req = $bdd->query("SELECT * FROM manga ORDER BY titre");

                while($don = $req->fetch()){
                    
                    $id = $don['id'];
                    $title = $don['titre'];
                    $editor = $don['edition'];
                    $type = $don['genre'];
                    $img = $don['image'];
                    $descri = $don['description'];

                    echo "<div class=\"card mb-3 d-flex flex-row\" style=\"width:100%;height:200px;\">
                            
                                <div class=\"col-md-2\">
                                    <img src=\"images\\$img\" class=\"card-img\" alt=\"$img\" style=\"width:150px;height:197px;\">
                                </div>
                                <div class=\"col-md-10 d-flex\">
                                    <div class=\"card-body \">
                                        <h5 class=\"card-title d-flex justify-content-start\">$title</h5>
                                    </div>
                                    <a href=\"resume.php?id=$id\" class=\"btn btn-info justify-content-center align-self-end\">See more</a>
                                </div>
                                
                            </div>";
                }
            
            ?>
        </div>
    </div>
</body>
</html>