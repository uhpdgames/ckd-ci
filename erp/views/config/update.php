<?php
echo form_open($action, array('id' => 'updateFrm', 'class' => 'updateFrm form-horizontal bordered-row'));
echo form_input(array('type' => 'hidden', 'name' => 'token', 'value' => $GLOBALS['var']['token']));
echo form_input(array('type' => 'hidden', 'name' => 'id', 'value' => $info['id']));
echo module_open('');
if (!$GLOBALS['cfg']['develop_mode']) {
    echo form_input(array('type' => 'hidden', 'name' => 'type', 'value' => $info['type']));
}
?>
<tr>
    <td>
        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-border btn-alt btn-hover border-primary font-primary waves-effect"><span><?php echo ($info['id'] ? 'Update' : 'Add new') ?></span><i class="glyph-icon icon-check"></i></button>
                <button type="button" class="btn btn-border btn-alt btn-hover border-red font-red waves-effect" id="backBtn"><span><?php echo ($info['id'] ? 'Back' : 'Cancel') ?></span><i class="glyph-icon icon-arrow-left"></i></button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-3 control-label">Tên cấu hình<?php echo ($GLOBALS['cfg']['develop_mode'] ? ' <span style="color:red">*</span>' : '') ?></div>
            <div class="col-sm-6">
                <?php
                if($GLOBALS['cfg']['develop_mode']) {
                    echo form_input(array('data-required' => 1, 'name' => 'name_vn', 'id' => 'name_vn', 'value' => $info['name_vn'], 'class' => 'form-control'));
                    echo '<div class="errordiv name_vn"><div class="arrow"></div>Vui lòng nhập tên cấu hình!</div>';
                } else {
                    echo form_input(array('type' => 'hidden', 'name' => 'name_vn', 'value' => $info['name_vn'], 'id' => 'name_vn'));
                    echo $info['name_vn'];
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-3 control-label">Nhóm cấu hình</div>
            <div class="col-sm-6">
                <div class="row">
                <?php
                if (!$info['id']) {
                    $info['cat'] = $this->input->cookie('mytab-' . $GLOBALS['var']['act'] . '-', true);
                }
                foreach ($category_list as $data) {
                    echo '<div class="col-md-3 radio-primary"><label><input name="cat" id="cat' . $data['id'] . '" type="radio" class="custom-radio" value="' . $data['id'] . '"' . ($info['cat'] == $data['id'] ? ' checked="checked"' : '') . '/>' . $data['name_vn'] . '</label></div>';
                }
                ?>
                </div>
            </div>
        </div>
        <?php
        if ($GLOBALS['cfg']['develop_mode']) {
        ?>
        <div class="form-group">
            <div class="col-sm-3 control-label">Kiểu nhập liệu</div>
            <div class="col-sm-6">
                <select name="type" id="type" class="form-control">
                    <option value="0"<?php echo ($info['type'] == 0 ? ' selected="selected"' : '') ?>>Đoạn text</option>
                    <option value="1"<?php echo ($info['type'] == 1 ? ' selected="selected"' : '') ?>>Văn bản dài</option>
                    <option value="2"<?php echo ($info['type'] == 2 ? ' selected="selected"' : '') ?>>Yes / no</option>
                    <option value="3"<?php echo ($info['type'] == 3 ? ' selected="selected"' : '') ?>>Văn bản HTML</option>
                    <option value="4"<?php echo ($info['type'] == 4 ? ' selected="selected"' : '') ?>>Thời gian</option>
                </select>
            </div>
        </div>
        <?php
        }
        ?>
        <div class="form-group">
            <div class="col-sm-3 control-label">PHP code<?php echo ($GLOBALS['cfg']['develop_mode'] ? ' <span style="color:red">*</span>' : '') ?></div>
            <div class="col-sm-6">
                <?php
                if ($GLOBALS['cfg']['develop_mode']) {
                    echo form_input(array('data-required' => 1, 'name' => 'keyword', 'id' => 'keyword', 'value' => $info['keyword'], 'class' => 'form-control'));
                    echo '<div class="errordiv keyword"><div class="arrow"></div>Vui lòng nhập mã cấu hình!</div>';
                } else {
                    echo form_input(array('type' => 'hidden', 'name' => 'keyword', 'value' => $info['keyword'], 'id' => 'keyword'));
                    echo '$GLOBALS[<font color="brown">\'cfg\'</font>][<font color="brown">\''.$info['keyword'].'\'</font>]';
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-3 control-label">Giá trị hiển thị</div>
            <div class="col-sm-6">
                <div id="td_value">
                    <?php
                    if ($info['type'] == 0) {
                        echo '<input type="text" class="form-control" name="value" id="value" value="' . $info['value'] . '" class="form-control" />';
                    } else if ($info['type'] == 1) {
                        echo '<textarea class="form-control tar_cfg" name="value" id="value">' . $info['value'] . '</textarea>';
                    } else if ($info['type'] == 2) {
                        echo '<div class="row"><div class="col-md-4 radio-primary"><label><input name="value" id="value1" type="radio" class="custom-radio" value="1"' . ($info['value'] == 1 || $info['value'] == '' ? ' checked="checked"' : '') . ' />Có</label></div><div class="col-md-4 radio-primary"><label><input name="value" id="value0" type="radio" class="custom-radio" value="0"' . ($info['value'] == 0 ? ' checked="checked"' : '') . ' />Không</label></div></div>';
                    } else if ($info['type'] == 3) {
                        echo '<textarea class="mceEditor" name="value" id="value">' . $info['value'] . '</textarea>';
                    } else if ($info['type'] == 4) {
                        $time = json_decode($info['value']);
                        echo '<div id="datepicker"><div class="input-daterange input-group"><input type="text" name="value[from]" value="' . $time->from . '" class="form-control" style="width: 50%; display: inline-block;"/><input type="text" name="value[to]" value="' . $time->to . '" class="form-control" style="width: 50%; display: inline-block;"/></div></div>';
                    }
                    ?>
                </div>
                <div class="errordiv value"><div class="arrow"></div>Vui lòng nhập giá trị cấu hình!</div>
            </div>
        </div>
        <div class="form-group"<?php echo ($GLOBALS['user']['id'] == 1 ? '' : ' style="display: block"') ?>>
            <div class="col-sm-3 control-label">Hidden</div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-md-4 radio-primary"><label><input name="hidden" id="hidden1" type="radio" class="custom-radio" value='1'<?php echo($info['hidden'] == 1 ? ' checked="checked"' : "") ?> />Có</label></div>
                    <div class="col-md-4 radio-primary"><label><input name="hidden" id="hidden0" type="radio" class="custom-radio" value='0'<?php echo($info['hidden'] == 0 ? ' checked="checked"' : '') ?> />Không</label></div>
                </div>
            </div>
        </div>
    </td>
</tr>
<?php
echo module_close();
echo form_close();
?>
<script type="text/javascript">
    $(document).ready(function() {
        <?php
        if ($updated == 1) {
            echo 'showNoti("Cấu hình: ' . $name . '", "Cập nhật cấu hình thành công!", "Ok");';
        }
        ?>
        $('#type').change(function() {
            var type = $(this).val();
            var value = $('[name="value"]').val();
            if (value == '' || value == undefined) {
                value = $('input[type="radio"][checked="checked"]').val();
            }
            if (type == 0) {
                $('#td_value').empty();
                $('#td_value').append('<input type="text" name="value" id="value" value="' + value + '" class="form-control" />');
            }
            if (type == 1) {
                $('#td_value').empty();
                $('#td_value').append('<textarea class="form-control tar_cfg" name="value" id="value">' + value + '</textarea>');
            }
            if (type == 2) {
                $('#td_value').empty();
                $('#td_value').append('<div class="row"><div class="col-md-4 radio-primary"><label><input name="value" id="value1" type="radio" class="custom-radio" value="1"' + (value == 1 || value == '' ? ' checked="checked"' : '') + '/>Có</label></div><div class="col-md-4 radio-primary"><label><input name="value" id="value0" type="radio" class="custom-radio" value="0"' + (value == '0' ? ' checked="checked"' : '') + '/>Không</label></div></div>');
                $('#td_value .radio span').append('<i class="glyph-icon icon-circle"></i>');
            }
            if (type == 3) {
                $('#td_value').empty();
                $('#td_value').append('<textarea class="mceEditor" name="value" id="value" style="height: 240px; width: 100%;">' + value + '</textarea>');
                /*$('.mceEditor2').editable({
                    inlineMode: false,
                    pastedImagesUploadURL: 'ajax/upload_image',
                    imageUploadURL: site_url + 'ajax/upload_image'
                });*/
                tinymce.init({
                    mode : "specific_textareas",
                    theme: "modern",
                    mobile: {
                    theme: 'mobile',
                        plugins: [ 'autosave', 'lists', 'autolink' ]
                    },
                    editor_selector : "mceEditor",
                    entity_encoding : "raw",
                    relative_urls: false,
                    convert_urls : false,
                    remove_script_host: false,
                    plugin_preview_width: 696,
                    height: 300,
                    image_advtab: true,
                    image_caption: true,
                    plugins: [
                        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                        "searchreplace wordcount visualblocks visualchars code fullscreen",
                        "insertdatetime media save table contextmenu moxiecut",
                        "directionality emoticons paste textcolor"
                    ],
                    content_css: site_url + "assets/css/tiny_content.css",
                    toolbar: "undo redo | styleselect | fontselect fontsizeselect | forecolor backcolor emoticons | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media insertfile | print preview fullscreen | code"
                });
            }
            if (type == 4) {
                $('#td_value').empty();
                $('#td_value').append('<div id="datepicker"><div class="input-daterange input-group"><input type="text" name="value[from]" value="" class="form-control" style="width: 50%; display: inline-block;"/><input type="text" name="value[to]" value="" class="form-control" style="width: 50%; display: inline-block;"/></div></div>');
                if ($('#datepicker .input-daterange').length) {
                    $('#datepicker .input-daterange').datepicker({
                        format: 'yyyy-mm-dd',
                        language: 'vi',
                        autoclose: true,
                        todayHighlight: true
                    });
                }
            }
        });
        /*$('.mceEditor2').editable({
            inlineMode: false,
            pastedImagesUploadURL: 'ajax/upload_image',
            imageUploadURL: site_url + 'ajax/upload_image'
        });*/
        tinymce.init({
            mode : "specific_textareas",
            theme: "modern",
            mobile: {
            theme: 'mobile',
                plugins: [ 'autosave', 'lists', 'autolink' ]
            },
            editor_selector : "mceEditor",
            entity_encoding : "raw",
            relative_urls: false,
            convert_urls : false,
            remove_script_host: false,
            plugin_preview_width: 696,
            height: 300,
            image_advtab: true,
            image_caption: true,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media save table contextmenu moxiecut",
                "directionality emoticons paste textcolor"
            ],
            content_css: site_url + "assets/css/tiny_content.css",
            toolbar: "undo redo | styleselect | fontselect fontsizeselect | forecolor backcolor emoticons | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media insertfile | print preview fullscreen | code"
        });
    });
</script>