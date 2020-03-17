<?php
/* * ********************************************
 * Ce code permet dâjouter des images et des commentaires 
 * ****************************************** */
include __DIR__ . '/upload.php';

$commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_STRING);
$images = filter_input(INPUT_POST, 'img[]', FILTER_SANITIZE_STRING);

if (isset($_FILES['img']) && $_FILES['img']['name'][0] === "" && $commentaire == "") {
    header('Location: ../post.php?error=3');
    exit;
} else {
    //Ajouter un commentaire
    if ($commentaire != "" && isset($_FILES['img']) && $_FILES['img']['name'][0] === "") {
        $idPost = ajouterCommentaire($commentaire);
        header('Location: ../index.php');
        exit;
    }

    if (isset($_FILES['img']) && $_FILES['img']['name'][0] !== "" && $commentaire !== "") {
        $idPost = ajouterCommentaire($commentaire);

        foreach ($_FILES['img']['name'] as $key => $value) {
            $str = mime_content_type($_FILES['img']["tmp_name"][$key]); //Savoir le type de fichier
            $typeFichier = explode('/', $str)[0]; //Découper le type de l'extension pour avoir que le type de fichier
            $path = $_FILES['img']['name'][$key]; //nom du fichier complet
            $extension = pathinfo($path, PATHINFO_EXTENSION); //permet de découper la variable pour récupérer l'extension
            //Vérifier la taille de l'image
            if ($_FILES['img']['size'][$key] > 24000000) {
                header('Location: ../post.php?error=1');
            }

            if ($typeFichier == "image") {
                if ($extension == "png" or $extension == "PNG" or $extension == "jpg") {
                    $newName = uniqid() . "." . $extension; //Nom unique pour le fichier
                    $dossier = "../media/images/" . $newName; //Emplacement du fichier
                    if (move_uploaded_file($_FILES['img']['tmp_name'][$key], $dossier . "")) { //Déplacer dans un dossier temporaire
                        ajouterMedia($typeFichier, $newName, $idPost);
                    } else {
                        header('Location: ../post.php?error=2');
                        exit;
                    }
                }
            }
            if ($typeFichier == "video") {
                $newName = uniqid() . "." . $extension;
                if ($extension == "mp4" or $extension == "mp3" or $extension == "wav") {
                    $dossier = "../media/videos/" . $newName;
                    if (move_uploaded_file($_FILES['img']['tmp_name'][$key], $dossier . "")) {
                        ajouterMedia($typeFichier, $newName, $idPost);
                    }
                }
            }
            if ($typeFichier == "audio") {
                $newName = uniqid() . "." . $extension;
                if ($extension == "mp4" or $extension == "mp3" or $extension == "wav") {
                    $dossier = "../media/sounds/" . $newName;
                    if (move_uploaded_file($_FILES['img']['tmp_name'][$key], $dossier . "")) {
                        echo 'Upload effectué avec succès !';
                        ajouterMedia($typeFichier, $newName, $idPost);
                    }
                }
            }
        }
    }
    header('Location: ../index.php');
    exit;
}
