<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<style type="text/css">
	body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
	</style>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=5QUV6G5DqeH7ljQ8iGOnYOcc"></script>
	<title>值守防范</title>
</head>
<body>
	<div id="allmap"></div>
	<div style="position:absolute;left:100px;top:100px;display:none;border:solid 1px #000;" id="fasong">
	    <div style="background-color:rgb(68,114,196);padding:10px;color:#FFF">
	        <table width="100%">
	            <tr>
	                <td>空气质量24监测值</td>
	                <td align="right"><img src="img/509835.png" width="16px" height="16px" style="cursor:pointer" id="guanbi"></td>
	            </tr>
	        </table>
	    </div>
	    <div style="background-color:#FFF;padding:10px">
	        <img src="img/kqzl.png">
	    </div>
	</div>
	<div style="position:absolute;left:100px;top:100px;display:none;border:solid 1px #000;" id="wry">
	    <div style="background-color:rgb(68,114,196);padding:10px;color:#FFF">
	        <table width="100%">
	            <tr>
	                <td>固定烟气污染源24监测曲线</td>
	                <td align="right"><img src="img/509835.png" width="16px" height="16px" style="cursor:pointer" id="wyrgb"></td>
	            </tr>
	        </table>
	    </div>
	    <div style="background-color:#FFF;padding:10px">
	        <img src="img/wry.png">
	    </div>
	</div>
</body>
</html>
<script src="../../js/jquery.min.js"></script>
<script type="text/javascript">
	// 百度地图API功能
	var map = new BMap.Map("allmap");    // 创建Map实例
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
	function attribute2(){
		$("#wry").show();
	}
	//map.addEventListener("click", showInfo);
	var pt = new BMap.Point(121.730548, 39.437962);
	var myIcon = new BMap.Icon("img/525013.png", new BMap.Size(32,32));
	var myIcon2 = new BMap.Icon("img/1208260.png", new BMap.Size(32,32));
	myIcon.setImageSize(new BMap.Size(32,32));
	myIcon2.setImageSize(new BMap.Size(32,32));
	
	function addMarker(point){
	  var marker = new BMap.Marker(point,{icon:myIcon});
	  var label = new BMap.Label("大气监测点位",{offset:new BMap.Size(20,-10)});
	  marker.setLabel(label);
	  marker.addEventListener("click",attribute);
	  map.addOverlay(marker);
	}
	function addMarkerf(point){
	  var marker = new BMap.Marker(point,{icon:myIcon2});
	  var label = new BMap.Label("风险源",{offset:new BMap.Size(20,-10)});
	  marker.setLabel(label);
	  marker.addEventListener("click",attribute2);
	  map.addOverlay(marker);
	}
	var bounds = map.getBounds();
	var sw = bounds.getSouthWest();
	var ne = bounds.getNorthEast();
	var lngSpan = Math.abs(sw.lng - ne.lng);
	var latSpan = Math.abs(ne.lat - sw.lat);
	for (var i = 0; i < 10; i ++) {
		var point = new BMap.Point(sw.lng + lngSpan * (Math.random() * 0.7), ne.lat - latSpan * (Math.random() * 0.7));
		addMarker(point);
	}
	for (var i = 0; i < 25; i ++) {
		var point = new BMap.Point(sw.lng + lngSpan * (Math.random() * 0.7), ne.lat - latSpan * (Math.random() * 0.7));
		addMarkerf(point);
	}
	$(function(){
	    $("#guanbi").click(function(){
	        $("#fasong").hide();
	    });
	    $("#wyrgb").click(function(){
	        $("#wry").hide();
	    });
	    
	});
</script>
