<style>
    .tab-pane .table tr td, .tab-pane .table tr th {
        background-color: transparent;
    }
</style>
<?php
$has_tab = is_array($parts) && count($parts) > 1;
if ($has_tab) {
    echo module_open('');
    echo '<tr class="no-border">';
    echo '<td>';
    echo '<input type="hidden" class="tabId" value="' . $GLOBALS['var']['mytab'] . '"/>';
    echo '<ul id="myTab" class="nav nav-tabs">';
    foreach ($parts as $i => $data) {
        echo '<li class="' . ($i > 1 ? ' hide640' : '') . (($GLOBALS['var']['mytab'] == $i) ? ' active' : '') . '" onclick="set_mytab($(this))"><a href="#tabs-' . $i . '" data-toggle="tab">' . $data . (is_array($rows[$data]) ? '<span class="bs-badge badge-blue-alt badge-absolute float-right">' . count($rows[$data]) . '</span>' : '') . '</a></li>';
    }
    echo '<li class="dropdown show640">';
    echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyph-icon icon-align-justify"></i><span class="caret"></span></a>';
    echo '<ul class="dropdown-menu">';
    foreach ($parts as $i => $data) {
        if ($i > 1) {
            echo '<li' . (($GLOBALS['var']['mytab'] == $i) ? ' class="active"' : '') . ' onclick="set_mytab($(this))"><a href="#tabs-' . $i . '" data-toggle="tab">' . $data . (is_array($rows[$data]) ? '<span class="bs-badge badge-blue-alt badge-absolute float-right">' . count($rows[$data]) . '</span>' : '') . '</a></li>';
        }
    }
    echo '</ul>';
    echo '</li>';
    ?>
    <li class="pull-right tag-close<?= $GLOBALS['var']['mytab'] === '10000' ? ' active' : '' ?>" onclick="set_mytab($(this)); $('#moduleInfo').attr('data-table', 'usergroups')"><a href="#tabs-10000" data-toggle="tab" class="bg-yellow">Level & Permission</a></li>
    <li class="pull-right tag-close<?= $GLOBALS['var']['mytab'] === '1001' ? ' active' : '' ?>" onclick="set_mytab($(this)); $('#moduleInfo').attr('data-table', 'signing_approval')"><a href="#tabs-1001" data-toggle="tab" class="bg-yellow">Signing Approval</a></li>

    <?php
    echo '</ul>';
    echo '<div id="myTabContent" class="tab-content">';
} else {
    echo module_open();
}
foreach ($parts as $j => $data) {
    if ($has_tab) {
        echo '<div id="tabs-' . $j . '" class="hide-columns tab-pane' . (($GLOBALS['var']['mytab'] == $j) ? ' active' : '') . '">';
        echo '<table class="table table-hover" cellpadding="0" cellspacing="0" width="100%" border="0">';
    }
    ?>
    <thead>
    <form method="get" action="<?php echo site_url($GLOBALS['var']['act']) ?>"
          id="filter<?php echo $GLOBALS['var']['act'] ?>">
        <tr class="filter-head">
            <th colspan="<?php if ($GLOBALS['per']['del']) echo 2; ?>" nowrap="nowrap">
                <button type="submit" class="btn btn-danger">Filter</button>
            </th>
            <?php
            $filter = $this->input->get('filter', true);
            foreach ($cols as $key => $col) {
                $op = false;
                if($key == 'department') $op = array(''=>'Select..') + $parts;
                if($key == 'headofdepartment') $op = array(''=>'Select..') +$parts;
                if($key == 'individual') $op = $staff;
                echo col_filter($col, $key, $filter, $op);
            }
            ?>
            <th class="center" width="1%">&nbsp;</th>
        </tr>
    </form>
    <tr style="background: #f9fafe">
        <?php if ($GLOBALS['per']['del']) echo '<th class="center th-sel" width="1%"><input id="checkall" type="checkbox" class="checkAll custom-checkbox"/></th>'; ?>
        <th width="1%">#</th>
        <?php
        $colspan = 3;
        foreach ($cols as $key => $col) {
            echo col_name($col, $key);
            if (isset($col->show) && $col->show == 1) {
                $colspan++;
            }
        }
        ?>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <?php
    if (is_array($rows[$data]) && count($rows[$data])) {
        $n = 1;
        $i = 1;
        $new_name = '';
        foreach ($rows[$data] as $row) {
            if(strupper($new_name) != strupper($row['department']) && $new_name != '') {
                echo '<tr class="highlight bg-primary"><td style="background: transparent"></td><td colspan="' . $colspan . '" style="background: transparent">' . $new_name . '</td></tr>';
            }
            $new_name = $row['department'];
            ?>
            <tr class="highlight" id="<?php echo $row['id'] ?>" name="<?php echo $row['username'] ?>">
                <?php if ($GLOBALS['per']['del']) echo '<td class="center">' . sel_item($row['id'], $row['id'] == 1) . '</td>'; ?>
                <td class="center" width="1%"><?php echo stt($row['id'], $GLOBALS['var']['rowstart'] + $i++) ?></td>
                <?php
                //<div data-table="" data-id="72" data-field="active" data-name="" class="changeStatus icon glyphicons check waves-effect waves-circle"></div>
                foreach ($cols as $key => $col) {
                    if ($key == 'part') {
                        $row[$key] = $row['department'];
                    }
                    $val = '';
                    switch ($key) {
                        case 'headofdepartment':
                            $tmp = '';
                            if (($row[$key] != '' || $row[$key] != 0) && isset($staff[$row[$key]]) && $staff[$row[$key]] != '') $tmp = $staff[$row[$key]];
                            $val = '<span title="' . $tmp . '">' . $tmp . '</span>';
                            break;
                        case 'direct':
                        case 'report':
                            $strTmp = array();
                            if (isset($row[$key]) && ($row[$key] != '' || $row[$key] != 0)) $strTmp = explode(',', $row[$key]);
                            $tmp = array();
                            if(count($strTmp) >0){
                                foreach ($strTmp as $k){
                                    if (($k != '' || $k != 0) && isset($staff[$k]) && $staff[$k] != '') array_push($tmp, $staff[$k]);
                                }
                            }
                            $tmp = implode(', ' ,$tmp);
                            $tmp = trimlink($tmp, 500);
                            $val = '<span title="' . $tmp . '">' . $tmp  . '</span>';
                            break;
                        default:
                            $val = isset($row[$key]) ? '<span title="' . $row[$key] . '">' . $row[$key] . '</span>' : '';
                    }
                    if($key=='active'){
                        echo '<td>'.change_status($row['id'], $row['active'], 'active', '', '', '', !$GLOBALS['per']['edit']).'</td>';
                    }else{
                        echo col_val($col, $key, $val, $row['id'], site_url($GLOBALS['var']['act'] . '/update/' . $row['id']) . $uri_str);
                    }
                }
                ?>

                <td class="center" nowrap="nowrap">
                    <?php
                    if ($GLOBALS['per']['edit']) {
                        echo edit_alink('', current_url() . '/update/' . $row['id'] . $uri_str);
                        echo '<div class="icon glyphicons magic waves-effect waves-circle btn-copy-permission" title="Sao chép phân quyền" data-id="' . $row['id'] . '" style="margin-left: 3px; margin-right: 3px;"></div>';
                    }
                    if ($GLOBALS['user']['level'] == 1) {
                        if ($row['mode_right'] || $GLOBALS['user']['id'] == $row['id']) {
                            echo '<div class="icon glyphicons rotation_lock waves-effect waves-circle" title="Đã khóa phân quyền" style="margin-left: 3px; margin-right: 3px;"></div>';
                        } else {
                            echo '<a class="ajax" title="Phân quyền" href="' . $url_str . '/permiss/' . $row['id'] . $uri_str . '"><div class="icon glyphicons settings waves-effect waves-circle"></div></a>';
                        }
                    }
                    if ($GLOBALS['per']['del']) {
                        if ($row['id'] != 1 && $row['id'] != $GLOBALS['user']['id']) {
                            echo del_restore_link($row['id'], $row['deleted']);
                        } else {
                            echo '<div class="icon glyphicons rotation_lock waves-effect waves-circle" title="Đã khóa chức năng xóa" style="margin-left: 3px; margin-right: 3px;"></div>';
                        }
                    }
                    ?>
                </td>
            </tr>
            <?php

        }
        echo '<tr class="highlight bg-primary"><td style="background: transparent"></td><td colspan="' . $colspan . '" style="background: transparent">' . $new_name . '</td></tr>';
    } else {
        echo no_data_mes(count((array)$cols) + 3);
    }
    if ($has_tab) {
        echo '</table>';
        echo '</div>';
    }
}
?>
<div id="tabs-10000" class="hide-columns tab-pane<?= $GLOBALS['var']['mytab'] == 10000 ? ' active' : '' ?>">
     <table id="mainTable-usergroups" class="table table-hover" cellpadding="0" cellspacing="0" width="100%" border="0">
                    <tr class="nodrop">
                        <?php if ($GLOBALS['per']['del']) echo '<th class="center" width="3%"><input id="checkall" type="checkbox" class="checkAll custom-checkbox"/></th>'; ?>
                        <th class="center" width="2%">#</th>
                        <th width="50%">Tên nhóm</th>
                        <th width="15%">Ngày tạo</th>
                        <th class="center" nowrap="nowrap">Active</th>
                        <th width="1%">&nbsp;</th>
                    </tr>
                    <?php
                    if (is_array($rows2) && count($rows2)) {
                        $i = 1;
                        foreach ($rows2 as $row) {
                            ?>
                            <tr class="highlight" id="<?php echo $row['id'] ?>" name="<?php echo $row['name_vn'] ?>">
                                <?php if ($GLOBALS['per']['del']) echo '<td class="center">' . sel_item($row['id'], $row['id'] == 1) . '</td>'; ?>
                                <td class="center"><?php echo stt($row['id'], $i++) ?></td>
                                <td><?php echo $row['name_vn'] ?></td>
                                <td><?php echo strftime(TIME_STR, strtotime($row['date_added'])) ?></td>
                                <td class="center"><?php echo change_status($row['id'], $row['active'], 'active', '', '', '', !$GLOBALS['per']['edit']) ?></td>
                                <td class="center" nowrap="nowrap">
                                    <?php
                                            if ($GLOBALS['per']['edit']) echo edit_alink($row['id'], '', 'updateLink');
                                            if ($GLOBALS['user']['level'] == 1) {
                                                if ($GLOBALS['user']['level'] < $row['id'] || $GLOBALS['user']['id'] == 1) {
                                                    echo '<a class="ajax" title="Phân quyền nhóm" href="' . $url_str . '/permiss_group/' . $row['id'] . $uri_str . '"><div class="icon glyphicons settings waves-effect waves-circle"></div></a>';
                                                } else {
                                                    echo '<div class="icon glyphicons rotation_lock waves-effect waves-circle" title="Đã khóa chức năng xóa" style="margin-left: 3px; margin-right: 3px;"></div>';
                                                }
                                            }
                                            if ($GLOBALS['per']['del']) {
                                                if ($row['id'] != 1 && $row['id'] != $GLOBALS['user']['id']) {
                                                    echo del_restore_link($row['id'], $row['deleted'], false, false, 'usergroups');
                                                } else {
                                                    echo '<div class="icon glyphicons rotation_lock waves-effect waves-circle" title="Đã khóa chức năng xóa" style="margin-left: 3px; margin-right: 3px;"></div>';
                                                }
                                            }
                                            ?>
                                </td>
                            </tr>
                    <?php
                            if ($GLOBALS['per']['add'] || $GLOBALS['per']['edit']) {
                                echo '<input class="textData ' . $row['id'] . '" data-field="name_vn" value="' . $row['name_vn'] . '" />';
                            }
                        }
                    }
                    ?>
                </table>
