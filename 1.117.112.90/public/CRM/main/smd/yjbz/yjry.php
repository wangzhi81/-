<?php
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>应急人员</title>
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
          <div class="panel-heading">应急人员</div>
          <div class="panel-body">
            <div class="panel panel-default">
              <div class="panel-body">
                <table width="100%">
                    <tr>
                        <td width="100px">
                            <span>姓名：</span>
                        </td>
                        <td width="200px">
                            <input class="form-control">
                        </td>
                        <td width="100px">
                            <span style="margin-left: 10px;">联系电话：</span>
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
                    <th>人员姓名</th>
                    <th>职务</th>
                    <th>联系方式</th>
                    <th>紧急联系方式</th>
                    <th>专家专业领域或类型</th>
                    <th>优先等级</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>张三</td>
                    <td>安检员</td>
                    <td>0411-12345678</td>
                    <td>13888888888</td>
                    <td>水污染专家</td>
                    <td>优先</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>李四</td>
                    <td>安检员</td>
                    <td>0411-12345678</td>
                    <td>13888888888</td>
                    <td>大气污染专家</td>
                    <td>优先</td>
                </tr>
            </table>
          </div>
        </div>
    <script src="../../../js/jquery.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
  </body>
</html>