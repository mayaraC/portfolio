<?php
/* * ******************************************************
 * Projet: Site web M152                                *
 * Auteur : Mayara Cochard                              *
 * Description : Page principale                        *
 * ****************************************************** */
include 'php/upload.php';
include 'php/affichagePost.php';
$nouveauCommentaire = filter_input(INPUT_POST, 'nouveauCommentaire', FILTER_SANITIZE_STRING);
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Ma page social</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/facebook.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper" >
        <div class="row row-offcanvas row-offcanvas-left">
            <?php include '../social/assets/include/nav.html'; ?>
            <div class="padding">
                <div class="full col-sm-9">
                    <!-- content -->
                    <div class="row" style="margin-left: 200px">
                        <!-- main col left -->
                        <div class="col-sm-5">
                            <div class="panel panel-default">
                                <div class="panel-thumbnail"><img src="assets/img/1001310.jpg" class="img-responsive" style="margin:auto"></div>
                                <div class="panel-body">
                                    <p class="lead">Mon compte</p>
                                </div>
                            </div>
                        </div>
                        <!-- main col right -->
                        <div class="col-sm-7">
                            <div class="panel panel-default" style="width: 70%; text-align: center">
                                <div class="panel-body">
                                    <H1>WELCOME</H1>
                                </div>
                            </div>
                            <?php
                            //Afficher les commentaires et les medias
                            $arrayComt = afficherImagesOuCommentaire();
                              foreach ($arrayComt as $commentaire) {
                              echo'<form method="POST" action="#" ><div class="panel panel-default" style="  height:auto;  width: 70%; text-align: center" >
                              <div class="panel-thumbnail"></div>
                              <div class="panel-body">  ';

                              //Modifier un commentaire
                              if (isset($_POST['modifier']) == "Modifier") {
                              echo '<input type="text" name="nouveauCommentaire" value="' . $commentaire['commentaire'] . '">
                              <input type="submit" name="modifierCommentaire" value="Ok">';
                              } else {
                              echo '<p class="lead">' . $commentaire['commentaire'] . '</p>
                              <input type="submit" name="modifier" value="Modifier">';
                              }
                              echo ' <input type="submit" name="supprimer" value="Supprimer">
                              <input type="hidden" name="idCommentaire" value="' . $commentaire['idPost'] . '">
                              </div>
                              </div>
                              </form>';
                              //Valider la modification du commentaire
                              if (isset($_POST['modifierCommentaire']) AND $_POST['modifierCommentaire'] == "Ok") {
                              $id = $commentaire['idPost'];
                              if (modifierCommenatire($nouveauCommentaire, $id)) {
                              echo "Commentaire modifié, actualiser la page";
                              }
                              }
                              } 
                            $img = afficherImagesEtCommentaire();
                            foreach ($img as $var) {
                                $typeFichier = $var['typeMedia'];
                                if ($typeFichier == "image") {
                                    $dossier = "/media/images/";
                                    echo '<form method="POST" action="#" >
                                    <div class="panel panel-default" style="height:auto;  width: 70%; text-align: center;">
                                        <div class="panel-thumbnail">
                                            <img src="media/images/' . $var['nomMedia'] . '"class="img-responsive" style=" width:auto; height:auto; margin:auto">
                                        </div>
                                        <div class="panel-body">
                                            <input type="hidden" name="idCommentaire" value="' . $var['Post_idPost'] . '">
                                            <input type="hidden" name="media" value="' . $var['nomMedia'] . '">
                                            <input type="hidden" name="dossier" value="media/images/">';
                                    if (isset($_POST['modifier']) == "Modifier") {
                                        echo '<input type="text" name="nouveauCommentaire" value="' . $var['commentaire'] . '">
                                                <input type="submit" name="modifierCommentaire" value="Ok">';
                                    } else {
                                        echo '<p class="lead">' . $var['commentaire'] . '</p> 
                                                <input type="submit" name="modifier" value="Modifier">';
                                    }
                                    echo '<input type="submit" name="supprimer" value="Supprimer"></div>
                                    </div>
                                </form>';

                                    //Valider la modification du commentaire
                                    if (isset($_POST['modifierCommentaire']) AND $_POST['modifierCommentaire'] == "Ok") {
                                        $id = $var['Post_idPost'];
                                        echo "test";
                                        if (modifierMediaCommenatire($typeFichier, $nomMedia, $id, $commentaire)) {
                                            echo "Commentaire modifié, actualiser la page";
                                        }
                                    }
                                }
                            }


                            /* if ($typeFichier == "video") {
                              $dossier = "/media/videos/";
                              echo '<form method="POST" action="#" >
                              <div class="panel panel-default" style="height: auto;  width: 70%; text-align: center;" >
                              <div class="panel-thumbnail">
                              <video controls width="450" controls autoplay loop style="margin:auto">
                              <source src="media/videos/' . $var['nomMedia'] . '" type="video/mp4">
                              </video>
                              </div>
                              <div class="panel-body">
                              <input type="submit" name="supprimer" value="Supprimer">
                              <input type="submit" name="modfier" value="Modifier">
                              <input type="hidden" name="idCommentaire" value="' . $var['Post_idPost'] . '">
                              <input type="hidden" name="media" value="' . $var['nomMedia'] . '">
                              <input type="hidden" name="dossier" value="media/videos/">
                              <p class="lead"> ' . $var['commentaire'] . '</p>
                              </div>
                              </div>
                              </form>';
                              }
                              /* if ($typeFichier == "audio") {
                              $dossier = "/media/sounds/";
                              echo '<form method="POST" action="#" >
                              <div class="panel panel-default" style="  height:auto;  width: 70%; text-align: center" >
                              <div class="panel-thumbnail">
                              <audio  controls>
                              <source src="media/sounds/' . $var['nomMedia'] . '" >
                              </audio>
                              </div>
                              <div class="panel-body">
                              <input type="submit" name="supprimer" value="Supprimer">
                              <input type="submit" name="modfier" value="Modifier">
                              <input type="hidden" name="idCommentaire" value="' . $var['Post_idPost'] . '">
                              <input type="hidden" name="media" value="' . $var['nomMedia'] . '">
                              <input type="hidden" name="dossier" value="media/sounds/">
                              <p class="lead"> ' . $var['commentaire'] . '</p>
                              </div>
                              </div>
                              </form>';
                              } */
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer> 
            <div>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="https://twitter.com/?lang=fr">Twitter</a> <small class="text-muted">|</small> <a href="https://fr-fr.facebook.com/">Facebook</a> <small class="text-muted">|</small> <a href="https://accounts.google.com/">Google+</a>
                    </div>
                </div>
                <div class="row" id="footer">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <p>
                            <a href="#" class="pull-right">copyright 2020</a>
                        </p>
                    </div>
                </div>
                <hr>
                <h4 class="text-center">
                    <a href="http://usebootstrap.com/theme/facebook" target="ext">Download this Template @Bootply</a>
                </h4>
                <hr>
            </div>
            <?php include '../social/assets/include/footer.html'; ?>                      
        </footer>
    </div>
</body>
</html> 