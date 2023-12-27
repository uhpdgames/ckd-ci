<?php
echo form_open($action, array('id' => 'updateFrm', 'class' => 'updateFrm form-horizontal bordered-row'));
echo form_input(array('type' => 'hidden', 'name' => 'token', 'value' => $GLOBALS['var']['token']));
echo form_input(array('type' => 'hidden', 'name' => 'id', 'value' => $user['id']));
echo form_input(array('type' => 'hidden', 'name' => 'username', 'value' => $user['username']));
echo module_open('');
?>
<tr>
    <td>
        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-border btn-alt btn-hover border-primary font-primary waves-effect"><span>Update</span><i class="glyph-icon icon-check"></i></button>
                <button type="button" class="btn btn-border btn-alt btn-hover border-red font-red waves-effect" id="backBtn"><span>Back</span><i class="glyph-icon icon-arrow-left"></i></button>
            </div>
        </div>
        <style>
            .test{
                display: none;
            }
            .test2{
                display: block;
            }
        </style>
        <?php
        $userrights = $test;
        foreach ($modules_groups as $cat) {

            $i = $cat['id'];
            $group = '';
            if (is_array($tab_dashboard[$i]) && count($tab_dashboard[$i])) {
                $html[$i] = '';
                $n = 0;
                $html[$i] .= '<tr><td class="permission-title">' . $cat['name_vn'] . '<a href="#collapse-' . $i . '" class="pull-right" data-toggle="collapse"><i class="fa fa-angle-down font-bold font-blue"></i></a></td></tr>';
                $html[$i] .= '<tr><td><div id="collapse-' . $i . '" class="collapse in">';
                foreach ($tab_dashboard[$i] as $row) {
                    if (check_rights($row['file'])) {
                        $disable = ($user['level'] < $user_level || $user['id'] == 1);
                        $act = json_decode($row['rights']);
                        $html[$i] .= '<div class="permission-item">';
                        $html[$i] .= '    <i class="' . $row['image'] . '"></i>';
                        $html[$i] .= '    <span class="name">' . $row['name_vn'] . '</span>';
                        $html[$i] .= '    <div class="rights">';
                        if ($act->view) {
                            $check = 0;
                            $check = $userrights->{$row['file']}->view;
                            $html[$i] .= '<div '.($disable ? 'class="disabled"' : '').'>';
                            $html[$i] .= '<span class="permission-icon fa fa-list waves-effect waves-circle '.($check == 1 ? 'red' : 'gray').'" title="View"></span>';
                            $html[$i] .= '<input name="rights['.$row['file'].'][view]" data-type="1" type="checkbox" value="1"'.($check == 1 ? ' checked="checked"' : '').' />';
                            $html[$i] .= '<input name="rights['.$row['file'].'][view]" data-type="0" type="checkbox" value="0"'.($check == 0 ? ' checked="checked"' : '').' />';
                            $html[$i] .= '</div>';
                        }
                        if ($act->add) {
                            $check = 0;
                            $check = $userrights->{$row['file']}->add;
                            $html[$i] .= '<div '.($disable ? 'class="disabled"' : '').'>';
                            $html[$i] .= '<span class="permission-icon fa fa-plus-circle waves-effect waves-circle '.($check == 1 ? 'red' : 'gray').'" title="Add New"></span>';
                            $html[$i] .= '<input name="rights['.$row['file'].'][add]" data-type="1" type="checkbox" value="1"'.($check == 1 ? ' checked="checked"' : '').' />';
                            $html[$i] .= '<input name="rights['.$row['file'].'][add]" data-type="0" type="checkbox" value="0"'.($check == 0 ? ' checked="checked"' : '').' />';
                            $html[$i] .= '</div>';
                        }
                        if ($act->edit) {
                            $check = 0;
                            $check = $userrights->{$row['file']}->edit;
                            $html[$i] .= '<div '.($disable ? 'class="disabled"' : '').'>';
                            $html[$i] .= '<span class="permission-icon fa fa-pencil waves-effect waves-circle '.($check == 1 ? 'red' : 'gray').'" title="Edit"></span>';
                            $html[$i] .= '<input name="rights['.$row['file'].'][edit]" data-type="1" type="checkbox" value="1"'.($check == 1 ? ' checked="checked"' : '').' />';
                            $html[$i] .= '<input name="rights['.$row['file'].'][edit]" data-type="0" type="checkbox" value="0"'.($check == 0 ? ' checked="checked"' : '').' />';
                            $html[$i] .= '</div>';
                        }
                        if ($act->del) {
                            $check = 0;
                            $check = $userrights->{$row['file']}->del;
                            $html[$i] .= '<div '.($disable ? 'class="disabled"' : '').'>';
                            $html[$i] .= '<span class="permission-icon fa fa-trash-o waves-effect waves-circle '.($check == 1 ? 'red' : 'gray').'" title="Delete / Restore"></span>';
                            $html[$i] .= '<input name="rights['.$row['file'].'][del]" data-type="1" type="checkbox" value="1"'.($check == 1 ? ' checked="checked"' : '').' />';
                            $html[$i] .= '<input name="rights['.$row['file'].'][del]" data-type="0" type="checkbox" value="0"'.($check == 0 ? ' checked="checked"' : '').' />';
                            $html[$i] .= '</div>';
                        }
                        if ($act->full) {
                            $check = 0;
                            $check = $userrights->{$row['file']}->full;
                            $html[$i] .= '<div '.($disable ? 'class="disabled"' : '').'>';
                            $html[$i] .= '<span class="permission-icon fa fa-font waves-effect waves-circle '.($check == 1 ? 'red' : 'gray').'" title="Full Control"></span>';
                            $html[$i] .= '<input name="rights['.$row['file'].'][full]" data-type="1" type="checkbox" value="1"'.($check == 1 ? ' checked="checked"' : '').' />';
                            $html[$i] .= '<input name="rights['.$row['file'].'][full]" data-type="0" type="checkbox" value="0"'.($check == 0 ? ' checked="checked"' : '').' />';
                            $html[$i] .= '</div>';
                        }
                        $html[$i] .= '    </div>';
                        $html[$i] .= '</div>';
                        $n++;
                    }
                }
                $html[$i] .= '</div></td></tr>';
                if (!$n) {
                    unset($html[$i]);
                }
                if (!empty($html[$i])) {
                    $group .= $html[$i];
                }
            }
            echo $group;
        }
        ?>
    </td>
</tr>
<?php
echo module_close();
echo form_close();
?>
<script type="text/javascript">
    $(document).ready(function() {
        <?php
        if ($permissed == 1) {
            echo 'showNoti("Nhân viên: ' . $name . '", "Phân quyền thành công!", "Ok");';
        }
        if ($failed == 1) {
            echo 'showNoti("Nhân viên: ' . $name . '", "Phân quyền thất bại!", "Err");';
        }
        ?>
    });
</script>