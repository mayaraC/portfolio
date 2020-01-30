<?php include'php/connexion.php';
include 'php/upload.php';

echo "select id * from media";
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
    <form method="POST" action="">
        <div class="wrapper">
            <div class="row row-offcanvas row-offcanvas-left">
                <?php include '../social/assets/include/nav.html'; ?>

                <div id="main">
                    <div  class="container bootstrap snippet">
                            <div  class="row">
                                <div class="col-md-offset-3 col-md-6 col-xs-12">
                                    <div class="well well-sm well-social-post">
                                        <form>
                                            <ul class="list-inline" id='list_PostActions'>
                                                <li class='active'><a href='#'>Update status</a></li>
                                                <li><a href='#'>Add photos/Video</a></li>
                                                <li><a href='#'>Create photo album</a></li>
                                            </ul>
                                            <img src="assets/img/logoCFPT.png" heght="50" width="50" id="profile-photo" alt="logo du cfpt" draggable="false">
                                            <textarea class="form-control" placeholder="What's in your mind?"></textarea>
                                            <ul class='list-inline post-actions'>
                                                <li><label for="img"> <img src="./assets/icon/iconmonstr-photo-camera-4.svg" alt="icon camera"> </label> 
                                                <input type="file" accept="image/*" name="img" id="img" multiple></li>
                                                <li><a href="#" class='glyphicon glyphicon-user'></a></li>
                                                <li><a href="#" class='glyphicon glyphicon-map-marker'></a></li>

                                                <li class='pull-right'><a href="#" class='btn btn-primary btn-xs'>Post</a></li>
                                            </ul>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php include '../social/assets/include/footer.html'; ?>
        </form>
    </body>
</html>