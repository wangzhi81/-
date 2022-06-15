<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"/www/wwwroot/erp.wangzhi81.com/public/../application/index/view/commodity/add.html";i:1552096312;}*/ ?>
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
        <div style="padding:10px;">
            添加商品
        </div>
        <div style="height:1px;background-color:#ddd;"></div>
        <div style="padding:10px;">
            <div style="padding:5px">商品名称：</div>
            <div><input type="text" class="form-control" id="trade_name" placeholder="请输入商品名称"></div>
            <div style="padding:5px">商品单价：</div>
            <div><input type="text" class="form-control" id="unit_price" onkeyup="onlyNumber(this)" placeholder="请输入商品单价"></div>
            <div style="padding:5px">商品图片：</div>
            <div>
                <div style="border:1px solid #ddd;width:100px">
                    <table style="width:100%">
                        <tr><td valign="middle" align="center" style="height:100px" id="djsc">
                            点击上传
                        </td></tr>
                    </table>
                </div>
            </div>
            <div style="display:none">
                <input type="file" id="sptp" accept="image/*">
            </div>
            <div style="height:10px"></div>
            <div style="padding:10px">
                <button class="btn btn-primary btn-lg btn-block" type="button" id="queding">确定</button>
            </div>
        </div>
        <script type="text/javascript" src="/static/js/jquery.min.js"></script>
        <script type="text/javascript" src="/static/js/jquery.cookie.js"></script>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
        <script type="text/javascript">
            function onlyNumber(obj){                          
                //得到第一个字符是否为负号    
                var t = obj.value.charAt(0);      
                //先把非数字的都替换掉，除了数字和.     
                obj.value = obj.value.replace(/[^\d\.]/g,'');       
                 //必须保证第一个为数字而不是.       
                 obj.value = obj.value.replace(/^\./g,'');       
                 //保证只有出现一个.而没有多个.       
                 obj.value = obj.value.replace(/\.{2,}/g,'.');       
                 //保证.只出现一次，而不能出现两次以上       
                 obj.value = obj.value.replace('.','$#$').replace(/\./g,'').replace('$#$','.');  
                 obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3');  
                 //如果第一位是负号，则允许添加    
                 if(t == '-'){
                   return;  
                 }    
            }  
            $(document).ready(function(){
                wx.error(function(e){
                    alert(e);
                });
                $.post("/comm/weixin/getJsSign",{
                    url:window.location.href
                },function(res){
                    wx.config(res);
                    wx.ready(function(){
                        $("#djsc").click(function(){
                            wx.chooseImage({
                                count: 1, // 默认9
                                sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                                sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                                success: function (res) {
                                    shadow.show();
                                    var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                                    wx.uploadImage({
                                        localId: localIds[0], // 需要上传的图片的本地ID，由chooseImage接口获得
                                        isShowProgressTips: 1, // 默认为1，显示进度提示
                                        success: function (res) {
                                            var serverId = res.serverId; // 返回图片的服务器端ID
                                            //alert(serverId);
                                            $.post('http://erp.wangzhi81.com/index/Commodity/saveImg',{
                                                serverId:serverId
                                            },function(res){
                                                res = res.replace('.png','_150.png');
                                                $("#djsc").html('<img src="'+res+'" class="img-responsive" id="commodity_pictures">');
                                                shadow.hide();
                                            });
                                        }
                                    });
                                }
                            });
                        });
                    });
                });
                var shadow = $('<div class="modal-backdrop fade in" id="shadow">'
            		+'<div id="loading-center-absolute">'
            		+'	<div class="object" id="object_one"></div>'
            		+'	<div class="object" id="object_two"></div>'
            		+'	<div class="object" id="object_three"></div>'
            		+'	<div class="object" id="object_four"></div>'
            		+'	<div class="object" id="object_five"></div>'
            		+'	<div class="object" id="object_six"></div>'
            		+'	<div class="object" id="object_seven"></div>'
            		+'	<div class="object" id="object_eight"></div>'
            		+'</div>'
            	+'</div>').appendTo("body");
            	shadow.hide();
                $("#queding").click(function(){
                    var trade_name = $("#trade_name").val().trim();
                    var commodity_pictures = $("#commodity_pictures").attr("src");
                    if(trade_name===''){
                        alert("请输入商品名称");
                        return false;
                    }
                    if(typeof(commodity_pictures)=="undefined") {
                        alert("请上传图片");
                        return false;
                    }
                    $.post("/index/Commodity/save",{
                        trade_name:trade_name,
                        commodity_pictures:commodity_pictures,
                        unit_price:$("#unit_price").val()
                    },function(res){
                        if(res.info==='ok'){
                            location.href = "/index/Commodity";
                        }else{
                            alert(res.info);
                        }
                    },'json');
                    //console.log(commodity_pictures);
                    //if(commodity_pictures)
                });
                $("#djsc").click(function(){
                    //$("#sptp").click();
                });
                $("#sptp").change(function(){
                    var formData = new FormData();
                    formData.append("file",$("#sptp")[0].files[0]);
                    $.ajax({ 
                        url : '/admin/Deshanginformation/UploadMerchantPhotos', 
                        type : 'POST', 
                        data : formData, 
                        // 告诉jQuery不要去处理发送的数据
                        processData : false, 
                        // 告诉jQuery不要去设置Content-Type请求头
                        contentType : false,
                        beforeSend:function(){
                            //console.log("正在进行，请稍候");
                            shadow.show();
                        },
                        success : function(data, textStatus) { 
                            //console.log(data);
                            data = data.replace('.png','_150.png');
                            $("#djsc").html('<img src="'+data+'" class="img-responsive" id="commodity_pictures">');
                            shadow.hide();
                        }, 
                        error : function(responseStr) { 
                            shadow.hide();
                            //console.log("error");
                            //alert(responseStr);
                        } 
                    });
                });
            });
        </script>
    </body>
</html>