<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:93:"/www/wwwroot/erp.wangzhi81.com/public/../application/index/view/shippingaccount/shipment.html";i:1552307460;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css" />
        <title>出货记账</title>
    </head>
    
    <body>
        <div style="padding:10px">
            <table width="100%">
                <tr>
                    <td>
                        <a href="/index/Shippingaccount" id="fanhui">
                            <img src="/static/img/ico/fanhui.png" style="width:10px">
                            返回
                        </a>
                    </td>
                    <td align="right">
                        <?php echo $ms; ?>记账
                    </td>
                </tr>
            </table>
        </div>
        <div style="height:1px;background-color:#ddd;"></div>
        <div style="padding:10px;">
            <div style="padding:5px"><?php echo $ms; ?>时间：</div>
            <div>
                <input id="shipping_time" class="form-control" type="date">
            </div>
            <div style="padding:5px">客户：</div>
            <div>
                <input id="customer" class="form-control" value="<?php echo $ShippingAccount['full_name']; ?>">
            </div>
            <div style="padding:5px">商品：</div>
            <div>
                <input id="commodity" class="form-control">
            </div>
            <div style="padding:5px">商品单价：</div>
            <div>
                <input id="unit_price" class="form-control" onkeyup="onlyNumber(this)">
            </div>
            
            <div style="padding:5px"><?php echo $ms; ?>数量：</div>
            <div><input type="text" class="form-control" id="quantity_shipped" placeholder="请输入出货数量" onkeyup="onlyNumber(this)"></div>
            <div style="padding:5px">商品总价：</div>
            <div>
                <span id="total_price"></span>
            </div>
            <div style="height:10px"></div>
            <div style="padding:10px">
                <button class="btn btn-primary btn-lg btn-block" type="button" id="queding">确定</button>
            </div>
        </div>
        <input type="hidden" id="ms" value="<?php echo $ms; ?>">
        <script type="text/javascript" src="/static/js/jquery.min.js"></script>
        <script type="text/javascript" src="/static/js/jquery.cookie.js"></script>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
        <script type="text/javascript">
        
            //计算商品总价
            function jszj(){
                var zj = $("#unit_price").val()*$("#quantity_shipped").val();
                $("#total_price").text(zj.toFixed(2));
            }
            
            //获取商品信息
            function getShangpin(){
                //alert($("#commodity_id").val());
                $.post("/index/ShippingAccount/getShangpin",{
                    id:$("#commodity").val()
                },function(res){
                    //alert(res);
                    $("#unit_price").val(res.unit_price);
                    jszj();
                });
            }
        
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
                
                $("#quantity_shipped").keyup(function(){
                    jszj();
                });
                
                $("#commodity").keyup(function(){
                    getShangpin();
                });
                
                //客户下拉框
                $.post("/index/ShippingAccount/getCustomerManagement",{},function(res){
                    var str = '';
                    $.each(res,function(i,v){
                        str += '<option value="'+v.CUSTOMER_MANAGEMENT_ID+'">'+v.full_name+'</option>';
                    });
                    $("#customer_id").html(str);
                });
                
                //商品下拉框
                $.post("/index/ShippingAccount/getCommodityManagement",{},function(res){
                    var str = '';
                    $.each(res,function(i,v){
                        str += '<option value="'+v.COMMODITY_MANAGEMENT_ID+'">'+v.trade_name+'</option>';
                    });
                    $("#commodity_id").html(str);
                    getShangpin();
                });
                
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
                    var commodity = $("#commodity").val().trim();
                    var customer = $("#customer").val().trim();
                    var quantity_shipped = $("#quantity_shipped").val().trim();
                    if(quantity_shipped===''){
                        alert("请输入出货数量");
                        return false;
                    }
                    var shipping_time = $("#shipping_time").val().trim();
                    //alert(shipping_time);
                    if(shipping_time===''){
                        alert("请输入出货日期");
                        return false;
                    }
                    //shadow.show();
                    //alert(commodity);
                    $.post("/index/Shippingaccount/save",{
                        commodity:commodity,
                        customer:customer,
                        quantity_shipped:quantity_shipped,
                        unit_price:$("#unit_price").val(),
                        total_price:$("#total_price").text(),
                        shipping_time:shipping_time,
                        ms:$("#ms").val()
                    },function(res){
                        //alert(res);
                        if(res.info==='ok'){
                            location.href = "/index/Shippingaccount";
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