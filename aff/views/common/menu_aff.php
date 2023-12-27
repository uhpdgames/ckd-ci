<div class="top-area">
    <div class="pc cate-wrap">
        <div class="inner">
            <div class="site-wrap">
                <div class="float-left">
                    <div class="logo-img df-bannermanager df-bannermanager-wp-head-logo">
                        <div class="vertical">
                            <a class="logo" href="<?= $config_base; ?>">
                                <img class="img-fluid" src="<?= image_default('logo')?>" />

                                <!--<div
									class="add-image"
									data-img="logo"
									data-src=""
									data-class="img-fluid"
								>-->
                            </a>
                        </div>
                    </div>
                    <div class="bs">
                        <a href="<?= MYSITE_AFFILIATE ?>" title="<?= getLang('tiepthilienket') ?>"><?= getLang('tiepthilienket') ?></a>
                    </div>
                    <div class="bs">
                        <a href="<?= MYSITE_AFFILIATE ?>" title="review">
                            Review
                        </a>
                    </div>
                    <?php if (!empty($uid) && $uid != 0 && $uid != ''): ?>
                    <div id="category" class="xans-element- xans-layout xans-layout-category cate-override">
                        <ul class="nav-top">
                            <li class="bs xans-record-">
                                <a href="<?= MYSITE_AFFILIATE ?>" title="Cộng tác viên">
                                    Danh sách
                                </a>
                                <div class="sub-category">
                                    <div class="sub-left">
                                        <ul class="sub02 sub02_84">
                                            <li class="cate_no_140 arrow">
                                                <a href="<?= MYSITE_AFFILIATE ?>account/thong-bao-cong-tac-vien"><?= getLang('ctv_thongbao') ?></a>
                                            </li>
                                            <li>
                                                <a href="<?= MYSITE_AFFILIATE ?>account/thong-tin-cong-tac-vien"><?= getLang('ctv_chitiet') ?></a>
                                            </li>
                                            <li>
                                                <a href="<?= MYSITE_AFFILIATE ?>account/cong-tac-vien-chuyen-doi"><?= getLang('ctv_chuyendoi') ?></a>
                                            </li>
                                            <li>
                                                <a href="<?= MYSITE_AFFILIATE ?>account"><?= getLang('taikhoan') ?></a>
                                                <ul class="sub03 sub03_140">
                                                    <li class="cate_no_142">
                                                        <a href="<?= MYSITE_AFFILIATE ?>account/thong-tin-chuyen-khoan"><?= getLang('ctv_thongtinchuyenkhoan') ?></a>
                                                    </li>
                                                    <li class="cate_no_143">
                                                        <a href="<?= MYSITE_AFFILIATE ?>account/them-tai-khoan-ngan-hang"><?= getLang('ctv_themtaikhoannganhang') ?></a>
                                                    </li>
                                                    <li class="cate_no_141">
                                                        <a href="<?= MYSITE_AFFILIATE ?>account/thong-tin-thu-nhap"><?= getLang('ctv_thunhap') ?></a>
                                                    </li>
                                                    <li class="cate_no_143">
                                                        <a href="<?= MYSITE_AFFILIATE ?>account/xac-nhan-chuyen-khoan"><?= getLang('ctv_ruttien') ?></a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="sub-right"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="bs">
                        <a href="<?= MYSITE_AFFILIATE ?>account/dangxuat" title="Đăng xuất">
                            <?= getLang('dangxuat') ?>
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="bs">
                        <a href="<?= MYSITE_AFFILIATE ?>dieu-khoan-chinh-sach" title="Điều khoản và chính sách">
                            <?= getLang('dieukhoanchinhsach') ?>
                        </a>
                    </div>
                    <div class="bs">
                        <a href="<?= MYSITE_AFFILIATE ?>account/dangky" title="Đăng ký">
                            <?= getLang('dangky') ?>
                        </a>
                    </div>
                    <div class="bs">
                        <a href="<?= MYSITE_AFFILIATE ?>account/dangnhap" title="Đăng nhập">
                            <?= getLang('dangnhap') ?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="float-right"></div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="mb">
        <div class="mb layout-menu" id="menu_mobile">
            <div class="sz-navbar-top-slide m-0 p-0">
                <div class="swiper-container m-0 p-0 swiper-initialized swiper-horizontal swiper-backface-hidden" id="slogan-swiper">
                    <div class="swiper-wrapper" id="swiper-wrapper-59c6a9a101fbe730f" aria-live="off" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px); transition-delay: 0ms;">
                        <!-- Slides -->
                        <div class="swiper-slide d-flex justify-content-center align-items-center swiper-slide-active" style="width: 615px;" role="group" aria-label="1 / 2">
                            <a class="discount_slide" href="https://ckdvietnam.com/account/dang-ky">Coupon 10% khi bạn đăng ký là thành viên của CKD !</a>
                        </div>
                        <!-- Slides -->
                        <div class="swiper-slide d-flex justify-content-center align-items-center swiper-slide-next" role="group" aria-label="2 / 2" style="width: 615px;">
                            <a class="discount_slide" href="https://ckdvietnam.com/gioi-thieu">Nhà phân phối chính thức độc quyền CKD tại Việt Nam</a>
                        </div>
                    </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
            </div>
            <div class="sz-navbar">
                <div class="sz-navbar-inner sz-navbar-left">
                    <div class="row sz-navbar-mb align-items-center justify-content-center" style="padding-top: 1rem;">
                        <div class="col-2 d-flex justify-content-start">
                            <input type="checkbox" id="sz-navbar-check" />
                            <label for="sz-navbar-check" class="sz-navbar-hamburger menu-toggle"> <img src="assets/icon/menu/open_menu.svg" alt="CKD COS VIET NAM" class="img-fluid menu-icon" /> </label>
                        </div>
                        <div class="col-8 d-flex justify-content-center navbar-logo">
                            <a class="menu-icon-mb" href="https://ckdvietnam.com/">
                                <img
                                    width="83px"
                                    src="data:image/webp;base64,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"
                                    alt="CKD VIỆT NAM"
                                />
                            </a>
                        </div>
                        <div class="col-2 d-flex justify-content-end"></div>
                    </div>

                    <div class="sz-navbar-items">
                        <div class="ngonngu">
                            <div class="execphpwidget">
                                <div id="flags">
                                    <a data-lang_dir="vietnamese" data-lang="vi" href="ngon-ngu/vi/">
                                        <img
                                            width="30"
                                            height="30"
                                            src="data:image/webp;base64,UklGRuYAAABXRUJQVlA4INoAAABwBgCdASojABkAPpE6mEgjopCarfwAWAkEswBai95GAXYBvIgGMeg2WWY+XKgv2o+PeXL7NK7fF3wl+AAA/uUIARV8MnY5YSqsaGoMZ69j/xlMCbvX1UHTfSj53ylfP/+oM//IM//IM+1wKHUVapW4iLzbwcH0Ww8aRKsXvYK71siph2+0VqBTDH9S1eZ+Dud9Uz1ZKR1FsQqW2emIiSxzrwDpWVPPaZ8ZVqL2kTj/KlavSjU/7TjcXJulh7MnN8y7Cq+K3wwohB6Q14srK6yTb0UfZdR7+wEgAA=="
                                            alt="Tiếng Việt"
                                        />
                                    </a>
                                    <a data-lang_dir="english" data-lang="en" href="ngon-ngu/en/">
                                        <img
                                            width="30"
                                            height="30"
                                            src="data:image/webp;base64,UklGRjQBAABXRUJQVlA4ICgBAABwBwCdASojABkAPp1KnUuwExEStMxYCcS1AEEqqO2ZN3Jf1VmKmHZd2KhA6gD9IAUFsiV32kg3nuxmaIi0/vEcJDws8AD+uwXEUex0E7oKNtaSfaBCRkqVF1jR3LJAMyT2PUlKv7Tl5wTUvMQYG479UVcePp3NavfKD9T4xgdxPiatS6esLrvlFsB6wT//WmYiYQtX4rDqfmS9dbNaT3ZfJzyoqh3btb9oAbMZvT/zO3Lf4KMHHs6MU+H/PMCB54+NBicRBAKb4GXeXwIHkqf+N/IqU+XSUb0TIfoo9kKio+5NMSOh5YY30JP7vquym4yb73/y4ZD66rKRcx9pTn//6JIsL5FkzClYj2Zz680xcRDeyju9VDf/5Bn6nq30AZ5TbJS3AwAAAA=="
                                            alt="English"
                                        />
                                    </a>
                                    <a href="ngon-ngu/ko/" style="pointer-events: none;">
                                        <img
                                            width="30"
                                            height="30"
                                            src="data:image/webp;base64,UklGRq4MAABXRUJQVlA4IKIMAABQSACdASosAcgAPp1MoEsyM7MqpxWpgLATiWdu4XHb+EGC/QcRv0nuLbajzAecP6M/N06iD0AOlq/cHCjP7n1s+V59neRC9J94Pzfta7AeAF+F/x3/Abx2AD8i/qfoezSsgDgFKAHkw/3fim/QP3p9wT9gvRs///tY/a7///9T4Lf2D//5Op8rGbzoNx1IBBHTjQ99qEZ8Z7OhADuRMEfQZy/qtKOt7BUxUQq86m40Zqkif7iRrCCuJjDpv4/CmvX/pHTTbMW3x0Z0cqAefyS7WQv31TwkKCX6w8r8oon5sGUC3vey/1kKpZwmBOiiHo9ftCfgyAPDVdjliHZGXZyia/QtQ6jsJ+X5P6OCLi7K/2IHHLf4XHn5R9t2xtVdRVPG2+zOht0CDykAq484ewjkK61RGwBhBCssxE0ZQhyJCOBzzoNvMCr/Z6c17+nxtZ89ikcfJaffAQR9BrC/x39Q1CUwMp+azMpI1svg1Xg3HRn8s4iRVceeSXWF4PXMwhzq21xpUqF49HQR8/6fPGkr3zzvPTlKOXJDeRYPduXtPquzkAODeQYHYseNQykg7oT/fEPBN1+PlEeSpmYEtpuu6IuNb5VCg+8BvkzYjLpt9z/TnEjFG0zsPBNWz0Q5/+alOAbhSAHGe+HITCNIf4HVRlGB3DZBWOg9WNiaj7krGGs4JrzwEL9sTiwkL5UyN0goAWM3KozK1Cwp+9So5I/3ubJNCkzkitjG646OSYxqvkpGq8FtKxh4RVDUp39+17zoNx1IBBH0G46iAAD+/vXoCgmfYuvfkYAk64Amj3nkxtIiPYj0atAUmf5ej6NtC98zwrKgyR0qkEblua3Tthk5oChrfeVRPxNWSaYZOdzIY9xJpD1LBPoA9CpzTvURUvr+h9ih1N/HQhWUh0q4cOQtcfJd/zbF6uX/h4ANpYhFMNsZHvy5IC9WefL+moJK5Znu6+xvZ5xXR3Y43HpDJC0minKglJF5Fwl1EC0TX8+7nahKHTf7tci/zc0PPgY75fjR4amQy9nZtyAtVgjvQF9mrt3zavSEqR5H1I9lqoBhfcuLx03F77tfp0CFGBxiSPod9wIDRqiSJFVaRWjkpWVO/hXXeKCPnzHfaVJ1fH/jVH9gJjrzVQUQnA8aeBB6NsMqHQ/6e4uSfM/wJ0THC5NAy4tZ/DQkohMALiu7EmSRd0ZmYYclnYyxzUBdECrwC+9KiidLXrP11MbQ936bqQcmhWn1FaHyGcPtQhzP5xvI1Ov6Oob1lrOdvFwroDUMvU1jSUgVJjygEDq0W2SRJeEiXZE98LMAFCOCA2wDpPJJlObZHxTb9HJCpJtMqTInyi6b4wXP/axCaPh0zdHgRwnoY3BfTQpe1sQF5r63093LjSOU70yK/G7GtboK5170rHB01/6Vx8RLjqWiD/+9aRIhDi+/11+Oy1G8WfTyDp0qOeM8M+Gg4ZR+9oVPI0y5Rzxci+8dL0YtT5P+q3cAD8y0RHjHJIIDPmJRnqDnNDf//GG0zYgc0yimWaYIuzHlVBM2CWwO2z8TDBn0I057inJIwFLvYgvtSBvga8/pYDY6B3dZhv0OqKNz+tSQ2wPsA5eyzSot1sGnblcoNrHWowFP6T6YXk+v7DCarYimkrVHd5gbnqUsEUre9r/emudwXSB9YwBUIPqHreIE9axEy+N1gLk2LiuICR/Vfok1l6nMoYrB2qIrynLlMOuQ+sMeKCCvBtSmRw9ARSyUYIKZ1hdGzUdmX83aIkPGnnyphJrglgbQ2N1uqgo90AEBiOjFpWA8Jbh69tQk9Zw/ugiIbXboHnl60+GjvUTUj9vC4ZEKV/10hoAkX0IBIVDbhvSthW2GaILSOElCR+WfYs8NKGVAYaEbeylxaZ2uQdb+S6plPVfO3NQjKZQqwfFKRZYjELXRXCcSSeXBhbiZp+dx1vzsAyeAXX/4Cih236wVkwJ6ZnV9WO9McpPF+cYdzBn+AD+YF7uEeRovBuKQv2G1oGa6i1JbNtDQIeEp0knmZohtALwAMODlPDKFQB7K7H6JRES2R8dIL2TN9MOCh3CVZ2WEts3maBAF3LzTdigTICTJMwUGVXVXxoi6wp3/9S+J795fGoJQCsniPa6ejj//F/VCtWfgFFIhsOUUaYUu1wo1ruykcPk7UXhqynJ8ZBsFSAZ4fiEW2XDlGBDAOzuVkJPfqV9UOGPkzYq8gZD/3rNiTYnB9Mw67kxZhf4BuxGuIKCUMiwAQnnaQnCts9kScRrtALbUKhJJf9xmgreaFrBLqtvGwHLin2QFZkISnxAL5m7khH50+9xNOLZlxvEmzjIOsgyO3YT6YfF4bx2Eg/Gy8fxzRyf1P9kofNfRn0Msy826bOsIER1gG0u1QQ71/iFAaScBUMZvoKlwx+Mlo7zdEC+RdwO/g4SO8fttsrOAAVcuWFiyM6XRSZyJAakK+xtdnOGut5XOzJSRjRPcwBkMfoeP9s45gU3R35zqxZGfnbPn1XeWdpRVjDRMCkYg9HYqwhusXH5n4t50q0SGBYOYYIrsf+AWOV+XKbtBD6a7BfHKUCc3aWqK75cpZh0X22z4IhEj4Ztwn0E2unqKyo6Fhh1agMJSod2WrHHAYcCYAYyJGjqGsZXt7CNVgigR5rnUXOatJsFGiM9/z1KkzDFmJnd/pbbzXfBp2hAZAjf4FcjJLLNeNfWPJ6hy5RDzsqH4z3Qd+MTxHIaMBfL5zl/yFoZyA3BcX2WeIOC0fzNTZPo3s4K77Ln8uVchLQ7XXOfMYzW8JXrhxcOvuHhzGnGO1gdW3uPjYubgf7zOg8jnFL5Y5NTF5JToZW1lX9Kxp1frib+e+ldGtR/LgfHYGJ9DANjOkF8svewo5pxGhodj7dmM+dI75SLkdhFLEZvmGUI6Yn/kPnIf+QYJK1lJieAR7GQ9K6BvtGzf1wtA3dZAHfcvBO9oOHQa1QplOwqA/JIb6qBDt6VXq+Av9U5eFv4xtbwl5h1jT6lEUpzU1d6rhs+d7LC6fA03Bfn6fLOMDB8RnMwBQ5cmmaeJffmc8GMY11M751b2yJSDJUQiHdr7Ulane5RK1nhqb/CRl33D5BVVi9OUEyOYMJhFHPRAVDwCMqror/vGnf70imccAH7JZnrIanEPuli688xruZlhL1GcUcyVrT1DOEAI2IcunZADEVmQPv6T4sj2e2Rv+nwDdxJZ0IP88R/+lUlk4yaNa33ANdUk24PfUvj6Ypk9XWMPqgPtoXGZNyLJ92opQoGpcl/65DtuRBVpGyRFr+uwc4vDTpkAEA/6NQcx9DyGf17T8bcaMoe5/lovZ2Oba6bQYor9g7ceaimYBf1shIK4TASuFd4ds01Kq8ZEH5UNtXnO3Bl9B1+1wza3tT5dvBlVzPXAqX+fpyA/SoOQ1C9qhz3nqWb1HtHEDDO56dJJPWkDojwFSaGpNcxjE16mGmV3jH87iVEqjlm0LNoZ3ZuQ5+CnXaGrYn9TB8rg3Yq6FCRr4gW+JXHw5rf4+yz/ejbA9bgHkQW3TzeIHDTc5F40IOt1usUQtQ4Ib/t6ZZO6AeTYDE1OAA/KXBp4W87dcqE+uctndZNuf9kfs3EbviaZ/lqkNaVSXEgrGODpGGOvCFQ/sG1e2srNsYa08XMzL8JTwb44ckIKd/PUJUWEx+781JoaOxtH1cu5EHqkH1KauFQSGCE+sn2jiZ5mrhQdcwysvoybcnIY/tXhoVqAFMdDjQ1wX3tqP7EblgSwqirKu88Dk4EvmWrBeptK7Angod25NUfKPz35iK68XsHMQtU1uytb5806HyZp/L1/kozaoF5NGuifeQ9Fv70Hx1W1UWu06t/zmn09JLODTx0i/ME8Q5qE6Lo3gRavJKsdA5C8dl1L1MXQ/4NS2hZx4EXGbFCNT9obohYfZV5jkhseAXyn3KOaupmBnD9C1d9I0XJ7i6jae6tPzQj4CxzfcKEcTn43VJlp9imP85l4Hr3RgxJPWEux2/Vpx6b9bMYDXBvpIrIh/G1mhJ2nK/hLnM8brdDf//GZtXdRjP2wwz37xITPwrrrB7zEPlEkHiOoRm4lYEq6XYi7cAUQ6G+Mrcu6fKVBf75lsKCKX83Lm87dEQzJ2GIIqm0dqjvBS1sSYAQMU9Q0/K8773+9ORt23MAHA3staIKSGz74hoEaKkzgobQzEnn8P7Bdb2Y7bhwZgBTmXxx/cXh1E6NNCzlpVIF1N9j0o1BpjKKwnBKItK3sfWwVoYb3FcBNfDBS4f62nxAAcNWMeMG6XH1/Ey8r9+6RHRpakswJW0F+2mP41eLhMOj87gAAAAA="
                                            alt="Korea"
                                            style="opacity: 0.5; filter: alpha(opacity=50); pointer-events: none; cursor: default;"
                                        />
                                    </a>
                                    <a href="https://ckdvietnam.com/" style="pointer-events: none;" title="China" class="flag zh-CN">
                                        <img
                                            width="30"
                                            height="30"
                                            src="data:image/webp;base64,UklGRkIEAABXRUJQVlA4IDYEAAAQGwCdASrhAJYAPp1Ook0yLq4lIjGooLATiWVu4XVQ+d0ao/6HkjeYSKX5H6gH5p9gDnFeYD9jv2q93T0MegB/S/6r1gHoAft31mv9s/5GU/h7IgRwK4+VK9vr6cNWxbup0mUcFULETRq2S+rimKveLrMjVTp2vyhIsE2829ArX4h+hWO2LOAqgOoQCO9cjdgMcfOlAQesKLbg92kJId06c0/EJQ/rLsozxoTEGFVGBAqDEJ/FYiXYS2VYsOPSYN2Vq2TB6wrX5AVUXbJg9YVr8gKqLtkwesK1+QFVF2yYNAAA/v6OM/3QRUL7f/7Kx/0rH/Ssd5whsEYzAzr72r++fo94ghHVpEskfqyTU49+rYl7EMDJcGdmL0mPCsiBkn4IsnHzbHK/N6p++cbIccd4OUnlfm6n/MP8dc4KgB7McJdMO7LG2RrIj+kzhXpGTLjWBg+KkMbyiN42XISFEIz0QGEz2hxjoGCExm4O6JwQdFBGpa/TEm1VEErUaKZE5yqS2HUchea5O9zBv6uaJtIk7AxVnEE7W2v8ELP/1PvGyIrZQGcVhSAhpBP8s1unzP70e1Ib5EzrFnXi6XSx74rMtDMuUIaAZGprDK9ckpDxMPUzX864y+K0AEwc0Lr8HMsPyt9sOybDjM2/YqMJnZEMeEVh2c+yPvlt8fQuwi4ZiB0fWd0Ti3ynJXMAT2j+6n4nVq/MJCLxhv2aH+6ofCsWoD42bDJPNued6Z8xcn1h8MNXNacRCgdH8Pf7Uhf2Echk+WNjtnJnVBdrSHZ1/Kta8yTXKH2JDJlRZTxq8C0zjSyjflT8yn2/+C0/0PMTBlElcEcmaYek32EHLsza/TryEZQBc/eXcFWLKI48d9ybbOSDjxFlBp4hb2eP2+VeY6jGvmsZoU2KmrzI+wB8HbCW/uvdnc5v88TZ2G5dbaPE3DE6KlU37aPCxtN+oYhUcrI+vf4RB2IJ8nCqiNjd9isPlJm2vR+JT1l5lzVeHJjnwSugSkSZfym4WoBdHSi8Gl70U7m2V91eipmaxSYXXqrxjD/mOyRgobirv/a7YBtT+3ws1JAaaNBOEpYCpSt8Qqhh757PmDEXToCUZbQ/J3M7OjhhQoov2eMYAxALY1FXL3OiEbq+9zdntR+Jq1xcSajApzCXyI6O7qNkrwS5iKosAzATwRsJvyYtv310viP/X3+eDGR6KcB4p271qbiXXBKZJIH1fvO6AJDSQhnMU5VgdZgtacMI8zwtxaL39k7qke43v/i9RtjUaW1Wo7ozry6N6LXCL4C+7XQZLMLVqO/4c2S1ZorZshKkIHUrHAMJ4vhAyH6j4Z7Snsrqk9tP2kypevfxr8ub1VYARLmfmzz/bfo0D9zZO6ty6VW1emY16zNDHT/B4hgWJF90VLF4Afi0gKS60NyzhPeKqRGNgAAAAAAAAAAA"
                                            border="0"
                                            style="opacity: 0.5; filter: alpha(opacity=50); pointer-events: none; cursor: default;"
                                            alt="CKD COS VIỆT NAM"
                                        />
                                    </a>
                                    <a href="https://ckdvietnam.com/" style="pointer-events: none;" title="Malaysia" class="flag ma">
                                        <img
                                            width="30"
                                            height="30"
                                            src="data:image/webp;base64,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"
                                            border="0"
                                            style="opacity: 0.5; filter: alpha(opacity=50); pointer-events: none; cursor: default;"
                                            alt="CKD COS VIỆT NAM"
                                        />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <nav class="animated bounceInDown nav-menu">
                            <ul>
                                <li class="text-left">
                                    <a href="<?= MYSITE_AFFILIATE ?>" title="<?= getLang('tiepthilienket') ?>"><?= getLang('tiepthilienket') ?></a>
                                </li>
                                <li class="text-left">
                                    <a href="<?= MYSITE_AFFILIATE ?>" title="review">
                                        Review
                                    </a>
                                </li>
                                <?php if (!empty($uid) && $uid != 0 && $uid != ''): ?>
                                <li class="sub-menu">
                                    <a class="submenu-toggle" href="/"> Danh sách <span class="submenu-icon">&nbsp;</span> </a>
                                    <ul style="display: none;">
                                        <li class="sub-menu">
                                            <a href="<?= MYSITE_AFFILIATE ?>account/thong-bao-cong-tac-vien"><?= getLang('ctv_thongbao') ?></a>
                                        </li>
                                        <li class="sub-menu">
                                            <a href="<?= MYSITE_AFFILIATE ?>account/thong-tin-cong-tac-vien"><?= getLang('ctv_chitiet') ?></a>
                                        </li>
                                        <li class="sub-menu">
                                            <a href="<?= MYSITE_AFFILIATE ?>account/cong-tac-vien-chuyen-doi"><?= getLang('ctv_chuyendoi') ?></a>
                                        </li>
                                        <li class="sub-menu">
                                            <a href="/">
                                                <?= getLang('taikhoan') ?>
                                                <span class="submenu-icon">&nbsp;</span>
                                            </a>
                                            <ul style="display: none;">
                                                <li class="sub-menu">
                                                    <a href="<?= MYSITE_AFFILIATE ?>account/thong-tin-chuyen-khoan"><?= getLang('ctv_thongtinchuyenkhoan') ?></a>
                                                    <a href="<?= MYSITE_AFFILIATE ?>account/them-tai-khoan-ngan-hang"><?= getLang('ctv_themtaikhoannganhang') ?></a>
                                                    <a href="<?= MYSITE_AFFILIATE ?>account/thong-tin-thu-nhap"><?= getLang('ctv_thunhap') ?></a>
                                                    <a href="<?= MYSITE_AFFILIATE ?>account/xac-nhan-chuyen-khoan"><?= getLang('ctv_ruttien') ?></a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="text-left">
                                    <a href="<?= MYSITE_AFFILIATE ?>account/dangxuat" title="Đăng xuất">
                                        <?= getLang('dangxuat') ?>
                                    </a>
                                </li>
                                <?php else: ?>
                                <li class="text-left">
                                    <a href="<?= MYSITE_AFFILIATE ?>account/dangky" title="Đăng ký">
                                        <?= getLang('dangky') ?>
                                    </a>
                                </li>
                                <li class="text-left">
                                    <a href="<?= MYSITE_AFFILIATE ?>account/dangnhap" title="Đăng nhập">
                                        <?= getLang('dangnhap') ?>
                                    </a>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="menu_overlay"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<script>
    NN_FRAMEWORK.Search();
    $(".sub-menu ul").hide();
    $(".submenu-toggle").click(function (e) {
        e.preventDefault();
        $(this).parent(".sub-menu").children("ul").slideToggle("100");
        var icon = $(this).find(".submenu-icon");
        icon.text(icon.text() == "&nbsp" ? "" : "");
        if ($(this).hasClass("open")) {
            $(this).removeClass("open");
        } else {
            $(this).addClass("open");
        }
    });
    $("#sz-navbar-check").change(function () {
        if (this.checked) {
            $(".layout-menu").addClass("mb_menu_open");
            $("body").addClass("fixed-position");
            $(".menu_overlay").show();
            $(".sz-navbar-hamburger img").attr("src", "assets/icon/menu/close.png");
        } else {
            $(".menu_overlay").hide();
            $("body").removeClass("fixed-position");
            $(".layout-menu").removeClass("mb_menu_open");
            $(".sz-navbar-hamburger img").attr("src", "assets/icon/menu/open_menu.svg");
        }
    });
    $(document).mouseup(function (e) {
        var container = $(".results");
        var menu = $(".sz-navbar-items");
        var search = $(".search");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.hide();
        }
        if (!search.is(e.target) && search.has(e.target).length === 0) {
            search.hide();
            $(".menu_overlay").hide();
            $("body").removeClass("fixed-position");
        }
    });
</script>
