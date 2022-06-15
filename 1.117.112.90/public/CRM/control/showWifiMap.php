<?php
    require_once dirname(__FILE__) .'/pdo.php';
    
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<style type="text/css">
	body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
	</style>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=5QUV6G5DqeH7ljQ8iGOnYOcc"></script>
	<title>地图展示</title>
</head>
<body>
	<div id="allmap"></div>
</body>
</html>
<script src="../js/jquery.min.js"></script>
<script type="text/javascript">
    
    $(function(){
        // 百度地图API功能
        var lbsIcon = new BMap.Icon("img/554200.png", new BMap.Size(32,32));
        var wifiIcon = new BMap.Icon("img/525013.png", new BMap.Size(32,32));
        var top_right_navigation = new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL}); 
        lbsIcon.setImageSize(new BMap.Size(32,32));
        wifiIcon.setImageSize(new BMap.Size(32,32));
    	var map = new BMap.Map("allmap");    // 创建Map实例
    	$.getJSON("getWifi_data.php",function(locadata){
    	    var point = new BMap.Point(locadata[0].B_LONGITUDE,locadata[0].B_LATITUDE);
    	    map.centerAndZoom(point, 15);  // 初始化地图,设置中心点坐标和地图级别
        	//map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
        	map.addControl(top_right_navigation);
        	var marker = new BMap.Marker(point);  // 创建标注
        	map.addOverlay(marker);               // 将标注添加到地图中
        	$.each(locadata,function(i,v){
        	    var pt = new BMap.Point(v.B_LONGITUDE,v.B_LATITUDE);
                var marker2 = new BMap.Marker(pt,{icon:wifiIcon});
                map.addOverlay(marker2);
        	});
    	});
    	$.getJSON("getBase_station_data.php",function(locadata){
    	    var point = new BMap.Point(locadata[0].B_LONGITUDE,locadata[0].B_LATITUDE);
    	    map.centerAndZoom(point, 15);  // 初始化地图,设置中心点坐标和地图级别
        	//map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
        	map.addControl(top_right_navigation);
        	var marker = new BMap.Marker(point);  // 创建标注
        	map.addOverlay(marker);               // 将标注添加到地图中
        	$.each(locadata,function(i,v){
        	    var pt = new BMap.Point(v.B_LONGITUDE,v.B_LATITUDE);
                var marker2 = new BMap.Marker(pt,{icon:lbsIcon});
                map.addOverlay(marker2);
        	});
    	});
    	map.enableScrollWheelZoom(true); 
    	/*$.getJSON("lbswifiloca.php",function(locadata){
    	    var point = new BMap.Point(locadata.x,locadata.y);
    	    map.centerAndZoom("沈阳市");  // 初始化地图,设置中心点坐标和地图级别
        	map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
        	var marker = new BMap.Marker(point);  // 创建标注
        	map.addOverlay(marker);               // 将标注添加到地图中
    	    $.each(locadata,function(i,v){
        	    var pt = new BMap.Point(v.x,v.y);
                var marker2 = new BMap.Marker(pt,{icon:lbsIcon});
                map.addOverlay(marker2);
        	});
        	map.enableScrollWheelZoom(true);
    	});*/
    });
</script>