<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IT解决方案行业CRM管理系统</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="xjst.css?v=0.3" rel="stylesheet">
    <link href="editEntitie.css?v=0.3" rel="stylesheet">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
    <style type="text/css">
        body{
            font-family:'微软雅黑' !important;
        }
        
     </style>
  </head>
  <body>
      <input id="ENTITY_UUID" type="hidden" value="<?php echo $_GET['id'];?>">
      <div class="div1">
          <div>
              <table><tr>
                  <td><span class="span1">修改实体</span></td>
                  <td><button class="btn2" id="fanhui"><span class="glyphicon glyphicon-log-out"></span>&nbsp;<span>返回实体列表</span></button></td>
              </tr></table>
          </div>
          <table>
              <tr>
                  <td>实体名称：</td>
                  <td><input class="input1" id="stmc" type="text" readonly="readonly"></td>
              </tr>
              <tr>
                  <td>实体代码：</td>
                  <td><span id="stdm"></span></td>
              </tr>
              <tr>
                  <td>实体说明：</td>
                  <td>
                      <textarea class="input1" id="stsm"></textarea>
                  </td>
              </tr>
              <tr>
                  <td></td>
                  <td>
                      <a class="btn" id="baocun">保存</a>
                  </td>
              </tr>
          </table>
      </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.json.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="editEntitie.js?v=0.4"></script>
  </body>
</html>