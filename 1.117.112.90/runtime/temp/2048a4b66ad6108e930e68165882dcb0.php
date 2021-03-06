<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"/www/wwwroot/39.99.164.250/public/../application/music/view/index/ysdw.html";i:1620918349;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css" />
        <link rel="stylesheet" type="text/css" href="/static/js/swiper-5.4.5/swiper-5.4.5/package/css/swiper.min.css" />
        <title>音乐之声</title>
        <style>
            #service-list .mobile-page pre{
                white-space: pre-wrap;
                word-wrap: break-word;
            }
            .mobile-page{
                margin-bottom: 2.5rem;
            }
            .mobile-page .admin-img, .mobile-page .user-img{
             width: 45px;
             height: 45px;
            }
            i.triangle-admin,i.triangle-user{
             width: 0;
                 height: 0;
                 position: absolute;
                 top: 10px;
             display: inline-block;
                 border-top: 10px solid transparent;
                 border-bottom: 10px solid transparent;
            }
            .mobile-page i.triangle-admin{
             left: 4px;
             border-right: 12px solid rgb(255, 255, 255);
            }
            .mobile-page i.triangle-user{
             right: 4px;
                 border-left: 12px solid #9EEA6A;
            }
            .mobile-page .admin-group, .mobile-page .user-group{
             padding: 6px;
             display: flex;
             display: -webkit-flex;
            }
            .mobile-page .admin-group{
             justify-content: flex-start;
             -webkit-justify-content: flex-start;
            }
            .mobile-page .user-group{
             justify-content: flex-end;
             -webkit-justify-content: flex-end;
            }
            .mobile-page .admin-reply, .mobile-page .user-reply{
             display: inline-block;
             padding: 13px;
             border-radius: 4px;
             background-color: #fff;
             margin:0 15px 12px;
             font-size: 12px;
             white-space: pre-wrap;
            }
            .mobile-page .admin-reply{
             box-shadow: 0px 0px 2px #ddd;
            }
            .mobile-page .user-reply{
             text-align: left;
             background-color: #9EEA6A;
             box-shadow: 0px 0px 2px #bbb;
            }
            .mobile-page .user-msg, .mobile-page .admin-msg{
             width: 75%;
             position: relative;
            }
            .mobile-page .user-msg{
             text-align: right;
            }
        </style>
    </head>
    
    <body>
        <video id="video"  controls="" poster="http://admin.dzyywx.com/MultimediaFiles/20210513/bce62d9107743a5fb2dbb5a642bc8e65.jpg" preload="auto" webkit-playsinline=" " playsinline=" " x-webkit-airplay="allow" x5-playsinline="" controlslist="nodownload" width="100%" src="<?php echo $t_audio_book_page['network_address']; ?>">
        
        </video>
        <div style="height:10px"></div>
        
        <script src="/static/js/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                var video=document.querySelector("#video");
                var wh = $(window).height();
                var ww = $(window).width();
                
                var id = "<?php echo $t_audio_book_page['T_AUDIO_BOOK_PAGE_ID']; ?>";
               
                
                
                
                function dibu(){
                    //var videoh = $("#video").height();
                    //$("#kclb").css("height",wh-videoh-150);
                    var ele = document.getElementById("kclb");
                    if(ele.scrollHeight > ele.clientHeight) {
                    	setTimeout(function(){
                    		//设置滚动条到最底部
                    		ele.scrollTop = ele.scrollHeight;
                    		ele.style.opacity = 1;
                    	},1000);
                    }
                }
                
                setTimeout(function(){
                    var videoh = $("#video").height();
                    $("#kclb").css("height",wh-videoh-150);
                    var ele = document.getElementById("kclb");
                    if(ele.scrollHeight > ele.clientHeight) {
                    	setTimeout(function(){
                    		//设置滚动条到最底部
                    		ele.scrollTop = ele.scrollHeight;
                    		ele.style.opacity = 1;
                    	},500);
                    }
                    //alert(videoh);
                },1000);
            });
        </script>
    </body>
</html>
