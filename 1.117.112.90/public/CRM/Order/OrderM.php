<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IT解决方案行业CRM管理系统</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/loading.css" rel="stylesheet">
    <link href="OrderM.css?v=0.2" rel="stylesheet">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
    <style type="text/css">
        body{
            font-family:'微软雅黑' !important;
        }
        input,button,a {
            outline:0 none !important; blr:expression(this.onFocus=this.blur());
        } 
     </style>
  </head>
  <body>
      <div class="div1">
          <table width="100%">
              <tr><td align="left"><span style="border-left-style: solid;border-left-width: 3px;border-left-color:#09C;padding:5px">订单管理</span></td></tr>
          </table>
          <hr style="margin-top: 10px;margin-bottom: 5px;">
          <table width="100%">
                <tr>
                    <td align="left">
                        <button class="btn btn-info" type="submit">新增订单</button>
                    </td>
                    <td align="right">
                    <table>
                        <tr>
                            <td><div class="toolbar"><span class="glyphicon glyphicon-import"></span></div></td>
                            <td><div class="toolbar"><span class="glyphicon glyphicon-cog"></span></div></td>
                        </tr>
                    </table>
                </td></tr>
          </table>
          <div id="stb">
              没有数据
          </div>
      </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/loading.js"></script>
    <script src="../js/table.js?v=0.4"></script>
    <script src="OrderM.js?v=0.3"></script>
  </body>
</html>