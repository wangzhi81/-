<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IT解决方案行业CRM管理系统</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../dataDictionary/xjst.css?v=0.4" rel="stylesheet">
    <link href="addOrder.css?v=0.4" rel="stylesheet">
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
              <table width="100%"><tr>
                  <td style="vertical-align:middle;">
                      <span class="glyphicon glyphicon-th ng-isolate-scope" style="color:#09C" aria-hidden="true"></span>
                      <span class="ng-isolate-scope">添加订单</span>
                  </td>
                  <td align="right"><button class="btn2" id="fanhui"><span class="glyphicon glyphicon-log-out"></span>&nbsp;<span>返回</span></button></td>
              </tr></table>
          </div>
          <hr>
          <div>
              <button class="btn2" id="fanhui"><span class="glyphicon glyphicon-screenshot"></span>&nbsp;<span>督办</span></button>
              <button class="btn2" id="fanhui"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp;<span>电话回访</span></button>
              <button class="btn2" id="fanhui"><span class="glyphicon glyphicon-search"></span>&nbsp;<span>抽查</span></button>
          </div>
          <table width="100%" style="margin-top:5px">
              <tr>
                  <td valign="top">
                      <div class="PanelTitle">
                          举报详情
                      </div>
                      <table class="table table-bordered">
                        <tr><td style="width:100px"><span class="text-muted">举报编号：</span></td><td><span class="ng-binding">170218340202010411</span></td></tr>
                        <tr><td><span class="text-muted">举报时间：</span></td><td><span class="ng-binding">2017年02月18日 15:32</span></td></tr>
                        <tr><td><span class="text-muted">举报方式：</span></td><td><span class="ng-binding">微信举报</span></td></tr>
                        <tr><td><span class="text-muted">缓急程度：</span></td><td><span class="ng-binding">普通件</span></td></tr>
                        <tr><td>
                            <span class="text-muted">举报人：</span>
                        </td>
                        <td>
                            <span class="ng-binding">张三丰</span>
                            <a href="#">详细>></a>
                        </td></tr>
                        <tr><td>
                            <span class="text-muted">举报对象：</span>
                        </td>
                        <td>
                            <span class="ng-binding">安徽中天印染有限公司</span>
                            <a href="#">详细>></a>
                        </td></tr>
                        <tr><td>
                            <span class="text-muted">详细地址：</span>
                        </td>
                        <td>
                            <span class="ng-binding">大连市滨海新区382号</span>
                            <a href="#">查看地图>></a>
                        </td></tr>
                        <tr><td>
                            <span class="text-muted">污染描述：</span>
                        </td>
                        <td>
                            <span class="ng-binding">安徽中天印染有限公司，伏虎市长江北街113号，有恶臭气体</span>
                        </td></tr>
                        <tr><td>
                            <span class="text-muted">录入时间：</span>
                        </td>
                        <td>
                            <span class="ng-binding">2017年02月18日 15:33</span>
                        </td></tr>
                        <tr><td>
                            <span class="text-muted">录入人：</span>
                        </td>
                        <td>
                            <span class="ng-binding">章某某</span>
                        </td></tr>
                        <tr><td>
                            <span class="text-muted">录入单位：</span>
                        </td>
                        <td>
                            <span class="ng-binding">大连市环保局</span>
                        </td></tr>
                      </table>
                  </td>
                  <td valign="top" style="padding-left:5px;width:400px">
                      <div class="ecs-detail-relation-box">
                          <table style="margin-left: auto;margin-right:auto;">
                              <tr>
                                  <td align="center">
                                      <span class="glyphicon glyphicon-user ecs-detail-relation-item" aria-hidden="true"></span>
                                  </td>
                                  <td align="center">
                                      <span class="ecs-detail-relation-item">……</span>
                                  </td>
                                  <td align="center">
                                      <span class="glyphicon glyphicon-file ecs-detail-relation-item" aria-hidden="true"></span>
                                  </td>
                                  <td align="center">
                                      <span class="ecs-detail-relation-item">……</span>
                                  </td>
                                  <td align="center">
                                      <span class="glyphicon glyphicon-phone-alt ecs-detail-relation-item" aria-hidden="true"></span>
                                  </td>
                                  <td align="center">
                                      <span class="ecs-detail-relation-item">……</span>
                                  </td>
                                  <td align="center">
                                      <span class="glyphicon glyphicon-ok ecs-detail-relation-item" aria-hidden="true"></span>
                                  </td>
                              </tr>
                          </table>
                      </div>
                      <div class="console-title">
                          <span>办理详情</span>
                      </div>
                      <hr>
                      <table style="margin-top:15px">
                          <tr>
                              <td>
                                  <div class="Axis-time">2017-02-17</div>
                                  <div class="Axis-time">17:00</div>
                              </td>
                              <td style="width:30px" align="center">
                                  <div class="line" style="top: 15px; height: 240px;"></div>
                                  <img src="about4_icon.png">
                              </td>
                              <td>
                                  <div class="Axis-text">办理人：张某某</div>
                                  <div class="Axis-text">已办结，办结意见：县环保局与12月26日接到关于该举报情况属实，处理意见：现场纠正；</div>
                              </td>
                          </tr>
                          <tr><td style="height:15px"></td></tr>
                          <tr>
                              <td>
                                  <div class="Axis-time">2017-02-17</div>
                                  <div class="Axis-time">17:00</div>
                              </td>
                              <td style="width:30px" align="center">
                                  <img src="about4_icon.png">
                              </td>
                              <td>
                                  <div class="Axis-text">办理人：张某某</div>
                                  <div class="Axis-text">已办结，办结意见：县环保局与12月26日接到关于该举报情况属实，处理意见：现场纠正；</div>
                              </td>
                          </tr>
                          <tr><td style="height:15px"></td></tr>
                          <tr>
                              <td>
                                  <div class="Axis-time">2017-02-17</div>
                                  <div class="Axis-time">17:00</div>
                              </td>
                              <td style="width:30px" align="center">
                                  <img src="about4_icon.png">
                              </td>
                              <td>
                                  <div class="Axis-text">办理人：张某某</div>
                                  <div class="Axis-text">已办结，办结意见：县环保局与12月26日接到关于该举报情况属实，处理意见：现场纠正；</div>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
          </table>
          
      </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.json.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="addOrder.js?v=0.5"></script>
  </body>
</html>