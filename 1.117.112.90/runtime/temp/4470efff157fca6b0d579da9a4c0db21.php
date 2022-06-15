<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"/www/wwwroot/39.99.164.250/public/../application/music/view/index/kecheng.html";i:1608553491;}*/ ?>
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
        <video id="video"  controls="" poster="<?php echo $course_information['course_pictures']; ?>" preload="auto" webkit-playsinline=" " playsinline=" " x-webkit-airplay="allow" x5-playsinline="" controlslist="nodownload" width="100%" src="<?php echo $course_information['course_video']; ?>">
        
        </video>
        <div style="height:10px"></div>
        <table width="100%">
            <tr>
                <td style="width:20px"></td>
                <td><?php echo $course_information['number_of_learners']; ?>人次</td>
                <td id="jishi"></td>
            </tr>
        </table>
        <div style="height:10px"></div>
        <div style="height:10px;background-color:rgb(223, 223, 223)"></div>
        <table width="100%" style="background-color:rgb(223, 223, 223)">
            <tr><td align="center">讨论区</td></tr>
        </table>
        <div style="height:10px;background-color:rgb(223, 223, 223)"></div>
        <div id="kclb" style="overflow: auto; background-color: rgb(223, 223, 223); margin-bottom: 0px;" class="mobile-page">
            
        </div>
        <div>
            <div style="height:5px;border-top-width: 1px;border-top-style: solid;border-color:#f2f2f2"></div>
            <div style="height:10px"></div>
            <table width="100%">
                <tr>
                    <td style="width:20px"></td>
                    <td><input type="text" class="form-control" placeholder="请输入文字" style="width:100%" id="what_to_say"></td>
                    <td style="width:10px"></td>
                    <td><button type="button" class="btn btn-success" id="fasong">发送</button></td>
                </tr>
            </table>
        </div>
        <script src="/static/js/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                var video=document.querySelector("#video");
                var wh = $(window).height();
                var ww = $(window).width();
                
                var id = "<?php echo $course_information['COURSE_INFORMATION_ID']; ?>";
                $("#fasong").click(function(){
                    $.post("/music/index/saveChat",{
                        course_id:id,
                        speaker_id:"<?php echo $openid; ?>",
                        what_to_say:$("#what_to_say").val()
                    },function(res){
                        $("#what_to_say").val('');
                        dibu();
                    });
                });
                
                function shuaxin(){
                    $.post("/music/index/getChat",{
                        course_id:id,
                        speaker_id:"<?php echo $openid; ?>"
                    },function(res){
                        //alert(res);
                        var strhtml = "";
                        $.each(res,function(i,v){
                            //alert(v.what_to_say);
                            if(v.speaker_id==="<?php echo $openid; ?>"){
                                strhtml+='<div class="admin-group"><img class="admin-img" src="/static/img/ico/user.png"/><div class="admin-msg"><i class="triangle-admin"></i><pre class="admin-reply">'+v.what_to_say+'</pre></div></div>';
                            }else{
                                strhtml+='<div class="user-group"><div class="user-msg"><pre class="user-reply">'+v.what_to_say+'</pre><i class="triangle-user"></i></div><img class="user-img" src="/static/img/ico/user.png"/></div>';
                            }
                        });
                        $("#kclb").html(strhtml);
                        //$("#jishi").text(video.currentTime);
                        if(video.currentTime>15){
                            //location.href="/music/index/gmck/id/"+id;
                        }
                        setTimeout(shuaxin,1000);
                    });
                }
                
                shuaxin();
                
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
