<script src="https://ckdvietnam.com/admin/assets/js/jquery.number.min.js">

</script>
<script>
    function removeRegxMoney(a) {
        return a.replace(/\\,/gi, a)

    }

    $(document).ready(function () {

        $('.money-format').number(true, 0, '.').click(function (e) {
            //const a = $(this).val();
            //$(this).val(removeRegxMoney(a));
           // const b = $(this).val();
        });


    });


</script>
