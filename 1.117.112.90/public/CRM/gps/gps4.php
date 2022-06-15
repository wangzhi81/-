<?php
    require_once dirname(__FILE__) .'/../control/pdo.php';
    $DEVICE_LISTs = pdoquery("select * from DEVICE_LIST where DEVICE_ID='561118010016494'");
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
    	var point = new BMap.Point(123.436245,41.707483);
    	map.centerAndZoom(point, 15);  // 初始化地图,设置中心点坐标和地图级别
    	map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
    	//map.setCurrentCity("北京");          // 设置地图显示的城市 此项是必须设置的
    	var marker = new BMap.Marker(point);  // 创建标注
    	map.addOverlay(marker);               // 将标注添加到地图中
    	<?php
    	    $BASE_STATION_DATAs = pdoquery("select * from WIFI_DATA,WIFI_LOCATION_DATA where GET_RESULTS='获取成功' and WIFI_DATA.WIFI_DATA_ID=WIFI_LOCATION_DATA.WIFI_ID");
    	    foreach ($BASE_STATION_DATAs as $key => $value) {
    	        $SIGNAL_INTENSITY = $value['SIGNAL_INTENSITY'];
    	        $ACCURACY = $value['ACCURACY'];
    	        $ADDRESS = $value['ADDRESS'];
    	        
    	        //$SIGNAL_INTENSITY = (100-$SIGNAL_INTENSITY)*5;
    	        $SIGNAL_INTENSITY = pow(10,((abs($SIGNAL_INTENSITY)-15)/(10*3.25)));
    	        echo 'map.addOverlay(new BMap.Marker(new BMap.Point('.$value['B_LONGITUDE'].','.$value['B_LATITUDE'].')));';
    	        echo 'map.addOverlay(new BMap.Circle(new BMap.Point('.$value['B_LONGITUDE'].','.$value['B_LATITUDE'].'),'.$SIGNAL_INTENSITY.',{strokeColor:"blue", strokeWeight:2, fillOpacity:0.1}));';
    	        echo 'map.addOverlay(new BMap.Label("'.$value['SIGNAL_INTENSITY'].'", {position : new BMap.Point('.$value['B_LONGITUDE'].','.$value['B_LATITUDE'].')}));';
    	        
    	    }
    	?>
    	//map.addOverlay(new BMap.Label("", {position : point}));
    	//marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
    	map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
    	//map.addEventListener("click",function(e){
    	//	alert(e.point.lng + "," + e.point.lat);
    	//});
    	//var myDis = new BMapLib.DistanceTool(map);
    	//map.addEventListener("load",function(){
    	//	myDis.open();  //开启鼠标测距
    		//myDis.close();  //关闭鼠标测距大
    	//});
    });
</script>
