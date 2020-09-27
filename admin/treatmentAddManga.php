<?php

    session_start();

    if(!isset($_SESSION['login'])){
        header ('LOCATION:403.php');
    }

    if(isset($_POST['titre'])){
        $err=0;

        if(!empty($_POST['titre'])){
            $title=htmlspecialchars($_POST['titre']);
        }else{
            $err=1;
        }

        if(!empty($_POST['edition'])){
            $editor=htmlspecialchars($_POST['edition']);
        }else{
            $err=2;
        }

        if(!empty($_POST['genre'])){
            $type=htmlspecialchars($_POST['genre']);
        }else{
            $err=3;
        }

        if(!empty($_POST['description'])){
            $descri=htmlspecialchars($_POST['description']);
        }else{
            $err=4;
        }



        //test en cas d'erreur 

        if($err==0){
            require ('../connexion.php');

            if(empty($_FILES['image']['tmp_name'])){
                $insert=$bdd->prepare('INSERT INTO manga(titre,edition,genre,description) VALUES(:titre,:edition,:genre,:descri)');
                $insert->execute([
                    ":titre"=>$title,
                    ":edition"=>$editor,
                    ":genre"=>$type,
                    ":descri"=>$descri
                ]);
                $insert->closeCursor();
                header ('LOCATION:admin.php?insert=success');
            }else{
                $dossier = '../images/'; 
                $fichier = basename($_FILES['image']['name']); 
                $taille_maxi = 2000000;
                $taille = filesize($_FILES['image']['tmp_name']); 
                $extensions = ['.png','.jpg','.jpeg']; 
                $extension = strrchr($_FILES['image']['name'], '.');

                if(!in_array($extension, $extensions)){
                    $erreur= 'Vous devez uploader un fichier de type png, jpg, jpeg';
                }

                if($taille>$taille_maxi){
                    $erreur='Le fichier dépasse la taille autorisée';
                }

                if(!isset($erreur)){
                    $fichier = strtr($fichier, 
                        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier); 
                    $fichiercptl=rand().$fichier;
                    
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichiercptl)){
                        $insert = $bdd->prepare('INSERT INTO manga(titre,edition,genre,image,description) VALUES(:titre,:edition,:genre,:image,:descri)');
                        $insert->execute([
                            ":titre"=>$title,
                            ":edition"=>$editor,
                            ":genre"=>$type,
                            ":image"=>$fichiercptl,
                            ":descri"=>$descri
                        ]);
                        $insert->closeCursor();

                        if($extension==".png"){
                            header("LOCATION:redimpng.php?image=".$fichiercptl);
                        }else{
                            header("LOCATION:redim.php?image=".$fichiercptl);
                        }

                    }else{
                        header('LOCATION:addManga.php?error=1&upload=echec');
                    }
                }else{
                    header("LOCATION:addManga.php?error=1&fich=".$erreur);
                }
            }
        }else{
                header("LOCATION:addManga.php?err=".$err);
            }
    }else{
        header("LOCATION:addManga.php");
    }



?>