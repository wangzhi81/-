<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"/www/wwwroot/39.99.164.250/public/../application/music/view/index/chaxun.html";i:1597806071;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css" />
        <title></title>
    </head>
    
    <body>
        <div style="background-color:#f2f3f7;padding:10px"><img src="/static/img/ico/fanhui.png" style="height:20px" id="fanhui"></div>
        <div style="padding:10px">
            <table width="100%">
                <tr>
                    <td><input type="text" class="form-control" id="cxtj" placeholder="查询全部课程" value="<?php echo $cxtj; ?>"></td>
                    <td style="width:50px" align="center"><a href="#" id="chaxun">查询</a></td>
                </tr>
            </table>
        </div>
        <div style="height:10px"></div>
        <table width="100%" id="kclb">
            
        </table>
        <script src="/static/js/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#fanhui").click(function(){
                    location.href = "/music/index/kclb";
                });
                chaxun();
                $("#chaxun").click(function(){
                    chaxun();
                });
            });
            function chaxun(){
                //if($("#cxtj").val().trim()!=''){
                    $.post("/music/index/chaxun1",{
                        cxtj:$("#cxtj").val()
                    },function(res){
                        var html = "";
                        $.each(res,function(i,v){
                            html+='<tr class="kclbclass" COURSE_INFORMATION_ID="'+v.COURSE_INFORMATION_ID+'"><td style="width:40%;padding:10px" valign="top"><img src="'+v.course_pictures+'" class="img-responsive img-rounded"></td><td style="padding:10px" valign="top"><div style="height:30px">'+v.course_title+'</div><div style="font-size:20px;color:#EF7C38">￥'+v.course_price+'</div><table width="100%"><tr><td><img src="/static/img/ico/user2.png" style="width:20px"><span style="color:#cdcdcd">'+v.teaching_teacher+'</span></td><td align="right"><img src="/static/img/ico/guanzhu.png" style="width:20px"><span style="color:#cdcdcd">'+v.number_of_learners+'</span></td></tr></table></td></tr>';
                        });
                        $("#kclb").html(html);
                        $(".kclbclass").click(function(){
                            var COURSE_INFORMATION_ID = $(this).attr("COURSE_INFORMATION_ID");
                            location.href = "/music/index/kecheng/id/"+COURSE_INFORMATION_ID;
                        });
                    });
                //}
            }
        </script>
    </body>
</html>
