<?php
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>事件管理</title>
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
          <div class="panel-heading">事件管理</div>
          <div class="panel-body">
            <div class="panel panel-default">
              <div class="panel-body">
                <table width="100%">
                    <tr>
                        <td width="100px">事件名称：</td>
                        <td width="200px"><input class="form-control"></td>
                        <td width="120px"><span style="margin-left: 10px;">涉及企业名称：</span></td>
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
                  <th>事件名称</th>
                  <th>涉及企业</th>
                  <th>发生位置</th>
                  <th>事件等级</th>
                  <th>联系电话</th>
                  <th>操作</th>
              </tr>
              <tr>
                  <td>1</td>
                  <td>水污染物泄露</td>
                  <td>大化集团有限责任公司</td>
                  <td>大连市甘井子区金西路10号</td>
                  <td>一般事件</td>
                  <td>0411-86893688</td>
                  <td><a href="sjxq.php" style="cursor:pointer;">详情</a></td>
              </tr>
              <tr>
                  <td>2</td>
                  <td>水污染物泄露</td>
                  <td>大连远达科技发展有限公司</td>
                  <td>大连市甘井子区华北路196号</td>
                  <td>一般事件</td>
                  <td>0411-85187477</td>
                  <td><a style="cursor:pointer;">详情</a></td>
              </tr>
            </table>
          </div>
        </div>
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
  </body>
</html>