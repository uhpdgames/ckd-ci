<?php echo module_open(); ?>
<tr class="nodrop">
  	<?php if ($GLOBALS['per']['del']) echo '<th class="center" width="1%"><input id="checkall" type="checkbox" class="checkAll custom-checkbox"/></th>'; ?>
    <th class="center" width="2%">#</th>
    <th width="80%">Tên nhóm</th>
    <th class="center" nowrap="nowrap">Active</th>
  	<th class="center" width="1%">&nbsp;</th>
</tr>
<?php
if (is_array($rows) && count($rows)) {
	$i = 1;
	foreach ($rows as $data) {
?>
<tr class="highlight" id="<?php echo $data['id'] ?>" name="<?php echo $data['name_vn'] ?>">
    <?php if ($GLOBALS['per']['del']) echo '<td class="center" width="1%">'.sel_item($data['id']).'</td>'; ?>
    <td class="center"><?php echo stt($data['id'], $i++) ?></td>
    <td><?php echo $data['name_vn'] ?></td>
    <td class="center" width="5%"><?php echo change_status($data['id'], $data['active'], 'active', 'Kích hoạt', '', '', !$GLOBALS['per']['edit']) ?></td>
	<td class="center" nowrap="nowrap">
        <?php
        if ($GLOBALS['per']['edit']) {
            echo edit_alink($data['id'], '', 'updateLink');
        }
        if ($GLOBALS['per']['del']) {
            echo del_restore_link($data['id'], $data['deleted']);
        }
        ?>
    </td>
</tr>
<?php
        if ($GLOBALS['per']['add'] || $GLOBALS['per']['edit']) {
            echo '<input class="textData '.$data['id'].'" data-field="name_vn" value="'.$data['name_vn'].'" />';
	    }
    }
} else {
    echo no_data_mes(5);
}
echo module_close();
if ($GLOBALS['per']['add'] || $GLOBALS['per']['edit']) {
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <?php
        echo form_open($action, array('id' => 'updateFrm', 'class' => 'updateFrm form-horizontal bordered-row'));
        echo form_input(array('type' => 'hidden', 'name' => 'token', 'value' => $GLOBALS['var']['token']));
        ?>
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <div class="col-sm-12">Tên nhóm cấu hình <span style="color:red">*</span></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" data-required="1" name="name_vn" id="name_vn"/>
                        <div class="errordiv name_vn"><div class="arrow"></div>Vui lòng nhập tên nhóm!</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?php echo form_input(array('type' => 'hidden', 'name' => 'id', 'class' => 'id')); ?>
                <button type="submit" class="btn btn-alt btn-primary btn-hover"><span>Cập nhật</span><i class="glyph-icon icon-check"></i></button>
                <button type="button" class="btn btn-alt btn-danger btn-hover" data-dismiss="modal"><span>Hủy bỏ</span><i class="glyph-icon icon-arrow-left"></i></button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<?php
}
?>
<script type="text/javascript">
    $(document).ready(function() {
        <?php
        if ($added == 1){
            echo 'showNoti("Nhóm cấu hình: ' . $name . '", "Thêm nhóm cấu hình thành công!", "Ok");';
        }
        if ($updated == 1){
            echo 'showNoti("Nhóm cấu hình: ' . $name .'", "Cập nhật nhóm cấu hình thành công!", "Ok");';
        }
        if ($failed == 1){
            echo 'showNoti("Nhóm cấu hình: ' . $name . '", "Cập nhật nhóm cấu hình thất bại!", "Err");';
        }
        if ($GLOBALS['var']['deleted'] != 1){
            echo 'makeDragOrder("'.$GLOBALS['var']['act'].'");';
        }
        ?>
    });
</script>