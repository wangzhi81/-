<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"/www/wwwroot/39.99.164.250/public/../application/music/view/index/business_list.html";i:1650275561;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css" />
        <title>业务列表</title>
    </head>
    <body>
        <table class="GridButtons table table-bordered" width="100%">
            <tr>
                <td class="text-center" id="OpenAccount">
                    <div><img src="/static/img/buttons/Order.png"></div>
                    <div>开户提单</div>
                </td>
                <td class="text-center" id="OrderEnquiry">
                    <div><img src="/static/img/buttons/Inquire.png"></div>
                    <div>订单查询</div>
                </td>
                <td class="text-center" id="PerformanceEnquiry">
                    <div><img src="/static/img/buttons/Performance.png"></div>
                    <div>业绩查询</div>
                </td>
            </tr>
            <tr>
                <td class="text-center" id="Resources">
                    <div><img src="/static/img/buttons/Resources.png"></div>
                    <div>资源查询</div>
                </td>
                <td class="text-center"></td>
                <td class="text-center"></td>
            </tr>
            <tr style="display:none">
                
                <td class="text-center" id="Leaflets">
                    <div><img src="/static/img/buttons/Flyer.png"></div>
                    <div>宣传单</div>
                </td>
                
                <td class="text-center"></td>
            </tr>
        </table>
        <!--<script data-main="/static/js/BusinessList.js?v=0.5" src="/static/js/require.min.js"></script>-->
        <script data-main="/static/js/BusinessList.js?v=1" src="/static/js/require.min.js"></script>
    </body>
</html>
