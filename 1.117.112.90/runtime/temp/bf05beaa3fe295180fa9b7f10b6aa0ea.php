<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"/www/wwwroot/erp.wangzhi81.com/public/../application/index/view/erp/index.html";i:1552307526;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css" />
        <title>批零企业微库存管理</title>
    </head>
    
    <body>
        <div>
            <img src="/static/img/ico/jwblogo2.png" class="img-responsive">
        </div>
        <div style="height:1px;background-color:#aaa;"></div>
        <div style="height:20px"></div>
        <div>
            <table width="100%">
                <tr><td style="height:10px"></td></tr>
                <tr>
                    <td></td>
                    <td style="width:30%" align="center">
                        <div><img src="/static/img/ico/jizhuang.png" class="img-responsive" style="width:50px" id="jizhuang"></div>
                        <div>出(返)货记账</div>
                    </td>
                    <td style="width:30%" align="center">
                        <div><img src="/static/img/ico/shangpin.png" class="img-responsive" style="width:50px" id="shangpin"></div>
                        <div>商品管理</div>
                    </td>
                    <td style="width:30%" align="center">
                        <div><img src="/static/img/ico/kehu.png" class="img-responsive" style="width:50px" id="kehuguanli"></div>
                        <div>客户管理</div>
                    </td>
                    <td></td>
                </tr>
                <tr><td style="height:20px"></td></tr>
                <tr>
                    <td></td>
                    <td style="width:30%" align="center"></td>
                    <td style="width:30%" align="center">
                        <div style="display:none">
                            <div><img src="/static/img/ico/logout.png" class="img-responsive" style="width:50px" id="logout"></div>
                            <div>退出登录</div>
                        </div>
                    </td>
                    <td style="width:30%" align="center">
                        <div><img src="/static/img/ico/key.png" class="img-responsive" style="width:50px" id="ModifyPassword"></div>
                        <div>修改密码</div>
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div id="info"></div>
        <script type="text/javascript" src="/static/js/jquery.min.js"></script>
        <script type="text/javascript" src="/static/js/jquery.cookie.js"></script>
        <script type="text/javascript">
            
            function isWeiXin() { 
                var ua = window.navigator.userAgent.toLowerCase(); 
                if (ua.match(/MicroMessenger/i) == 'micromessenger') { 
                    return true; 
                } else { 
                    return false; 
                } 
            }
        
            $(document).ready(function(){
                if(isWeiXin()){
                    $.ajax({         
                    　　type: 'POST',         
                    　　url: '/index/erp/getOpenid',         
                    　　data: {},         
                    　　dataType: 'json',        
                    　　success: function (res) { 
                    　　      $.cookie('LogInfo', res, { expires: 365 , path: '/'}); 
                            //$("#info").text(document.cookie);
                    　　},
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            location.href = "/index/erp/guanzhu";
                            //alert(XMLHttpRequest);
                     　 }     
                    });
                }else{
                    var LogInfo = $.cookie().LogInfo;
                    if(typeof(LogInfo)=="undefined") {
                        location.href = "/index/erp/login";
                    }
                    if(LogInfo==="") {
                        location.href = "/index/erp/login";
                    }
                    $.post("/index/erp/islogin",{
                        LogInfo:LogInfo
                    },function(res){
                        //console.log(res);
                        if(res.info!=='ok'){
                            $("#logout").click();
                        }
                    },'json');
                    //$("#info").text(LogInfo);
                }
                //$("#info").text(document.cookie);
                
                $("#logout").click(function(){
                    $.cookie('LogInfo', "", { expires: 365 , path: '/'}); 
                    //alert(document.cookie);
                    location.href = "/index/erp/login";
                });
                $("#ModifyPassword").click(function(){
                    location.href = "/index/erp/ModifyPassword";
                });
                
                $("#shangpin").click(function(){
                    location.href = "/index/Commodity";
                });
                
                $("#kehuguanli").click(function(){
                    location.href = "/index/Customer";
                });
                
                $("#jizhuang").click(function(){
                    location.href = "/index/ShippingAccount";
                });
                
                //$.cookie('the_cookie', 'the_value', { expires: 365 });
                /*console.log($.cookie().userInfo);
                $.cookie("userInfo", "", { expires: 365 , path: '/'});
                console.log($.cookie().userInfo2);
                console.log($.cookie());
                console.log($.cookie("userInfo"));
                console.log(document.cookie);*/
            });
        </script>
    </body>
</html>
