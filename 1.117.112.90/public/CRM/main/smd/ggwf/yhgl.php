<?php
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>用户管理</title>
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
          <div class="panel-heading">用户管理</div>
          <div class="panel-body">
            <div class="panel panel-default">
              <div class="panel-body">
                <table width="100%">
                    <tr>
                        <td width="100px">
                            <span>用户名：</span>
                        </td>
                        <td width="200px">
                            <input class="form-control">
                        </td>
                        <td width="100px">
                            <span>权限类别：</span>
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
            <table>
                <tr>
                    <td><button type="button" class="btn btn-primary">添加用户</button></td>
                </tr>
            </table>
            <table class="table table-bordered" style="margin-top:10px">
                <tr>
                    <th>序号</th>
                    <th>用户名</th>
                    <th>姓名</th>
                    <th>权限类别</th>
                    <th>操作</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>zhangsan</td>
                    <td>张三</td>
                    <td>超级管理员</td>
                    <td><a>修改</a><a style="margin-left: 10px;">删除</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>lisi</td>
                    <td>李四</td>
                    <td>管理员</td>
                    <td><a>修改</a><a style="margin-left: 10px;">删除</a></td>
                </tr>
            </table>
          </div>
        </div>
    <script src="../../../js/jquery.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
  </body>
</html>