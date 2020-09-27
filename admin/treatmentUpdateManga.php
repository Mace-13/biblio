<?php 
    session_start();
  
    if(!isset($_SESSION['login'])){
        header("LOCATION:403.php");
    }


    if(isset($_GET['id'])){
        $id=htmlspecialchars($_GET['id']); 
    }else{
        header("LOCATION:admin.php");
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
            $description=htmlspecialchars($_POST['description']);
        }else{
            $err=4;
        }



       
        if($err==0){
            require "../connexion.php";
            if(empty($_FILES['image']['tmp_name'])){
                
                $upload = $bdd->prepare("UPDATE manga SET titre=:titre, edition=:edition,genre=:genre,description=:descri WHERE id=:myid");
                $upload->execute([
                    ":titre"=>$title,
                    ":edition"=>$editor,
                    ":genre"=>$type,
                    ":descri"=>$description,
                    ":myid"=>$id
                ]);
                $upload->closeCursor();
                header("LOCATION:admin.php?update=success");
            }else{
               
                $reqImg = $bdd->prepare("SELECT image FROM manga WHERE id=?");
                $reqImg->execute([$id]);
                $donImg=$reqImg->fetch();

                if(!empty($donImg['image'])){
                    unlink("../images/".$donImg['image']);  
                    unlink("../images/mini_".$donImg['image']);  
                }

                //traitement du fichier
                $dossier = '../images/';
                $fichier = basename($_FILES['image']['name']);
                $taille_maxi = 2000000;
                $taille = filesize($_FILES['image']['tmp_name']);
                $extensions = array('.png','.jpg','.jpeg');
                $extension = strrchr($_FILES['image']['name'], '.'); 
                
                
                
                if(!in_array($extension, $extensions))
                {
                    $erreur = 'Vous devez uploader un fichier de type png, jpg, jpeg';
                   
                }
                if($taille>$taille_maxi)
                {
                    $erreur = 'Le fichier dépasse la taille autorisée';
                }
                
                if(!isset($erreur)) 
                {
                     
                    $fichier = strtr($fichier, 
                        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier); 
                    $fichiercptl=rand().$fichier;
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichiercptl)) 
                    {
                        $upload = $bdd->prepare("UPDATE manga SET titre=:titre, edition=:edition,genre=:genre,image=:image,description=:descri WHERE id=:myid");
                        $upload->execute([
                            ":titre"=>$title,
                            ":edition"=>$edition,
                            ":genre"=>$type,
                            ":image"=>$fichiercptl,
                            ":descri"=>$description,
                            ":myid"=>$id
                        ]);
                        $upload->closeCursor();
                        if($extension==".png"){
                            header("LOCATION:redimpng.php?image=".$fichiercptl);
                        }else{
                            header("LOCATION:redim.php?image=".$fichiercptl);
                        }
                            
                    }
                    else 
                    {
                        header("LOCATION:updateManga.php?id=".$id."&error=1&upload=echec");
                    }
                }
                else
                {
                    header("LOCATION:updateManga.php?id=".$id."&error=1&fich=".$erreur);
                }	


            }
        }else{
            header("LOCATION:updateManga.php?id=".$id."&err=".$err);
        }




    }else{
        header("LOCATION:updateManga.php?id=".$id);
    }




?>