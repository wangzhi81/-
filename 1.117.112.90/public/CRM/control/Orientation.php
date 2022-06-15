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
	<div style="position:absolute;top:1px;left:1px;background:rgba(255,255,0,0.5);padding:2px">
	    <div>定位时间：<span id="ddwsj"></span></div>
	    <div>定位模式：<span id="dwms"></span></div>
	    <div>电量：<span id="diang"></span></div>
	</div>
</body>
</html>
<script src="../js/jquery.min.js"></script>
<script type="text/javascript">
    function shuaxin(){
        location.href = "Orientation.php?v=<?php echo rand();?>";
    }
    $(function(){
        setTimeout(shuaxin,60000);
        // 百度地图API功能
        var lbsIcon = new BMap.Icon("img/554200.png", new BMap.Size(32,32));
        var wifiIcon = new BMap.Icon("img/525013.png", new BMap.Size(32,32));
        var top_right_navigation = new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL}); 
        lbsIcon.setImageSize(new BMap.Size(32,32));
        wifiIcon.setImageSize(new BMap.Size(32,32));
    	var map = new BMap.Map("allmap");    // 创建Map实例
    	$.getJSON("getCli.php",function(locadata){
    	    var point = new BMap.Point(locadata.points[0].x,locadata.points[0].y);
    	    map.centerAndZoom(point, 15);  // 初始化地图,设置中心点坐标和地图级别
        	//map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
        	map.addControl(top_right_navigation);
        	var marker = new BMap.Marker(point);  // 创建标注
        	map.addOverlay(marker);               // 将标注添加到地图中
        	$("#ddwsj").text(locadata.time_);
        	$("#dwms").text(locadata.type);
        	$("#diang").text(locadata.ELECTRICITY);
        	$.each(locadata.lbss,function(i,v){
        	    var pt = new BMap.Point(v.B_LONGITUDE,v.B_LATITUDE);
                var marker2 = new BMap.Marker(pt,{icon:lbsIcon});
                map.addOverlay(marker2);
                var circle = new BMap.Circle(pt,v.d-130,{strokeColor:"blue", fillColor:"#F00", fillOpacity:0.1, strokeWeight:1});
                map.addOverlay(circle);
        	});
        	$.each(locadata.points,function(i,v){
    	        var pt = new BMap.Point(v.x,v.y);
    	        var marker2 = new BMap.Marker(pt); 
    	        //map.addOverlay(marker2);  
    	    });
        	
        	$.each(locadata.wifis,function(i,v){
    	        var pt = new BMap.Point(v.B_LONGITUDE,v.B_LATITUDE);
    	        var marker2 = new BMap.Marker(pt,{icon:wifiIcon});
    	        map.addOverlay(marker2);  
    	        var opts = {
            	  position : pt,    // 指定文本标注所在的地理位置
            	  offset   : new BMap.Size(0, 0)    //设置文本偏移量
            	}
            	var label = new BMap.Label(v.strength,opts); 
            	map.addOverlay(label);   
    	    });
        	marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
        	map.enableScrollWheelZoom(true);
        	$.post("getPath.php",{
        	    DEVICE_ID:"561118010016494"
        	},function(pathdata){
        	    var path = new Array();
    	        path.push(point);
        	    $.each(pathdata,function(i,v){
        	        var point2 =new BMap.Point(v.B_LONGITUDE, v.B_LATITUDE);
        	        path.push(point2);
        	    });
        	    var polyline = new BMap.Polyline(path,{strokeColor:"#F00", strokeWeight:1, strokeOpacity:1, strokeStyle:"dashed"});
        	    map.addOverlay(polyline);
        	},"json");
    	});
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