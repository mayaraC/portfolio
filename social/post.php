<?php
include 'php/upload.php';
session_start();
$commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_STRING);
$images = filter_input(INPUT_POST, 'img[]', FILTER_SANITIZE_STRING);
$error = array();
if (isset($_POST['post']) == 'post') {
    if ($commentaire = "" && $path="") {
        $error['commentaireMediaVide'] = "Commentaire ou image obligatoire";
    } else {
        //Ajouter un commentaire
        if ($commentaire !="" && $path =="") {
            $idPost = ajouterCommentaire($commentaire);
        }

        //Ajouter des images
        foreach ($_FILES['img']['name'] as $key => $value) {
            //Savoir le type de fichier
            $str = mime_content_type($_FILES['img']["tmp_name"][$key]);
            $typeFichier = explode('/', $str)[0];
            echo $str;
            $path = $_FILES['img']['name'][$key]; //nom du fichier complet
            $extension = pathinfo($path, PATHINFO_EXTENSION); //permet de découper la variable pour récupérer l'extension
            //Vérifier la taille de l'image
            /* if ($_FILES['img']['size'][$key] > 24000000) {
              $error['horsTaille'] = "Ce fichier dépasse la taille acceptée";
              header('Location: post.php');
              } */
            if ($commentaire == "") {
                $error['commentaireVide'] = "Commentaire obligatoire";
            } else {
                if ($typeFichier == "image") {
                    if ($extension == "png" or $extension == "PNG" or $extension == "jpg") {
                        $newName = uniqid() . "." . $extension;
                        $dossier = "media/images/" . $newName;
                        if (move_uploaded_file($_FILES['img']['tmp_name'][$key], $dossier . "")) {//Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                            echo 'Upload effectué avec succès !';
                            ajouterMedia($typeFichier, $newName, $idPost);
                            //header('Location: index.php');
                            //exit;
                        } else {
                            $error['imgPasAJoute'] = "Ce fichier n'a pu être ajouté";
                            echo 'Echec de l\'upload !</br';
                            //header('Location: ../ajoutJeu.php?erreur=19');
                            //exit;
                        }
                    }
                } else {
                    $error['mauvaiseExtension'] = "Ce fichier n'est pas une image";
                }
                if ($typeFichier == "video") {
                    $newName = uniqid() . "." . $extension;
                    if ($extension == "mp4" or $extension == "mp3" or $extension == "wav") {
                        $dossier = "media/videos/" . $newName;
                        if (move_uploaded_file($_FILES['img']['tmp_name'][$key], $dossier . "")) {//Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                            echo 'Upload effectué avec succès !';
                            ajouterMedia($typeFichier, $newName, $idPost);
                        }
                    }
                }
                if ($typeFichier == "audio") {
                    $newName = uniqid() . "." . $extension;
                    if ($extension == "mp4" or $extension == "mp3" or $extension == "wav") {
                        $dossier = "media/sounds/" . $newName;
                        if (move_uploaded_file($_FILES['img']['tmp_name'][$key], $dossier . "")) {//Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                            echo 'Upload effectué avec succès !';
                            ajouterMedia($typeFichier, $newName, $idPost);
                        }
                    }
                }
            }
        }
    }
} else {
    echo "voifdho";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>Facebook Theme Demo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <link href="assets/css/facebook.css" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <div class="row row-offcanvas row-offcanvas-left">
                <?php // include '../social/assets/include/nav.html';              ?>
                <div id="main">
                    <div  class="container bootstrap snippet">
                        <div  class="row">
                            <div class="col-md-offset-3 col-md-6 col-xs-12">
                                <div class="well well-sm well-social-post">
                                    <form method="POST" action="#" enctype="multipart/form-data">
                                        <ul class="list-inline" id='list_PostActions'>
                                            <li class='active'><a href='#'>Update status</a></li>
                                        </ul>
                                        <img src="assets/img/logoCFPT.png" heght="50" width="50" id="profile-photo" alt="logo du cfpt" draggable="false">
                                        <textarea  name="commentaire" class="form-control" placeholder="What's in your mind?"></textarea>
                                        <ul class='list-inline post-actions'>
                                            <li>
                                                <label for="img"> <img src="./assets/icon/iconmonstr-photo-camera-4.svg" alt="icon camera"> </label> 
                                                <input type="file" accept="video/*, image/*, audio/*" name="img[]" id="img" multiple>
                                            </li>
                                            <li>
                                                <a href="#" class='glyphicon glyphicon-user'></a>
                                            </li>
                                            <li>
                                                <a href="#" class='glyphicon glyphicon-map-marker'></a>
                                            </li>
                                            <li class='pull-right'><input type="submit" name='post' value='post' class='btn btn-primary btn-xs'></li>
                                        </ul>
                                        <?php
                                        foreach ($error as $key => $value) {
                                            echo $value;
                                        }
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../social/assets/include/footer.html'; ?>
    </body>
</html>
