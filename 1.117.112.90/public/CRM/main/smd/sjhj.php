<?php
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>数据汇聚</title>
    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body{
            font-family:'微软雅黑' !important;
        }
        
     </style>
  </head>
  <body>
        <div class="panel panel-default">
          <div class="panel-heading">数据汇聚</div>
          <div class="panel-body">
            <div class="panel panel-default">
              <div class="panel-body">
                <table width="100%">
                    <tr>
                        <td width="100px">数据源：</td>
                        <td width="200px"><input class="form-control"></td>
                        <td width="120px"><span style="margin-left: 10px;">数据源类型：</span></td>
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
            <button type="button" class="btn btn-primary" style="margin-bottom: 10px;">添加汇聚规则</button>
            <table class="table table-bordered">
              <tr>
                  <th>序号</th>
                  <th>数据源</th>
                  <th>数据源类型</th>
                  <th>汇聚频率</th>
                  <th>任务状态</th>
                  <th>创建时间</th>
                  <th>操作</th>
              </tr>
              <tr>
                  <td>1</td>
                  <td>风险源数据</td>
                  <td>结构化数据</td>
                  <td>每一天在凌晨3:00</td>
                  <td>正常</td>
                  <td>2010-10-10</td>
                  <td><a href="#" style="cursor:pointer;">详情</a></td>
              </tr>
              <tr>
                  <td>2</td>
                  <td>污染源监控数据</td>
                  <td>半结构化数据</td>
                  <td>每小时</td>
                  <td>正常</td>
                  <td>2010-10-10</td>
                  <td><a href="#" style="cursor:pointer;">详情</a></td>
              </tr>
            </table>
          </div>
        </div>
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
  </body>
</html>