</div>
<div id="tabs-1001" class="hide-columns tab-pane<?= $GLOBALS['var']['mytab'] == 1001 ? ' active' : '' ?>">
     <table id="mainTable-signing_approval" class="table table-hover" cellpadding="0" cellspacing="0" width="100%" border="0">
                    <tr class="nodrop">
                        <?php if ($GLOBALS['per']['del']) echo '<th class="center" width="3%"><input id="checkall" type="checkbox" class="checkAll custom-checkbox"/></th>'; ?>
                        <th class="center" width="2%">#</th>
                        <th width="50%">Tên nhóm</th>
                        <th width="15%">Ngày tạo</th>
                        <th class="center" nowrap="nowrap">Active</th>
                        <th width="1%">&nbsp;</th>
                    </tr>
                    <?php
                    if (is_array($rows3) && count($rows3)) {
                        $i = 1;
                        foreach ($rows3 as $row) {
                            ?>
                            <tr class="highlight" id="<?php echo $row['id'] ?>" name="<?php echo $row['name_vn'] ?>">
                                <?php if ($GLOBALS['per']['del']) echo '<td class="center">' . sel_item($row['id'], $row['id'] == 1) . '</td>'; ?>
                                <td class="center"><?php echo stt($row['id'], $i++) ?></td>
                                <td><?php echo $row['name_vn'] ?></td>
                                <td><?php echo strftime(TIME_STR, strtotime($row['date_added'])) ?></td>
                                <td class="center"><?php echo change_status($row['id'], $row['active'], 'active', '', '', '', !$GLOBALS['per']['edit']) ?></td>
                                <td class="center" nowrap="nowrap">
                                    <?php
                                            if ($GLOBALS['per']['edit']) echo edit_alink($row['id'], '', 'updateLink');
                                           {
                                          
                                                    echo del_restore_link($row['id'], $row['deleted'], false, false, 'signing_approval');
                                              
                                            }
							
                                            ?>
								
                                </td>
                            </tr>
                    <?php
                            if ($GLOBALS['per']['add'] || $GLOBALS['per']['edit']) {
                                echo '<input class="textData ' . $row['id'] . '" data-field="name_vn" value="' . $row['name_vn'] . '" />';
                                echo '<input class="radioData ' . $row['id'] . '" data-field="view" value="' . json_decode($row['group_rights'])->view . '" />';
                                echo '<input class="radioData ' . $row['id'] . '" data-field="edit" value="' . json_decode($row['group_rights'])->edit . '" />';
                                echo '<input class="radioData ' . $row['id'] . '" data-field="add" value="' . json_decode($row['group_rights'])->add . '" />';
                                echo '<input class="radioData ' . $row['id'] . '" data-field="delete" value="' . json_decode($row['group_rights'])->delete . '" />';
                            }
                        }
                    }
                    ?>
                </table>
