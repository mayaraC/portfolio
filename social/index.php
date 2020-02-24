<?php
include 'php/upload.php';
session_start();

$idCommentaire = filter_input(INPUT_POST, 'idCommentaire', FILTER_SANITIZE_STRING);

if (isset($_POST['supprimer']) == 'Supprimer') {
    effacerMediaCommenatire($idCommentaire);
}
?>
<!DOCTYPE html>
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
            <?php //include '../social/assets/include/nav.html'; ?>
            
            <div class="padding">
                <div class="full col-sm-9">

                    <!-- content -->
                    <div class="row">

                        <!-- main col left -->
                        <div class="col-sm-5">

                            <div class="panel panel-default">
                                <div class="panel-thumbnail"><img src="assets/img/bg_5.jpg" class="img-responsive"></div>
                                <div class="panel-body">
                                    <p class="lead">Urbanization</p>

                                    <p>
                                        <img src="assets/img/uFp_tsTJboUY7kue5XAsGAs28.png" height="28px" width="28px">
                                    </p>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading"><a href="#" class="pull-right">View all</a>
                                    <h4>Bootstrap Examples</h4></div>
                                <div class="panel-body">
                                    <div class="list-group">
                                        <a href="http://usebootstrap.com/theme/facebook" class="list-group-item">Modal / Dialog</a>
                                        <a href="http://usebootstrap.com/theme/facebook" class="list-group-item">Datetime Examples</a>
                                        <a href="http://usebootstrap.com/theme/facebook" class="list-group-item">Data Grids</a>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading"><a href="#" class="pull-right">View all</a>
                                    <h4>More Templates</h4></div>
                                <div class="panel-body">
                                    <img src="assets/img/150x150.gif" class="img-circle pull-right"> <a href="#">Free @Bootply</a>
                                    <div class="clearfix"></div>
                                    There a load of new free Bootstrap 3 ready templates at Bootply. All of these templates are free and don't require extensive customization to the Bootstrap baseline.
                                    <hr>
                                    <ul class="list-unstyled">
                                        <li><a href="http://usebootstrap.com/theme/facebook">Dashboard</a></li>
                                        <li><a href="http://usebootstrap.com/theme/facebook">Darkside</a></li>
                                        <li><a href="http://usebootstrap.com/theme/facebook">Greenfield</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- main col right -->
                        <div class="col-sm-7">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <H1>WELCOME</H1>
                                </div>
                            </div>
                            <?php
                            $arrayComt = afficherCommentaire();
                            foreach ($arrayComt as $commentaire) {

                                echo'<form method="POST" action="#" ><div class="panel panel-default" style="  height:auto;  width: 70%; text-align: center" >
                                  <div class="panel-thumbnail"></div>
                                  <div class="panel-body">
                                  <p class="lead">' . $commentaire['commentaire'] . '</p>
                                  <input type="submit" name="supprimer" value="Supprimer">
                                  <input type="hidden" name="idCommentaire" value="'. $commentaire['idPost']. '">
                                  </div>
                                  </div></form>';
                            }
                            $img = afficherImagesEtCommentaire();
                            foreach ($img as $var) {

                                echo'
                                <form method="POST" action="#" > <div class="panel panel-default" style="  height:auto;  width: 70%; text-align: center" >
                                    <div class="panel-thumbnail"><img src="media/images/' . $var['nomMedia'] . '"class="img-responsive" style=" width:auto; height:auto"></div>
                                    <div class="panel-body"> 
                                    <input type="submit" name="supprimer" value="Supprimer">
                                    <input type="hidden" name="idCommentaire" value="'. $var['Post_idPost']. '">
                                        <p class="lead"> ' . $var['commentaire'] . '</p>
                                    </div>
                                </div></form>';
                            }
                            ?>

                        </div>
                    </div>
                    <!--/row-->

                    <div class="row">
                        <div class="col-sm-6">
                            <a href="#">Twitter</a> <small class="text-muted">|</small> <a href="#">Facebook</a> <small class="text-muted">|</small> <a href="#">Google+</a>
                        </div>
                    </div>

                    <div class="row" id="footer">
                        <div class="col-sm-6">

                        </div>
                        <div class="col-sm-6">
                            <p>
                                <a href="#" class="pull-right">ʃopyright 2013</a>
                            </p>
                        </div>
                    </div>

                    <hr>

                    <h4 class="text-center">
                        <a href="http://usebootstrap.com/theme/facebook" target="ext">Download this Template @Bootply</a>
                    </h4>

                    <hr>

                </div>
                <!-- /col-9 -->
            </div>
            <!-- /padding -->
        </div>
        <!-- /main -->

    </div>


    <!--post modal-->
    <div id="postModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">׼/button> Update Status
                </div>
                <div class="modal-body">
                    <form class="form center-block">
                        <div class="form-group">
                            <textarea class="form-control input-lg" autofocus="" placeholder="What do you want to share?"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div>
                        <ul class="pull-left list-inline">
                            <li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li>
                            <li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li>
                            <li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../social/assets/include/footer.html'; ?>
</body>
</html>