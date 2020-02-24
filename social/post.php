<?php
include'php/upload.php';

session_start();


//print_r($_FILES['img']);
$commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_STRING);
$images = filter_input(INPUT_POST, 'img[]', FILTER_SANITIZE_STRING);
$error = array();

if (isset($_POST['post']) == 'post') {
    Start();
    if (!empty($commentaire) && empty($path)) {
        $idPost = ajouterCommentaire($commentaire);
        if ($idPost == false){
            RollBack(); //Annule toutes la transaction dans la base de données
        }
    }
    foreach ($_FILES['img']['name'] as $key => $value) {
        $path = $_FILES['img']['name'][$key]; //nom du fichier complet
        $extension = pathinfo($path, PATHINFO_EXTENSION); //permet de découper la variable pour récupérer l'extension

        //Vérifier la taille de l'image
        if ($_FILES['img']['size'][$key] > 24000000) {
            RollBack();
            $error['horsTaille'] = "Ce fichier dépasse la taille acceptée";
            header('Location: post.php');
        }

        if ($extension == "png" or $extension == "PNG" or $extension == "jpg" or (empty($commentaire) && empty($path))) {
            $newName = uniqid() . "." . $extension;
            $dossier = "media/images/" . $newName;
            ajouterMedia($extension, $newName ,  $idPost);
               
        if (move_uploaded_file($_FILES['img']['tmp_name'][$key], $dossier . "")) {//Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                echo 'Upload effectué avec succès !';
                ajouterMedia($extension, $newName ,  $idPost);
                Commit();
                //header('Location: index.php');
                //exit;
            } else { 
                RollBack();
                $error['imgPasAJoute'] = "Ce fichier n'a pu être ajouté";
                echo 'Echec de l\'upload !</br';
                //header('Location: ../ajoutJeu.php?erreur=19');
                //exit;
            }
        }
        else{
            $error['mauvaiseExtension'] = "Ce fichier n'est pas une image";
            RollBack();
        }
        
    }
    Commit();
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
                <?php // include '../social/assets/include/nav.html';       ?>
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
                                                <input type="file" accept="image/*" name="img[]" id="img" multiple>
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
