<?php
session_start();

	
$source = imagecreatefromjpeg("../images/".$_GET['image']); 

$TailleImageChoisie = getimagesize("../images/".$_GET['image']);

$NouvelleLargeur = 300;

$Reduction = ( ($NouvelleLargeur * 100)/$TailleImageChoisie[0] );

$NouvelleHauteur = ( ($TailleImageChoisie[1] * $Reduction)/100 );

$destination =  imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur"); 

imagecopyresampled($destination, $source, 0, 0, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);

$rep_nom="../images/mini_".$_GET['image'];

imagejpeg($destination,$rep_nom,80);

header("LOCATION:admin.php?insert=success");

?>