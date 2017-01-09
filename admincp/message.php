<?php
require_once("template/headerad.php");
require_once("template/asidead.php");
require_once("template/bridcrumsad.php");
$action = $_GET["action"];
$do = $_GET["do"];
if (!$action) {
    $action = $_POST["action"];
}
if (!$do) {
    $do = $_POST["do"];
}
$id = $_GET["message"];
?>

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="tabbable">
                    <ul id="inbox-tabs" class="inbox-tabs nav nav-tabs padding-16 tab-size-bigger tab-space-1">
                        <li class="li-new-mail pull-right">
                            <a data-toggle="tab" href="#" data-target="write" class="btn-new-mail">
														<span class="btn btn-purple no-border">
															<i class="ace-icon fa fa-envelope bigger-130"></i>
															<span class="bigger-110">nouveau</span>
														</span>
                            </a>
                        </li><!-- /.li-new-mail -->

                        <li class="active">
                            <a data-toggle="tab" href="#inbox" data-target="inbox">
                                <i class="blue ace-icon fa fa-inbox bigger-130"></i>
                                <span class="bigger-110">réception</span>
                            </a>
                        </li>

                        <li>
                            <a data-toggle="tab" href="#sent" data-target="sent">
                                <i class="orange ace-icon fa fa-location-arrow bigger-130"></i>
                                <span class="bigger-110">Sent</span>
                            </a>
                        </li>


                    </ul>
                    </li><!-- /.dropdown -->
                    </ul>
                    <?php if ($id == ""){
                    ?>
                    <div class="tab-content no-border no-padding">
                        <div id="inbox" class="tab-pane in active">
                            <div class="message-container">
                                <div id="id-message-list-navbar" class="message-navbar clearfix">
                                    <div class="message-bar">
                                        <div class="message-infobar" id="id-message-infobar">
                                            <span class="blue bigger-150">messagerie</span>
                                            <?php

                                            $catsrow = get_row_count("message", "WHERE lu='non-lu'");
                                            ?>
                                            <span class="grey bigger-110">(vous avez <?php echo $catsrow; ?> nouveau messages)</span>
                                        </div>

                                        <div class="message-toolbar hide">
                                            <div class="inline position-relative align-left">
                                                <button type="button"
                                                        class="btn-white btn-primary btn btn-xs dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <span class="bigger-110">Action</span>

                                                    <i class="ace-icon fa fa-caret-down icon-on-right"></i>
                                                </button>

                                            </div>

                                            <div class="inline position-relative align-left">

                                            </div>
                                        </div>


                                        <div class="messagebar-item-right">
                                            <div class="inline position-relative">

                                            </div>
                                        </div>

                                        <div class="nav-search minimized">
                                            <form class="form-search">
																		<span class="input-icon">
																			<input type="text" autocomplete="off"
                                                                                   class="input-small nav-search-input"
                                                                                   placeholder="Search inbox ..."/>
																			<i class="ace-icon fa fa-search nav-search-icon"></i>
																		</span>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div id="id-message-item-navbar" class="hide message-navbar clearfix">
                                    <div class="message-bar">
                                        <div class="message-toolbar">
                                            <div class="inline position-relative align-left">
                                                <button type="button"
                                                        class="btn-white btn-primary btn btn-xs dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <span class="bigger-110">Action</span>

                                                    <i class="ace-icon fa fa-caret-down icon-on-right"></i>
                                                </button>


                                            </div>

                                            <div class="inline position-relative align-left">
                                                <button type="button"
                                                        class="btn-white btn-primary btn btn-xs dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <i class="ace-icon fa fa-folder-o bigger-110 blue"></i>
                                                    <span class="bigger-110">Move to</span>

                                                    <i class="ace-icon fa fa-caret-down icon-on-right"></i>
                                                </button>
                                            </div>

                                            <button type="button" class="btn btn-xs btn-white btn-primary">
                                                <i class="ace-icon fa fa-trash-o bigger-125 orange"></i>
                                                <span class="bigger-110">Delete</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="messagebar-item-left">
                                            <a href="#" class="btn-back-message-list">
                                                <i class="ace-icon fa fa-arrow-left blue bigger-110 middle"></i>
                                                <b class="bigger-110 middle">Back</b>
                                            </a>
                                        </div>

                                        <div class="messagebar-item-right">
                                            <i class="ace-icon fa fa-clock-o bigger-110 orange"></i>
                                            <span class="grey">Today, 7:15 pm</span>
                                        </div>
                                    </div>
                                </div>

                                <div id="id-message-new-navbar" class="hide message-navbar clearfix">
                                    <div class="message-bar">
                                        <div class="message-toolbar">
                                            =
                                        </div>
                                    </div>

                                    <div>
                                        <div class="messagebar-item-left">
                                            <a href="#" class="btn-back-message-list">
                                                <i class="ace-icon fa fa-arrow-left bigger-110 middle blue"></i>
                                                <b class="middle bigger-110">Back</b>
                                            </a>
                                        </div>

                                        <div class="messagebar-item-right">
																	<span class="inline btn-send-message">
																		<button type="button"
                                                                                class="btn btn-sm btn-primary no-border btn-white btn-round">
																			<span class="bigger-110">Send</span>

																			<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
																		</button>
																	</span>
                                        </div>
                                    </div>
                                </div>
                                <?php

                                $catsquery = SQL_Query_exec("SELECT * FROM message ORDER BY lu");

                                while ($catsrow = mysqli_fetch_assoc($catsquery)) {

                                    echo '                                
                                <div class="message-list-container">
                                    <div class="message-list">
                                        <div class="message-item message-unread">
                                            <label class="inline">
                                                <input type="checkbox" class="ace" />
                                                <span class="lbl"></span>
                                            </label>

                                            <i class="message-star glyphicon-envelope "></i>
                                            <span class="sender" title="Alex John Red Smith">' . $catsrow["name"] . '</span>
                                            <span class="time">' . $catsrow["dates"] . '</span>

                                            <span >
																		
											<a href="message.php?message=' . $catsrow["id"] . '">' . $catsrow["message"] . '</a>
																		
																	</span>
                                        </div>
                                    </div>
                                </div>';
                                }


                                $catsrow = get_row_count("message");
                                ?>
                                <div class="message-footer clearfix">
                                    <div class="pull-left"><?php echo $catsrow; ?> message</div>

                                    <div class="pull-right">
                                        <div class="inline middle"> page 1 of 16</div>

                                        &nbsp; &nbsp;
                                        <ul class="pagination middle">
                                            <li class="disabled">
																		<span>
																			<i class="ace-icon fa fa-step-backward middle"></i>
																		</span>
                                            </li>

                                            <li class="disabled">
																		<span>
																			<i class="ace-icon fa fa-caret-left bigger-140 middle"></i>
																		</span>
                                            </li>

                                            <li>
																		<span>
																			<input value="1" maxlength="3" type="text"/>
																		</span>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <i class="ace-icon fa fa-caret-right bigger-140 middle"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <i class="ace-icon fa fa-step-forward middle"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="hide message-footer message-footer-style2 clearfix">
                                    <div class="pull-left"> simpler footer</div>

                                    <div class="pull-right">
                                        <div class="inline middle"> message 1 of 151</div>

                                        &nbsp; &nbsp;
                                        <ul class="pagination middle">
                                            <li class="disabled">
																		<span>
																			<i class="ace-icon fa fa-angle-left bigger-150"></i>
																		</span>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <i class="ace-icon fa fa-angle-right bigger-150"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.tab-content -->
                </div><!-- /.tabbable -->
            </div><!-- /.col -->
        </div><!-- /.row -->

        <?php
        } else {


            $catsquery = SQL_Query_exec("SELECT * FROM message WHERE id=$id");
            SQL_Query_exec("UPDATE message SET `lu` = 'lu' WHERE id=$id");
            while ($catsmail = mysqli_fetch_assoc($catsquery)) {

                echo '

        <div class="message-content" id="id-message-content">
            <div class="message-header clearfix">
                <div class="pull-left">
                    <span class="blue bigger-125">' . $catsmail['email'] . '</span>

                    <div class="space-4"></div>

                    <i class="ace-icon fa fa-star orange2"></i>

                    &nbsp;
                    <img class="middle" alt="John\'s Avatar" src="assets/images/avatars/avatar.png" width="32" />
                    &nbsp;
                    <a href="#" class="sender">' . $catsmail['name'] . '</a>

                    &nbsp;
                    <i class="ace-icon fa fa-clock-o bigger-110 orange middle"></i>
                    <span class="time grey">' . $catsmail['dates'] . '</span>
                </div>

                <div class="pull-right action-buttons">
                    <a href="#">
                        <i class="ace-icon fa fa-reply green icon-only bigger-130"></i>
                    </a>

                    <a href="#">
                        <i class="ace-icon fa fa-mail-forward blue icon-only bigger-130"></i>
                    </a>

                    <a href="message.php?action=supprimer&id=' . $catsrow["id"] . '">
                        <i class="ace-icon fa fa-trash-o red icon-only bigger-130"></i>
                    </a>
                </div>
            </div>

            <div class="hr hr-double"></div>

            <div class="message-body">
            <p>
                ' . $catsmail['message'] . '
            </p>
            </div>

            <div class="hr hr-double"></div>

            ';
            }
        }
        if ($action == "supprimer") {
            if (!is_numeric($id)) {
                die('je ne te conseil pas');
            }
            if ($do == "supprimer") {
                if ($id != "") {
                    if (is_numeric($id)) {
                        SQL_Query_exec("DELETE FROM message WHERE id=$id");
                        echo "le message a bien etait supprimé";
                    } else {
                        echo 'tu tente quoi la ??';
                    }

                } else {
                    echo 'Mauvais identifiant de message';
                }
            } else {
                echo 'Vous allez supprimer le message ' . $id;
                echo '<br /><br />';
                echo '<a class="red" href="message.php?action=supprimer&do=supprimer&id=' . $id . '">Cliquez ici</a> si vous voulez effectuer cette action.';
            }
        }
        ?>

        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.page-content -->
</div>
</div><!-- /.main-content -->

<?php
require_once("template/footerad.php");
?>
