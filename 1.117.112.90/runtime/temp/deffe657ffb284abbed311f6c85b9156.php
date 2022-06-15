<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:92:"/www/wwwroot/erp.wangzhi81.com/public/../application/index/view/commodity/getcommoditys.html";i:1552096448;}*/ ?>
<?php if(is_array($commodity_managements) || $commodity_managements instanceof \think\Collection || $commodity_managements instanceof \think\Paginator): $i = 0; $__LIST__ = $commodity_managements;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <div style="height:10px;background-color:#ddd;"></div>
        <div style="padding:10px">
            <table width="100%">
                <tr>
                    <td style="width:80px;height:80px" valign="middle" align="center">
                        <img src="<?php echo $vo['commodity_pictures']; ?>" class="img-responsive" style="width:70px;height:70px">
                    </td>
                    <td valign="top">
                        <div style="padding:10px;height:60px">
                            <div><?php echo $vo['trade_name']; ?></div>
                            <div>单价：<?php echo $vo['unit_price']; ?></div>
                        </div>
                        <div style="height:20px;text-align:right">
                            <a href="/index/Commodity/edit/id/<?php echo $vo['COMMODITY_MANAGEMENT_ID']; ?>">修改</a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
<?php endforeach; endif; else: echo "" ;endif; ?>