</div>
<?php
if ($has_tab) {
    echo '</div>';
    echo '</td>';
    echo '</tr>';
}
echo module_close();
?>
<div class="modal animated bounceIn fullsceen-modal" id="importModal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal bordered-row" onsubmit="return false;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Import data from the file</h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12">
                                <input type="hidden" id="fileName" name="fileName" />
                                <div id="fileuploader" data-dir="<?php echo UPLDIR ?>" class="btn btn-border btn-alt btn-hover border-primary font-primary waves-effect">
                                    <span>Select file</span><i class="glyph-icon icon-file"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5 col-sm-5">Sheet</div>
                            <div class="col-xs-7 col-sm-7">
                                <select name="sheet" id="sheet" class="form-control" disabled>
                                    <option value="0">Sheet 1</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5 col-sm-5">Header row</div>
                            <div class="col-xs-3 col-sm-3">
                                <select name="headerRow" id="headerRow" class="form-control select2" disabled>
                                    <option value="1">1</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5 col-sm-5">Start on row</div>
                            <div class="col-xs-3 col-sm-3">
                                <select name="starRow" id="starRow" class="form-control select2" disabled>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            <div class="col-xs-1 col-sm-1">to</div>
                            <div class="col-xs-3 col-sm-3">
                                <select name="endRow" id="endRow" class="form-control select2" disabled>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5 col-sm-5">Employee ID</div>
                            <div class="col-xs-7 col-sm-7">
                                <select data-fieldname="Employee ID" class="form-control select2 field-update" data-fieldkey="EmployeeID" id="employee_id" disabled>
                                    <option value="">Chọn ...</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-5 col-sm-5">Day off</div>
                            <div class="col-xs-7 col-sm-7">
                                <select data-fieldname="Day off" class="form-control select2 field-update" data-fieldkey="day_off" id="day_off" disabled>
                                    <option value="">Chọn ...</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-7">
                        <h4>Preview</h4>
                        <div class="progress" style="position: relative; margin-bottom: 5px;">
                            <span id="person">0% (0/0)</span>
                            <div class="progress-bar progress-bar-success" style="width: 0;"></div>
                        </div>
                        <div id="sheetPreview" style="overflow-x: auto;">
                            <table class="table table-hover" cellpadding="0" cellspacing="0" width="100%">
                                <tbody id="sheetData">
                                <tr>
                                    <td class="excel-top">
                                        <div class="excel-angel"></div>
                                    </td>
                                    <td class="excel-top">A</td>
                                    <td class="excel-top">B</td>
                                    <td class="excel-top">C</td>
                                    <td class="excel-top">D</td>
                                    <td class="excel-top">E</td>
                                    <td class="excel-top">F</td>
                                    <td class="excel-top">G</td>
                                    <td class="excel-top">H</td>
                                    <td class="excel-top">I</td>
                                    <td class="excel-top">J</td>
                                    <td class="excel-top">K</td>
                                    <td class="excel-top">L</td>
                                    <td class="excel-top">M</td>
                                    <td class="excel-top">N</td>
                                    <td class="excel-top">O</td>
                                    <td class="excel-top">P</td>
                                    <td class="excel-top">Q</td>
                                    <td class="excel-top">R</td>
                                    <td class="excel-top">S</td>
                                    <td class="excel-top">T</td>
                                    <td class="excel-top">U</td>
                                    <td class="excel-top">V</td>
                                    <td class="excel-top">W</td>
                                    <td class="excel-top">X</td>
                                    <td class="excel-top">Y</td>
                                    <td class="excel-top">Z</td>
                                </tr>
                                <?php
                                for ($i = 1; $i < 21; $i++) {
                                    ?>
                                    <tr>
                                        <td class="excel-left"><?php echo $i ?></td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                        <td class="excel-cell">&nbsp;</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt btn-border border-primary btn-hover font-primary btn-modal-submit" id="importRow" disabled><span>Execute</span><i class="glyph-icon icon-save"></i></button>
                    <div class="btn btn-alt btn-border border-red btn-hover font-red" data-dismiss="modal"><span>Close</span><i class="glyph-icon icon-arrow-left"></i></div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <?php
        echo form_open($action, array('id' => 'updateFrm', 'class' => 'updateFrm form-horizontal bordered-row'));
        echo form_input(array('type' => 'hidden', 'name' => 'token', 'value' => $GLOBALS['var']['token']));
        ?>
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <div class="col-sm-12 type1" >Tên nhóm phân quyền <span style="color:red">*</span></div>
                    <div class="col-sm-12 type2" > Signing Approva <span style="color:red">*</span></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
						 <input type="text" class="form-control" data-required="1" name="name_vn" id="name_vn" />
                        <div class="errordiv name_vn">
                            <div class="arrow"></div>Not empty!
                        </div>
                    </div>
                </div>
				  <div class="form-group SigningApproval">
					<div class="col-xs-2 control-label">View</div>
                    <div class="col-xs-7">
                        <label style="margin-right: 20px;"><input name="rights[view]" id="view1" type="radio" class="custom-radio" value="1"><span>Có</span></label>
                        <label><input name="rights[view]" id="view0" type="radio" class="custom-radio" value="0" checked="checked"><span>Không</span></label>
                    </div>
                </div>
				 <div class="form-group SigningApproval">
					<div class="col-xs-2 control-label">Edit</div>
                    <div class="col-xs-7">
                        <label style="margin-right: 20px;"><input name="rights[edit]" id="edit1" type="radio" class="custom-radio" value="1"><span>Có</span></label>
                        <label><input name="rights[edit]" id="edit0" type="radio" class="custom-radio" value="0" checked="checked"><span>Không</span></label>
                    </div>
                </div>
			 <div class="form-group SigningApproval">
					<div class="col-xs-2 control-label">Add</div>
                    <div class="col-xs-7 ">
                        <label style="margin-right: 20px;"><input name="rights[add]" id="add1" type="radio" class="custom-radio" value="1"><span>Có</span></label>
                        <label><input name="rights[add]" id="add0" type="radio" class="custom-radio" value="0" checked="checked"><span>Không</span></label>
                    </div>
             </div>
				 <div class="form-group SigningApproval">
					<div class="col-xs-2 control-label">Delete</div>
                    <div class="col-xs-7 ">
                        <label style="margin-right: 20px;"><input name="rights[delete]" id="delete1" type="radio" class="custom-radio" value="1"><span>Có</span></label>
                        <label><input name="rights[delete]" id="delete0" type="radio" class="custom-radio" value="0" checked="checked"><span>Không</span></label>
                    </div>
             </div>
            </div>
            <div class="modal-footer">
                <?php echo form_input(array('type' => 'hidden', 'name' => 'id', 'class' => 'id')); ?>
                <button type="submit" class="btn btn-alt btn-border border-primary btn-hover font-primary"><span>Add new</span><i class="glyph-icon icon-save"></i></button>
                <button type="button" class="btn btn-alt btn-border border-red btn-hover font-red" data-dismiss="modal"><span>Cancel</span><i class="glyph-icon icon-remove"></i></button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript">
	
	 if($.cookie('mytab') === '10000') {
       $('.type2').hide();
			$('.type1').show();
			$('.SigningApproval').hide();
		
			$('#updateFrm').attr('action',$( '#act' ).val()+'/process_group');
			$('#moduleInfo').remove();
			$('#page-wrapper').append('<div id="moduleInfo" data-table="usergroups" data-type="Nhân viên"></div>');	 }
      else if($.cookie('mytab') === '1001'){
		  
		  $('.SigningApproval').show();
			    $('.type1').hide();
			    $('.type2').show();
				$('#updateFrm').attr('action',$( '#act' ).val()+'/process_Approval');
				$('#moduleInfo').remove();
				$('#page-wrapper').append('<div id="moduleInfo" data-table="signing_approval" data-type="Nhân viên"></div>');
		
			}
	else {
	$('#moduleInfo').remove();
	$('#page-wrapper').append('<div id="moduleInfo" data-table="users" data-type="Nhân viên"></div>');

	}
	  
//    if($.cookie('mytab') === '1') {
//        $('#myTab li').each(function () {
//            if($(this).hasClass('active')) $(this).removeClass('active');
//            if($(this).hasClass('pull-right')) $(this).addClass('active');
//
//        });
//        $('#myTabContent div').each(function () {
//            if($(this).hasClass('active')) $(this).removeClass('active');
//        });
//        $('#tabs-10000').addClass('active');
//        $.cookie("lv_group", '0');   }
//	  if($.cookie('signing_approval') === '1') {
//        $('#myTab li').each(function () {
//            if($(this).hasClass('active')) $(this).removeClass('active');
//           if($(this).hasClass('pull-right')) $(this).addClass('active');
//        });
//        $('#myTabContent div').each(function () {
//           if($(this).hasClass('active')) $(this).removeClass('active');
//        });
//        $('#tabs-1001').addClass('active');
//        $.cookie("signing_approval", '0');
//    }
	
    $(document).ready(function() {
        <?php
        if ($updated == 1) {
            echo 'showNoti("Nhân viên: ' . $name . '", "Thêm nhân viên mới thành công!", "Ok");';
        }
        if ($failed == 2) {
            echo 'showNoti("Nhóm nhân viên: ' . $name . '", "Cập nhật nhóm nhân viên thất bại!", "Err");';
        }
        if ($updated == 2) {
            echo 'showNoti("Nhóm nhân viên: ' . $name . '", "Cập nhật nhóm phân quyền thành công!", "Ok");';
        }
        if ($added == 2) {
            echo 'showNoti("Nhóm nhân viên: ' . $name . '", "Thêm nhóm phân quyền thành công!", "Ok");';
        }
        if ($GLOBALS['var']['deleted'] != 1) {
            echo 'makeDragOrder("usergroups", "", "", "", "ASC");';
        }
        ?>
        $('.addLink').bind('click', function() {
            if($('#moduleInfo').data('table') =='usergroups') {
                if ($('.tab-content').length) {
                    if ($('#tabs-0').is(':hidden')) {
                        $('#myModal').modal('show');
                        $.cookie("lv_group", '1');
                        return false;
                    }
                }
            }
		   if($('#moduleInfo').data('table') =='signing_approval') {
			if ($('.tab-content').length) {
				if ($('#tabs-0').is(':hidden')) {
					$('#myModal').modal('show');
					$.cookie("signing_approval", '1');
					return false;
				}
			}
		}
        });
        $('body').on('click', '.updateLink', function () {
            $.cookie("lv_group", '1');
            $.cookie("signing_approval", '1');
        }).on('click', '.btn-copy-permission', function() {
            var id = $(this).data('id');
            $('#copyPermission').find('#currentID').val(id);
            $('#copyPermission').modal('show');
        }).on('click', '.btn-copy', function() {
            var currentID = $('#copyPermission #currentID').val();
            var targetID = $('#copyPermission [name="targetID"]');
            if (currentID == '') {
                showNoti('Không nhân diện được đang phân quyền cho nhân viên nào', 'Xin vui lòng chọn lại nhân viên cần sao chép', 'War');
                return false;
            }
            var flag = false;
            if ($('#copyPermission [name="targetID"]:checked').length > 0) {
                flag = true;
            }
            if (flag) {
                $.ajax({
                    url: site_url + $('#act').val() + '/copy_permission',
                    type: 'POST',
                    data: {
                        currentID: currentID,
                        targetID: $('#copyPermission [name="targetID"]:checked').val()
                    },
                    success: function(string) {
                        if (string == 0) {
                            showNoti('Permission copy failed', 'Err', 'Ok');
                        } else {
                            showNoti('Permission copy successful', 'Success', 'Ok');
                        }
                        $('#copyPermission').modal('hide');
                        return false;
                    }
                })
            } else {
                $('#targetID').focus();
                showErrOfField('targetID', 'targetID');
                showNoti('Vui lòng chọn nhân viên muốn sao chép', 'Cảnh báo nhập liệu', 'War');
                return false;
            }
        }).on('hidden.bs.modal', '#copyPermission', function() {
            $('#copyPermission #currentID').val('');
            $('#copyPermission [name="targetID"]').prop('checked', false);
        }).on('click', '.imports-file', function() {
            $('#importModal').modal('show');
        }).on('change', '#headerRow', function() {
            var headerRow = parseInt($(this).val());
            $('#starRow').val(headerRow + 1).trigger('chosen:updated').change();
            $('.field-update').empty().append('<option value="">Chọn ...</option>');
            $('#sheetData tr').removeClass('excel-header');
            $('#sheetData #row' + headerRow).addClass('excel-header').find('td:not(.excel-left)').each(function() {
                $('.field-update').append('<option value="' + $(this).data('col') + '" data-fieldname="' + $(this).text() + '">' + $(this).data('col') + ' - ' + $(this).text() + '</option>');
            });
            $('.field-update').each(function() {
                var fieldname = $(this).data('fieldname');
                $(this).find('option[data-fieldname="' + fieldname + '"]').attr('selected', 'selected');
            });
            $('.field-update').trigger('chosen:updated');
        }).on('change', '#starRow', function() {
            $('#endRow option').attr('disabled', false);
            for (i = 0; i < parseInt($(this).val()) - 1; i++) {
                $('#endRow option:eq(' + i + ')').attr('disabled', true);
            }
            $('#endRow option:last-child').prop('selected', true);
            $('#endRow').trigger('chosen:updated');

            $('#sheetData tr').removeClass('excel-selected');
            for (i = parseInt($(this).val()); i <= parseInt($('#endRow').val()); i++) {
                $('#sheetData #row' + i).addClass('excel-selected');
            }
        }).on('change', '#endRow', function() {
            $('#sheetData tr').removeClass('excel-selected');
            for (i = parseInt($('#starRow').val()); i <= parseInt($(this).val()); i++) {
                $('#sheetData #row' + i).addClass('excel-selected');
            }
        }).on('click', '#importRow', function() {
            var starRow = parseInt($('#starRow').val());
            var endRow = parseInt($('#endRow').val());
            var dataRow = parseInt($('#sheetData tr').length) - 1;
            var rowSelect = parseInt($('#sheetData tr.excel-selected').length);
            index = starRow;
            num = (endRow > dataRow || isNaN(endRow) || endRow == 0) ? dataRow : endRow;
            $('#sheetData tr').removeClass('updated notfound');
            $('.progress-bar').css({
                width: '0%'
            });
            $('#person').text('0% (' + index + '/' + num + ')');
            setTimeout(function() {
                import_row();
            }, 500);
            return false;
        }).on('hidden.bs.modal', '#importModal', function(e) {
            $('#sheet, #headerRow, #starRow, #endRow, .field-update, #sheetPreview .table .excel-cell').empty().attr('disabled', true).trigger('chosen:updated');
            $('#sheetPreview .table tr').removeAttr('class');
            $('#person').text('0% (0/0)');
            $('.progress-bar').css('width', '0%');
            delete_fileupload($('#fileName').val());
        }).on('click','#myTab li', function () {
			if($(this).find('a').attr('href') =='#tabs-10000'){
			$('.type2').hide();
			$('.type1').show();
			$('.SigningApproval').hide();
		
			$('#updateFrm').attr('action',$( '#act' ).val()+'/process_group');
			$('#moduleInfo').remove();
			$('#page-wrapper').append('<div id="moduleInfo" data-table="usergroups" data-type="Nhân viên"></div>');
			}
			else if ($(this).find('a').attr('href') =='#tabs-1001'){
				$('.SigningApproval').show();
			    $('.type1').hide();
			    $('.type2').show();
				$('#updateFrm').attr('action',$( '#act' ).val()+'/process_Approval');
				$('#moduleInfo').remove();
				$('#page-wrapper').append('<div id="moduleInfo" data-table="signing_approval" data-type="Nhân viên"></div>');
		
			}
			else {
			$('#moduleInfo').remove();
			$('#page-wrapper').append('<div id="moduleInfo" data-table="users" data-type="Nhân viên"></div>');
				
			}
			
        });

        if ($('#fileuploader').length) {
            var dir = $('#fileuploader').data('dir');
            $('#fileuploader').uploadFile({
                url: site_url + 'ajax/upload',
                fileName: 'myfile',
                formData: {
                    dir: dir
                },
                uploadButtonClass: 'btn btn-border btn-alt btn-hover border-primary font-primary waves-effect',
                dragDropStr: '<span> Drag and drop files here</span>',
                allowedTypes: 'xlsx,xls',
                uploadErrorStr: 'File không đúng danh mục!',
                onSubmit: function(files) {
                    var starRow = parseInt($('#starRow').val());
                    var endRow = parseInt($('#endRow').val());
                    if (endRow < starRow && endRow > 0) {
                        showNoti('Vị trí dòng bắt đầu lớn hơn dòng kết thúc!', 'Lỗi nhập liệu', 'Err');
                        return false;
                    }
                },
                onSuccess: function(files, data, xhr) {
                    $('[type="submit"], [type="button"]').attr('disabled', true);

                    showNoti('Đang đọc dữ liệu file. Vui lòng đợi!', 'Upload file thành công', 'War');
                    showProcess(1);

                    $('#fileName').val(data.split('/').pop());

                    read_sheet($('#sheet').val());
                }
            });
        }

        $('.modal-content .modal-footer .border-red').click(function () {
            $.cookie("lv_group", '0');
            $.cookie("signing_approval", '0');
			
        });
    });

    function read_sheet(sheet) {
        $.ajax({
            url: site_url + 'ajax/read_sheet',
            type: 'POST',
            data: {
                file: $('#fileName').val(),
                sheet: sheet
            },
            dataType: 'json',
            success: function(data) {
                if (data == '') {
                    showNoti('Tệp tin không tồn tại!', 'Không thể đọc thông tin file', 'Err');
                } else {
                    var headerRow = parseInt($('#headerRow').val());
                    var html = '';

                    $('#sheet').empty();
                    for (i = 0; i < data.sheets.length; i++) {
                        $('#sheet').append('<option value="' + i + '"' + (i == sheet ? ' selected="selected"' : '') + '>' + data.sheets[i] + '</option>');
                    }
                    $('#sheet').trigger('chosen:updated');

                    $('#headerRow, #starRow, #endRow').empty();
                    $.each(data.sheetData, function(i, row) {
                        if (i == 1) {
                            html += '<tr>';
                            $.each(row, function(columnLetter, value) {
                                if (columnLetter == 'A') {
                                    html += '<td class="excel-top"><div class="excel-angel"></div></td>';
                                }
                                html += '<td class="excel-top">' + columnLetter + '</td>';
                            });
                            html += '</tr>';
                        }
                        html += '<tr id="row' + i + '"' + (i == headerRow ? ' class="excel-header"' : '') + '>';
                        $.each(row, function(columnLetter, value) {
                            if (columnLetter == 'A') {
                                html += '<td class="excel-left">' + i + '</td>';
                            }
                            html += '<td data-col="' + columnLetter + '" nowrap="nowrap" class="excel-cell">' + (value != null ? value : '') + '</td>';
                            if (i == headerRow) {
                                $('.field-update').append('<option value="' + columnLetter + '" data-fieldname="' + value + '">' + columnLetter + ' - ' + value + '</option>');
                            }
                        });
                        html += '</tr>';
                        $('#headerRow, #starRow, #endRow').append('<option value="' + i + '">' + i + '</option>');
                    });

                    $('#starRow').val(2);
                    for (i = 0; i < parseInt($('#starRow').val()) - 1; i++) {
                        $('#endRow option:eq(' + i + ')').attr('disabled', true);
                    }
                    $('#endRow option:last-child').prop('selected', true);

                    $('.field-update').each(function() {
                        var fieldname = $(this).data('fieldname');
                        $(this).find('option[data-fieldname="' + fieldname + '"]').attr('selected', 'selected');
                    });
                    $('#sheetData').html(html);
                    $('#sheet, #starRow, #endRow, #headerRow, .field-update').attr('disabled', false).trigger('chosen:updated');

                    $('#sheetData tr').removeClass('excel-selected');
                    for (i = parseInt($('#starRow').val()); i <= parseInt($('#endRow').val()); i++) {
                        $('#sheetData #row' + i).addClass('excel-selected');
                    }

                    $('[type="submit"], [type="button"]').attr('disabled', false);
                    $('#person').text('0% (0/' + (parseInt($('#sheetData tr').length) - 1) + ')');
                    $('.amaran-wrapper').remove();
                    hideLoading();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                showNoti('Lỗi:' + xhr.status + ' ' + thrownError, 'Không thể đọc thông tin file', 'Err');
            }
        });
    }

    function import_row() {
        var tr = $('#sheetData tr:eq(' + index + ')');
        var employee_id_col = $('#employee_id').val();
        var employee_id = tr.find('[data-col="' + employee_id_col + '"]').text().trim();
        var day_off_col = $('#day_off').val();
        var day_off = tr.find('[data-col="' + day_off_col + '"]').text().trim();
        if (!tr.hasClass('exists') && employee_id) {
            $.ajax({
                url: site_url + $('#act').val() + '/update_day_off',
                type: 'POST',
                data: {
                    id: employee_id,
                    day_off: day_off,
                },
                success: function(string) {
                    // if (category && arrqp.includes(supplier_part)) {
                    var getData = $.parseJSON(string);
                    if (string == 0) {
                        tr.addClass('notfound');
                    } else {
                        var employee_id_col = $('#employee_id').val();
                        var employee_id = tr.find('[data-col="' + employee_id_col + '"]').text().trim();
                        var day_off_col = $('#day_off').val();
                        var day_off = tr.find('[data-col="' + day_off_col + '"]').text().trim();
                        tr.addClass('updated');
                    }
                    var percent = (index / num * 100).toFixed(0);
                    $('.progress-bar').css({
                        width: percent + '%'
                    });

                    $('#person').text(percent + '% (' + index + '/' + num + ')');
                    index++;

                    if (index <= num) {
                        import_row();
                    } else {
                        if ($('#sheetData .notfound').length) {
                            showNoti('Có ' + $('#sheetData .notfound').length + ' mục không tìm thấy danh mục', 'Cảnh báo!', 'War');
                        } else {
                            $('[data-dismiss="modal"]').click();
                        }
                    }
                }
            });
        } else {
            var percent = (index / num * 100).toFixed(0);
            $('.progress-bar').css({
                width: percent + '%'
            });

            $('#person').text(percent + '% (' + index + '/' + num + ')');
            index++;

            if (index <= num) {
                import_row();
            } else {
                $('[data-dismiss="modal"]').click();
            }
        }
    }

    function delete_fileupload(file = '') {
        $.ajax({
            url: site_url + 'ajax/delete_fileupload',
            type: 'POST',
            data: { file: file },
            success: function(string) {
                if (string == 0) {
                    console.log('Delete file failed');
                } else {
                    console.log('Delete file successfully');
                }
            }
        });
    }

</script>
<div class="modal fade" id="copyPermission" tabindex="-1" role="dialog" aria-labelledby="copyPermissionLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form onsubmit="return false;">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-center">Chọn nhân viên cần sao chép phân quyền</h6>
                </div>
                <div class="modal-body" style="height: 300px;">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <ul>
                                <input type="hidden" id="targetID" value="">
                                <?php
                                echo error_div('targetID', 'Vui lòng nhập!');
                                if (is_array($users) && count($users)) {
                                    foreach ($users as $user) {
                                        echo '<li><label><input name="targetID" type="radio" value="' . $user['id'] . '">' . $user['id'] . ' - ' . $user['fullname'] . '</label></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php echo form_input(array('type' => 'hidden', 'id' => 'currentID')); ?>
                    <button type="submit" class="btn btn-alt btn-border border-primary btn-hover font-primary btn-copy"><span>Copy</span><i class="glyph-icon icon-save"></i></button>
                    <button type="button" class="btn btn-alt btn-border border-red btn-hover font-red" data-dismiss="modal"><span>Cancel</span><i class="glyph-icon icon-remove"></i></button>
                </div>
        </form>
    </div>
</div>
</div>
