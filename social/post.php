<?php
/* * ******************************************************
 * Projet: Site web M152                                *
 * Auteur : Mayara Cochard                              *
 * Description : Page d'ajout                           *
 * ****************************************************** */
require_once './php/ajoutPost.php';
include './php/errors.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Social</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <link href="assets/css/facebook.css" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <div class="row row-offcanvas row-offcanvas-left" >
                <?php include '../social/assets/include/nav.html'; ?>
                <div id="main">
                    <div class="container bootstrap snippet">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-6 col-xs-12" >
                                <div class="well well-sm well-social-post" style="margin-top:70px">
                                    <form method="POST" action="./php/ajoutPost.php" enctype="multipart/form-data">
                                        <ul class="list-inline" id='list_PostActions'>
                                            <li class='active'><a href='#'>Update status</a></li>
                                        </ul>
                                        <img src="assets/img/logoCFPT.png" heght="50" width="50" id="profile-photo" alt="logo du cfpt" draggable="false">
                                        <textarea name="commentaire" class="form-control" placeholder="What's in your mind?"></textarea>
                                        <ul class='list-inline post-actions'>
                                            <li>
                                                <label for="img"> <img src="./assets/icon/iconmonstr-photo-camera-4.svg" alt="icon camera"> </label>
                                                <input type="file" accept="video/*, image/*, audio/*" name="img[]" id="img" multiple>
                                            </li>
                                            <li class='pull-right'><input type="submit" name='post' value='Post' class='btn btn-primary btn-xs' style="width: 100px"></li>
                                        </ul>
                                        <?php displayError(); ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer style="position: fixed; bottom: 0;">
            <?php include '../social/assets/include/footer.html'; ?>
        </footer>
    </body>
</html>