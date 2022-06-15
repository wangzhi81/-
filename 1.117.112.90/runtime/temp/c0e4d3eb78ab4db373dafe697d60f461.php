<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"/www/wwwroot/39.99.164.250/public/../application/music/view/shop/goumai.html";i:1600331637;}*/ ?>
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
        <title>购买商品</title>
    </head>
    
    <body>
        <div style="background-color:#f2f3f7;padding:10px"><img src="/static/img/ico/fanhui.png" style="height:20px" id="fanhui"></div>
        <table width="100%">
            <tr>
                <td style="width:30px;padding:10px">
                    <img src="/static/img/ico/dingwei.png" style="width:25px">
                </td>
                <td style="padding:10px;color:#cdcdcd" id="ghdz">
                    请选择购货地址
                </td>
                <td align="right" style="padding:10px" id="xzgwdz">
                    <img src="/static/img/ico/right.png" style="width:20px">
                </td>
            </tr>
        </table>
        <div style="height:5px;background-color:#ddd"></div>
        <table width="100%">
            <tr>
                <td style="width:30px;padding:10px">
                    <img src="/static/img/ico/gouwu.png" style="width:25px">
                </td>
                <td style="padding:10px;color:#cdcdcd">
                    购物清单
                </td>
                <td align="right" style="padding:10px">
                    
                </td>
            </tr>
        </table>
        <div style="margin-right:10px;margin-left:10px;border-top-width: 1px;border-top-style: solid;border-color:#cdcdcd;margin-bottom: 10px;"></div>
        <table width="100%">
            <tr>
                <td style="width:10px"></td>
                <td width="30%" valign="top">
                    <img src="<?php echo $commodity_information['product_picture']; ?>" class="img-responsive">
                </td>
                <td style="width:10px"></td>
                <td valign="top">
                    <div><?php echo $commodity_information['trade_name']; ?></div>
                    <div style="height:10px"></div>
                    <div style="color:#ddd">规格：<?php echo $commodity_information['commodity_specifications']; ?></div>
                    <div style="height:10px"></div>
                    <div>￥<?php echo $commodity_information['commodity_price']; ?><span style="margin-left:10px;text-decoration:line-through;color:#cdcdcd">￥<?php echo $commodity_information['original_price_of_goods']; ?></span></div>
                    <div style="height:10px"></div>
                    <div><span style="color:#000">会员<?php echo $commodity_information['member_discount']; ?>折</span></div>
                </td>
            </tr>
        </table>
        <div style="height:30px"></div>
        <table width="100%">
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
                    共计<span id="gongji">1</span>件<span style="margin-left:10px;color:#EF7C38">小计：￥<span id="xiaoji" style="font-size:20px"><?php echo $commodity_information['commodity_price']; ?></span></span>
                    
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
                <td style="width:100px">买家留言：</td>
                <td>
                    <input type="text" style="border-width:0px;width:100%" id="buyer_message">
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
                <td style="width:100px">运费：</td>
                <td>
                    ￥<span id="freight_amount"><?php echo $commodity_information['freight']; ?></span>
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
                          ￥<span id="heji" style="font-size:22px"><?php echo $commodity_information['original_price_of_goods']; ?></span>
                          
                      </td>
                      <td style="width:10px"></td>
                      <td style="width:100px;background-color:#EF7C38;color:#fff;height:40px" align="center" id="djdd">
                          <span>提交订单</span>
                      </td>
                      <td style="width:20px"></td>
                  </tr>
              </table>
          </div>
        <script src="/static/js/jquery.min.js"></script>
        <script>
            var consignee;
            var contact_number;
            var zk = <?php echo $user_list['zk']; ?>;
            $(document).ready(function() {
                
                var wh = $(window).height();
                var ww = $(window).width();
                $("#dibu").css("width",ww);
                $("#dibu").css("top",wh-50);
                var hj = <?php echo $commodity_information['commodity_price']; ?>*zk+<?php echo $commodity_information['freight']; ?>;
                hj = hj.toFixed(2); 
                $("#heji").text(hj);
                var xiaoji = <?php echo $commodity_information['commodity_price']; ?>*zk;
                xiaoji = xiaoji.toFixed(2); 
                $("#xiaoji").text(xiaoji);
                $("#djdd").click(function(){
                    if($("#ghdz").text().trim()==='请选择购货地址'){
                        alert("请选择购货地址！");
                        return false;
                    }
                    //alert(contact_number);
                    $.post("/music/shop/djdd",{
                        commodity_id:"<?php echo $commodity_information['COMMODITY_INFORMATION_ID']; ?>",
                        shipping_address:$("#ghdz").text(),
                        buyer_message:$("#buyer_message").val(),
                        quantity_of_goods:$("#gongji").text(),
                        commodity_amount:$("#xiaoji").text(),
                        freight_amount:$("#freight_amount").text(),
                        consignee:consignee,
                        contact_number:contact_number
                    },function(res){
                        window.open(res,"_blank");  
                    });
                });
                
                var SHIPPING_ADDRESS_ID = "<?php echo $SHIPPING_ADDRESS_ID; ?>";
                if(SHIPPING_ADDRESS_ID!==''){
                    $.post("/music/shop/getdz/id/"+SHIPPING_ADDRESS_ID,{},function(res){
                        $("#ghdz").text(res.location+res.detailed_address);
                        consignee = res.addressee;
                        contact_number = res.contact_number;
                        //alert(contact_number);
                    })
                }
                
                $("#xzgwdz").click(function(){
                    location.href = "/music/shop/dzbj/id/<?php echo $commodity_information['COMMODITY_INFORMATION_ID']; ?>";
                });
                $("#shuliang").val(1);
                $("#fanhui").click(function(){
                    location.href = "/music/shop";
                });
                $("#jian").click(function(){
                    var sl = $("#shuliang").val();
                    if(sl>1){
                        sl--;
                        $("#shuliang").val(sl);
                        $("#gongji").text(sl);
                        var hj = sl*<?php echo $commodity_information['commodity_price']; ?>*zk+<?php echo $commodity_information['freight']; ?>;
                        hj = hj.toFixed(2); 
                        var xiaoji = sl*<?php echo $commodity_information['commodity_price']; ?>*zk;
                        xiaoji = xiaoji.toFixed(2); 
                        $("#xiaoji").text(xiaoji);
                        $("#heji").text(hj);
                    }
                });
                $("#jia").click(function(){
                    var sl = $("#shuliang").val();
                    sl++;
                    $("#shuliang").val(sl);
                    $("#gongji").text(sl);
                    var hj = sl*<?php echo $commodity_information['commodity_price']; ?>*zk+<?php echo $commodity_information['freight']; ?>;
                    hj = hj.toFixed(2); 
                    var xiaoji = sl*<?php echo $commodity_information['commodity_price']; ?>*zk;
                    xiaoji = xiaoji.toFixed(2); 
                    $("#xiaoji").text(xiaoji);
                    $("#heji").text(hj);
                });
            });
        </script>
    </body>
</html>