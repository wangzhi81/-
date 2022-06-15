<?php
    require_once dirname(__FILE__) .'/../control/pdo.php';
    $DEVICE_LISTs = pdoquery("select * from DEVICE_LIST where DEVICE_ID='4109194802'");
    $B_LONGITUDE = $DEVICE_LISTs[0]['B_LONGITUDE'];
    $B_LATITUDE = $DEVICE_LISTs[0]['B_LATITUDE'];
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
	<div style="position:absolute;top:10px;left:10px">
	    <?php echo $DEVICE_LISTs[0]['ONLINE_STATUS'];?>
	    电量：<?php echo $DEVICE_LISTs[0]['ELECTRICITY'];?>
	</div>
</body>
</html>
<script src="../js/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        // 百度地图API功能
    	var map = new BMap.Map("allmap");    // 创建Map实例
    	var point = new BMap.Point(<?php echo $B_LONGITUDE;?>, <?php echo $B_LATITUDE;?>);
    	map.centerAndZoom(point, 19);  // 初始化地图,设置中心点坐标和地图级别
    	map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
    	//map.setCurrentCity("北京");          // 设置地图显示的城市 此项是必须设置的
    	var marker = new BMap.Marker(point);  // 创建标注
    	map.addOverlay(marker);               // 将标注添加到地图中
    	marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
    	map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
    	var path = new Array();
    	path.push(point);
    	$.post("getDEVICE_TRAJECTORY.php",{
    	    DEVICE_ID:"4109194802"
    	},function(data){
    	    $(data).each(function(i,v){
    	        //alert(v.B_LONGITUDE);
    	        var point2 =new BMap.Point(v.B_LONGITUDE, v.B_LATITUDE);
    	        path.push(point2);
    	    });
    	    var polyline = new BMap.Polyline(path,{strokeColor:"blue", strokeWeight:2, strokeOpacity:0.5});
    	    map.addOverlay(polyline);
    	},"json");
    });
</script>
