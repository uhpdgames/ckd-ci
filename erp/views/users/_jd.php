<div id="tabs-3" class="tab-pane<?php echo ($GLOBALS['var']['mytab'] == 3 ? ' active' : '') ?>">
    <!--todo left-->
    <div class="col-sm-6">
        <div class="form-group">
            <div class="col-sm-4 control-label"><?= $trans['title'] ?><span
                        style="color:red">*</span></div>
            <div class="col-sm-8">
                <input data-required="1" name="title" value="<?= $info['title'] ?>" id="title"
                       class="form-control"/>
                <div class="errordiv title">
                    <div class="arrow"></div>
                    Please enter a Title
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4 control-label">Indirect Report<span style="color:red">*</span>
            </div>
            <div class="col-sm-8">
                <?php echo form_dropdown('report', array('' => 'Select..') + $positions, $info['report'], 'id="headofdepartment" class="select2" data-required="1"') ?>
                <div class="errordiv headofdepartment">
                    <div class="arrow"></div>
                    Please choose a Head of department
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4 control-label">Head of department<span style="color:red">*</span>
            </div>
            <div class="col-sm-8">
                <?php echo form_dropdown('headofdepartment', array('' => 'Select..') + $positions, $info['headofdepartment'], 'id="headofdepartment" class="select2" data-required="1"') ?>
                <div class="errordiv headofdepartment">
                    <div class="arrow"></div>
                    Please choose a Head of department
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4 control-label"><?= $trans['local'] ?><span
                        style="color:red">*</span></div>
            <div class="col-sm-8">
                <?php echo form_dropdown('location', $location, $info['location'], 'id="location" class="select2" data-required="1"') ?>
                <div class="errordiv location">
                    <div class="arrow"></div>
                    Please choose a Location
                </div>
            </div>
        </div>
    </div>
    <!--todo right-->
    <div class="col-sm-6">
        <div class="form-group">
            <div class="col-sm-4 control-label">Classification<span style="color:red">*</span></div>
            <div class="col-sm-8">
                <?php echo form_dropdown('class',$class, $info['class'], 'id="class" class="select2" data-required="1"') ?>
                <div class="errordiv class">
                    <div class="arrow"></div>
                    Please choose a class
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4 control-label">Direct Report<span
                        style="color:red">*</span></div>
            <div class="col-sm-8">
                <?php echo form_dropdown('direct', array('' => 'Select..') + $positions, $info['direct'], 'id="direct" class="select2" data-required="1"') ?>
                <div class="errordiv direct">
                    <div class="arrow"></div>
                    Please choose a Direct Reports
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4 control-label"><?= $trans['dep'] ?><span style="color:red">*</span>
            </div>
            <div class="col-sm-8">
                <?php echo form_dropdown('department', $department, $info['department'], 'id="department" class="select2" data-required="1"') ?>
                <div class="errordiv department">
                    <div class="arrow"></div>
                    Please choose a department
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4 control-label"><?= $trans['hod'] ?><span style="color:red">*</span>
            </div>
            <div class="col-sm-8">
                <?php $my_postion = array('' => 'Select..');
                $pdisable = '';
                if ($myid != 0 || $myid != "") {
                    $pdisable = 'disabled';
                    $my_postion = $staff;
                }
                echo form_dropdown('position', $my_postion, $info['position'], ' id="position" class="select2 ' . $pdisable . '" data-required="1"') ?>
                <div class="errordiv position">
                    <div class="arrow"></div>
                    Please choose a position
                </div>
            </div>
        </div>
    </div>

    <textarea class="mceEditor" id="job_description" name="job_description" style="height: 300px;"><?php echo $info['job_description']?></textarea>
</div>