<?php
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>应急预案</title>
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
          <div class="panel-heading">应急预案</div>
          <div class="panel-body">
            <div class="panel panel-default">
              <div class="panel-body">
                <table width="100%">
                    <tr>
                        <td width="100px">
                            <span>危险源名称：</span>
                        </td>
                        <td width="200px">
                            <input class="form-control">
                        </td>
                        <td width="120px">
                            <span style="margin-left: 10px;">环境风险级别：</span>
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
                    <th>危险源名称</th>
                    <th>环境风险级别</th>
                    <th>预案编制时间</th>
                    <th>是否备案</th>
                    <th>操作</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>XX风险源</td>
                    <td>一般风险源</td>
                    <td>2006-10-10</td>
                    <td>已备案</td>
                    <td><a style="cursor:pointer" href="yjyaxq.php">详细</a></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>XX风险源</td>
                    <td>一般风险源</td>
                    <td>2006-10-10</td>
                    <td>已备案</td>
                    <td><a style="cursor:pointer">详细</a></td>
                </tr>
            </table>
          </div>
        </div>
    <script src="../../../js/jquery.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
  </body>
</html>