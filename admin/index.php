<?php

session_start();

if(isset($_SESSION['login'])){
    header ('LOCATION:admin.php');
}

$error="";

if(isset($_POST['login'])){
    if($_POST['login']=='' || $_POST['password']==''){
        $error="Veuillez remplir le formulaire";
    }else{
        require ('../connexion.php');

        $login=htmlspecialchars($_POST['login']);
        $password=htmlspecialchars($_POST['password']);

        $req = $bdd->prepare('SELECT * FROM admin WHERE login=?');
        $req->execute([$login]);

        if($don=$req->fetch()){
            if(password_verify($password,$don['password'])){

                $_SESSION['login']=$don['login'];
                $_SESSION['password']=$don['password'];
                header ('LOCATION:admin.php');
            }else{
                $error="Votre mot de passe est incorrect";
            }
        }else{
            $error="Votre login n'existe pas";
        }
        $req->closeCursor();
    }
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
<body class="h-100">
<div class="row">
    
    <div class="col-4 offset-1 justify-content-center">
        <h1>Administration</h1>
        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="log">Login :</label>
                <input type="text" class="form-control" value="" id="login" name="login" placeholder="Votre login">
                
            </div>
            <div class="form-group">
                <label for="pass">Mot de passe :</label>
                <input type="password" class="form-control" value="" id="password" name="password" placeholder="Votre mot de passe">
                <?php
                echo "<div class='error mt-3 text-danger'>$error</div>"
                ?>
            </div>
            <div class="form-group">
                <input type="submit" value="connexion" class="btn btn-primary">
            </div>
        
        
        </form>
    </div>

</div> 
    
</body>
</html>