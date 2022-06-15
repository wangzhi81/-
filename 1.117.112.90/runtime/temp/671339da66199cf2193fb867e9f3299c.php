<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:100:"/www/wwwroot/erp.wangzhi81.com/public/../application/index/view/customer/getcustomermanagements.html";i:1549858880;}*/ ?>
<?php if(is_array($CustomerManagements) || $CustomerManagements instanceof \think\Collection || $CustomerManagements instanceof \think\Paginator): $i = 0; $__LIST__ = $CustomerManagements;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <div style="height:10px;background-color:#ddd;"></div>
        <div style="padding:10px">
            <table width="100%">
                <tr>
                    <td style="width:80px;height:80px" valign="middle" align="center">
                        <img src="<?php echo $vo['photo']; ?>" class="img-responsive" style="width:70px;height:70px">
                    </td>
                    <td valign="top">
                        <div style="padding:10px;height:60px">
                            <?php echo $vo['full_name']; ?><br>
                            <?php echo $vo['mobile_phone']; ?><br>
                            <?php echo $vo['shipping_address']; ?>
                        </div>
                        <div style="height:20px;text-align:right">
                            <a href="/index/Customer/edit/id/<?php echo $vo['CUSTOMER_MANAGEMENT_ID']; ?>">修改</a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
<?php endforeach; endif; else: echo "" ;endif; ?>
