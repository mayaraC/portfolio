<?php include'php/connexion.php' ;

session_start();


//$fichier = basename($_FILES['img']['name']);
print_r($_FILES['img']);
//$path = $_FILES['img']['name'];
//$extension = pathinfo($path, PATHINFO_EXTENSION);

if(isset($_POST['post'])== 'post'){

foreach ($_FILES['img']['name'] as $key => $value) {
    $path = $_FILES['img']['name'][$key]; //nom du fichier complet
    $extension = pathinfo($path, PATHINFO_EXTENSION); //permet de découper la variable pour récupérer l'extension
    echo $extension;

    if ($extension == "png" or $extension == "PNG" or $extension == "jpg") {
        $newName = uniqid().".".$extension;
        $dossier = "img/" . $newName;
    
        if (move_uploaded_file($_FILES['img']['tmp_name'][$key], $dossier . "")) {//Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            echo 'Upload effectué avec succès !';
            ajouterMedia($extension, $newName);
            
            //header('Location: ../index.php');
            echo"au top";
            //exit;
        } else { //Sinon (la fonction renvoie FALSE).
            echo 'Echec de l\'upload !</br';
            //header('Location: ../ajoutJeu.php?erreur=19');

            //exit;
        }
    }
    }
}else 
 echo "voifdho";

/*
if ($extension == "png" or $extension == "PNG" or $extension == "jpg") {
    $newName = uniqid().".".$extension;
    $dossier = "img/" . $newName;

    if (move_uploaded_file($_FILES['img']['tmp_name'], $dossier . "")) {//Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        echo 'Upload effectué avec succès !';
        ajouterMedia($extension, $newName);
        
        //header('Location: ../index.php');
        echo"au top";
        exit;
    } else { //Sinon (la fonction renvoie FALSE).
        echo 'Echec de l\'upload !</br';
        //header('Location: ../ajoutJeu.php?erreur=19');
        echo"fuck";
        exit;
    }
}
*/

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
                <?php include '../social/assets/include/nav.html'; ?>

                <div id="main">
                    <div  class="container bootstrap snippet">
                            <div  class="row">
                                <div class="col-md-offset-3 col-md-6 col-xs-12">
                                    <div class="well well-sm well-social-post">
                                        <form method="POST" action="#" enctype="multipart/form-data">
                                            <ul class="list-inline" id='list_PostActions'>
                                                <li class='active'><a href='#'>Update status</a></li>
                                                <li><a href='#'>Add photos/Video</a></li>
                                                <li><a href='#'>Create photo album</a></li>
                                            </ul>
                                            <img src="assets/img/logoCFPT.png" heght="50" width="50" id="profile-photo" alt="logo du cfpt" draggable="false">
                                            <textarea  name="commentaire" class="form-control" placeholder="What's in your mind?"></textarea>
                                            <ul class='list-inline post-actions'>
                                                <li><label for="img"> <img src="./assets/icon/iconmonstr-photo-camera-4.svg" alt="icon camera"> </label> 
                                                <input type="file" accept="image/*" name="img[]" id="img" multiple></li>
                                                <li><a href="#" class='glyphicon glyphicon-user'></a></li>
                                                <li><a href="#" class='glyphicon glyphicon-map-marker'></a></li>

                                                <li class='pull-right'><input type="submit" name='post' value='post' class='btn btn-primary btn-xs'></li>
                                            </ul>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <?php 
                            $arrayImg = afficherImages();
                            foreach ($arrayImg as  $var) {

                                echo'<div class="panel panel-default" style=" width:500px; height:300px; text-align: center" >
                                    <div class="panel-thumbnail"><img src="img/'. $var['nomMedia'] . '"class="img-responsive" style=" width:auto; height:auto"></div>
                                    <div class="panel-body">
                                        <p class="lead">Social Good</p>
                                        <p>1,200 Followers, 83 Posts</p>
                                    </div>
                                </div>';
                            }
                                ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php include '../social/assets/include/footer.html'; ?>
        
    </body>
</html>
