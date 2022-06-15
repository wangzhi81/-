<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<style type="text/css">
	body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
	</style>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=5QUV6G5DqeH7ljQ8iGOnYOcc"></script>
	<title>辅助指挥</title>
</head>
<body>
	<div id="allmap"></div>
	<div style="position:absolute;left:100px;top:100px;width:300px;display:none" id="fasong">
	    <div style="background-color:rgb(68,114,196);padding:10px;color:#FFF">
	        <table width="100%">
	            <tr>
	                <td>辅助指挥</td>
	                <td align="right"><img src="img/509835.png" width="16px" height="16px" style="cursor:pointer" id="guanbi"></td>
	            </tr>
	        </table>
	    </div>
	    <div style="background-color:#FFF;padding:10px">
	        <textarea style="width: 275px; height: 200px;"></textarea>
	        <table width="100%">
	            <tr><td align="center">
	                <button>发送</button>
	            </td></tr>
	        </table>
	    </div>
	</div>
</body>
</html>
<script src="../../js/jquery.min.js"></script>
<script type="text/javascript">
	// 百度地图API功能
	var map = new BMap.Map("allmap",{mapType:BMAP_SATELLITE_MAP});    // 创建Map实例
	map.centerAndZoom(new BMap.Point(121.731698, 39.425589), 13);  // 初始化地图,设置中心点坐标和地图级别
	map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
	map.setCurrentCity("大连");          // 设置地图显示的城市 此项是必须设置的
	map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
	function showInfo(e){
		alert(e.point.lng + ", " + e.point.lat);
	}
	function attribute(){
		$("#fasong").show();
	}
	//map.addEventListener("click", showInfo);
	var pt = new BMap.Point(121.738022, 39.407416);
	var myIcon = new BMap.Icon("img/585127.png", new BMap.Size(32,32));
	myIcon.setImageSize(new BMap.Size(32,32));
	var myIcon2 = new BMap.Icon("img/11724.png", new BMap.Size(32,32));
	myIcon2.setImageSize(new BMap.Size(32,32));
	var myIcon3 = new BMap.Icon("img/125.png", new BMap.Size(32,32));
	myIcon3.setImageSize(new BMap.Size(32,32));
	var marker = new BMap.Marker(pt,{icon:myIcon});
	map.addOverlay(marker);
	var points = new Array();
	points.push(new BMap.Point(121.735579, 39.438853));
	points.push(new BMap.Point(121.701659, 39.409869));
	points.push(new BMap.Point(121.75915, 39.410092));
	$.each(points,function(i,v){
	    var marker2 = new BMap.Marker(v,{icon:myIcon2});
	    map.addOverlay(marker2);
	});
	var points2 = new Array();
	points2.push(new BMap.Point(121.705396, 39.43328));
	points2.push(new BMap.Point(121.758863, 39.424586));
	points2.push(new BMap.Point(121.704533, 39.383996));
	points2.push(new BMap.Point(121.776398, 39.373511));
	$.each(points2,function(i,v){
	    var marker2 = new BMap.Marker(v,{icon:myIcon3});
	    map.addOverlay(marker2);
	});
	var sContent =
	"<h4 style='margin:0 0 5px 0;padding:0.2em 0'>XX某化工厂爆炸事故</h4>" + 
	"<table width='100%'>"+
	"<tr>"+
	"<td style='font-size:12px' valign='top'>"+
	"2015年8月5日下午14时40左右，江苏常州一化工厂爆炸，两个甲苯类储罐爆燃，现场黑烟滚滚。据了解，爆炸未造成人员伤亡。发生爆炸的是位于常州滨江化工园区的常州新东化工发展有限公司车间。新东化工是以氯碱和聚氯乙烯产品为主的综合性化工企业，规模较大。"+
	"</td>"+
	"<td valign='top'>"+
	"<img src='img/Img418765966.jpg' width='200px'>"+
	"</td>"+
	"</tr>"+
	"</table>";
	var opts = {
	  width : 400
	}
	var infoWindow = new BMap.InfoWindow(sContent,opts);
	marker.addEventListener("click", function(){
	    this.openInfoWindow(infoWindow);
	});
	
	function addMarker(point){
	  var marker = new BMap.Marker(point,{icon:myIcon});
	  var label = new BMap.Label("应急工作组",{offset:new BMap.Size(20,-10)});
	  marker.setLabel(label);
	  marker.addEventListener("click",attribute);
	  map.addOverlay(marker);
	}
	var bounds = map.getBounds();
	var sw = bounds.getSouthWest();
	var ne = bounds.getNorthEast();
	var lngSpan = Math.abs(sw.lng - ne.lng);
	var latSpan = Math.abs(ne.lat - sw.lat);
	//for (var i = 0; i < 25; i ++) {
	//	var point = new BMap.Point(sw.lng + lngSpan * (Math.random() * 0.7), ne.lat - latSpan * (Math.random() * 0.7));
	//	addMarker(point);
	//}
	$(function(){
	    $("#guanbi").click(function(){
	        $("#fasong").hide();
	    });
	});
</script>
