<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/www/wwwroot/erp.wangzhi81.com/public/../application/admin/view/index/index.html";i:1586599673;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="/favicon.ico?v=0.1" rel="shortcut icon" />
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/General.css?v=0.9" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.2" />
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap-datetimepicker.min.css?v=0.2" />
        <link rel="stylesheet" type="text/css" href="/static/js/summernote.css" />
        <title>后台管理</title>
    </head>
    <body style="overflow:hidden">
        <div id="Title" class="Title">
            <table width="100%">
                <tr>
                    <td style="width:48px"><img src="/static/img/broadband.png" height="48px"></td>
                    <td style="padding:3px"><span class="TitleText">中国移动宽带接入系统</span></td>
                </tr>
            </table>
        </div>
        <table width="100%">
            <tr>
                <td class="MenuTd" valign="top">
                    <div class="text-center Telescopic"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span></div>
                    <div id="Menu" class="Menu" >
                        
                    </div>
                </td>
                <td class="Workspace">
                    <div class="pre-scrollable">
                        <div class="WorkspaceTitle" id="WorkspaceTitle">
                            <div id="MainTitle">标题</div><div id="SecondTitle"></div>
                        </div>
                        <hr class="DividingLine">
                        <div id="QueryPanels" class="QueryPanels"></div>
                        <div id="WorkspaceButtons" class="WorkspaceButtons">
                            
                        </div>
                        <div id="WorkspaceContent" class="WorkspaceContent">
                            
                        </div>
                        <div id="PageInfor"></div>
                    </div>
                </td>
            </tr>
        </table>
        <div class="ModalDialog2" id="RemindDialog" style="width:400px;height:300px">
            <div class="ModalDialogTitle">
                <table width="100%">
                    <tr>
                        <td>提醒</td>
                        <td align="right"><img src="/static/img/ico/del.png" class="delimg2" id="RemindClose"></td>
                    </tr>
                </table>
            </div>
            <hr class="DividingLine">
            <div class="ModalDialogContent" id="RemindContent">
                
            </div>
        </div>
        <audio id="myaudio" src="/static/img/dingdong.wav" controls="controls" hidden="true" ></audio>
        <div id="zztishi">
            <table width="100%"><tr><td align="center" valign="middle">
                <span id="zztishitd"></span>
            </td></tr></table>
        </div>
        <script data-main="/static/js/main.js?v=6" src="/static/js/require.min.js"></script>
    </body>
</html>
