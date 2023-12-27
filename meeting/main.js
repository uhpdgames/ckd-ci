function googleTranslateElementInit() {


    new google.translate.TranslateElement(
        {
            pageLanguage: 'vi',
            includedLanguages: 'en,ko,vi',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element'
    );
}

function logout() {
    eraseCookie('task_by_uid');
    eraseCookie('task_by_name');
    eraseCookie('report_today');
    window.location.reload();
}

config_base = "<?php echo $config_base?>";
isAdmin = "<?php echo $isAdmin?>";
const join = ["<?=$name;?>"];
const j = "<?=$login;?>";


$(document).ready(function () {

    function updateSEO() {
        $seo = [
            'serum collagen',
            'chăm sóc da bằng collagen',
            'collagen chống lão hóa',
            'collagen chống nếp nhăn',
            'collagen hàn quốc',
            'collagen thủy phân tử',
            'retinol chống lão hóa',
            'tác dụng phụ của retinol',
            'retinol trị mụn',
            'retinol cho nếp nhăn',
            'retinol cho da nhạy cảm',
            'collagen tự nhiên',
            'kem dưỡng da chống lão hóa',
        ];

        const keys = ['top', 'keyword', 'note'];
        $seo.forEach((vv, index) => {
            console.log(index)
            join.forEach((v) => {
                // j++;
                for (let v of keys) {
                    const content = $(`#${v}_${j}_${index}`).html();
                    if (!!content) {
                        $(`.${v}_${j}_${index}`).val(content);

                    }
                }
            });
        })

    }

    function raw() {
        if (isAdmin == "1") {
            const my_content = $('#value_meeting_content').html();
            if (!!my_content) {
                $('.value_meeting_content').val(my_content);
            }
        } else {
            updateSEO();

            const keys = ['attention', 'worked', 'work'];
            join.forEach((v) => {
                // j++;
                for (let v of keys) {
                    const content = $(`#${v}_${j}`).html();
                    if (!!content) {
                        $(`.${v}_${j}`).val(content);

                    }
                }
            });
        }

        // const join = ['Ms.Tiền', 'Mr.Huỳnh', 'Mr.Hảo', 'Ms.Quyên', 'Mr.Hòa', 'Mr.Thanh', 'Mr.Long', 'Ms.Thùy Anh', 'Mr.Đăng', 'Mr.Tuấn', 'Mr.Hào', 'Mr.Nhật'];

    }

    function save() {
        return 0;
        raw();
        $form = $('#table_meeting');

        var postForm = { //Fetch form data
            'meeting_content': $('#value_meeting_content').html(),
            'attention': $('.attention').html(),
            'worked': $('#value_meeting_content').html(),
            'work': $('#value_meeting_content').html(),

            'id': $('.has-worked-today').val(),
        };

        console.log(my_data);

        const request = $.ajax({
            url: "<?=$config_base?>/meeting/save.php",
            type: "POST",
            dataType: 'json',
            data: my_data
        });

        request.done(function (response, textStatus, jqXHR) {
            // Log a message to the console
            console.log("Hooray, it worked!");
        });

        // Callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown) {
            // Log the error to the console
            console.error(
                "The following error occurred: " +
                textStatus, errorThrown
            );
        });

    }


    $('.more-input').on('DOMSubtreeModified', function (e) {
        console.log('changed');

        // save();
    });

    $('#my_submit').click(function (e) {
        raw();
    });

    $('#my_print').click(function (e) {

        //  var $elie = $("#table_meeting");
        //  var $body = $('body');
        //  $body.addClass('print');

        //rotate(90);

        /*function rotate(degree) {
            $elie.css({WebkitTransform: 'rotate(' + degree + 'deg)'});
            $elie.css({'-moz-transform': 'rotate(' + degree + 'deg)'});
        }*/

        document.title = "Print page title";
        window.print();


        //rotate(0);
        //$body.removeClass('print');
    });

    $('input[name=date]').change(function () {
        const _val = $(this).val();
        setCookie('report_today', _val, 7);
        console.log(_val);
        $("#date").datepicker({dateFormat: 'dd-mm-yy'}).datepicker("setDate", _val);
        window.location.reload();
    });

    function replaceQueryParam(param, newval, search) {
        var regex = new RegExp("([?;&])" + param + "[^&;]*[;&]?");
        var query = search.replace(regex, "$1").replace(/&$/, '');

        return (query.length > 2 ? query + "&" : "?") + (newval ? param + "=" + newval : '');
    }

});

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

$("#date").datepicker({dateFormat: 'dd-mm-yy'});


function disabledEnter(event) {
    if (event.which == '13') {
        event.preventDefault();
    }
}
