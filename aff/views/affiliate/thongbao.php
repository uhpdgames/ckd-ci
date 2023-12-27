
<div class="w_1000">
    <div class="affiliate text-center mx-auto wrap">

        <div class="title-main"><span><?= getLang('thongbao') ?></span></div>
        <hr class="p-0 my-4 f-small w_1000"/>

        <div class="wp_form bank m-auto p-0 thongbao">
            <div class="h5 wap_form_title"><?= getLang('thongbao') ?></div>
            <div class="info d-flex flex-column justify-content-center text-center flex-wrap align-items-center">
                <div class="title mt-4"><?= getLang('daxacnhanthongtin;') ?></div>
                <div class="sub-title"><?= getLang('chaomungbandenvoi;') ?></div>

                <div class="p-0 my-4"><img src="<?= MYSITE?>assets/images/check-mark.png" ></div>

                <div class="sub-title p-0 my-2"><strong><?= getLang('maxacnhancuaban;') ?></strong></div>
                <div class="referral">
                    <div class="copy-link">
                        <input type="hidden" class="url-link-input" value="<?= $_Affiliate->urlCode() ?>">
                        <input type="text" class="copy-link-input" value="<?= $_Affiliate->code() ?>" readonly/>
                        <button type="button" class="copy-link-button">
                            <span class="material-icons">content_copy</span>
                        </button>
                    </div>

                </div>

                <div class="desc f-small"><?= getLang('chiaselink') ?></div>

                <div class="fw-900 my-4">
                    <a href="<?=MYSITE?>san-pham"
                       class="btn btn-primary btn-block"><span><?= getLang('densanpham') ?></span></a>
                </div>

            </div>

        </div>
    </div>
</div>
<hr class="p-0 my-4 f-small"/>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<script>
    var old_code = document.querySelector(".copy-link-input");
    document.querySelectorAll(".copy-link").forEach((copyLinkParent) => {
        const inputField = copyLinkParent.querySelector(".copy-link-input");
        const urlCode = copyLinkParent.querySelector(".url-link-input");
        const copyButton = copyLinkParent.querySelector(".copy-link-button");
        const text = urlCode.value;
        const oldText = old_code.value;
        console.log(text)

        inputField.addEventListener("focus", () => inputField.select());

        copyButton.addEventListener("click", () => {
            inputField.select();
            navigator.clipboard.writeText(text);

            inputField.value = "<?=getLang('dasaochep');?>";
            setTimeout(() => (inputField.value = oldText), 2000);
        });
    });

</script>
