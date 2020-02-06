<?php 
include 'php/upload.php' ;
session_start();
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
                                        <p>45 Followers, 13 Posts</p>

                                        <p>
                                            <img src="assets/img/uFp_tsTJboUY7kue5XAsGAs28.png" height="28px" width="28px">
                                        </p>
                                    </div>
                                </div>


                                <div class="panel panel-default">
                                    <div class="panel-heading"><a href="#" class="pull-right">View all</a> <h4>Bootstrap Examples</h4></div>
                                    <div class="panel-body">
                                        <div class="list-group">
                                            <a href="http://usebootstrap.com/theme/facebook" class="list-group-item">Modal / Dialog</a>
                                            <a href="http://usebootstrap.com/theme/facebook" class="list-group-item">Datetime Examples</a>
                                            <a href="http://usebootstrap.com/theme/facebook" class="list-group-item">Data Grids</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="well"> 
                                    <form class="form-horizontal" role="form">
                                        <h4>What's New</h4>
                                        <div class="form-group" style="padding:14px;">
                                            <textarea class="form-control" placeholder="Update your status"></textarea>
                                        </div>
                                        <button class="btn btn-primary pull-right" type="button">Post</button><ul class="list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
                                    </form>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading"><a href="#" class="pull-right">View all</a> <h4>More Templates</h4></div>
                                    <div class="panel-body">
                                        <img src="assets/img/150x150.gif" class="img-circle pull-right"> <a href="#">Free @Bootply</a>
                                        <div class="clearfix"></div>
                                        There a load of new free Bootstrap 3
                                        ready templates at Bootply. All of these templates are free and don't 
                                        require extensive customization to the Bootstrap baseline.
                                        <hr>
                                        <ul class="list-unstyled"><li><a href="http://usebootstrap.com/theme/facebook">Dashboard</a></li><li><a href="http://usebootstrap.com/theme/facebook">Darkside</a></li><li><a href="http://usebootstrap.com/theme/facebook">Greenfield</a></li></ul>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading"><h4>What Is Bootstrap?</h4></div>
                                    <div class="panel-body">
                                        Bootstrap is front end frameworkto 
                                        build custom web applications that are fast, responsive &amp; intuitive.
                                        It consist of CSS and HTML for typography, forms, buttons, tables, 
                                        grids, and navigation along with custom-built jQuery plug-ins and 
                                        support for responsive layouts. With dozens of reusable components for 
                                        navigation, pagination, labels, alerts etc..                          </div>
                                </div>



                            </div>

                            <!-- main col right -->
                            <div class="col-sm-7">

                                <div class="well"> 
                                    <form class="form">
                                        <h4>Sign-up</h4>
                                        <div class="input-group text-center">
                                            <input class="form-control input-lg" placeholder="Enter your email address" type="text">
                                            <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="button">OK</button></span>
                                        </div>
                                    </form>
                                </div>


                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <H1>WELCOME</H1>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-thumbnail"><img src="assets/img/bg_4.jpg" class="img-responsive"></div>
                                    <div class="panel-body">
                                        <p class="lead">Social Good</p>
                                        <p>1,200 Followers, 83 Posts</p>

                                        <p>
                                            <img src="assets/img/photo.jpg" height="28px" width="28px">
                                            <img src="assets/img/photo.png" height="28px" width="28px">
                                            <img src="assets/img/photo_002.jpg" height="28px" width="28px">
                                        </p>
                                    </div>
                                </div>
                                <?php 
                            $arrayImg = afficherImages();
                            foreach ($arrayImg as  $var) {

                                echo'<div class="panel panel-default" style=" width:500px; height:300px; text-align: center" >
                                    <div class="panel-thumbnail"><img src="media/images/'. $var['nomMedia'] . '"class="img-responsive" style=" width:auto; height:auto"></div>
                                    <div class="panel-body">
                                        <p class="lead">Social Good</p>
                                        <p>1,200 Followers, 83 Posts</p>
                                    </div>
                                </div>';
                            }
                                ?>

                            </div>
                        </div><!--/row-->

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


                    </div><!-- /col-9 -->
                </div><!-- /padding -->
            </div>
            <!-- /main -->

        </div>
    </div>
</div>


<!--post modal-->
<div id="postModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">׼/button>
                    Update Status
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
                    <button class="btn btn-primary btn-sm" data-dismiss="modal" aria-hidden="true">Post</button>
                    <ul class="pull-left list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
                </div>	
            </div>
        </div>
    </div>
</div>

<?php include '../social/assets/include/footer.html'; ?>
</body>
</html>