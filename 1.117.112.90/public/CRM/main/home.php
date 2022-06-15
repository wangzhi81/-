<?php
    session_start();
    //include '../control/weixin.qy.class.php';
    require_once dirname(__FILE__) .'/../control/pdo.php';
    //$wxtool = new weixinTool();
    //$userid = $wxtool->getUseridByOpenid($_SESSION['openid']);
    $userid = $_SESSION['think']['OPENID'];
    //$userinfo = $wxtool->getUserInfoByUserid($userid);
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>12369环保举报云服务平台</title>
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="home.css?v=0.5" rel="stylesheet">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
    <style type="text/css">
        body{
            font-family:'微软雅黑' !important;
        }
        
     </style>
  </head>
  <body>
      <input type="hidden" id="openid" value="<?php echo $_SESSION['think']['OPENID'];?>">
      <input type="hidden" id="username" value="<?php echo $userinfo['name'];?>">
    <div style="padding:5px">
        <span class="span6">公告：</span>
        <span class="span7"><a href="#">[10.18]系统平台升级的公告</a></span>
        <span class="span7"><a href="#">[10.18]关于发布《用户平台使用协议》的公告</a></span>
        <span class="span7"><a href="#">更多>></a></span>
    </div>
    <div class="kuang1">
        <table width="100%">
            <tr>
                <td valign="center">
                    <table width="100%">
                        <tr>
                            <td class="kuang2" align="center" style="width:150px">
                                <div><img src="<?php echo $userinfo['avatar'];?>" class="img-circle" width="50px"></div>
                                <div>您好，<?php echo $userinfo['name'];?></div>
                            </td>
                            <td class="kuang3" style="width:300px">
                                <table>
                                    <tr>
                                        <td>
                                            <div>余额：</div>
                                            <div>
                                                <span class="span1">0</span><span>.00</span>
                                                <span class="span2">元</span>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-primary">充值</button>
                                                <span class="span2"><a href="#">交易记录</a></span>
                                                <span class="jiange">|</span>
                                                <span class="span2"><a href="#">申请提现</a></span>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="kuang3">
                                <table>
                                    <tr>
                                        <td>
                                            <div>待办：</div>
                                            <div>
                                                <span class="span1">0</span>
                                                <span class="span2"><a href="#">需待办</a></span>
                                            </div>
                                            <div>
                                                <span class="span2"><a href="#">未办理</a></span>
                                                <span class="shuzi">0</span>
                                                <span class="jiange">|</span>
                                                <span class="span2"><a href="#">办理中</a></span>
                                                <span class="shuzi">0</span>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <div class="jiange2"></div>
                    <table width="100%">
                        <tr>
                            <td class="kuang3" style="width:50%">
                                <div style="margin-bottom:10px"><span class="span4">超期预警</span></div>
                                <div class="kuang2">
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <span>超期未办理</span>
                                                <span class="shuzi2">0</span>
                                                <span>件</span>
                                            </td>
                                            <td>
                                                <span class="span3">即将超期</span>
                                                <span class="shuzi2">0</span>
                                                <span>件</span>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="kuang4">
                                        <a href="#">立即查看</a>
                                    </div>
                                </div>
                            </td>
                            <td class="kuang3">
                                <div style="margin-bottom:10px"><span class="span4">督办抽查</span></div>
                                <div class="kuang2">
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <span>督办</span>
                                                <span class="shuzi2">0</span>
                                                <span>件</span>
                                            </td>
                                            <td>
                                                <span class="span3">抽查</span>
                                                <span class="shuzi2">0</span>
                                                <span>件</span>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="kuang4">
                                        <a href="#">立即查看</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width:20px"></td>
                <td id="righttd" valign="top" style="width:300px">
                    
                </td>
            </tr>
        </table>
        
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="home.js?v=1"></script>
  </body>
</html>