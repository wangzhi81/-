<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"/www/wwwroot/erp.wangzhi81.com/public/../application/index/view/test/login.html";i:1568556585;}*/ ?>
<!DOCTYPE html>
<html style="--status-bar-height:0px; font-size: 96px; --window-top:0px; --window-bottom:0px;" lang="zh-CN">
    
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>登录</title>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.documentElement.style.fontSize = document.documentElement.clientWidth / 20 + 'px'
        })
         var coverSupport = 'CSS' in window && typeof CSS.supports === 'function' && (CSS.supports('top: env(a)') ||
            CSS.supports('top: constant(a)'))
         document.write(
            '<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0' +
            (coverSupport ? ', viewport-fit=cover' : '') + '" />')
        </script>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
        <link rel="stylesheet" href="/login_files/index.css">
        <style type="text/css">
        uni-page-body {
            height:100%;
            background:#2d3463
        }
        .uni-page-head-ft {
            margin-right:51px
        }
        .form {
            padding:0 76px;
            margin-top:204px
        }
        .form_ipt {
            background:#3b4374;
            height:230px;
            padding-left:51px;
            border-radius:25px;
            display:-webkit-box;
            display:-webkit-flex;
            display:-ms-flexbox;
            display:flex;
            -webkit-box-align:center;
            -webkit-align-items:center;
            -ms-flex-align:center;
            align-items:center
        }
        .form_ipt uni-text {
            color:#b8c6e0;
            display:inline-block;
            font-size:81px;
            color:#e3e9ff
        }
        .form_ipt uni-input {
            display:inline-block;
            color:#fff;
            -webkit-box-flex:2;
            -webkit-flex-grow:2;
            -ms-flex-positive:2;
            flex-grow:2
        }
        .uni-input-placeholder {
            color:#7988b3
        }
        .form_btn {
            height:230px
        }
        .form_btn uni-button {
            color:#fff;
            background:#74d1f8
        }
        /*每个页面公共css */
        body {
            background:#2d3463
        }
        </style>
        <script charset="utf-8" src="/login_files/pages-index-index.js"></script>
        <style type="text/css">
        .load[data-v-5fc1f3b4] {
            height:100%;
            width:100%;
            position:fixed;
            top:0;
            left:0;
            z-index:1000;
            background:rgba(0, 0, 0, .7)
        }
        </style>
        <style type="text/css">
        .content[data-v-6b96c4ec] {
            padding:0 2%;
            padding-bottom:307px;
            overflow:hidden;
            overflow-x:hidden
        }
        .top_img[data-v-6b96c4ec] {
            color:#fff;
            text-align:right;
            background:#3a3d46;
            border-radius:25px;
            /* min-height: 300upx; */
            height:768px;
            /* margin: 156upx 26upx 20upx; */
            /* margin: 20upx 26upx; */
            margin-top:281px
        }
        .swiper-item[data-v-6b96c4ec] {
            height:100%
        }
        .bang_img[data-v-6b96c4ec] {
            width:100%;
            /* height: 100%; */
            height:768px
        }
        .top[data-v-6b96c4ec] {
            position:fixed;
            top:0;
            left:0;
            width:100%;
            -webkit-box-sizing:border-box;
            box-sizing:border-box;
            text-align:center;
            color:#fff;
            background:#343c6d;
            overflow:hidden;
            height:256px;
            padding:102px 51px 51px 51px;
            font-size:81px;
            font-weight:700;
            z-index:888
        }
        .top uni-image[data-v-6b96c4ec] {
            width:128px;
            height:128px
        }
        .top uni-image[data-v-6b96c4ec]:first-of-type {
            float:left
        }
        .top uni-image[data-v-6b96c4ec]:nth-of-type(2) {
            float:right
        }
        .more[data-v-6b96c4ec] {
            height:460px;
            -webkit-box-sizing:border-box;
            box-sizing:border-box;
            overflow:hidden
        }
        .more uni-image[data-v-6b96c4ec] {
            margin-top:51px;
            width:96%;
            position:absolute
        }
        .newsList[data-v-6b96c4ec] {
            display:-webkit-box;
            display:-webkit-flex;
            display:-ms-flexbox;
            display:flex;
            margin-bottom:56px;
            overflow:hidden;
            background:#fff;
            border-radius:25px
        }
        .newsList .right[data-v-6b96c4ec] {
            /* width: 59%; */
            -webkit-box-flex:2;
            -webkit-flex-grow:2;
            -ms-flex-positive:2;
            flex-grow:2;
            height:409px;
            display:-webkit-box;
            display:-webkit-flex;
            display:-ms-flexbox;
            display:flex;
            -webkit-box-pack:center;
            -webkit-justify-content:center;
            -ms-flex-pack:center;
            justify-content:center;
            -webkit-box-orient:vertical;
            -webkit-box-direction:normal;
            -webkit-flex-direction:column;
            -ms-flex-direction:column;
            flex-direction:column
        }
        .newsList .left[data-v-6b96c4ec] {
            width:819px;
            height:409px;
            margin-right:4%
        }
        .newsList .left uni-image[data-v-6b96c4ec] {
            width:819px;
            height:409px
        }
        .newsList_title[data-v-6b96c4ec] {
            font-size:81px;
            overflow:hidden;
            -o-text-overflow:ellipsis;
            text-overflow:ellipsis;
            white-space:nowrap;
            color:#444653
        }
        .newsList_concet[data-v-6b96c4ec] {
            margin-top:51px;
            font-size:61px;
            display:-webkit-box;
            -webkit-box-orient:vertical;
            -webkit-line-clamp:2;
            overflow:hidden;
            color:#9fa7ba
        }
        .box[data-v-6b96c4ec] {
            height:128px;
            overflow:hidden;
            position:relative;
            bottom:-312px
        }
        .uni-swiper-msg[data-v-6b96c4ec] {
            color:#4a93c4;
            text-align:center;
            font-size:71px
        }
        .swiper-item[data-v-6b96c4ec] {
            height:100%;
            border-radius:51px
        }
        .sw_left[data-v-6b96c4ec] {
            margin-right:51px
        }
        .help[data-v-6b96c4ec] {
            margin-top:76px;
            color:#afbbe5
        }
        .help .test[data-v-6b96c4ec] {
            font-size:71px;
            margin-bottom:25px
        }
        .help uni-image[data-v-6b96c4ec] {
            width:100%
        }
        .help_plan[data-v-6b96c4ec] {
            height:512px;
            color:#fff;
            margin-bottom:76px
        }
        .help_plan .help_left[data-v-6b96c4ec] {
            float:left;
            text-align:center;
            line-height:512px;
            width:50%
        }
        .help_plan .help_rigth[data-v-6b96c4ec] {
            height:512px;
            border-bottom-right-radius:51px;
            border-top-right-radius:51px;
            float:right;
            width:50%;
            background:#fff;
            padding:51px;
            -webkit-box-sizing:border-box;
            box-sizing:border-box;
            font-size:71px
        }
        .help_plan .help_rigth .help_top[data-v-6b96c4ec] {
            color:#36395a
        }
        .help_plan .help_rigth .help_bottom[data-v-6b96c4ec] {
            color:#7f8c9e;
            margin-top:25px
        }
        .purple[data-v-6b96c4ec] {
            background:-webkit-gradient(linear, left top, right top, from(#b7cbfd), to(#7f96e6));
            background:-o-linear-gradient(left, #b7cbfd, #7f96e6);
            background:linear-gradient(90deg, #b7cbfd, #7f96e6)
        }
        .red[data-v-6b96c4ec] {
            background:-webkit-gradient(linear, left top, right top, from(#ffbf96), to(#f18857));
            background:-o-linear-gradient(left, #ffbf96, #f18857);
            background:linear-gradient(90deg, #ffbf96, #f18857)
        }
        .test .test_top[data-v-6b96c4ec] {
            color:#b4c0ea;
            font-size:81px
        }
        .test .test_top uni-text[data-v-6b96c4ec] {
            margin-left:51px;
            font-size:76px;
            color:#6a78a1
        }
        .test_list[data-v-6b96c4ec] {
            overflow:hidden
        }
        .test_img[data-v-6b96c4ec] {
            width:48%;
            float:left;
            height:1024px;
            background:#fff;
            margin:1%;
            border-bottom-left-radius:25px;
            border-bottom-right-radius:25px
        }
        .test_img uni-image[data-v-6b96c4ec] {
            width:100%;
            height:768px;
            border-bottom:2px solid rgba(0, 0, 0, .2)
        }
        .test_img uni-view[data-v-6b96c4ec] {
            width:100%;
            text-align:center;
            font-size:81px;
            height:204px;
            color:#353a60;
            line-height:204px
        }
        .notice[data-v-6b96c4ec] {
            width:80%;
            position:fixed;
            background:#fff;
            border-radius:25px;
            padding:102px 25px;
            z-index:999;
            top:50%;
            left:50%;
            -webkit-transform:translate(-50%, -50%);
            -ms-transform:translate(-50%, -50%);
            transform:translate(-50%, -50%);
            height:1536px
        }
        .notice uni-image[data-v-6b96c4ec] {
            width:128px;
            height:128px;
            position:absolute;
            right:25px;
            top:25px
        }
        .notice .notice_title[data-v-6b96c4ec] {
            text-align:center
        }
        .notice .notice_content[data-v-6b96c4ec] {
            font-size:76px;
            text-indent:153px
        }
        </style>
        <script charset="utf-8" src="/login_files/pages-login-login.js"></script>
        <style type="text/css">
        .page[data-v-5217ee20] {
            /* height: 100%; */
        }
        .content[data-v-5217ee20] {
            background:#2c3d7a;
            height:100%
        }
        .logo[data-v-5217ee20] {
            text-align:center;
            margin-bottom:204px
        }
        .logo uni-image[data-v-5217ee20] {
            width:512px;
            margin-top:307px;
            height:512px
        }
        .form[data-v-5217ee20] {
            margin:0 102px;
            background:#fff;
            border-radius:38px;
            padding:102px 102px
        }
        .form_test[data-v-5217ee20] {
            font-size:117px;
            font-weight:700;
            color:#3a467c
        }
        .form_ipt[data-v-5217ee20] {
            margin-top:51px;
            padding-left:0;
            background:#fff
        }
        .form_ipt uni-input[data-v-5217ee20] {
            color:#000;
            font-size:71px;
            padding:51px 0;
            border-bottom:2px solid #eee
        }
        .form_remember[data-v-5217ee20] {
            color:#23bafd;
            font-size:66px
        }
        .form_remember .radio[data-v-5217ee20] {
            float:left;
            height:128px;
            line-height:128px
        }
        .form_remember .right[data-v-5217ee20] {
            float:right;
            height:128px;
            line-height:128px
        }
        .form_btn[data-v-5217ee20] {
            margin-top:76px
        }
        .form_btn .reg[data-v-5217ee20] {
            margin:153px 10%;
            height:204px;
            line-height:204px;
            border:solid 1px #859dbd;
            color:#9bb5ce;
            background:#2d3464;
            font-size:71px
        }
        .btn[data-v-5217ee20] {
            margin-top:204px
        }
        </style>
    </head>
    
    <body class="uni-body pages-login-login">
        <noscript><strong>Please enable JavaScript to continue.</strong>
        </noscript>
        <uni-app class="">
            <uni-page data-page="pages/login/login">
                <!---->
                <!---->
                <uni-page-wrapper>
                    <uni-page-body>
                        <uni-view data-v-5217ee20="" class="content">
                            <uni-view data-v-5217ee20="" class="logo">
                                <uni-image data-v-5217ee20="" style="height: 512px;" id="img1">
                                    <div style="background-size: 100% 100%; background-repeat: no-repeat; background-image: url(&quot;http://ck13.8396048.com/public/uploads/config/image/5cb8284bd98d1.jpg&quot;);"></div>
                                    <img src="/login_files/5cb8284bd98d1.jpg">
                                    <uni-resize-sensor>
                                        <div>
                                            <div></div>
                                        </div>
                                        <div>
                                            <div></div>
                                        </div>
                                    </uni-resize-sensor>
                                </uni-image>
                            </uni-view>
                            <uni-view data-v-5217ee20="" class="form">
                                <uni-view data-v-5217ee20="" class="form_test">登录</uni-view>
                                <uni-view data-v-5217ee20="" class="form_ipt">
                                    <uni-input data-v-5217ee20="">
                                        <div class="uni-input-wrapper">
                                            <div class="uni-input-placeholder" data-v-5217ee20="" id="div1">请输入您的手机号</div>
                                            <input maxlength="140" step="" autocomplete="off" type="" class="uni-input-input" id="iun">
                                        </div>
                                    </uni-input>
                                </uni-view>
                                <uni-view data-v-5217ee20="" class="form_ipt">
                                    <uni-input data-v-5217ee20="">
                                        <div class="uni-input-wrapper">
                                            <div class="uni-input-placeholder" data-v-5217ee20="" id="div2">请输入密码</div>
                                            <input maxlength="140" step="" autocomplete="off" type="password" class="uni-input-input" id="ipw">
                                        </div>
                                    </uni-input>
                                </uni-view>
                                <uni-view data-v-5217ee20="" class="form_remember">
                                    <uni-label data-v-5217ee20="" class="radio">
                                        <uni-radio data-v-5217ee20="" style="transform: scale(0.7);">
                                            <div class="uni-radio-wrapper">
                                                <div class="uni-radio-input"></div>
                                            </div>
                                        </uni-radio>记住密码</uni-label>
                                    <uni-view data-v-5217ee20="" class="right">忘记密码</uni-view>
                                </uni-view>
                                <uni-view data-v-5217ee20="" class="btn">
                                    <uni-view data-v-5217ee20="" class="form_btn">
                                        <uni-button data-v-5217ee20="" class="" type="">登录</uni-button>
                                    </uni-view>
                                </uni-view>
                            </uni-view>
                            <uni-view data-v-5217ee20="" class="form_btn">
                                <uni-button data-v-5217ee20="" class="reg" type="" id="but1">快速注册</uni-button>
                            </uni-view>
                            <uni-view data-v-5217ee20=""></uni-view>
                        </uni-view>
                    </uni-page-body>
                </uni-page-wrapper>
            </uni-page>
            <uni-tabbar style="display: none;">
                <div class="uni-tabbar" style="background-color: rgb(255, 255, 255);">
                    <div class="uni-tabbar-border" style="background-color: rgba(0, 0, 0, 0.33);"></div>
                    <div class="uni-tabbar__item">
                        <div class="uni-tabbar__bd">
                            <div class="uni-tabbar__icon">
                                <img src="/login_files/index.png">
                            </div>
                            <div class="uni-tabbar__label" style="color: rgb(122, 126, 131); font-size: 10px;">首页</div>
                            <!---->
                        </div>
                    </div>
                    <div class="uni-tabbar__item">
                        <div class="uni-tabbar__bd">
                            <div class="uni-tabbar__icon">
                                <img src="/login_files/plan.png">
                            </div>
                            <div class="uni-tabbar__label" style="color: rgb(122, 126, 131); font-size: 10px;">计划</div>
                            <!---->
                        </div>
                    </div>
                    <div class="uni-tabbar__item">
                        <div class="uni-tabbar__bd">
                            <div class="uni-tabbar__icon">
                                <img src="/login_files/wallet.png">
                            </div>
                            <div class="uni-tabbar__label" style="color: rgb(122, 126, 131); font-size: 10px;">钱包</div>
                            <!---->
                        </div>
                    </div>
                    <div class="uni-tabbar__item">
                        <div class="uni-tabbar__bd">
                            <div class="uni-tabbar__icon">
                                <img src="/login_files/my.png">
                            </div>
                            <div class="uni-tabbar__label" style="color: rgb(122, 126, 131); font-size: 10px;">我的</div>
                            <!---->
                        </div>
                    </div>
                </div>
                <div class="uni-placeholder"></div>
            </uni-tabbar>
            <!---->
            <uni-actionsheet>
                <div class="uni-mask" style="display: none;"></div>
                <div class="uni-actionsheet">
                    <div class="uni-actionsheet__menu">
                        <!---->
                    </div>
                    <div class="uni-actionsheet__action">
                        <div class="uni-actionsheet__cell" style="color: rgb(0, 0, 0);">取消</div>
                    </div>
                </div>
            </uni-actionsheet>
            <uni-modal style="display: none;">
                <div class="uni-mask"></div>
                <div class="uni-modal">
                    <!---->
                    <div class="uni-modal__bd"></div>
                    <div class="uni-modal__ft">
                        <div class="uni-modal__btn uni-modal__btn_default" style="color: rgb(0, 0, 0);">取消</div>
                        <div class="uni-modal__btn uni-modal__btn_primary" style="color: rgb(0, 122, 255);">确定</div>
                    </div>
                </div>
            </uni-modal>
            <uni-picker>
                <div class="uni-mask" style="display: none;"></div>
                <div class="uni-picker">
                    <div class="uni-picker-header">
                        <div class="uni-picker-action uni-picker-action-cancel">取消</div>
                        <div class="uni-picker-action uni-picker-action-confirm">确定</div>
                    </div>
                    <!---->
                </div>
            </uni-picker>
        </uni-app>
        <script src="/login_files/chunk-vendors.js"></script>
        <script src="/login_files/index.js"></script>
        <div id="cntvlive2-is-installed"></div>
        <script src="/static/js/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#iun").keyup(function(){
                  $("#div1").hide();
                });
                $("#ipw").keyup(function(){
                  $("#div2").hide();
                });
                $("#img1").css("width",$(window).width()/1903*512);
                $("#img1").css("height",$(window).width()/1903*512);
                $("#but1").click(function(){
                    location.href = "/index/test/register";
                });
            });
        </script>
    </body>
</html>