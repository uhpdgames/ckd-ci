



<?php
if (!$this->input->is_ajax_request()) {
    echo '</div></div></div>';
    ?>
    <a id="btn-scrollup" rel="nofollow" title="L�n d?u trang" onclick="$('html, body').animate({ scrollTop: 0 }, 'slow');"><i class="fa fa-arrow-up"></i></a>
    <div class="modal fade logout-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                    <h4 class="modal-title">�ang xu?t</h4>
                </div>
                <div class="modal-body" style="padding: 5px 15px;">
                    <p>B?n c� ch?c s? dang xu?t kh?i h? th?ng qu?n l�</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a type="button" class="btn btn-primary" href="./dashboard/logout">OK</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animated bounceIn fullsceen-modal" id="colsModal" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"></div>
        </div>
    </div>
    <div class="modal animated bounceIn fullsceen-modal" id="gantt-tasks" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Daily tasks update</h4>
                </div>
                <div class="modal-body-tasks">
                    <div class="alert alert-info alert-gantt-tasks hidden">
                        <strong>Alert!</strong> Currently no job ...
                    </div>
                    <div class="title-my-tasks" style="height: 30px; font-size: 20px; font-weight: bold; text-align: center">
                        My task
                    </div>
                    <div id="gantt_here" class="dhx_cal_container" style="width:100%; height: calc(50% - 30px);"></div>
                    <div class="title-tasks-need-approval" style="height: 30px; font-size: 20px; font-weight: bold; text-align: center">
                        Task Need Approval
                    </div>
                    <div id="gantt_here_too" class="dhx_cal_container" style="width:100%; height: calc(50% - 30px);"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animated bounceIn fullsceen-modal" id="show-nofity" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">NOTIFICATIONS</h4>
                </div>
                <div class="modal-body modal-body-notify">

                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="options-export" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <!-- <div class="sb-slidebar bg-black sb-right sb-style-overlay">
        <div class="scrollable-content scrollable-slim-sidebar">
            <div class="pad15A">
                <a href="#" title="" data-toggle="collapse" data-target="#sidebar-New" class="popover-title">Late <span class="bs-label bg-orange tooltip-button" title="Label example">Warning</span><span class="caret"></span></a>
                <div id="sidebar-New" class="collapse in">
                    <ul class="notifications-box notifications-box-alt">
                        <li class="notification-item">
                            <span class="icon-notification glyph-icon fa fa-exclamation-triangle"></span>
                            <span class="notification-text"></span>
                            <div class="notification-time"><span class="glyph-icon icon-clock-o"></span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
    <!--    modal update ng�n ng? th? th-->
    <div class="modal fade" id="Modal_languages" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="-webkit-box-shadow:unset !important;box-shadow: unset !important;">
                <div class="modal-body">
                    <div class="">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="padding: 15px 0;"></h4>
                    </div>
                    <?php  if($GLOBALS['per']['full']) { ?>
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="col-sm-3 control-label">English</div>
                                    <div class="col-sm-9"><textarea class="form-control tar_lng" name="en" id="enlng"></textarea></div>
                                </div>
                                <div class="form-group" style="padding: 50px 0">
                                    <div class="col-sm-3 control-label">Vietnamese</div>
                                    <div class="col-sm-9"><textarea class="form-control tar_lng" name="vn" id="vnlng"></textarea></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="keyword">
                                <span class="btn btn-alt btn-primary btn-hover" id="updatelng"><span>Update</span><i
                                            class="glyph-icon icon-check"></i></span>
                                <button type="button" class="btn btn-alt btn-danger btn-hover" data-dismiss="modal"><span>Close</span><i
                                            class="glyph-icon icon-arrow-left"></i></button>
                            </div>
                        </div>
                    <?php } else { ?>
                    <div class="form-group">
                        <div class="fetched-data" style="margin-top: 5px;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt btn-danger btn-hover" data-dismiss="modal"><span>Close</span><i class="glyph-icon icon-arrow-left"></i></button>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <style>
        .modal-content {
            -webkit-box-shadow: unset !important;
        }
    </style>
//    <?php 
//        $time_to = '';
//        $time = json_decode($GLOBALS['cfg']['time_update']);
//        if ($time) {
//            if ($time->from <= date('Y-m-d') && date('Y-m-d') <= $time->to) {
//                $time_to = $time->to;
//                echo '<div class="warning-refresh"><div class="content"><div class="close"><i class="fa fa-close"></i></div><p class="notifications">' . destrip_input($GLOBALS['cfg']['website_update_notification']) . '</p><p><font size="5" color="cyan">PLEASE</font></p></div></div>' ;
//            }
//        }
//     ?> 
    <!-- /.Sidebar -->
    <script type="text/javascript" src="assets/js/extra.js"></script>
    <?php echo '</body></html>'; ?>
    <script type="text/javascript" src="assets/js/jquery.alerts.js"></script>
    <script type="text/javascript" src="assets/js/jquery.slimscroll.min.js"></script>
    <script type="text/javascript" src="assets/js/layout.js"></script>
    <script type="text/javascript" src="assets/js/fn.js" charset="utf-8"></script>
    <script type="text/javascript" src="assets/js/atckey.js" charset="utf-8"></script>
    <script type="text/javascript" src="assets/js/uniform.js"></script>
    <script type="text/javascript" src="assets/js/tabs.js"></script>
    <script type="text/javascript" src="assets/js/modal.js"></script>
    <script type="text/javascript" src="assets/js/jquery.amaran.min.js"></script>
    <script type="text/javascript" src="assets/js/waves.min.js"></script>
    <?php if ($GLOBALS['var']['act'] != 'customer_request_management'): ?>
    <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
    <?php endif ?>
    <script type="text/javascript" src="assets/js/jquery.tablednd.js"></script>
    <script type="text/javascript" src="assets/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="assets/js/jquery.uploadfile.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="assets/js/jquery.treeview.js"></script>
    <script type="text/javascript" src="assets/js/jquery.nestable.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-datepicker.vi.min.js"></script>
    <script type="text/javascript" src="assets/js/moment-with-locales.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.accounting.min.js"></script>
    <script type="text/javascript" src="assets/js/select2.min.js"></script>
    <script type="text/javascript" src="assets/js/chosen.js"></script>
    <script type="text/javascript" src="assets/js/jquery.maskedinput.js"></script>
    <script type="text/javascript" src="assets/js/calendar.js"></script>
    <script type="text/javascript" src="assets/js/colorpicker.js"></script>
    <script type="text/javascript" src="assets/js/timepicker.js"></script>
    <script type="text/javascript" src="assets/js/zepto.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.webcam.as3.js"></script>
    <script type="text/javascript" src="assets/js/jquery.history.js"></script>
    <script type="text/javascript" src="assets/js/jquery.stickytableheaders.js"></script>
    <!-- <script type="text/javascript" src="assets/js/froala/froala_editor.min.js"></script> -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="assets/js/froala/froala_editor_ie8.min.js"></script>
    <![endif]-->
    <!-- <script type="text/javascript" src="assets/js/froala/plugins/tables.min.js"></script>
    <script type="text/javascript" src="assets/js/froala/plugins/lists.min.js"></script>
    <script type="text/javascript" src="assets/js/froala/plugins/colors.min.js"></script>
    <script type="text/javascript" src="assets/js/froala/plugins/font_family.min.js"></script>
    <script type="text/javascript" src="assets/js/froala/plugins/font_size.min.js"></script>
    <script type="text/javascript" src="assets/js/froala/plugins/block_styles.min.js"></script>
    <script type="text/javascript" src="assets/js/froala/plugins/media_manager.min.js"></script>
    <script type="text/javascript" src="assets/js/froala/plugins/video.min.js"></script>
    <script type="text/javascript" src="assets/js/froala/plugins/fullscreen.min.js"></script> -->
    <script type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="assets/js/tinymce.js"></script>
    <script type="text/javascript" src="assets/js/jquery.sticky.js"></script>
    <script type="text/javascript" src="assets/js/slidebars.js"></script>
    <script type="text/javascript" src="assets/js/slidebars-demo.js"></script>
    <script type="text/javascript" src="assets/js/jquery.minicolors.js"></script>


    <script src="assets/js/push.js"></script>
    <script src="assets/js/atckey/push_notify.js"></script>
    <?php
}
?>
<script type="text/javascript" src="assets/js/ajax-ready.js"></script>
<input type="hidden" id="login" value="<?echo (isset($GLOBALS['var']['user_id']) ? $GLOBALS['var']['user_id'] : 0)?>" />

<script>
    var countLate = <?php echo isset($countLate) ? $countLate : 0; ?>;
    var current_userid = <?php echo $GLOBALS['user']['id']; ?>;
    var AssignedTo = <?php echo isset($AssignedTo) ? json_encode($AssignedTo) : 0; ?>;
    var due_date = <?php echo isset($time_to) ? '"' . $time_to . '"' : '""' ?>;
    $(document).ready(function () {
        if (countLate > 0 && AssignedTo == current_userid) {
            showNoti('B?n c� ' + countLate + ' c�ng vi?c ph?i ho�n th�nh xong trong h�m nay!', 'C?nh b�o', 'War');
            $('.sb-toggle-right').append('<span class="badge badge-warning">' + countLate + '</span>');
        }
        $('.notifications-box').each(function () {
            if ($(this).find('li.notification-item').length == 0) {
                // $(this).append('<li class="pad10A text-center"><i>Empty</i></li>');
                $(this).parent().hide().prev('a').hide();
            }
        })
        if ($('.scrollable-slim-sidebar').find('li.notification-item').length == 0) { $('.scrollable-slim-sidebar div').append('<div class="text-center"><p class="mrg45B">Hi?n t?i b?n chua c� c�ng vi?c n�o du?c giao.</p><i class="fa fa-smile-o fa-4x font-yellow"></i></div>'); }
    })
</script>
<script type="text/javascript">
    var myTasks = <?php echo $GLOBALS['tasks'] ? $GLOBALS['tasks'] : '' ?>;
    var tasksNeedApproval = <?php echo $GLOBALS['tasks_approver'] ? $GLOBALS['tasks_approver'] : '[]' ?>;
    $('#btn-gantt-tasks').click(function () {
        $('#gantt-tasks').modal('show');
        if (myTasks == '') {
            $('.title-my-tasks').hide();
            $('#gantt_here').hide();
        }
        if (tasksNeedApproval == '') {
            $('.title-tasks-need-approval').hide();
            $('#gantt_here_too').hide();
        }
        if (myTasks == '' && tasksNeedApproval == '') {
            $('.alert-gantt-tasks').removeClass('hidden');
        }
        init();
    })

    function init() {
            var tasksA = {
                data: myTasks
            };
            var tasksB = {
                data: tasksNeedApproval
            };

            gantt.config.work_time = true;

            gantt.config.scale_unit = "day";
            gantt.config.date_scale = "%D, %d";
            gantt.config.min_column_width = 50;
            gantt.config.duration_unit = "day";
            gantt.config.scale_height = 20*3;
            gantt.config.row_height = 25;

            var weekScaleTemplate = function(date){
                var dateToStr = gantt.date.date_to_str("%d %M");
                var weekNum = gantt.date.date_to_str("(week %W)");
                var endDate = gantt.date.add(gantt.date.add(date, 1, "week"), -1, "day");
                return dateToStr(date) + " - " + dateToStr(endDate) + " " + weekNum(date);
            };

            gantt.config.subscales = [
                {unit:"month", step:1, date:"%F, %Y"},
                {unit:"week", step:1, template:weekScaleTemplate}
            ];

            gantt.templates.task_cell_class = function(task, date){
                if(!gantt.isWorkTime(date))
                    return "week_end";
                return "";
            };

            gantt.templates.task_text = function(start,end,task){
                return "<span>"+Math.round(task.progress*100)+ "% </span>";
            };

            gantt.config.columns = [
                { name:"text", label: "Task name", tree:true, width:150, resize: true},
                { name:"start_date", label: "Start time", align: "center", width:100, resize:true},
                { name:"end_date", label: "End time", align: "center", width:100, resize:true},
                { name:"duration", label: "Duration", align: "center", width:100, resize:true},
            ];

            gantt.config.readonly = true;

            gantt.init("gantt_here");
            gantt.parse(tasksA);

            var gantt2 = Gantt.getGanttInstance();

            gantt2.config.work_time = true;

            gantt2.config.scale_unit = "day";
            gantt2.config.date_scale = "%D, %d";
            gantt2.config.min_column_width = 50;
            gantt2.config.duration_unit = "day";
            gantt2.config.scale_height = 20*3;
            gantt2.config.row_height = 25;

            var weekScaleTemplate = function(date){
                var dateToStr = gantt2.date.date_to_str("%d %M");
                var weekNum = gantt2.date.date_to_str("(week %W)");
                var endDate = gantt2.date.add(gantt2.date.add(date, 1, "week"), -1, "day");
                return dateToStr(date) + " - " + dateToStr(endDate) + " " + weekNum(date);
            };

            gantt2.config.subscales = [
                {unit:"month", step:1, date:"%F, %Y"},
                {unit:"week", step:1, template:weekScaleTemplate}
            ];

            gantt2.templates.task_cell_class = function(task, date){
                if(!gantt2.isWorkTime(date))
                    return "week_end";
                return "";
            };

            gantt2.templates.task_text = function(start,end,task){
                return "<span>"+Math.round(task.progress*100)+ "% </span>";
            };

            gantt2.config.columns = [
                { name:"text", label: "Task name", tree:true, width:150, resize: true},
                { name:"start_date", label: "Start time", align: "center", width:100, resize:true},
                { name:"end_date", label: "End time", align: "center", width:100, resize:true},
            ];

            gantt2.config.readonly = true;

            gantt2.init("gantt_here_too");
            gantt2.parse(tasksB);

        }
        if($('.modal-notify').length > 0) {
            $('.notify').css({ 'position': 'relative' });
            $('.notify .badge').css({ 'position': 'absolute', 'top': '-7px', 'right': '-7px' });
            $('#btn-show-notify').removeClass('sb-toggle-right');
        }
    var notify = <?= !is_array(info_notifi()) ? '' : json_encode(info_notifi()) ?>;
    var isOpenNofity = null;
    $('body').on('click', '#btn-show-notify', function (event) {
    if(!isOpenNofity) {
        if($('.modal-notify').length > 0) {
            $('#show-nofity').modal('show');

            var html = '';
            html += '<ul class="border-1px">';
            if(!!notify){
                if(!!notify.new){
                    var n_new = notify.new;
                    $.each(n_new, function (stt, item) {
                        html += '<li class="font-bold bg-red" >&nbsp;NEW </li>';
                        html += '<div class="panel panel-default"> <div class="panel-body"><a class="press-notify" data-id="'+item.id+'" href="'+item.link+'"> <div class="row"> <div class="col-xs-2"> <div class="icon-circle" style="background:'+(item.read == 0 ? '#0093d9': '#00a85a')+'"><i class="fa '+(item.read == 0 ? 'fa-bell': 'fa-bell-slash-o')+'"></i></div> </div> <div class="col-xs-10"><span class="word-break">'+item.content+'</span> <p class="word-break" style="color: #aaa;margin-top: 2px;"><i class="fa fa-clock-o"></i> '+item.date_added+'</p></div> </div> </a></div> </div>';
                    })
                }
                if(!!notify.old){
                    var o_new = notify.old;
                    $.each(o_new, function (stt, item) {
                      html += '<li class="font-bold bg-blue">&nbsp;OLD </li>';
                      html += '<div class="panel panel-default"> <div class="panel-body"><a class="press-notify" data-id="'+item.id+'" href="'+item.link+'"> <div class="row"> <div class="col-xs-2"> <div class="icon-circle" style="background:'+(item.read == 0 ? '#0093d9': '#00a85a')+'"><i class="fa '+(item.read == 0 ? 'fa-bell': 'fa-bell-slash-o')+'"></i></div> </div> <div class="col-xs-10"><span class="word-break">'+item.content+'</span> <p class="word-break" style="color: #aaa;margin-top: 2px;"><i class="fa fa-clock-o"></i> '+item.date_added+'</p></div> </div> </a></div> </div>';
                    })
                }
            }
            html += '</ul>';
            $('.modal-body-notify').html(html);
        }else{
            $(this).prev().addClass('open');
        }
        //$(this).find('.icon-bell').removeClass('icon-bell').addClass('icon-bell-o');
        isOpenNofity = true;
    }
    else {
        isOpenNofity = false;
        $(this).prev().removeClass('open');
        //$(this).find('.icon-bell-o').removeClass('icon-bell-o').addClass('icon-bell');
    }
    event.stopPropagation();

});
        

    </script>
    <?php if ($GLOBALS['user']['level'] != 1): ?>
    <script type="text/javascript" src="assets/js/not-dev.js"></script>
    <?php endif ?>
