<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"/www/wwwroot/39.99.164.250/public/../application/music/view/shop/test3.html";i:1602300696;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
    </head>
    
    <body>
        
        <img src="http://admin.dzyywx.com/MultimediaFiles/20200929/4b54fef9131eba0cd7bcd8c817dbf63e.jpg">
          <script src="/static/js/jquery.min.js"></script>
          <script src="http://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
          <script>
            $(document).ready(function() {
                $.post("/comm/weixin/getJsSign",{
                    url:window.location.href
                },function(res){
                    wx.config(res);
                    wx.ready(function(){
                        wx.onMenuShareTimeline({
                            title: '音乐之声', // 分享标题
                            link: window.location.href, // 分享链接,将当前登录用户转为puid,以便于发展下线
                            imgUrl: 'http://admin.dzyywx.com/MultimediaFiles/20200929/4b54fef9131eba0cd7bcd8c817dbf63e.jpg', // 分享图标
                            success: function () { 
                                // 用户确认分享后执行的回调函数
                                //以下代码放入success内，
                                setTimeout(function(){
                                   //回调要执行的代码
                                }, 500);
                            },
                            cancel: function () { 
                                // 用户取消分享后执行的回调函数
                            }
                        });
                        wx.updateTimelineShareData({ 
                            title: '音乐之声', // 分享标题
                            link: window.location.href, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                            imgUrl: 'http://admin.dzyywx.com/MultimediaFiles/20200929/a24f3000f5fbc0a426e858328845da91.jpg', // 分享图标
                            success: function () {
                              // 设置成功
                            }
                        });
                    });
                });
            });
          </script>
    </body>
</html>
