<?php
$has_tab = is_array($category_list) && count($category_list) > 1;
if ($has_tab) {
    echo module_open('');
    echo '<tr class="no-border">';
    echo '<td>';
    echo '<input type="hidden" class="tabId" value="' . $GLOBALS['var']['mytab'] . '"/>';
    echo '<ul id="myTab" class="nav nav-tabs">';
    $i = 0;
    foreach ($category_list as $data) {
        echo '<li class="' . ($i > 2 ? ' hide640' : '') . ($data['id'] == $GLOBALS['var']['mytab'] || ($GLOBALS['var']['mytab'] == $i && $i == 0) ? ' active' : '') . '" onclick="set_mytab($(this))"><a href="#tabs-' . $data['id'] . '" data-toggle="tab">' . $data['name_vn'] . '</a></li>';
        $i++;
    }
    echo '<li class="dropdown show640">';
    echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyph-icon icon-align-justify"></i><span class="caret"></span></a>';
    echo '<ul class="dropdown-menu">';
    $i = 0;
    foreach ($category_list as $data) {
        if ($i > 2) {
            echo '<li' . ($data['id'] == $GLOBALS['var']['mytab'] || ($GLOBALS['var']['mytab'] == $i && $i == 0) ? ' class="active"' : '') . ' onclick="set_mytab($(this))"><a href="#tabs-' . $data['id'] . '" data-toggle="tab">' . $data['name_vn'] . '</a></li>';
        }
        $i++;
    }
    echo '</ul>';
    echo '</li>';
    echo '</ul>';
    echo '<div id="myTabContent" class="tab-content">';
} else {
    echo module_open();
}
$i = 0;
foreach ($category_list as $data) {
    if ($has_tab) {
        echo '<div id="tabs-' . $data['id'] . '" class="hide-columns tab-pane' . ($data['id'] == $GLOBALS['var']['mytab'] || ($GLOBALS['var']['mytab'] == $i && $i == 0) ? ' active' : '') . '">';
        echo '<table class="table table-hover" cellpadding="0" cellspacing="0" width="100%" border="0">';
    }
    ?>
    <thead>
    <tr>
        <?php
        if($GLOBALS['per']['del'] && $GLOBALS['cfg']['develop_mode']) {
            echo '<th class="center" width="1%"><input id="checkall" type="checkbox" class="checkAll custom-checkbox"/></th>';
        }
        ?>
        <th class="center" width="2%">#</th>
        <th width="20%" nowrap="nowrap">Tên cấu hình</th>
        <?php
        if($GLOBALS['cfg']['develop_mode']) {
            echo '<th width="20%">PHP code</th>';
        }
        ?>
        <th>Giá trị</th>
        <th width="1%">&nbsp;</th>
    </tr>
    </thead>
    <?php
    if(is_array($tabs[$data['id']]) && count($tabs[$data['id']])) {
        $n = 0;
        foreach ($tabs[$data['id']] as $row) {
        ?>
        <tr class="highlight" id="<?php echo $row['id'] ?>" name="<?php echo $row['name_vn'] ?>">
            <?php
            if($GLOBALS['per']['del'] && $GLOBALS['cfg']['develop_mode']) {
                echo '<td class="center" width="1%">' . sel_item($row['id']) . '</td>';
            }
            ?>
            <td class="center"><?php echo stt($row['id'], $n + 1) ?></td>
            <td><?php echo ($GLOBALS['per']['edit'] ? '<a class="ajax" href="' . $url_update.'/'.$row['id'].$uri_str . '">' : '') . $row['name_vn'] . ($GLOBALS['per']['edit'] ? '</a>' : '') ?></td>
            <?php
            if($GLOBALS['cfg']['develop_mode']) {
                echo '<td nowrap="nowrap">$GLOBALS[<font color="brown">\'cfg\'</font>][<font color="brown">\'' . $row['keyword'] . '\'</font>]</td>';
            }
            if($row['type'] == 2) {
                echo '<td>' . toggle_input($row['id'], $row['value'], 'value', !$GLOBALS['per']['edit']) . '</td>';
            } else {
                echo '<td>' . nl2br(substr($row['value'], 0, 200))  . '</td>';
            }
            ?>
            <td nowrap="nowrap">
                <?php
                if($GLOBALS['per']['edit']) {
                    echo edit_alink('', current_url() . '/update/' . $row['id'] . $uri_str);
                }
                if($GLOBALS['per']['del'] && $GLOBALS['cfg']['develop_mode']) {
                    echo del_restore_link($row['id'], $row['deleted']);
                }
                ?>
            </td>
        </tr>
            <?php
            $n++;
        }
    } else {
        echo no_data_mes(6);
    }
    if ($has_tab) {
        echo '</table>';
        echo '</div>';
    }
    $i++;
}
if ($has_tab) {
    echo '</div>';
    echo '</td>';
    echo '</tr>';
}
echo module_close();
?>
<script type="text/javascript">
    $(document).ready(function() {
        <?php
        if($failed == 1) {
            echo 'showNoti("Cấu hình: '.$name.'", "Cập nhật cấu hình thất bại!", "Err");';
        }
        if($updated == 1) {
            echo 'showNoti("Cấu hình: '.$name.'", "Cập nhật cấu hình thành công!", "Ok");';
        }
        if($added == 1) {
            echo 'showNoti("Cấu hình: '.$name.'", "Thêm cấu hình thành công!", "Ok");';
        }
        ?>
        $('.dropdown-toggle .current-tab-name').text($('.dropdown-menu > .active > a').text());
    });
</script>