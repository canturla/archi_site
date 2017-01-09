</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.page-content -->
</div>
</div><!-- /.main-content -->

<div class="footer">
    <div class="footer-inner">
        <div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Admin</span>
							Application &copy; 2016
						</span>

            &nbsp; &nbsp;

        </div>
    </div>
</div>

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
</a>
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script src="assets/js/jquery-2.1.4.min.js"></script>

<!-- <![endif]-->
<!-- page specific plugin scripts -->
<script src="assets/js/jquery-ui.custom.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/chosen.jquery.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/js/fullcalendar.min.js"></script>
<script src="assets/js/bootbox.js"></script>
<!-- page specific plugin scripts -->
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/jquery.jqGrid.min.js"></script>
<script src="assets/js/grid.locale-en.js"></script>
<!-- page specific plugin scripts -->
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="assets/js/dataTables.buttons.min.js"></script>
<script src="assets/js/buttons.flash.min.js"></script>
<script src="assets/js/buttons.html5.min.js"></script>
<script src="assets/js/buttons.print.min.js"></script>
<script src="assets/js/buttons.colVis.min.js"></script>
<script src="assets/js/dataTables.select.min.js"></script>
<script src="assets/js/excanvas.min.js"></script>
<script src="assets/js/jquery.gritter.min.js"></script>
<script src="assets/js/jquery.easypiechart.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/jquery.hotkeys.index.min.js"></script>
<script src="assets/js/bootstrap-wysiwyg.min.js"></script>
<script src="assets/js/select2.min.js"></script>
<script src="assets/js/spinbox.min.js"></script>
<script src="assets/js/bootstrap-editable.min.js"></script>
<script src="assets/js/ace-editable.min.js"></script>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<script src="assets/js/jquery.inputlimiter.min.js"></script>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<script src="assets/js/bootstrap-tag.min.js"></script>


