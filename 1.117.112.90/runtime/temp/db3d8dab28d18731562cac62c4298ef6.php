<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"/www/wwwroot/39.99.164.250/public/../application/music/view/index/daka.html";i:1597044783;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css?v=0.5" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.4" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css?v=0.5" />
        <title></title>
        <style>
            .div1{border-radius:50%;background-color:#eee;padding:4px;font-size:9px;text-align:center;width:35px;height:35px;line-height:28px;color:#bbb;}
            .td1{padding:5px;text-align:center;}
            .div2{color:#bbb;font-size:9px;text-align:center;margin-right: 4px;margin-top: 5px;}
            .div3{border-radius:50%;background-color:#fff;padding:4px;font-size:9px;text-align:center;width:35px;height:35px;line-height:28px;color:#bbb;}
            .div4{color:#000;font-size:9px;text-align:center;margin-right: 4px;margin-top: 5px;}
            .div5{border-radius:50%;background-color:#F56C6C;padding:4px;font-size:12px;text-align:center;width:35px;height:35px;line-height:28px;color:#fff;}
        </style>
    </head>
    
    <body>
        <div style="background-color:#F56C6C">
            <div style="padding:10px;font-size:14px;color:#fff">
                <img src="/static/img/ico/jifen.png" style="width:20px">
                我的积分：<span><?php echo $user['integral']; ?></span>
            </div>
            <div style="margin:20px;border-radius:25px;padding:20px;background-color:#FFF">
                <div style="text-align:center" id="ylxtd">
                    <div style="margin-left:auto;margin-right:auto;border-radius:25px;background-color:#F56C6C;width:200px;height:30px;line-height:30px;color:#fff" id="qiandao">签到</div>
                </div>
              <div style="height:20px"></div>
              <div style="text-align:center">连续签到10天有惊喜哦~</div>
              <div style="height:20px"></div>
              <table width="100%">
                  <tr>
                      <td class="td1">
                          <div class="div1" id="qsit">未签到</div>
                          <div class="div2" id="qsit">08-07</div>
                      </td>
                      <td class="td1">
                          <div class="div1" id="qst">未签到</div>
                          <div class="div2" id="qst_">08-07</div>
                      </td>
                      <td class="td1">
                          <div class="div1" id="qet">未签到</div>
                          <div class="div2" id="qet_">08-07</div>
                      </td>
                      <td class="td1">
                          <div class="div1" id="qyt">未签到</div>
                          <div class="div2" id="qyt_">08-07</div>
                      </td>
                      <td class="td1">
                          <div class="div3" id="jt"><img src="/static/img/ico/success.png" style="width:25px"></div>
                          <div class="div4">今天</div>
                      </td>
                      <td class="td1">
                          <div class="div5">+5</div>
                          <div class="div4" id="hyt_">08-07</div>
                      </td>
                      <td class="td1">
                          <div class="div5">+5</div>
                          <div class="div4" id="het_">08-07</div>
                      </td>
                  </tr>
              </table>
            </div>
        </div>
        <script src="/static/js/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                
                $.post("/music/index/qwtqdqk",{
                    student_openid:'<?php echo $openid; ?>'
                },function(res){
                    if(res[0]['dk']===true){
                        $("#jt").html('<img src="/static/img/ico/success.png" style="width:25px">');
                        $.post("/music/index/lxqdjt",{
                            student_openid:'<?php echo $openid; ?>'
                        },function(res2){
                            if(res2!=='0'){
                                $("#ylxtd").html('<div style="text-align:center">已连续签到</div><div style="text-align:center;font-size:25px;font-weight:bold">'+res2+'</div>');
                            }
                        });
                    }else{
                        $("#jt").html('未签到');
                    }
                    if(res[1]['dk']===true){
                        $("#qyt").html('<img src="/static/img/ico/success.png" style="width:25px">');
                    }else{
                        $("#qyt").html('未签到');
                    }
                    $("#qyt_").html(res[1]['rq']);
                    if(res[2]['dk']===true){
                        $("#qet").html('<img src="/static/img/ico/success.png" style="width:25px">');
                    }else{
                        $("#qet").html('未签到');
                    }
                    $("#qet_").html(res[2]['rq']);
                    if(res[3]['dk']===true){
                        $("#qst").html('<img src="/static/img/ico/success.png" style="width:25px">');
                    }else{
                        $("#qst").html('未签到');
                    }
                    $("#qst_").html(res[3]['rq']);
                    if(res[4]['dk']===true){
                        $("#qsit").html('<img src="/static/img/ico/success.png" style="width:25px">');
                    }else{
                        $("#qsit").html('未签到');
                    }
                    $("#qsit_").html(res[4]['rq']);
                    $("#hyt_").html(res[5]['rq']);
                    $("#het_").html(res[6]['rq']);
                    //alert(res);
                })
                $("#qiandao").click(function(){
                    $.post("/music/index/qiandao",{
                        student_openid:'<?php echo $openid; ?>'
                    },function(res){
                        window.location.reload();
                    });
                });
            });
        </script>
    </body>
</html>
