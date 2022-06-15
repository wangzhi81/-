<?php
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>应急设备</title>
    <!-- Bootstrap -->
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body{
            font-family:'微软雅黑' !important;
        }
        
     </style>
  </head>
  <body>
        <div class="panel panel-default">
          <div class="panel-heading">应急设备</div>
          <div class="panel-body">
            <div class="panel panel-default">
              <div class="panel-body">
                <table width="100%">
                    <tr>
                        <td width="100px">
                            <span>设备名称：</span>
                        </td>
                        <td width="200px">
                            <input class="form-control">
                        </td>
                        <td width="100px">
                            <span style="margin-left: 10px;">装备类型：</span>
                        </td>
                        <td width="200px">
                            <input class="form-control">
                        </td>
                        <td align="right">
                            <button type="button" class="btn btn-primary">查询</button>
                        </td>
                    </tr>
                </table>
              </div>
            </div>
            <table class="table table-bordered">
                <tr>
                    <th>序号</th>
                    <th>设备编号</th>
                    <th>设备类别</th>
                    <th>设备名称</th>
                    <th>联系人</th>
                    <th>联系电话</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>YJSB001</td>
                    <td>洗消器</td>
                    <td>水污染洗消器</td>
                    <td>张三</td>
                    <td>13888888888</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>YJSB002</td>
                    <td>毒性中和剂</td>
                    <td>苯系物中和剂</td>
                    <td>张三</td>
                    <td>13888888888</td>
                </tr>
            </table>
          </div>
        </div>
    <script src="../../../js/jquery.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
  </body>
</html>