<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
    if ('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
<?php
if (basename($_SERVER['PHP_SELF']) == 'calendrier.php') {


    ?>

    <script type="text/javascript">
        jQuery(function ($) {

            <!-- inline scripts related to this page -->
            /* initialize the external events
             -----------------------------------------------------------------*/

            $('#external-events div.external-event').each(function () {

// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
// it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

// store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

// make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });


            /* initialize the calendar
             -----------------------------------------------------------------*/

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();


            var calendar = $('#calendar').fullCalendar({
//isRTL: true,
//firstDay: 1,// >> change first day of week

                buttonHtml: {
                    prev: '<i class="ace-icon fa fa-chevron-left"></i>',
                    next: '<i class="ace-icon fa fa-chevron-right"></i>'
                },

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: [
                    {
                        title: 'All Day Event',
                        start: new Date(y, m, 1),
                        className: 'label-important'
                    },
                    {
                        title: 'Long Event',
                        start: moment().subtract(5, 'days').format('YYYY-MM-DD'),
                        end: moment().subtract(1, 'days').format('YYYY-MM-DD'),
                        className: 'label-success'
                    },
                    {
                        title: 'Some Event',
                        start: new Date(y, m, d - 3, 16, 0),
                        allDay: false,
                        className: 'label-info'
                    }
                ]
                ,

                /**eventResize: function(event, delta, revertFunc) {

alert(event.title + " end is now " + event.end.format());

if (!confirm("is this okay?")) {
revertFunc();
}

},*/

                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function (date) { // this function is called when something is dropped

// retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');
                    var $extraEventClass = $(this).attr('data-class');


// we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

// assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = false;
                    if ($extraEventClass) copiedEventObject['className'] = [$extraEventClass];

// render the event on the calendar
// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

// is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
// if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }

                }
                ,
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {

                    bootbox.prompt("New Event Title:", function (title) {
                        if (title !== null) {
                            calendar.fullCalendar('renderEvent',
                                {
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay,
                                    className: 'label-info'
                                },
                                true // make the event "stick"
                            );
                        }
                    });


                    calendar.fullCalendar('unselect');
                }
                ,
                eventClick: function (calEvent, jsEvent, view) {

//display a modal
                    var modal =
                        '<div class="modal fade">\
                            <div class="modal-dialog">\
                                <div class="modal-content">\
                                    <div class="modal-body">\
                                        <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
                                        <form class="no-margin">\
                                            <label>changer le nom de l\'evenement &nbsp;</label>\
                                            <input class="middle" autocomplete="off" type="text" value="' + calEvent.title + '" />\
                    <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Sauvegarde</button>\
                </form>\
            </div>\
            <div class="modal-footer">\
                <button type="button" class="btn btn-sm btn-danger" data-action="delete"><i class="ace-icon fa fa-trash-o"></i> supprimer Evenement</button>\
                <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Retour</button>\
            </div>\
        </div>\
    </div>\
</div>';


                    var modal = $(modal).appendTo('body');
                    modal.find('form').on('submit', function (ev) {
                        ev.preventDefault();

                        calEvent.title = $(this).find("input[type=text]").val();
                        calendar.fullCalendar('updateEvent', calEvent);
                        modal.modal("hide");
                    });
                    modal.find('button[data-action=delete]').on('click', function () {
                        calendar.fullCalendar('removeEvents', function (ev) {
                            return (ev._id == calEvent._id);
                        })
                        modal.modal("hide");
                    });

                    modal.modal('show').on('hidden', function () {
                        modal.remove();
                    });


//console.log(calEvent.id);
//console.log(jsEvent);
//console.log(view);

// change the border color just for fun
//$(this).css('border-color', 'red');

                }

            });


        })
    </script>
    <?php
}

if (basename($_SERVER['PHP_SELF']) == 'categoriead.php' || basename($_SERVER['PHP_SELF']) == 'nouveautesad.php' || basename($_SERVER['PHP_SELF']) == 'produitad.php') {

    ?>
    <script type="text/javascript">
        jQuery(function ($) {
            //initiate dataTables plugin
            var myTable =
                $('#dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                    .DataTable({
                        bAutoWidth: false,
                        "aoColumns": [
                            {"bSortable": false},
                            null, null, null, null, null,
                            {"bSortable": false}
                        ],
                        "aaSorting": [],


                        //"bProcessing": true,
                        //"bServerSide": true,
                        //"sAjaxSource": "http://127.0.0.1/table.php"	,

                        //,
                        //"sScrollY": "200px",
                        //"bPaginate": false,

                        //"sScrollX": "100%",
                        //"sScrollXInner": "120%",
                        //"bScrollCollapse": true,
                        //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                        //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                        //"iDisplayLength": 50


                        select: {
                            style: 'multi'
                        }
                    });


            $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

            new $.fn.dataTable.Buttons(myTable, {
                buttons: [
                    {
                        "extend": "colvis",
                        "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        columns: ':not(:first):not(:last)'
                    },
                    {
                        "extend": "copy",
                        "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "csv",
                        "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "excel",
                        "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "pdf",
                        "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "print",
                        "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        autoPrint: false,
                        message: 'This print was produced using the Print button for DataTables'
                    }
                ]
            });
            myTable.buttons().container().appendTo($('.tableTools-container'));

            //style the message box
            var defaultCopyAction = myTable.button(1).action();
            myTable.button(1).action(function (e, dt, button, config) {
                defaultCopyAction(e, dt, button, config);
                $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
            });


            var defaultColvisAction = myTable.button(0).action();
            myTable.button(0).action(function (e, dt, button, config) {

                defaultColvisAction(e, dt, button, config);


                if ($('.dt-button-collection > .dropdown-menu').length == 0) {
                    $('.dt-button-collection')
                        .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                        .find('a').attr('href', '#').wrap("<li />")
                }
                $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
            });

            ////

            setTimeout(function () {
                $($('.tableTools-container')).find('a.dt-button').each(function () {
                    var div = $(this).find(' > div').first();
                    if (div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
                    else $(this).tooltip({container: 'body', title: $(this).text()});
                });
            }, 500);


            myTable.on('select', function (e, dt, type, index) {
                if (type === 'row') {
                    $(myTable.row(index).node()).find('input:checkbox').prop('checked', true);
                }
            });
            myTable.on('deselect', function (e, dt, type, index) {
                if (type === 'row') {
                    $(myTable.row(index).node()).find('input:checkbox').prop('checked', false);
                }
            });


            /////////////////////////////////
            //table checkboxes
            $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

            //select/deselect all rows according to table header checkbox
            $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function () {
                var th_checked = this.checked;//checkbox inside "TH" table header

                $('#dynamic-table').find('tbody > tr').each(function () {
                    var row = this;
                    if (th_checked) myTable.row(row).select();
                    else  myTable.row(row).deselect();
                });
            });

            //select/deselect a row when the checkbox is checked/unchecked
            $('#dynamic-table').on('click', 'td input[type=checkbox]', function () {
                var row = $(this).closest('tr').get(0);
                if (this.checked) myTable.row(row).deselect();
                else myTable.row(row).select();
            });


            $(document).on('click', '#dynamic-table .dropdown-toggle', function (e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();
            });


            //And for the first simple table, which doesn't have TableTools or dataTables
            //select/deselect all rows according to table header checkbox
            var active_class = 'active';
            $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function () {
                var th_checked = this.checked;//checkbox inside "TH" table header

                $(this).closest('table').find('tbody > tr').each(function () {
                    var row = this;
                    if (th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                    else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
                });
            });

            //select/deselect a row when the checkbox is checked/unchecked
            $('#simple-table').on('click', 'td input[type=checkbox]', function () {
                var $row = $(this).closest('tr');
                if ($row.is('.detail-row ')) return;
                if (this.checked) $row.addClass(active_class);
                else $row.removeClass(active_class);
            });


            /********************************/
            //add tooltip for small view action buttons in dropdown menu
            $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

            //tooltip placement on right or left
            function tooltip_placement(context, source) {
                var $source = $(source);
                var $parent = $source.closest('table')
                var off1 = $parent.offset();
                var w1 = $parent.width();

                var off2 = $source.offset();
                //var w2 = $source.width();

                if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
                return 'left';
            }


            /***************/
            $('.show-details-btn').on('click', function (e) {
                e.preventDefault();
                $(this).closest('tr').next().toggleClass('open');
                $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
            });
            /***************/


            /**
             //add horizontal scrollbars to a simple table
             $('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
             {
               horizontal: true,
               styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
               size: 2000,
               mouseWheelLock: true
             }
             ).css('padding-top', '12px');
             */


        })
    </script>

    <?php
}
if (basename($_SERVER['PHP_SELF']) == 'accueilad.php') {
    ?>
    <script type="text/javascript">
        jQuery(function ($) {

            //editables on first profile page
            $.fn.editable.defaults.mode = 'inline';
            $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
            $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>' +
                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';

            //editables

            //text editable
            $('#username')
                .editable({
                    type: 'text',
                    name: 'username'
                });


            //select2 editable
            var countries = [];
            $.each({
                "CA": "Canada",
                "IN": "India",
                "NL": "Netherlands",
                "TR": "Turkey",
                "US": "United States"
            }, function (k, v) {
                countries.push({id: k, text: v});
            });

            var cities = [];
            cities["CA"] = [];
            $.each(["Toronto", "Ottawa", "Calgary", "Vancouver"], function (k, v) {
                cities["CA"].push({id: v, text: v});
            });

            var currentValue = "NL";
            $('#country').editable({
                type: 'select2',
                value: 'NL',
                //onblur:'ignore',
                source: countries,
                select2: {
                    'width': 140
                },
                success: function (response, newValue) {
                    if (currentValue == newValue) return;
                    currentValue = newValue;

                    var new_source = (!newValue || newValue == "") ? [] : cities[newValue];

                    //the destroy method is causing errors in x-editable v1.4.6+
                    //it worked fine in v1.4.5
                    /**
                     $('#city').editable('destroy').editable({
							type: 'select2',
							source: new_source
						}).editable('setValue', null);
                     */

                        //so we remove it altogether and create a new element
                    var city = $('#city').removeAttr('id').get(0);
                    $(city).clone().attr('id', 'city').text('Select City').editable({
                        type: 'select2',
                        value: null,
                        //onblur:'ignore',
                        source: new_source,
                        select2: {
                            'width': 140
                        }
                    }).insertAfter(city);//insert it after previous instance
                    $(city).remove();//remove previous instance

                }
            });

            $('#city').editable({
                type: 'select2',
                value: 'Amsterdam',
                //onblur:'ignore',
                source: cities[currentValue],
                select2: {
                    'width': 140
                }
            });


            //custom date editable
            $('#signup').editable({
                type: 'adate',
                date: {
                    //datepicker plugin options
                    format: 'yyyy/mm/dd',
                    viewformat: 'yyyy/mm/dd',
                    weekStart: 1

                    //,nativeUI: true//if true and browser support input[type=date], native browser control will be used
                    //,format: 'yyyy-mm-dd',
                    //viewformat: 'yyyy-mm-dd'
                }
            })

            $('#age').editable({
                type: 'spinner',
                name: 'age',
                spinner: {
                    min: 16,
                    max: 99,
                    step: 1,
                    on_sides: true
                    //,nativeUI: true//if true and browser support input[type=number], native browser control will be used
                }
            });


            $('#login').editable({
                type: 'slider',
                name: 'login',

                slider: {
                    min: 1,
                    max: 50,
                    width: 100
                    //,nativeUI: true//if true and browser support input[type=range], native browser control will be used
                },
                success: function (response, newValue) {
                    if (parseInt(newValue) == 1)
                        $(this).html(newValue + " hour ago");
                    else $(this).html(newValue + " hours ago");
                }
            });

            $('#about').editable({
                mode: 'inline',
                type: 'wysiwyg',
                name: 'about',

                wysiwyg: {
                    //css : {'max-width':'300px'}
                },
                success: function (response, newValue) {
                }
            });


            // *** editable avatar *** //
            try {//ie8 throws some harmless exceptions, so let's catch'em

                //first let's add a fake appendChild method for Image element for browsers that have a problem with this
                //because editable plugin calls appendChild, and it causes errors on IE at unpredicted points
                try {
                    document.createElement('IMG').appendChild(document.createElement('B'));
                } catch (e) {
                    Image.prototype.appendChild = function (el) {
                    }
                }

                var last_gritter
                $('#avatar').editable({
                    type: 'image',
                    name: 'avatar',
                    value: null,
                    //onblur: 'ignore',  //don't reset or hide editable onblur?!
                    image: {
                        //specify ace file input plugin's options here
                        btn_choose: 'Change Avatar',
                        droppable: true,
                        maxSize: 110000,//~100Kb

                        //and a few extra ones here
                        name: 'avatar',//put the field name here as well, will be used inside the custom plugin
                        on_error: function (error_type) {//on_error function will be called when the selected file has a problem
                            if (last_gritter) $.gritter.remove(last_gritter);
                            if (error_type == 1) {//file format error
                                last_gritter = $.gritter.add({
                                    title: 'File is not an image!',
                                    text: 'Please choose a jpg|gif|png image!',
                                    class_name: 'gritter-error gritter-center'
                                });
                            } else if (error_type == 2) {//file size rror
                                last_gritter = $.gritter.add({
                                    title: 'File too big!',
                                    text: 'Image size should not exceed 100Kb!',
                                    class_name: 'gritter-error gritter-center'
                                });
                            }
                            else {//other error
                            }
                        },
                        on_success: function () {
                            $.gritter.removeAll();
                        }
                    },
                    url: function (params) {
                        // ***UPDATE AVATAR HERE*** //
                        //for a working upload example you can replace the contents of this function with
                        //examples/profile-avatar-update.js

                        var deferred = new $.Deferred

                        var value = $('#avatar').next().find('input[type=hidden]:eq(0)').val();
                        if (!value || value.length == 0) {
                            deferred.resolve();
                            return deferred.promise();
                        }


                        //dummy upload
                        setTimeout(function () {
                            if ("FileReader" in window) {
                                //for browsers that have a thumbnail of selected image
                                var thumb = $('#avatar').next().find('img').data('thumb');
                                if (thumb) $('#avatar').get(0).src = thumb;
                            }

                            deferred.resolve({'status': 'OK'});

                            if (last_gritter) $.gritter.remove(last_gritter);
                            last_gritter = $.gritter.add({
                                title: 'Avatar Updated!',
                                text: 'Uploading to server can be easily implemented. A working example is included with the template.',
                                class_name: 'gritter-info gritter-center'
                            });

                        }, parseInt(Math.random() * 800 + 800))

                        return deferred.promise();

                        // ***END OF UPDATE AVATAR HERE*** //
                    },

                    success: function (response, newValue) {
                    }
                })
            } catch (e) {
            }

            /**
             //let's display edit mode by default?
             var blank_image = true;//somehow you determine if image is initially blank or not, or you just want to display file input at first
             if(blank_image) {
					$('#avatar').editable('show').on('hidden', function(e, reason) {
						if(reason == 'onblur') {
							$('#avatar').editable('show');
							return;
						}
						$('#avatar').off('hidden');
					})
				}
             */

            //another option is using modals
            $('#avatar2').on('click', function () {
                var modal =
                    '<div class="modal fade">\
                      <div class="modal-dialog">\
                       <div class="modal-content">\
                        <div class="modal-header">\
                            <button type="button" class="close" data-dismiss="modal">&times;</button>\
                            <h4 class="blue">Change Avatar</h4>\
                        </div>\
                        \
                        <form class="no-margin">\
                         <div class="modal-body">\
                            <div class="space-4"></div>\
                            <div style="width:75%;margin-left:12%;"><input type="file" name="file-input" /></div>\
                         </div>\
                        \
                         <div class="modal-footer center">\
                            <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Submit</button>\
                            <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>\
                         </div>\
                        </form>\
                      </div>\
                     </div>\
                    </div>';


                var modal = $(modal);
                modal.modal("show").on("hidden", function () {
                    modal.remove();
                });

                var working = false;

                var form = modal.find('form:eq(0)');
                var file = form.find('input[type=file]').eq(0);
                file.ace_file_input({
                    style: 'well',
                    btn_choose: 'Click to choose new avatar',
                    btn_change: null,
                    no_icon: 'ace-icon fa fa-picture-o',
                    thumbnail: 'small',
                    before_remove: function () {
                        //don't remove/reset files while being uploaded
                        return !working;
                    },
                    allowExt: ['jpg', 'jpeg', 'png', 'gif'],
                    allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
                });

                form.on('submit', function () {
                    if (!file.data('ace_input_files')) return false;

                    file.ace_file_input('disable');
                    form.find('button').attr('disabled', 'disabled');
                    form.find('.modal-body').append("<div class='center'><i class='ace-icon fa fa-spinner fa-spin bigger-150 orange'></i></div>");

                    var deferred = new $.Deferred;
                    working = true;
                    deferred.done(function () {
                        form.find('button').removeAttr('disabled');
                        form.find('input[type=file]').ace_file_input('enable');
                        form.find('.modal-body > :last-child').remove();

                        modal.modal("hide");

                        var thumb = file.next().find('img').data('thumb');
                        if (thumb) $('#avatar2').get(0).src = thumb;

                        working = false;
                    });


                    setTimeout(function () {
                        deferred.resolve();
                    }, parseInt(Math.random() * 800 + 800));

                    return false;
                });

            });


            //////////////////////////////
            $('#profile-feed-1').ace_scroll({
                height: '450px',
                min-height
            :
            '300px',
                mouseWheelLock
            :
            true,
                alwaysVisible
            :
            true
        })
            ;

            $('a[ data-original-title]').tooltip();

            $('.easy-pie-chart.percentage').each(function () {
                var barColor = $(this).data('color') || '#555';
                var trackColor = '#E2E2E2';
                var size = parseInt($(this).data('size')) || 72;
                $(this).easyPieChart({
                    barColor: barColor,
                    trackColor: trackColor,
                    scaleColor: false,
                    lineCap: 'butt',
                    lineWidth: parseInt(size / 10),
                    animate: false,
                    size: size
                }).css('color', barColor);
            });

            ///////////////////////////////////////////

            //right & left position
            //show the user info on right or left depending on its position
            $('#user-profile-2 .memberdiv').on('mouseenter touchstart', function () {
                var $this = $(this);
                var $parent = $this.closest('.tab-pane');

                var off1 = $parent.offset();
                var w1 = $parent.width();

                var off2 = $this.offset();
                var w2 = $this.width();

                var place = 'left';
                if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) place = 'right';

                $this.find('.popover').removeClass('right left').addClass(place);
            }).on('click', function (e) {
                e.preventDefault();
            });


            ///////////////////////////////////////////
            $('#user-profile-3')
                .find('input[type=file]').ace_file_input({
                style: 'well',
                btn_choose: 'Change avatar',
                btn_change: null,
                no_icon: 'ace-icon fa fa-picture-o',
                thumbnail: 'large',
                droppable: true,

                allowExt: ['jpg', 'jpeg', 'png', 'gif'],
                allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
            })
                .end().find('button[type=reset]').on(ace.click_event, function () {
                $('#user-profile-3 input[type=file]').ace_file_input('reset_input');
            })
                .end().find('.date-picker').datepicker().next().on(ace.click_event, function () {
                $(this).prev().focus();
            })
            $('.input-mask-phone').mask('(999) 999-9999');

            $('#user-profile-3').find('input[type=file]').ace_file_input('show_file_list', [{
                type: 'image',
                name: $('#avatar').attr('src')
            }]);


            ////////////////////
            //change profile
            $('[data-toggle="buttons"] .btn').on('click', function (e) {
                var target = $(this).find('input[type=radio]');
                var which = parseInt(target.val());
                $('.user-profile').parent().addClass('hide');
                $('#user-profile-' + which).parent().removeClass('hide');
            });


            /////////////////////////////////////
            $(document).one('ajaxloadstart.page', function (e) {
                //in ajax mode, remove remaining elements before leaving page
                try {
                    $('.editable').editable('destroy');
                } catch (e) {
                }
                $('[class*=select2]').remove();
            });
        });
    </script>
    <?php
}
if (basename($_SERVER['PHP_SELF']) == 'message.php') {
    ?>
    <script type="text/javascript">
        jQuery(function ($) {

            //handling tabs and loading/displaying relevant messages and forms
            //not needed if using the alternative view, as described in docs
            $('#inbox-tabs a[data-toggle="tab"]').on('show.bs.tab', function (e) {
                var currentTab = $(e.target).data('target');
                if (currentTab == 'write') {
                    Inbox.show_form();
                }
                else if (currentTab == 'inbox') {
                    Inbox.show_list();
                }
            })


            //basic initializations
            $('.message-list .message-item input[type=checkbox]').removeAttr('checked');
            $('.message-list').on('click', '.message-item input[type=checkbox]', function () {
                $(this).closest('.message-item').toggleClass('selected');
                if (this.checked) Inbox.display_bar(1);//display action toolbar when a message is selected
                else {
                    Inbox.display_bar($('.message-list input[type=checkbox]:checked').length);
                    //determine number of selected messages and display/hide action toolbar accordingly
                }
            });


            //check/uncheck all messages
            $('#id-toggle-all').removeAttr('checked').on('click', function () {
                if (this.checked) {
                    Inbox.select_all();
                } else Inbox.select_none();
            });

            //select all
            $('#id-select-message-all').on('click', function (e) {
                e.preventDefault();
                Inbox.select_all();
            });

            //select none
            $('#id-select-message-none').on('click', function (e) {
                e.preventDefault();
                Inbox.select_none();
            });

            //select read
            $('#id-select-message-read').on('click', function (e) {
                e.preventDefault();
                Inbox.select_read();
            });

            //select unread
            $('#id-select-message-unread').on('click', function (e) {
                e.preventDefault();
                Inbox.select_unread();
            });

            /////////

            //display first message in a new area
            $('.message-list .message-item:eq(0) .text').on('click', function () {
                //show the loading icon
                $('.message-container').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-spinner orange2 bigger-160"></i></div>');

                $('.message-inline-open').removeClass('message-inline-open').find('.message-content').remove();

                var message_list = $(this).closest('.message-list');

                $('#inbox-tabs a[href="#inbox"]').parent().removeClass('active');
                //some waiting
                setTimeout(function () {

                    //hide everything that is after .message-list (which is either .message-content or .message-form)
                    message_list.next().addClass('hide');
                    $('.message-container').find('.message-loading-overlay').remove();

                    //close and remove the inline opened message if any!

                    //hide all navbars
                    $('.message-navbar').addClass('hide');
                    //now show the navbar for single message item
                    $('#id-message-item-navbar').removeClass('hide');

                    //hide all footers
                    $('.message-footer').addClass('hide');
                    //now show the alternative footer
                    $('.message-footer-style2').removeClass('hide');


                    //move .message-content next to .message-list and hide .message-list
                    $('.message-content').removeClass('hide').insertAfter(message_list.addClass('hide'));

                    //add scrollbars to .message-body
                    $('.message-content .message-body').ace_scroll({
                        size: 150,
                        mouseWheelLock: true,
                        styleClass: 'scroll-visible'
                    });

                }, 500 + parseInt(Math.random() * 500));
            });


            //display second message right inside the message list
            $('.message-list .message-item:eq(1) .text').on('click', function () {
                var message = $(this).closest('.message-item');

                //if message is open, then close it
                if (message.hasClass('message-inline-open')) {
                    message.removeClass('message-inline-open').find('.message-content').remove();
                    return;
                }

                $('.message-container').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-spinner orange2 bigger-160"></i></div>');
                setTimeout(function () {
                    $('.message-container').find('.message-loading-overlay').remove();
                    message
                        .addClass('message-inline-open')
                        .append('<div class="message-content" />')
                    var content = message.find('.message-content:last').html($('#id-message-content').html());

                    //remove scrollbar elements
                    content.find('.scroll-track').remove();
                    content.find('.scroll-content').children().unwrap();

                    content.find('.message-body').ace_scroll({
                        size: 150,
                        mouseWheelLock: true,
                        styleClass: 'scroll-visible'
                    });

                }, 500 + parseInt(Math.random() * 500));

            });


            //back to message list
            $('.btn-back-message-list').on('click', function (e) {

                e.preventDefault();
                $('#inbox-tabs a[href="#inbox"]').tab('show');
            });


            //hide message list and display new message form
            /**
             $('.btn-new-mail').on('click', function(e){
					e.preventDefault();
					Inbox.show_form();
				});
             */




            var Inbox = {
                //displays a toolbar according to the number of selected messages
                display_bar: function (count) {
                    if (count == 0) {
                        $('#id-toggle-all').removeAttr('checked');
                        $('#id-message-list-navbar .message-toolbar').addClass('hide');
                        $('#id-message-list-navbar .message-infobar').removeClass('hide');
                    }
                    else {
                        $('#id-message-list-navbar .message-infobar').addClass('hide');
                        $('#id-message-list-navbar .message-toolbar').removeClass('hide');
                    }
                }
                ,
                select_all: function () {
                    var count = 0;
                    $('.message-item input[type=checkbox]').each(function () {
                        this.checked = true;
                        $(this).closest('.message-item').addClass('selected');
                        count++;
                    });

                    $('#id-toggle-all').get(0).checked = true;

                    Inbox.display_bar(count);
                }
                ,
                select_none: function () {
                    $('.message-item input[type=checkbox]').removeAttr('checked').closest('.message-item').removeClass('selected');
                    $('#id-toggle-all').get(0).checked = false;

                    Inbox.display_bar(0);
                }
                ,
                select_read: function () {
                    $('.message-unread input[type=checkbox]').removeAttr('checked').closest('.message-item').removeClass('selected');

                    var count = 0;
                    $('.message-item:not(.message-unread) input[type=checkbox]').each(function () {
                        this.checked = true;
                        $(this).closest('.message-item').addClass('selected');
                        count++;
                    });
                    Inbox.display_bar(count);
                }
                ,
                select_unread: function () {
                    $('.message-item:not(.message-unread) input[type=checkbox]').removeAttr('checked').closest('.message-item').removeClass('selected');

                    var count = 0;
                    $('.message-unread input[type=checkbox]').each(function () {
                        this.checked = true;
                        $(this).closest('.message-item').addClass('selected');
                        count++;
                    });

                    Inbox.display_bar(count);
                }
            }

            //show message list (back from writing mail or reading a message)
            Inbox.show_list = function () {
                $('.message-navbar').addClass('hide');
                $('#id-message-list-navbar').removeClass('hide');

                $('.message-footer').addClass('hide');
                $('.message-footer:not(.message-footer-style2)').removeClass('hide');

                $('.message-list').removeClass('hide').next().addClass('hide');
                //hide the message item / new message window and go back to list
            }

            //show write mail form
            Inbox.show_form = function () {
                if ($('.message-form').is(':visible')) return;
                if (!form_initialized) {
                    initialize_form();
                }


                var message = $('.message-list');
                $('.message-container').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-spinner orange2 bigger-160"></i></div>');

                setTimeout(function () {
                    message.next().addClass('hide');

                    $('.message-container').find('.message-loading-overlay').remove();

                    $('.message-list').addClass('hide');
                    $('.message-footer').addClass('hide');
                    $('.message-form').removeClass('hide').insertAfter('.message-list');

                    $('.message-navbar').addClass('hide');
                    $('#id-message-new-navbar').removeClass('hide');


                    //reset form??
                    $('.message-form .wysiwyg-editor').empty();

                    $('.message-form .ace-file-input').closest('.file-input-container:not(:first-child)').remove();
                    $('.message-form input[type=file]').ace_file_input('reset_input');

                    $('.message-form').get(0).reset();

                }, 300 + parseInt(Math.random() * 300));
            }


            var form_initialized = false;

            function initialize_form() {
                if (form_initialized) return;
                form_initialized = true;

                //intialize wysiwyg editor
                $('.message-form .wysiwyg-editor').ace_wysiwyg({
                    toolbar: [
                        'bold',
                        'italic',
                        'strikethrough',
                        'underline',
                        null,
                        'justifyleft',
                        'justifycenter',
                        'justifyright',
                        null,
                        'createLink',
                        'unlink',
                        null,
                        'undo',
                        'redo'
                    ]
                }).prev().addClass('wysiwyg-style1');


                //file input
                $('.message-form input[type=file]').ace_file_input()
                    .closest('.ace-file-input')
                    .addClass('width-90 inline')
                    .wrap('<div class="form-group file-input-container"><div class="col-sm-7"></div></div>');

                //Add Attachment
                //the button to add a new file input
                $('#id-add-attachment')
                    .on('click', function () {
                        var file = $('<input type="file" name="attachment[]" />').appendTo('#form-attachments');
                        file.ace_file_input();

                        file.closest('.ace-file-input')
                            .addClass('width-90 inline')
                            .wrap('<div class="form-group file-input-container"><div class="col-sm-7"></div></div>')
                            .parent().append('<div class="action-buttons pull-right col-xs-1">\
							<a href="#" data-action="delete" class="middle">\
								<i class="ace-icon fa fa-trash-o red bigger-130 middle"></i>\
							</a>\
						</div>')
                            .find('a[data-action=delete]').on('click', function (e) {
                            //the button that removes the newly inserted file input
                            e.preventDefault();
                            $(this).closest('.file-input-container').hide(300, function () {
                                $(this).remove()
                            });
                        });
                    });
            }//initialize_form

            //turn the recipient field into a tag input field!
            /**
             var tag_input = $('#form-field-recipient');
             try {
					tag_input.tag({placeholder:tag_input.attr('placeholder')});
				} catch(e) {}


             //and add form reset functionality
             $('#id-message-form').on('reset', function(){
					$('.message-form .message-body').empty();

					$('.message-form .ace-file-input:not(:first-child)').remove();
					$('.message-form input[type=file]').ace_file_input('reset_input_ui');

					var val = tag_input.data('value');
					tag_input.parent().find('.tag').remove();
					$(val.split(',')).each(function(k,v){
						tag_input.before('<span class="tag">'+v+'<button class="close" type="button">&times;</button></span>');
					});
				});
             */

        });
    </script>
    <?php
}
?>
</body>
</html>




