<?PHP
require_once("template/headerad.php");
require_once("template/asidead.php");
require_once("template/bridcrumsad.php");


?>
    <!-- PAGE CONTENT BEGINS -->


    <div class="row">
        <div class="col-sm-9">
            <div class="space"></div>

            <div id="calendar"></div>
        </div>

        <div class="col-sm-3">
            <div class="widget-box transparent">
                <div class="widget-header">
                    <h4>Evenement</h4>
                </div>

                <div class="widget-body">
                    <div class="widget-main no-padding">
                        <div id="external-events">
                            <div class="external-event label-grey" data-class="label-grey">
                                <i class="ace-icon fa fa-arrows"></i>

                            </div>

                            <div class="external-event label-success" data-class="label-success">
                                <i class="ace-icon fa fa-arrows"></i>

                            </div>

                            <div class="external-event label-danger" data-class="label-danger">
                                <i class="ace-icon fa fa-arrows"></i>

                            </div>

                            <div class="external-event label-purple" data-class="label-purple">
                                <i class="ace-icon fa fa-arrows"></i>

                            </div>

                            <div class="external-event label-yellow" data-class="label-yellow">
                                <i class="ace-icon fa fa-arrows"></i>

                            </div>

                            <div class="external-event label-pink" data-class="label-pink">
                                <i class="ace-icon fa fa-arrows"></i>

                            </div>

                            <div class="external-event label-info" data-class="label-info">
                                <i class="ace-icon fa fa-arrows"></i>

                            </div>

                            <label>
                                <input type="checkbox" class="ace ace-checkbox" id="drop-remove"/>
                                <span class="lbl"> Modifier ou supprimer</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require_once("template/footerad.php");
?>