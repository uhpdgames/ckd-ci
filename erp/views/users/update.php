<?php
$GLOBALS['var']['mytab'] = 0;
echo form_open($action, array('name'=>'nameFrm','id' => 'updateFrm', 'class' => 'updateFrm form-horizontal bordered-row'));
echo form_input(array('type' => 'hidden', 'name' => 'token', 'value' => $GLOBALS['var']['token']));
echo form_input(array('type' => 'hidden', 'name' => 'id', 'value' => $info['id']));
echo module_open('');
?>
<tr>
    <td>
        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-border btn-alt btn-hover border-primary font-primary waves-effect"><span><?php echo ($info['id'] ? 'Update' : 'Add new') ?></span><i class="glyph-icon icon-save"></i></button>
                <button type="button" class="btn btn-border btn-alt btn-hover border-red font-red waves-effect" id="backBtn"><span><?php echo ($info['id'] ? 'Back' : 'Cancel') ?></span><i class="glyph-icon icon-arrow-left"></i></button>
            </div>
        </div>
        <input type="hidden" class="tabId" value="<?php echo $GLOBALS['var']['mytab'] ?>" >
        <ul id="myTab" class="nav nav-tabs">
            <li class="<?php echo ($GLOBALS['var']['mytab'] == 0 ? ' active' : '') ?>" onclick="set_mytab($(this))"><a href="#tabs-0" data-toggle="tab">Basic Info</a></li>
            <li class="<?php echo ($GLOBALS['var']['mytab'] == 1 ? ' active' : '') ?>" onclick="set_mytab($(this))"><a href="#tabs-1" data-toggle="tab">User Info</a></li>
            <li class="<?php echo ($GLOBALS['var']['mytab'] == 2 ? ' active' : '') ?>" onclick="set_mytab($(this))"><a href="#tabs-2" data-toggle="tab">Salary</a></li>
            <li class="<?php echo ($GLOBALS['var']['mytab'] == 3 ? ' active' : '') ?>" onclick="set_mytab($(this))"><a href="#tabs-3" data-toggle="tab">Job Description</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div id="tabs-0" class="tab-pane<?php echo ($GLOBALS['var']['mytab'] == 0 ? ' active' : '') ?>">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Họ tên <span style="color:red">*</span></div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="fullname" id="fullname" data-required="1" value="<?php echo $info['fullname'] ?>">
                                <?php echo error_div('fullname', 'Vui lòng nhập họ tên!'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">CMND</div>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-4"><input type="text" class="form-control" name="so_cmnd" value="<?php echo $info['so_cmnd'] ?>" placeholder="Số CMND"></div>
                                    <div class="col-sm-4"><input type="text" class="form-control date" name="ngaycap_cmnd" value="<?php echo $info['ngaycap_cmnd'] ?>" placeholder="Ngày cấp"></div>
                                    <div class="col-sm-4"><input type="text" class="form-control" name="noicap_cmnd" value="<?php echo $info['noicap_cmnd'] ?>" placeholder="Nơi cấp"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Ngày sinh</div>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-4"><input type="text" class="form-control date" name="ngaysinh" value="<?php echo $info['ngaysinh'] ?>"></div>
                                    <div class="col-sm-4"><label><input name="gioitinh" id="gioitinh1" type="radio" class="custom-radio" value="1"<?php echo($info['gioitinh'] == 1 ? ' checked="checked"' : '') ?> ><span>Nam</span></label></div>
                                    <div class="col-sm-4"><label><input name="gioitinh" id="gioitinh0" type="radio" class="custom-radio" value="0"<?php echo($info['gioitinh'] == 0 ? ' checked="checked"' : '') ?> ><span>Nữ</span></label></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Nơi sinh</div>
                            <div class="col-sm-8"><input type="text" class="form-control" name="noisinh" value="<?php echo $info['noisinh'] ?>" ></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Nguyên quán</div>
                            <div class="col-sm-8"><input type="text" class="form-control" name="nguyenquan" value="<?php echo $info['nguyenquan'] ?>" ></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Địa chỉ thường trú</div>
                            <div class="col-sm-8"><input type="text" class="form-control" name="diachi" value="<?php echo $info['diachi'] ?>"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Địa chỉ tạm trú</div>
                            <div class="col-sm-8"><input type="text" class="form-control" name="diachi_tamtru" value="<?php echo $info['diachi_tamtru'] ?>"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Email <span style="color:red">*</span></div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="email" id="email" data-required="1" value="<?php echo $info['email'] ?>" >
                                <?php echo error_div('email', 'Vui lòng nhập email!'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Điện thoại cá nhân</div>
                            <div class="col-sm-8"><input type="text" class="form-control" name="phone" value="<?php echo $info['phone'] ?>" ></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Điện thoại nhà</div>
                            <div class="col-sm-8"><input type="text" class="form-control" name="tel" value="<?php echo $info['tel'] ?>" ></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Biển số xe chính</div>
                            <div class="col-sm-8"><input type="text" class="form-control" name="biensoxe" value="<?php echo $info['biensoxe'] ?>" ></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Tình trạng hôn nhân</div>
                            <div class="col-sm-8">
                                <?php
                                foreach ($GLOBALS['tinhtrang_honnhan'] as $key => $item) {
                                    echo '<label style="margin-right: 20px;"><input name="honnhan" id="honnhan' . $key . '" type="radio" class="custom-radio" value="' . $item . '"' . ($info['honnhan'] == $item ? ' checked="checked"' : '') . '><span>' . $item . '</span></label>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Dân tộc</div>
                            <div class="col-sm-8"><input type="text" class="form-control" name="dantoc" value="<?php echo $info['dantoc'] ?>" ></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Tôn giáo</div>
                            <div class="col-sm-8"><input type="text" class="form-control" name="tongiao" value="<?php echo $info['tongiao'] ?>" ></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Trình độ chuyên môn</div>
                            <div class="col-sm-8">
                                <?php
                                foreach ($GLOBALS['trinhdo'] as $key => $item) {
                                    echo '<label style="margin-right: 20px;"><input name="trinhdo" id="trinhdo' . $key . '" type="radio" class="custom-radio" value="' . $item . '"' . ($info['trinhdo'] == $item ? ' checked="checked"' : '') . '><span>' . $item . '</span></label>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Chuyên ngành</div>
                            <div class="col-sm-8"><input type="text" class="form-control" name="chuyennganh" value="<?php echo $info['chuyennganh'] ?>" ></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Trường</div>
                            <div class="col-sm-8"><input type="text" class="form-control" name="truong" value="<?php echo $info['truong'] ?>" ></div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <?php
                        if (is_array($departments) && count($departments)) {
                            ?>
                            <div class="form-group">
                                <div class="col-sm-4 control-label">Phòng ban <span style="color:red">*</span></div>
                                <div class="col-sm-8"><?php echo form_dropdown('part', $departments, $info['part'], 'id="mydeprent" class="form-control" data-required="1"'); ?>
                                    <div class="errordiv mydeprent">
                                        <div class="arrow"></div>
                                        Vui lòng chọn phòng ban
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        if (is_array($positions) && count($positions)) {
                            ?>
                            <div class="form-group">
                                <div class="col-sm-4 control-label">Chức vụ <span style="color:red">*</span></div>
                                <div class="col-sm-8"><?php echo form_dropdown('position', ($info['id'] ? $arr_pos: $positions), $info['position'], 'id="myposition" class="form-control" data-required="1"'); ?>
                                    <div class="errordiv myposition">
                                        <div class="arrow"></div>
                                        Vui lòng chọn chức vụ
                                    </div>
                                </div>
                            </div>
                            <?php
                        }

                        ?>
                        <?

                        ?>
                            <div class="form-group">
                                <div class="col-sm-4 control-label">Nhóm</div>
                                <div class="col-sm-8"><?php echo form_dropdown('nhom', $nhom, $info['nhom'], 'id="myteam" class="form-control"'); ?></div>
                            </div>
                            <?php
                        ?>
                        <?
                        if (is_array($branchs) && count($branchs)) {
                            ?>
                            <div class="form-group">
                                <div class="col-sm-4 control-label">Chi nhánh</div>
                                <div class="col-sm-8"><?php echo form_dropdown('coso', $branchs, $info['coso'], 'class="form-control"'); ?></div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Country</div>
                            <div class="col-sm-8">
                                <?php echo get_options('country', $info['country'], 'id="country" class="form-control"', 'country') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Số tài khoản</div>
                            <div class="col-sm-8"><input type="text" class="form-control" name="sotk" value="<?php echo $info['sotk'] ?>" ></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Ngân hàng</div>
                            <div class="col-sm-8"><input type="text" class="form-control" name="nganhang" value="<?php echo $info['nganhang'] ?>" ></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Ngày vào làm</div>
                            <div class="col-sm-8"><input type="text" class="form-control date" name="ngay_vaolam" value="<?php echo $info['ngay_vaolam'] ?>"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Ngày làm chính thức</div>
                            <div class="col-sm-8"><input type="text" class="form-control date" name="hanthuviec" value="<?php echo $info['hanthuviec'] ?>"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Ngày nghỉ việc</div>
                            <div class="col-sm-8"><input type="text" class="form-control date" name="ngay_nghiviec" value="<?php echo $info['ngay_nghiviec'] ?>"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Ngày ký hợp đồng</div>
                            <div class="col-sm-8"><input type="text" class="form-control date" name="ngaykyhd" value="<?php echo $info['ngaykyhd'] ?>"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Số hợp đồng</div>
                            <div class="col-sm-8"><input type="text" class="form-control" name="sohopdong" value="<?php echo $info['sohopdong'] ?>"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Loại hợp đồng</div>
                            <div class="col-sm-8">
                                <?php
                                foreach ($GLOBALS['loai_hopdong'] as $key => $item) {
                                    echo '<label style="margin-right: 20px;"><input name="loaihopdong" id="loaihopdong' . $key . '" type="radio" class="custom-radio" value="' . $item . '"' . ($info['loaihopdong'] == $item ? ' checked="checked"' : '') . '><span>' . $item . '</span></label>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Ngày tham gia BHXH</div>
                            <div class="col-sm-8"><input type="text" class="form-control date" name="ngay_thamgiabhxh" value="<?php echo $info['ngay_thamgiabhxh'] ?>"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Mã số BHXH</div>
                            <div class="col-sm-8">
                                <input onkeypress='validate(event)' type="text" class="form-control" name="maso_bhxh" value="<?php echo $info['maso_bhxh'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Số sổ BHXH</div>
                            <div class="col-sm-8">
                                <input onkeypress='validate(event)' type="text" class="form-control" name="soso_bhxh" value="<?php echo $info['soso_bhxh'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Số tờ rời</div>
                            <div class="col-sm-4">
                                <div class="input-group myDuration">
                                    <input min="0" onkeypress='validate(event)' type="text" class="form-control" name="soto_bhxh" value="<?php echo $info['soto_bhxh'] ?>">
                                    <div class="input-group-addon">&nbsp;Tờ&nbsp;</div>
                                </div>
                            </div>
                            <div class="col-sm-3 control-label">Số BHXH</div>
                            <div class="col-sm-1">
                                <input type="checkbox" name="coso_bhxh" value="1" <?php echo ($info['coso_bhxh'] == 1 ? 'checked' : '')?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 control-label">Ngày phép còn lại</div>
                            <div class="col-sm-8"><input type="text" class="form-control" name="ngayphep" value="<?php echo $info['ngayphep'] ?>"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tabs-1" class="tab-pane<?php echo ($GLOBALS['var']['mytab'] == 1 ? ' active' : '') ?>">
                <div class="form-group">
                    <?

                    ?>
                    <div class="col-xs-5 col-sm-3 control-label">Tên đăng nhập <span style="color:red">*</span></div>
                    <div class="col-xs-7 col-sm-4" style="line-height: 28px;">
                        <?php
                        if($info['id'] && !$GLOBALS['user']['id'] == 1) {
                            echo '<strong>' . $info['username'] . '</strong>';
                            echo '<input type="hidden" name="username" value="' . $info['username'] . '" >';
                        } else {
                            echo '<input type="text" class="form-control" data-required="1" id="username" name="username" value="' . $info['username'] . '" >';
                            echo error_div('username', 'Vui lòng nhập username!');
                        }
                        ?>
                    </div>
                </div>
                 <div class="form-group">
                    <div class="col-xs-5 col-sm-3 control-label">M?t kh?u</div>
                    <div class="col-xs-7 col-sm-4">
                        <input type="text" class="form-control" id="new_password" name="new_password" autocomplete="off" >
                    </div>
                </div>
                
                <div class="form-group"<?php echo ($info['id'] != 1 && $info['id'] != $GLOBALS['var']['user_id'] ? '' : ' style="display: none"') ?>>
                    <div class="col-xs-5 col-sm-3 control-label">Phân quyền <span style="color:red">*</span></div>
                    <div class="col-xs-7 col-sm-6">
                        <div id="radio">
                        <?php
                        foreach ($usergroups as $key => $val) {
                            $dcheck = ($info['level'] == $key ? ' checked="checked"' : '');
                            if(!$id && $key == 3) $dcheck = 'checked="checked"';
                            echo '<label style="margin-right: 20px;"><input data-required="1" name="level" id="level' . $key . '" type="radio" class="custom-radio" value="' . $key . '"' . $dcheck . '>' . $val . '</label>';
                        }
                        echo '<div class="errordiv level">Vui lòng chọn nhóm phân quyền!</div>';
                        ?>
                        </div>
                    </div>
                </div>
 
                <!-- todo producr profile -->
                <div class="form-group"<?php echo ($info['id'] != 1 && $info['id'] != $GLOBALS['var']['user_id'] ? '' : ' style="display: none"') ?>>
                    <div class="col-xs-5 col-sm-3 control-label">Produce profile <span style="color:red">*</span></div>
                    <div class="col-xs-7 col-sm-6">
                        <?php
                        foreach ($permissions as $key => $val) {
                            echo '<label style="margin-right: 20px;"><input name="access_file" id="access_file' . $key . '" type="radio" class="custom-radio" value="' . $key . '"' . ($info['access_file'] == $key ? ' checked="checked"' : '') . '>' . $val . '</label>';
                            echo error_div('access_file' . $key, 'Vui lòng chọn nhóm phân quyền profile');
                        }
                        ?>
                    </div>
                </div>
    			<div class="form-group">
                    <div class="col-xs-5 col-sm-3 control-label">Approve Payment <span style="color:red">*</span></div>
                    <div class="col-xs-7 col-sm-6">
                        <?php
                        foreach ($signing_approval as $key => $val) {
							
                            echo '<label style="margin-right: 20px;"><input name="signing_approval" id="access_file' . $key . '" type="radio" class="custom-radio ' . ( $key==2 ? 'limit' : 'noneLimit' ) . '" value="' . $key . '"' . ( $info['signing_approval']!=2 ? ' checked="checked"': $info['signing_approval'] == $key ? ' checked="checked"' : '' ) . '>' . $val . '</label>';
                           // echo error_div('access_file' . $key, 'Vui lòng chọn nhóm Signing approval');
                        }
                        ?>
                    </div> 
                </div>
                <div class="form-group" id ="limitdisplay" style="<?= $info['signing_approval']!=2 ? 'display: none;' : '' ?> " >
                    <div class="col-xs-5 col-sm-3 control-label">Limit payment</div>
                    <div class="col-xs-7 col-sm-6">
                        <div class="row">
                            <div class="col-sm-3">
					            <div class="input-group">
                                    <input type="text" class="form-control" name="payment_limit" id="payment_limit" value="<?=number_format($info['payment_limit']) ?>">
                                    <div class="input-group-addon">VND</div>
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-2 control-label">Limit total month</div>

                            <div class="col-sm-3">
					            <div class="input-group">
                                    <input type="text" class="form-control" name="payment_month_limit" id="payment_month_limit" value="<?= number_format($info['payment_month_limit']) ?>">
                                    <div class="input-group-addon">VNĐ</div>
                                </div>
                            </div>
                        </div>
					</div>
                </div>
                <div class="form-group">
                    <div class="col-xs-5 col-sm-3 control-label">Tạm ứng</div>
                    <div class="col-xs-7 col-sm-6">
                        <div class="row">
                            <div class="col-sm-3">
					            <div class="input-group">
                                    <input type="text" class="form-control" name="advances_usd" id="advances_usd" value="<?=number_format($info['advances_usd'] == 0 ? 50 : $info['advances_usd'], 2) ?>">
                                    <div class="input-group-addon">USD</div>
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-2"></div>
                            <div class="col-sm-3">
					            <div class="input-group">
                                    <input type="text" class="form-control" name="" id="advances_vnd" value="<?= number_format($info['advances_usd'] == 0 ? 50 * $GLOBALS['cfg']['usd_exchange_rate'] : $info['advances_usd'] * $GLOBALS['cfg']['usd_exchange_rate']) ?>">
                                    <div class="input-group-addon">VNĐ</div>
                                </div>
                            </div>
                        </div>
					</div>
                </div>
                <div class="form-group">
                    <div class="col-xs-5 col-sm-3 control-label">Miễn chấm công</div>
                    <div class="col-xs-7 col-sm-6">
                        <label style="margin-right: 20px;"><input name="mien_chamcong" id="mien_chamcong1" type="radio" class="custom-radio" value="1"<?php echo($info['mien_chamcong'] == 1 ? ' checked="checked"' : '') ?> ><span>Có</span></label>
                        <label><input name="mien_chamcong" id="mien_chamcong0" type="radio" class="custom-radio" value="0"<?php echo($info['mien_chamcong'] == 0 ? ' checked="checked"' : '') ?> ><span>Không</span></label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-5 col-sm-3 control-label">Miễn trễ sớm</div>
                    <div class="col-xs-7 col-sm-6">
                        <label style="margin-right: 20px;"><input name="mien_tresom" id="mien_tresom1" type="radio" class="custom-radio" value="1"<?php echo($info['mien_tresom'] == 1 ? ' checked="checked"' : '') ?> ><span>Có</span></label>
                        <label><input name="mien_tresom" id="mien_tresom0" type="radio" class="custom-radio" value="0"<?php echo($info['mien_tresom'] == 0 ? ' checked="checked"' : '') ?> ><span>Không</span></label>
                    </div>
                </div>
                <?php
                if (is_array($timetables) && count($timetables)) {
                    ?>
                    <div class="form-group">
                        <div class="col-xs-5 col-sm-3 control-label">Nhóm chấm công</div>
                        <div class="col-xs-7 col-sm-2"><?php echo form_dropdown('cachchamcong', $timetables, $info['cachchamcong'], 'id="cachchamcong" class="form-control"'); ?></div>
                    </div>
                    <?php
                }
                if (is_array($departments) && count($departments)) {
                    ?>
                    <div class="form-group">
                        <div class="col-xs-5 col-sm-3 control-label">Quản lý nhân viên</div>
                        <div class="col-xs-7 col-sm-9">
                            <div class="row">
                                <?php
                                foreach ($departments as $key => $val) {
                                    if ($key) {
                                        echo '<label class="col-xs-3 col-sm-3"><input name="viewall[]" id="viewall' . $key . '" type="checkbox" class="custom-checkbox" value="' . $key . '"' . (@in_array($key, json_decode($info['viewall'])) ? ' checked="checked"' : '') . '><span>' . $val . '</span></label>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="form-group">
                    <div class="col-xs-5 col-sm-3 control-label">Quyền truy cập</div>
                    <div class="col-xs-7 col-sm-6">
                        <label style="margin-right: 20px;"><input name="mode_right" id="mode_right1" type="radio" class="custom-radio" value="1"<?php echo($info['mode_right'] == 1 ? ' checked="checked"' : '') ?> ><span>Theo nhóm</span></label>
                        <label><input name="mode_right" id="mode_right0" type="radio" class="custom-radio" value="0"<?php echo($info['mode_right'] == 0 ? ' checked="checked"' : '') ?> ><span>Phân quyền riêng</span></label>
                    </div>
                </div>
            </div>
            <div id="tabs-2" class="tab-pane<?php echo ($GLOBALS['var']['mytab'] == 2 ? ' active' : '') ?>">
                <div class="form-group">
                    <div class="col-xs-5 col-sm-3 control-label">Loại nhân viên</div>
                    <div class="col-xs-7 col-sm-5">
                        <label style="margin-right: 20px;"><input name="type" id="type0" type="radio" class="custom-radio" value="0"<?php echo($info['type'] == 0 ? ' checked="checked"' : '') ?> ><span>Chính thức</span></label>
                        <label style="margin-right: 20px;"><input name="type" id="type1" type="radio" class="custom-radio" value="1"<?php echo($info['type'] == 1 ? ' checked="checked"' : '') ?> ><span>Thử việc</span></label>
                        <label><input name="type" id="type1" type="radio" class="custom-radio" value="2"<?php echo($info['type'] == 2 ? ' checked="checked"' : '') ?> ><span>Parttime</span></label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-5 col-sm-3 control-label">Tính lương</div>
                    <div class="col-xs-7 col-sm-5">
                        <label style="margin-right: 20px;"><input name="anluong" id="anluong1" type="radio" class="custom-radio" value="1"<?php echo($info['anluong'] == 1 ? ' checked="checked"' : '') ?> ><span>Có</span></label>
                        <label><input name="anluong" id="anluong0" type="radio" class="custom-radio" value="0"<?php echo($info['anluong'] == 0 ? ' checked="checked"' : '') ?> ><span>Không</span></label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-5 col-sm-3 control-label">Lương xác định thử việc</div>
                    <div class="col-xs-7 col-sm-5"><input type="text" class="form-control money" name="luong_thuviec" value="<?php echo $info['luong_thuviec'] ?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-xs-5 col-sm-3 control-label">Lương xác định chính thức</div>
                    <div class="col-xs-7 col-sm-5"><input type="text" class="form-control money" name="luong" value="<?php echo $info['luong'] ?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-xs-5 col-sm-3 control-label">Lương căn bản</div>
                    <div class="col-xs-7 col-sm-5"><input type="text" class="form-control money" name="luong_cb" value="<?php echo $info['luong_cb'] ?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-xs-5 col-sm-3 control-label">Lương theo giờ</div>
                    <div class="col-xs-7 col-sm-5"><input type="text" class="form-control money" name="luong_theogio" value="<?php echo $info['luong_theogio'] ?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-xs-5 col-sm-3 control-label">Phụ cấp</div>
                    <div class="col-xs-7 col-sm-5"><input type="text" class="form-control money" name="phucap" value="<?php echo $info['phucap'] ?>"></div>
                </div>

                <div class="form-group">
                    <div class="col-xs-5 col-sm-3 control-label">Trách nhiệm</div>
                    <div class="col-xs-7 col-sm-5"><input type="text" class="form-control money" name="trachnhiem" value="<?php echo $info['trachnhiem'] ?>"></div>
                </div>

                <div class="form-group">
                    <div class="col-xs-5 col-sm-3 control-label">Chuyên cần</div>
                    <div class="col-xs-7 col-sm-5"><input type="text" class="form-control money" name="chuyencan" value="<?php echo $info['chuyencan'] ?>"></div>
                </div>

                <div class="form-group">
                    <div class="col-xs-5 col-sm-3 control-label">Tiền bảo hiểm</div>
                    <div class="col-xs-7 col-sm-5"><input type="text" class="form-control money" name="baohiem" value="<?php echo $info['baohiem'] ?>"></div>
                </div>
				  
            </div>
            <div id="tabs-3" class="tab-pane<?php echo ($GLOBALS['var']['mytab'] == 3 ? ' active' : '') ?>">
                <div class="clearfix"></div>
                <!--todo left-->
                <div class="col-sm-6">

                    <div class="form-group">
                        <div class="col-sm-4 control-label">Indirect Report
                        </div>
                        <div class="col-sm-8">
                            <span><?=$desc['report']?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 control-label">Head of department
                        </div>
                        <div class="col-sm-8">
                            <span><?=$desc['headofdepartment']?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 control-label">Location</div>
                        <div class="col-sm-8">
                            <span><?= (isset($branchs[$desc['location']]) && $branchs[$desc['location']] !='') ? $branchs[$desc['location']] : ''?></span>
                        </div>
                    </div>
                </div>
                <!--todo right-->
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="col-sm-4 control-label">Classification</div>
                        <div class="col-sm-8">
                            <span><?=$desc['class']?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 control-label">Direct Report</div>
                        <div class="col-sm-8">
                            <span><?=$desc['direct']?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 control-label">Department
                        </div>
                        <div class="col-sm-8">
                            <span><?=$desc['department']?></span>
                        </div>
                    </div>
                </div>
                <span><?php echo $info['job_description'];?></span>
            </div>
        </div>
    </td>
</tr>


<?php
echo module_close();
echo form_close();
?>
<script type="text/javascript">
    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
    $(document).ready(function() {
        //alert($('.limit'));
        
        <?php
        if ($updated == 1) {
            echo 'showNoti("Nhân viên: ' . $name . '", "Cập nhật thông tin thành công!", "Ok");';
        }
        if ($failed == 1) {
            echo 'showNoti("Nhân viên: ' . $name . '", "Cập nhật thông tin thất bại!", "Err");';
        }
        ?>
 
        var $old_name = $('#username').val();
        $('#username').change(function () {
            var val = $(this).val();
            var allusers = <?= json_encode($allusers)?>;
            if(jQuery.inArray(val, allusers) !== -1){
                showNoti('Tên đăng nhập đã tồn tại, vui lòng chọn tên khác!', 'Users', 'Err');
                $(this).val($old_name);
                return;
            }

           
        });

        $('#myposition').change(function () {
            var id = $(this).val();
            if(!!id){
                $.ajax({
                    url: site_url + "users/ajax_team",
                    method: "POST",
                    data: {pos: id},
                    success: function(data) {
                       if(!!data){
                           $('#myteam').html(data).trigger('chosen:updated');
                       }
                    }
                })
            }
        });

        $('#mydeprent').change(function () {
           var id = $(this).val();
           if(!!id || id !=11){
               $.ajax({
                   url: site_url + "users/ajax_postion",
                   method: "POST",
                   data: {id: id},
                   success: function(data) {
                       var obj = jQuery.parseJSON(data);
                       if (!!obj.title && obj.title != '') {
                           $('#myposition').html(obj.title).trigger('chosen:updated');
                       }
                   }
               })
           }
        });
		
		
    });
	
	     $('#advances_usd').change(function () {
            var val = $(this).val().replace(/\s/g, '').replace(/,/g, '');
			var advances_vnd = val*<?= $GLOBALS['cfg']['usd_exchange_rate']?>;
			 $('#advances_vnd').val(accounting.formatMoney(advances_vnd, '', 0));
        
        });
		 $('#payment_limit').change(function () {
		var val = $(this).val().replace(/\s/g, '').replace(/,/g, '');
		 $('#payment_limit').val(accounting.formatMoney(val, '', 0));
        
        });
 		$('#payment_month_limit').change(function () {
		var val = $(this).val().replace(/\s/g, '').replace(/,/g, '');
		 $('#payment_month_limit').val(accounting.formatMoney(val, '', 0));
        
        });
        $('.limit').change(function () {
           // $('#limit').show();
            document.getElementById("limitdisplay").style.display  = "flex";
           // alert(1);
		///var val = $(this).val().replace(/\s/g, '').replace(/,/g, '');
		// $('#payment_month_limit').val(accounting.formatMoney(val, '', 0));
        
        });
        $('.noneLimit').change(function () {
           // $('#limit').show();
            document.getElementById("limitdisplay").style.display  = "none";
           // alert(1);
		///var val = $(this).val().replace(/\s/g, '').replace(/,/g, '');
		// $('#payment_month_limit').val(accounting.formatMoney(val, '', 0));
        
        });
</script>
