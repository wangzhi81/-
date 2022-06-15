<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"/www/wwwroot/erp.wangzhi81.com/public/../application/admin/view/towadd26/gjdpsjzs.html";i:1531140654;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <title>2+26城市机动车遥感监测平台</title>
        <style type="text/css">
            body{overflow:hidden;}
            .iframediv{position:absolute;top:50px;left:180px;}
            .biaoqian{color:#999;}
            .div4{
                border: 1px solid #0F0;padding: 10px;
            }
            .delimg{
                cursor: pointer;
            }
            .ycsjdhk{
                position: absolute;top: 60px;left: 300px;
                padding: 10px;color: #FFF;
                background-color: rgba(0,0,0,0.6);
            }
            .biaoti{
                font-size: 14px;font-weight: bold;
            }
            .ycsjdiv{
                position: absolute;top: 80px;left: 50px;
                padding: 10px;color: #FFF;
                background-color: rgba(0,0,0,0.5);display: none;
            }
            .tulidiv{
                position: absolute;top:100px;left: 50px;
                height: 120px;width: 200px;
                background-color: rgba(0,0,0,0.5);
                color: #FFF;
                padding: 10px;
            }
            .div1{
                height: 50px;background-color: #2f3e50;padding-left: 10px;
            }
            .td1{
                width:180px;
            }
            .td2{
                height: 50px;
            }
            .div2{
                height: 45px;background-color: #222e3c;
            }
            .div3{
                background-color: #2f3e50;
            }
            .span1{
                font-size: 16px;color: #FFF;
            }
            .glyphicon{
                color:#8290a4;
            }
            .baidu-maps label {
              max-width: none;
            }
            .caidan{
                padding: 10px;cursor: pointer;color: #bbb;
            }
            .caidan:hover{
                color: #0F0;color: #fff;
            }
            .selected{
                background-color: #336699;
            }
        </style>
    </head>
    
    <body>
        <table width="100%">
            <tr>
                <td>
                    <div style="overflow:no">
                        <div id="mapdiv" class ="baidu-maps"></div>
                    </div>
                </td>
            </tr>
        </table>
        <div class="tulidiv" id="tulidiv">
            <table width="100%">
                <tr>
                    <td align="center">图例</td>
                </tr>
            </table>
            <div style="height:10px"></div>
            <table width="100%">
                <tr>
                    <td align="right" style="width:30%"><img src="/static/img/ico/lvdian10.png" width="10px"></td>
                    <td style="width:10px"></td>
                    <td>正常点位</td>
                </tr>
                <tr><td style="height:5px"></td></tr>
                <tr>
                    <td align="right" style="width:30%"><img src="/static/img/ico/dianwei10.png" width="10px"></td>
                    <td style="width:10px"></td>
                    <td>异常点位</td>
                </tr>
                <tr><td style="height:5px"></td></tr>
                <tr>
                    <td align="right" style="width:30%"><img src="/static/img/ico/huidian10.png" width="10px"></td>
                    <td style="width:10px"></td>
                    <td>离线点位</td>
                </tr>
            </table>
        </div>
        <div class="ycsjdiv" id="ycsjdiv">
            <table width="100%">
                <tr>
                    <td align="center" class="biaoti">监测点位基本信息</td>
                </tr>
            </table>
            <div style="height:10px"></div>
            <table width="100%">
                <tr><td align="right">点位编号：</td><td id="dwbh">A210112001</td></tr>
                <tr><td style="height:5px"></td></tr>
                <tr><td align="right">点位名称：</td><td id="dwmc"></td></tr>
                <tr><td style="height:5px"></td></tr>
                <tr><td align="right">点位类型：</td><td id="dwlx">垂直固定式</td></tr>
                <tr><td style="height:5px"></td></tr>
                <tr><td align="right">点位状态：</td><td id="dwzt">正常</td></tr>
                <tr><td style="height:5px"></td></tr>
                <tr><td align="right">点位地址：</td><td id="dwdz">沈阳市浑南区新秀街2号</td></tr>
                <tr><td style="height:5px"></td></tr>
                <tr><td align="right">地址经度：</td><td id="dzjd"></td></tr>
                <tr><td style="height:5px"></td></tr>
                <tr><td align="right">地址纬度：</td><td id="dzwd"></td></tr>
            </table>
            <div style="height:10px"></div>
            <table width="100%">
                <tr>
                    <td align="right">
                        <table><tr>
                            <td><a href="javascript:;" id="ycsjan">遥测数据</a></td>
                            <td style="width:10px"></td>
                            <td><a href="javascript:;" id="jtllsja">交通流量数据</a></td>
                        </tr></table>
                    </td>
                </tr>
            </table>
        </div>
        <div class="ycsjdhk" id="ycsjdhk" style="display:none">
            <div class="ydbiaoti">
                <table width="100%"><tr>
                    <td>遥测数据</td>
                    <td align="right"><img src="/static/img/ico/del.png" class="delimg" id="ycsjdhkdel"></td>
                </tr></table>
            </div>
            <div style="height:10px"></div>
            <table width="100%">
                <tr>
                    <td width="60%" valign="top" class="div4">
                        <div id="spxxdiv">
                            <video controls="controls" autoplay="autoplay" loop="loop" width="100%">
                                <source src="/static/video/A130128001032018051410180661.mp4" type="video/mp4" />
                            </video>
                        </div>
                    </td>
                    <td style="width:10px"></td>
                    <td valign="top" class="div4">
                        <div id="clxxdiv">
                            <table width="100%">
                                <tr><td align="center">车辆信息</td></tr>
                            </table>
                            <div style="height:10px"></div>
                            <table class="table table-bordered">
                                <tr><td>
                                    <div class="biaoqian">号牌号码</div>
                                    <div id="hphm">AJ888E</div>
                                </td><td>
                                    <div class="biaoqian">车牌颜色</div>
                                    <div id="cpys">蓝色</div>
                                </td></tr>
                                <tr><td>
                                    <div class="biaoqian">号牌种类</div>
                                    <div id="hpzl">小型汽车号牌</div>
                                </td><td>
                                    <div class="biaoqian">燃料种类</div>
                                    <div id="rlzl">汽油</div>
                                </td></tr>
                                <tr><td>
                                    <div class="biaoqian">行驶速度</div>
                                    <div id="clsd"></div>
                                </td><td>
                                    <div class="biaoqian">加速度</div>
                                    <div id="cljsd"></div>
                                </td></tr>
                                <tr><td>
                                    <div class="biaoqian">比功率</div>
                                    <div id="bgl"></div>
                                </td><td>
                                    <div class="biaoqian">车道序号</div>
                                    <div>01</div>
                                </td></tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
            <div style="height:10px"></div>
            <div class="div4">
                <table  class="table table-bordered" style="margin-bottom:0px">
                    <tr>
                        <th>监测时间</th><th>车牌号码</th><th>监测结果</th><th>CO<sub>2</sub>(%)</th><th>CO(%)</th><th>NO(10<sup>-6</sup>)</th><th>HC(10<sup>-6</sup>)</th><th>不透光度</th>
                    </tr>
                    <tbody id="ycsjTable">
                        
                    </tbody>
                </table>
            </div>
            <div style="height:10px"></div>
            <table width="100%">
                <tr><td align="right"><a href="javascript:;" id="dtjcqka">当天监测情况</a></td></tr>
            </table>
        </div>
        <div class="ycsjdhk" id="jtlgxx" style="overflow:no">
            <div class="ydbiaoti">
                <table width="100%"><tr>
                    <td>交通流量信息</td>
                    <td align="right"><img src="/static/img/ico/del.png" class="delimg" id="jtlgxxgb"></td>
                </tr></table>
            </div>
            <div style="height:10px"></div>
            <table width="100%">
                <tr>
                    <td width="60%" valign="top" class="div4">
                        <div class="jtlgxxmap" style="height:280px;overflow:hidden;background-color: #000;">
                            <div class="jtlgxxmap" id="jtlgxxmap" style="height:340px;"></div>
                        </div>
                    </td>
                    <td style="width:10px"></td>
                    <td valign="top" class="div4">
                        <table width="100%">
                            <tr>
                                <td align="center">交通实时流量</td>
                            </tr>
                        </table>
                        <div id="jtlltb" style="width: 260px;height:260px;">
                            
                        </div>
                    </td>
                </tr>
            </table>
            <div style="height:10px"></div>
            <div class="div4">
                <table  class="table table-bordered" style="margin-bottom:0px">
                    <tr>
                        <th>微小型客车数</th><th>中型客车数</th><th>大型客车数</th><th>小型货车数</th><th>中型货车数</th><th>重型货车数</th>
                    </tr>
                    <tbody>
                        <tr>
                            <td class="cheliangsu" align="center"></td><td class="cheliangsu" align="center"></td><td class="cheliangsu" align="center"></td><td class="cheliangsu" align="center"></td><td class="cheliangsu" align="center"></td><td class="cheliangsu" align="center"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="height:10px"></div>
            <table width="100%">
                <tr><td align="right"><a href="javascript:;" id="drjtllqka">当日交通流量</a></td></tr>
            </table>
        </div>
        <div class="ycsjdhk" id="drjcqk">
            <div class="ydbiaoti">
                <table width="100%"><tr>
                    <td>当日监测情况</td>
                    <td align="right"><img src="/static/img/ico/del.png" class="delimg" id="drjcqkgb"></td>
                </tr></table>
            </div>
            <div style="height:10px"></div>
            <div style="overflow:auto;height:450px">
                <table class="table table-bordered" style="margin-bottom:0px">
                    <tr><th>监测时间</th><th>车牌号码</th><th>监测结果</th><th>CO<sub>2</sub>(%)</th><th>CO(%)</th><th>NO(10<sup>-6</sup>)</th><th>HC(10<sup>-6</sup>)</th><th>不透光度</th></tr>
                    <tbody id="drjcqktb"></tbody>
                </table>
            </div>
        </div>
        <div class="ycsjdhk" id="drjtllqk">
            <div class="ydbiaoti">
                <table width="100%"><tr>
                    <td>当日交通流量</td>
                    <td align="right"><img src="/static/img/ico/del.png" class="delimg" id="drjtllqkgb"></td>
                </tr></table>
            </div>
            <div style="height:10px"></div>
            <div style="overflow:auto;height:450px">
                <table class="table table-bordered" style="margin-bottom:0px">
                    <tr><th>监测时间</th><th>微小型客车数</th><th>中型客车数</th><th>大型客车数</th><th>小型货车数</th><th>中型货车数</th><th>重型货车数</th></tr>
                    <tbody id="drjtllqktb"></tbody>
                </table>
            </div>
        </div>
        <script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=5QUV6G5DqeH7ljQ8iGOnYOcc"></script>
        <script src="/static/js/Towadd26/echarts.min.js"></script>
        <script src="/static/js/Towadd26/bmap.js"></script>
        <script data-main="/static/js/Towadd26/gjdpsjzs.js?v=13" src="/static/js/require.min.js"></script>
    </body>
</html>
