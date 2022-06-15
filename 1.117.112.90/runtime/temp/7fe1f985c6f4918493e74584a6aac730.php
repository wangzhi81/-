<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"/www/wwwroot/39.99.164.250/public/../application/music/view/shop/gmzy.html";i:1603674447;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css" />
        <link rel="stylesheet" type="text/css" href="/static/js/swiper-5.4.5/swiper-5.4.5/package/css/swiper.min.css" />
        <title>购买资源</title>
    </head>
    
    <body>
        <div style="background-color:#f2f3f7;padding:10px"><img src="/static/img/ico/fanhui.png" style="height:20px" id="fanhui"></div>
        
        <div style="margin-right:10px;margin-left:10px;border-top-width: 1px;border-top-style: solid;border-color:#cdcdcd;margin-bottom: 10px;"></div>
        <table width="100%">
            <tr>
                <td style="width:10px"></td>
                <td width="30%" valign="top">
                    <img src="<?php echo $download_resources['resource_image']; ?>" class="img-responsive">
                </td>
                <td style="width:10px"></td>
                <td valign="top">
                    <div><?php echo $download_resources['resource_name']; ?></div>
                    
                    <div style="height:10px"></div>
                    <div>￥<?php echo $download_resources['resource_price']; ?></div>
                </td>
            </tr>
        </table>
        <div style="height:30px"></div>
        <table width="100%" style="display:none">
            <tr>
                <td style="width:10px"></td>
                <td>商品数量</td>
                <td align="right" style="width:100px">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button" id="jian">-</button>
                      </span>
                      <input type="text" class="form-control" placeholder="" value="1" readonly id="shuliang">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button" id="jia">+</button>
                      </span>
                    </div>
                </td>
                <td style="width:10px"></td>
            </tr>
        </table>
        <div style="height:20px"></div>
        <table width="100%">
            <tr>
                <td align="right">
                    
                </td>
                <td style="width:10px"></td>
            </tr>
        </table>
        <div style="height:20px"></div>
        <div style="height:10px;background-color:#eee"></div>
        <div style="height:20px"></div>
        <table width="100%">
            <tr>
                <td style="width:10px"></td>
                <td style="width:100px;font-size:20px">平台支付</td>
                <td>
                    
                </td>
                <td style="width:10px"></td>
            </tr>
        </table>
        <hr>
        <table width="100%">
            <tr>
                <td style="width:10px"></td>
                <td style="width:100px">
                    <img src="/static/img/ico/weixin.png" width="30px">
                </td>
                <td align="right">
                    <img src="/static/img/ico/xuanzhong.png" width="30px">
                </td>
                <td style="width:10px"></td>
            </tr>
        </table>
        <div style="height:20px"></div>
        <div style="height:10px;background-color:#eee"></div>
        <div style="height:20px"></div>
        <div style="position:absolute;left:0px;height:50px;background-color:#fff;padding:5px" id="dibu">
              <table width="100%">
                  <tr>
                      <td align="right" style="color:#EF7C38">
                          ￥<span id="heji"><?php echo $download_resources['resource_price']; ?></span>
                      </td>
                      <td style="width:10px"></td>
                      <td style="width:100px;background-color:#EF7C38;color:#fff;height:40px" align="center" id="tjdd">
                          <span>提交订单</span>
                      </td>
                      <td style="width:20px"></td>
                  </tr>
              </table>
          </div>
        <script src="/static/js/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                var wh = $(window).height();
                var ww = $(window).width();
                $("#dibu").css("width",ww);
                $("#dibu").css("top",wh-50);
                
                $("#tjdd").click(function(){
                    $.post("/music/shop/getzfurl",{
                        price:$("#heji").text(),
                        commodity_id:'<?php echo $download_resources['DOWNLOAD_RESOURCES_ID']; ?>'
                    },function(res){
                        //window.open(res,"_blank");  
                        location.href = res;
                    });
                });
                
                $("#shuliang").val(1);
                $("#fanhui").click(function(){
                    location.href = "/music/shop/zylb";
                });
                $("#jian").click(function(){
                    var sl = $("#shuliang").val();
                    if(sl>1){
                        sl--;
                        $("#shuliang").val(sl);
                        $("#gongji").text(sl);
                        var hj = sl*<?php echo $download_resources['resource_price']; ?>;
                        $("#xiaoji").text(hj);
                        $("#heji").text(hj);
                    }
                });
                $("#jia").click(function(){
                    var sl = $("#shuliang").val();
                    sl++;
                    $("#shuliang").val(sl);
                    $("#gongji").text(sl);
                    var hj = sl*<?php echo $download_resources['resource_price']; ?>;
                    $("#xiaoji").text(hj);
                    $("#heji").text(hj);
                });
            });
        </script>
    </body>
</html>