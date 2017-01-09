<?PHP
require_once("template/headerad.php");
require_once("template/asidead.php");
require_once("template/bridcrumsad.php");
$today = date("Y-m-d");
?>


    <div class="page-header">
        <h1>
            Accueil
            <small>

        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">


            <div>
                <div id="user-profile-1" class="user-profile row">
                    <div class="col-xs-12 col-sm-3 center">
                        <div>
                            <?php $catsquery = SQL_Query_exec("SELECT * FROM clients WHERE id");

                            echo '
												<span class="profile-picture">
													<img id="avatar" class="editable img-responsive" alt="" src="' . $castrow['avatar'] . '" />
												</span>';

                            ?>
                            <div class="space-4"></div>

                            <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                <div class="inline position-relative">
                                    <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                        <i class="ace-icon fa fa-circle light-green"></i>
                                        &nbsp;
                                        <span class="white">admin</span>
                                    </a>

                                    <ul class="align-left dropdown-menu dropdown-caret dropdown-lighter">
                                        <li class="dropdown-header">Status</li>

                                        <li>
                                            <a href="#">
                                                <i class="ace-icon fa fa-circle green"></i>
                                                &nbsp;
                                                <span class="green">disponible</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ace-icon fa fa-circle red"></i>
                                                &nbsp;
                                                <span class="red">absent</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ace-icon fa fa-circle grey"></i>
                                                &nbsp;
                                                <span class="grey">hors-ligne</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="space-6"></div>

                        <div class="profile-contact-info">


                            <div class="space-6"></div>

                            <div class="profile-social-links align-center">


                            </div>
                        </div>

                        <div class="hr hr12 dotted"></div>


                        <div class="hr hr16 dotted"></div>
                    </div>

                    <div class="col-xs-12 col-sm-9">
                        <div class="center">
												<span class="btn btn-app btn-sm btn-light no-hover">
													<span class="line-height-1 bigger-170 blue"> 1,411 </span>

													<br/>
													<span class="line-height-1 smaller-90"> Vue </span>
												</span>

                            <?php
                            $catsrow = get_row_count("produits");
                            ?>
                            <span class="btn btn-app btn-sm btn-pink no-hover">
													<span class="line-height-1 bigger-170"><?php echo $catsrow; ?></span>
													<br/>
													<span class="line-height-1 smaller-90"> Produits </span>
												</span>
                            <?php $commande = get_row_count("commande", "WHERE dates = '$today'");
                            ?>

                            <span class="btn btn-app btn-sm btn-grey no-hover">
													<span class="line-height-1 bigger-170"><?php echo $commande; ?></span>

													<br/>
													<span class="line-height-1 smaller-90"> commande </span>
												</span>

                            <span class="btn btn-app btn-sm btn-success no-hover">
													<span class="line-height-1 bigger-170"> 7 </span>

													<br/>
													<span class="line-height-1 smaller-90"> nouv-add </span>
												</span>
                            <?php $contact = get_row_count("clients"); ?>
                            <span class="btn btn-app btn-sm btn-primary no-hover">
													<span class="line-height-1 bigger-170"><?php echo $contact; ?></span>

													<br/>
													<span class="line-height-1 smaller-90"> Contacts </span>
												</span>
                        </div>
                        <?php

                        $catsquery = SQL_Query_exec("SELECT * FROM clients WHERE id=1");
                        $catsinfo = mysqli_fetch_assoc($catsquery);

                        echo '
                                                <div class="space-12" ></div >

											<div class="profile-user-info profile-user-info-striped" >
												<div class="profile-info-row" >
													<div class="profile-info-name" > Username </div >

													<div class="profile-info-value" >
														<span class="editable" id = "username" >' . $catsinfo['username'] . '</span >
													</div >
												</div >
												<div class="profile-info-row" >
													<div class="profile-info-name" > crée le </div >

													<div class="profile-info-value" >
														<span class="editable" id = "signup">' . $catsinfo['added'] . ' </span >
													</div >
												</div >';
                        ?>

                    </div>

                    <div class="space-20"></div>

                    <div class="widget-box transparent">
                        <div class="widget-header widget-header-small">
                            <h4 class="widget-title blue smaller">
                                <i class="ace-icon fa fa-rss orange"></i>
                                Activités récentes
                            </h4>

                            <div class="widget-toolbar action-buttons">
                                <a href="#" data-action="reload">
                                    <i class="ace-icon fa fa-refresh blue"></i>
                                </a>
                                &nbsp;
                                <a href="#" class="pink">
                                    <i class="ace-icon fa fa-trash-o"></i>
                                </a>
                            </div>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main padding-12">
                                <div id="profile-feed-1" class="profile-feed">
                                    <div class="profile-activity clearfix">
                                        <div>
                                            <img class="pull-left" alt="Alex Doe's avatar"
                                                 src="assets/images/avatars/avatar5.png"/>
                                            <a class="user" href="#"> Alex Doe </a>
                                            changed his profile photo.
                                            <a href="#">Take a look</a>

                                            <div class="time">
                                                <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                an hour ago
                                            </div>
                                        </div>

                                        <div class="tools action-buttons">
                                            <a href="#" class="blue">
                                                <i class="ace-icon fa fa-pencil bigger-125"></i>
                                            </a>

                                            <a href="#" class="red">
                                                <i class="ace-icon fa fa-times bigger-125"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="profile-activity clearfix">
                                        <div>
                                            <img class="pull-left" alt="Susan Smith's avatar"
                                                 src="assets/images/avatars/avatar1.png"/>
                                            <a class="user" href="#"> Susan Smith </a>

                                            is now friends with Alex Doe.
                                            <div class="time">
                                                <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                2 hours ago
                                            </div>
                                        </div>

                                        <div class="tools action-buttons">
                                            <a href="#" class="blue">
                                                <i class="ace-icon fa fa-pencil bigger-125"></i>
                                            </a>

                                            <a href="#" class="red">
                                                <i class="ace-icon fa fa-times bigger-125"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="profile-activity clearfix">
                                        <div>
                                            <i class="pull-left thumbicon fa fa-check btn-success no-hover"></i>
                                            <a class="user" href="#"> Alex Doe </a>
                                            joined
                                            <a href="#">Country Music</a>

                                            group.
                                            <div class="time">
                                                <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                5 hours ago
                                            </div>
                                        </div>

                                        <div class="tools action-buttons">
                                            <a href="#" class="blue">
                                                <i class="ace-icon fa fa-pencil bigger-125"></i>
                                            </a>

                                            <a href="#" class="red">
                                                <i class="ace-icon fa fa-times bigger-125"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="profile-activity clearfix">
                                        <div>
                                            <i class="pull-left thumbicon fa fa-picture-o btn-info no-hover"></i>
                                            <a class="user" href="#"> Alex Doe </a>
                                            uploaded a new photo.
                                            <a href="#">Take a look</a>

                                            <div class="time">
                                                <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                5 hours ago
                                            </div>
                                        </div>

                                        <div class="tools action-buttons">
                                            <a href="#" class="blue">
                                                <i class="ace-icon fa fa-pencil bigger-125"></i>
                                            </a>

                                            <a href="#" class="red">
                                                <i class="ace-icon fa fa-times bigger-125"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="profile-activity clearfix">
                                        <div>
                                            <img class="pull-left" alt="David Palms's avatar"
                                                 src="assets/images/avatars/avatar4.png"/>
                                            <a class="user" href="#"> David Palms </a>

                                            left a comment on Alex's wall.
                                            <div class="time">
                                                <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                8 hours ago
                                            </div>
                                        </div>

                                        <div class="tools action-buttons">
                                            <a href="#" class="blue">
                                                <i class="ace-icon fa fa-pencil bigger-125"></i>
                                            </a>

                                            <a href="#" class="red">
                                                <i class="ace-icon fa fa-times bigger-125"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="profile-activity clearfix">
                                        <div>
                                            <i class="pull-left thumbicon fa fa-pencil-square-o btn-pink no-hover"></i>
                                            <a class="user" href="#"> Alex Doe </a>
                                            published a new blog post.
                                            <a href="#">Read now</a>

                                            <div class="time">
                                                <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                11 hours ago
                                            </div>
                                        </div>

                                        <div class="tools action-buttons">
                                            <a href="#" class="blue">
                                                <i class="ace-icon fa fa-pencil bigger-125"></i>
                                            </a>

                                            <a href="#" class="red">
                                                <i class="ace-icon fa fa-times bigger-125"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hr hr2 hr-double"></div>

                    <div class="space-6"></div>

                    <div class="center">
                        <button type="button" class="btn btn-sm btn-primary btn-white btn-round">
                            <i class="ace-icon fa fa-rss bigger-150 middle orange2"></i>
                            <span class="bigger-110">Voir plus d'activities</span>

                            <i class="icon-on-right ace-icon fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


<?php
require_once("template/footerad.php");
?>