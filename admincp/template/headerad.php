<?php
require_once("../backend/functions.php");
dbconn(true);
$today = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Adimin Canturla</title>

    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.min.css" />
    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="assets/css/ui.jqgrid.min.css" />
    <link rel="stylesheet" href="assets/css/chosen.min.css" />
    <!-- text fonts -->
    <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="assets/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="no-skin">
    <div id="navbar" class="navbar navbar-default          ace-save-state">
        <div class="navbar-container ace-save-state" id="navbar-container">
            <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>
            </button>

            <div class="navbar-header pull-left">
                <a href="index.html" class="navbar-brand">
                    <small>
                        <i class="fa fa-pagelines" aria-hidden="true"></i>
                        Canturla Admin
                    </small>
                </a>
            </div>
            <?php $commande = get_row_count("commande", "WHERE dates = '$today'");
            $notif = $commande;
            ?>
            <div class="navbar-buttons navbar-header pull-right" role="navigation">
                <ul class="nav ace-nav">
                    <li class="grey dropdown-modal">
                    <li class="purple dropdown-modal">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                            <span class="badge badge-important"><?php echo $notif; ?></span>
                        </a>

                        <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-exclamation-triangle"></i>
                                <?php echo $notif; ?> notifications
                            </li>

                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar navbar-pink">
                                    <li>
                                        <a href="commande.php">
                                            <div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
                                                        nouvelle commande
													</span>
                                                <span class="pull-right badge badge-success"><?php echo $commande; ?></span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <?php  $catsrow = get_row_count("message", "WHERE lu='non-lu'");
                    echo '
                    <li class="green dropdown-modal">
                        <a  href="message.php">
                            <i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
                            <span class="badge badge-success">'.$catsrow.'</span>
                        </a>';
                    ?>
                    </li>

                    <li class="light-blue dropdown-modal">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <img class="nav-user-photo" src="assets/images/avatars/admin-17a058.gif" alt="Jason's Photo" />
							    	<span class="user-info">
								    	<small>Bienvenue,</small>
									    Admin
								    </span>

                                    <i class="ace-icon fa fa-caret-down"></i>
                        </a>

                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <li>
                                <a href="profilsad.php">
                                    <i class="ace-icon fa fa-cog"></i>
                                    Option
                                </a>
                            </li>
                            <li class="divider"></li>

                            <li>
                                <a href="#">
                                    <i class="ace-icon fa fa-power-off"></i>
                                    Deconnection
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!-- /.navbar-container -->
    </div>