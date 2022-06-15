<?php
    session_start();
    $_SESSION['openid'] = "";
    require_once dirname(__FILE__) .'/control/pdo.php';
    $LOGIN_VERIFICATION_NOTE_ID = getOne("select uuid()");
    pdoexec("insert into LOGIN_VERIFICATION_NOTE(LOGIN_VERIFICATION_NOTE_ID,THE_GENERATION_TIME__) values('$LOGIN_VERIFICATION_NOTE_ID',now())");
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IT解决方案行业CRM管理系统</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/mf.ico" type="image/x-icon" />
    <style type="text/css">
        body{
            font-family:'微软雅黑' !important;
        }
        
     </style>
  </head>
  <body>
      <input type="hidden" id="LOGIN_VERIFICATION_NOTE_ID" value="<?php echo $LOGIN_VERIFICATION_NOTE_ID;?>">
      <div style="margin-top:50px">
          <table style="margin-left:auto;margin-right:auto;">
              <tr>
                  <td>
                      <span style="font-size:20px;color:#000">IT解决方案行业CRM管理系统</span>
                  </td>
              </tr>
          </table>
      </div>
      <div style="background:#EAEAEA;margin-top:10px;padding:50px">
          <table style="margin-left:auto;margin-right:auto;">
              <tr>
                  <td style="padding:10px">
                      <img src="img/tu1.png" width="400px">
                  </td>
                  <td style="padding:10px">
                      <div class="panel panel-primary">
                          <div class="panel-heading">
                            <h3 class="panel-title">使用微信扫描二维码登录</h3>
                            <h3 class="panel-title"><?php echo $LOGIN_VERIFICATION_NOTE_ID;?></h3>
                          </div>
                          <div class="panel-body">
                            <table width="100%">
                                <tr>
                                    <td align="center">
                                        <img src="login/loginqrcode.php?LOGIN_VERIFICATION_NOTE_ID=<?php echo $LOGIN_VERIFICATION_NOTE_ID;?>" width="300px">
                                    </td>
                                </tr>
                            </table>
                          </div>
                        </div>
                  </td>
              </tr>
          </table>
      </div>
    <div>
        <table style="margin-left:auto;margin-right:auto;">
            <tr>
                <td>
                    <span style="margin:10px">东软环保团队</span><span style="margin:10px">Copyright © 2008-2017 NET</span>
                </td>
            </tr>
        </table>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="index.js"></script>
  </body>
</html>