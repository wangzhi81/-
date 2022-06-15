<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"/dc/www/1.117.112.90/public/../application/gps/view/index/zcrz.html";i:1655214971;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css" />
        <title>注册认证</title>
    </head>
    <body>
        <table class="GridButtons table table-bordered" width="100%">
            <tr>
                <td style="text-align: center;vertical-align:middle;width:150px">姓名：</td>
                <td colspan="2"><input type="text" class="form-control" id="employee_name"></td>
            </tr>
            <tr>
                <td style="text-align: center;vertical-align:middle">手机：</td>
                <td><input type="text" class="form-control" id="phone_number"></td>
                <td style="text-align: center;vertical-align:middle"><button type="button" class="btn btn-primary btn-xs" id="fasongyanzhengma">发送验证码</button></td>
            </tr>
            <tr>
                <td style="text-align: center;vertical-align:middle">验证码：</td>
                <td colspan="2"><input type="text" class="form-control" id="verification_code"></td>
            </tr>
            <tr>
                <td style="text-align: center;vertical-align:middle">身份证号码：</td>
                <td colspan="2"><input type="text" class="form-control" id="citizenship_card"></td>
            </tr>
            <tr>
                <td style="text-align: center;vertical-align:middle">生日：</td>
                <td colspan="2">
                    <span id="birthday"></span>
                    </td>
            </tr>
            <tr>
                <td style="text-align: center;vertical-align:middle">身份证照片：</td>
                <td colspan="2">
                    <img src="/static/img/sfzzm.png" alt="..." class="img-rounded" style="width:200px;height:100px" id="id_photo">
                    <img src="/static/img/sfzfm.png" alt="..." class="img-rounded" style="width:200px;height:100px" id="reverse_side_of_id_card">
                </td>
            </tr>
            <tr>
                <td style="text-align: center;vertical-align:middle">驾驶证照片：</td>
                <td colspan="2">
                    <img src="/static/img/jszzm.png" alt="..." class="img-rounded" style="width:200px;height:100px" id="driving_license_photo">
                    <img src="/static/img/jszfm.png" alt="..." class="img-rounded" style="width:200px;height:100px" id="reverse_side_of_driving_certificate">
                </td>
            </tr>
        </table>
        <div style="text-align:center">
            <button type="button" class="btn btn-success" style="width:80%;" id="tijiao">提交</button>
        </div>
        
        <!--<script data-main="/static/js/BusinessList.js?v=0.5" src="/static/js/require.min.js"></script>-->
        <script data-main="/static/js/zcrz.js?v=50" src="/static/js/require.min.js"></script>
    </body>
</html>
