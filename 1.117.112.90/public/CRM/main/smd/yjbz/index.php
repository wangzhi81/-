<?php
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IT解决方案行业CRM管理系统</title>

    <!-- Bootstrap -->
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../css/loading.css" rel="stylesheet">
    <link href="index.css?v=0.5" rel="stylesheet">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
    <style type="text/css">
        body{
            font-family:'微软雅黑' !important;
        }
        
     </style>
  </head>
  <body>
      <input type="hidden" id="openid" value="<?php echo $_SESSION['openid'];?>">
    <table id="maintable" width="100%">
        <tr>
            <td id="righttd" class="td1" valign="top">
                <div class="div1">
                    <span class="span1">应急保障</span>
                </div>
                <div class="div2 div2selected">
                    <span id="yjsb" class="span2">应急设备</span>
                </div>
                <div class="div2">
                    <span id="yjry" class="span2">应急人员</span>
                </div>
                <div class="div2">
                    <span id="jywz" class="span2">救援物资</span>
                </div>
            </td>
            <td id="lefttd" align="center" valign="top">
                <iframe id="mainfram" src="yjsb.php" width="100%" frameborder="0">
                    
                </iframe>
            </td>
        </tr>
    </table>
    <div id="huadong">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../../../js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../../js/bootstrap.min.js"></script>
    <script src="../../../js/loading.js"></script>
    <script src="index.js?v=0.3"></script>
  </body>
</html>