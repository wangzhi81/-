<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"/www/wwwroot/39.99.164.250/public/../application/music/view/shop/zyxz.html";i:1600769226;}*/ ?>
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
        <title></title>
    </head>
    
    <body>
        <div style="background-color:#f2f3f7;padding:10px"><img src="/static/img/ico/fanhui.png" style="height:20px" id="fanhui"></div>
        <div id="neirong" style="overflow: auto; margin-bottom: 0px;">
            <div class="swiper-container" id="lunbo">
            <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="<?php echo $download_resources['resource_image']; ?>" class="img-responsive"></div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Arrows -->
            <div class="swiper-button-next" style="display:none"></div>
            <div class="swiper-button-prev" style="display:none"></div>
          </div>
          <div style="height:10px"></div>
          <table>
              <tr>
                  <td style="width:20px"></td>
                  <td style="color:#EF7C38">￥<span style="font-size:25px;font-weight:bold"><?php echo $download_resources['resource_price']; ?></span></td>
                  <td style="width:10px"></td>
                  <td><span style="text-decoration:line-through;color:#cdcdcd"></span></td>
              </tr>
          </table>
          <table width="100%">
              <tr>
                  <td style="width:20px"></td>
                  <td style="font-size:20px"><?php echo $download_resources['resource_name']; ?></td>
                  <td align="right">大小：<?php echo $download_resources['resource_size']; ?></td>
                  <td style="width:20px"></td>
              </tr>
          </table>
          <div style="height:10px"></div>
          <div style="background-color:#eee;height:5px"></div>
          <div style="height:10px"></div>
          
        </div>
        
          <div style="position:absolute;left:0px;height:50px;background-color:#fff;padding:5px" id="dibu">
              <table width="100%">
                  <tr>
                      <td align="right" style="color:#EF7C38">
                          
                          
                      </td>
                      <td style="width:10px"></td>
                      <td style="width:100px;background-color:#EF7C38;color:#fff;height:40px" align="center" id="ljxz">
                          <span>立即下载</span>
                      </td>
                      <td style="width:20px"></td>
                  </tr>
              </table>
          </div>
        <script src="/static/js/jquery.min.js"></script>
        <script src="/static/js/swiper-5.4.5/swiper-5.4.5/package/js/swiper.min.js"></script>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
        <script>
            $(document).ready(function() {
                $.post("/comm/weixin/getJsSign",{
                    url:window.location.href
                },function(res){
                    wx.config(res);
                    wx.ready(function(){
                        wx.onMenuShareTimeline({
                            title: '<?php echo $download_resources['resource_name']; ?>', // 分享标题
                            link: window.location.href, // 分享链接,将当前登录用户转为puid,以便于发展下线
                            imgUrl: '<?php echo $download_resources['resource_image']; ?>', // 分享图标
                            success: function () { 
                                // 用户确认分享后执行的回调函数
                                
                            },
                            cancel: function () { 
                                // 用户取消分享后执行的回调函数
                            }
                        });
                        wx.updateTimelineShareData({ 
                            title: '<?php echo $download_resources['resource_name']; ?>', // 分享标题
                            link: window.location.href, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                            imgUrl: '<?php echo $download_resources['resource_image']; ?>', // 分享图标
                            success: function () {
                              // 设置成功
                            }
                        });
                    });
                });
                var wh = $(window).height();
                var ww = $(window).width();
                $("#neirong").css("height",wh-90);
                $("#dibu").css("width",ww);
                $("#dibu").css("top",wh-50);
                $("#ljgm").click(function(){
                    location.href = "/music/shop/goumai/id/<?php echo $download_resources['DOWNLOAD_RESOURCES_ID']; ?>";
                });
                $("#ljxz").click(function(){
                    location.href = "/music/shop/ljxz/id/<?php echo $download_resources['DOWNLOAD_RESOURCES_ID']; ?>";
                });
                $("#fanhui").click(function(){
                    location.href = "/music/shop/zylb";
                });
                var swiper = new Swiper('.swiper-container', {
                  spaceBetween: 30,
                  centeredSlides: true,
                  autoplay: false,
                  pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                  },
                  navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                  },
                });
            });
        </script>
    </body>
</html>
