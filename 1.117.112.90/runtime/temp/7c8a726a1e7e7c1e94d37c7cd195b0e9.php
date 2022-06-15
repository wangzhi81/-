<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"/www/wwwroot/erp.wangzhi81.com/public/../application/index/view/customer/edit.html";i:1549858845;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css" />
        <title>修改客户信息</title>
    </head>
    
    <body>
        <div style="padding:10px;">
            修改客户信息
        </div>
        <div style="height:1px;background-color:#ddd;"></div>
        <div style="padding:10px;">
            <div style="padding:5px">客户姓名：</div>
            <div><input type="text" class="form-control" id="full_name" placeholder="请输入客户姓名" value="<?php echo $CustomerManagement['full_name']; ?>"></div>
            <div style="padding:5px">手机号码：</div>
            <div><input type="text" class="form-control" id="mobile_phone" placeholder="请输入手机号码" value="<?php echo $CustomerManagement['mobile_phone']; ?>"></div>
            <div style="padding:5px">发货地址：</div>
            <div><input type="text" class="form-control" id="shipping_address" placeholder="请输入发货地址" value="<?php echo $CustomerManagement['shipping_address']; ?>"></div>
            <div style="padding:5px">客户照片：</div>
            <div>
                <div style="border:1px solid #ddd;width:100px">
                    <table style="width:100%">
                        <tr><td valign="middle" align="center" style="height:100px" id="djsc">
                            <img src="<?php echo $CustomerManagement['photo']; ?>" class="img-responsive" id="photo">
                        </td></tr>
                    </table>
                </div>
            </div>
            <div style="display:none">
                <input type="file" id="sptp" accept="image/*">
                <input type="hidden" id="CUSTOMER_MANAGEMENT_ID" value="<?php echo $CustomerManagement['CUSTOMER_MANAGEMENT_ID']; ?>">
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
                                                $("#djsc").html('<img src="'+res+'" class="img-responsive" id="photo">');
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
                    var full_name = $("#full_name").val().trim();
                    var mobile_phone = $("#mobile_phone").val().trim();
                    var shipping_address = $("#shipping_address").val().trim();
                    var photo = $("#photo").attr("src");
                    if(full_name===''){
                        alert("请输入客户姓名");
                        return false;
                    }
                    if(typeof(photo)=="undefined") {
                        photo = '';
                    }
                    //shadow.show();
                    $.post("/index/Customer/update",{
                        full_name:full_name,
                        mobile_phone:mobile_phone,
                        shipping_address:shipping_address,
                        photo:photo,
                        CUSTOMER_MANAGEMENT_ID:$("#CUSTOMER_MANAGEMENT_ID").val()
                    },function(res){
                        if(res.info==='ok'){
                            location.href = "/index/Customer";
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
                            $("#djsc").html('<img src="'+data+'" class="img-responsive" id="photo">');
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