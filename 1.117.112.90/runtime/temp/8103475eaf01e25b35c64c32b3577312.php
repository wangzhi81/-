<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"/www/wwwroot/erp.wangzhi81.com/public/../application/comm/view/index/remotecontrol.html";i:1509437114;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>远程桌面</title>
    </head>
        
    <body>
        <img src="<?php echo $RemoteDesktop; ?>">
        <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("img").bind("click", function(e){    //传递事件对象e
                    var mp={};
                    mp.x = e.offsetX;
                    mp.y = e.offsetY;
                    $.post("/comm/index/MousePosition",{
                        mp:mp
                    },function(res){
                        //alert(res);
                    });
                });
                function show(){
                    $.post("/comm/index/getRemoteDesktop",{},function(res){
                        $("img").attr("src",res+"?r="+Math.random());
                        console.log(res);
                        setTimeout(show,3000);
                    });
                }
                show();
            });
        </script>
    </body>
</html>
