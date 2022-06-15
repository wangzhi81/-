<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"/www/wwwroot/erp.wangzhi81.com/public/../application/admin/view/broadbandorders/audit.html";i:1530498738;}*/ ?>
    <input type="hidden" id="SecondTitleInput" value="<?php echo $SecondTitle; ?>">
    <input type="hidden" id="ScriptFragment" value="<?php echo $ScriptFragment; ?>">
    <table>
        <tr>
            <td valign="top">
                <table class="FormTable" id="Broadbandorders" style="margin-top:-30px">
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" id="BROADBAND_ORDERS_ID" value="<?php echo $BroadbandOrders['BROADBAND_ORDERS_ID']; ?>">
                        </td>
                    </tr><tr>
                        <td>开户人：</td>
                        <td><?php echo $BroadbandOrders['full_name']; ?></td>
                    </tr><tr>
                        <td>业务状态：</td>
                        <td id="business_state"><?php echo $BroadbandOrders['business_state']; ?></td>
                    </tr>
                    <tr>
                        <td>主号姓名：</td>
                        <td><?php echo $BroadbandOrders['master_name']; ?></td>
                    </tr><tr>
                        <td>手机号码：</td>
                        <td><?php echo $BroadbandOrders['phone_number']; ?></td>
                    </tr><tr>
                        <td>接入地址：</td>
                        <td><?php echo $BroadbandOrders['access_address']; ?></td>
                    </tr><tr>
                        <td>行政区：</td>
                        <td><?php echo $BroadbandOrders['administrative_area']; ?></td>
                    </tr><tr>
                        <td>社区：</td>
                        <td><?php echo $BroadbandOrders['community']; ?></td>
                    </tr><tr>
                        <td>套餐名称：</td>
                        <td><?php echo $BroadbandOrders['package_name']; ?></td>
                    </tr><tr>
                        <td>支付状态：</td>
                        <td><?php echo $BroadbandOrders['whether_to_pay']; if($BroadbandOrders['whether_to_pay'] == '已支付'): ?>
                                <span style="color:#F00">￥<?php echo $BroadbandOrders['amount_of_payment']; ?></span>
                            <?php endif; if($BroadbandOrders['whether_to_pay'] == '未支付'): ?>
                                <button type="button" class="btn btn-primary btn-xs" id="xianxiask">线下收款</button>
                            <?php endif; ?>
                        </td>
                    </tr><tr>
                        <td>接入方式：</td>
                        <td><?php echo $BroadbandOrders['access_mode']; ?></td>
                    </tr><tr>
                        <td>身份证正面：</td>
                        <td><?php echo $BroadbandOrders['front_of_id_card']; ?></td>
                    </tr><tr>
                        <td>身份证反面：</td>
                        <td><?php echo $BroadbandOrders['reverse_of_id_card']; ?></td>
                    </tr><tr>
                        <td>备注：</td>
                        <td><?php echo $BroadbandOrders['remarks']; ?></td>
                    </tr>
                    <tr>
                        <td>上次退回原因：</td>
                        <td><?php echo $BroadbandOrders['reasons_for_return']; ?></td>
                    </tr>
                </table>
            </td>
            <td style="width:10px"></td>
            <td valign="top">
                <p>操作日志：</p>
                <div class="operation_log" id="operation_log" style="margin-left: 10px;">
                    
                </div>
            </td>
        </tr>
    </table>
    
    <div class="BottomButtons">
        <!--<div class="Button" id="Approved">审核通过</div>-->
        <div class="Button State" id="InputComplete">录入完成</div>
        <div class="Button State" id="InstallationComplete">安装完成</div>
        <div class="Button State" id="BillsIssued">票据已派发</div>
        <div class="Button State" id="BillReturned">订单已完成</div>
        <div class="Button" id="Return">退回</div><div class="Button" id="Cancel">取消</div>
    </div>
    <div class="ModalDialog" id="ReturnReasons" style="width:400px">
        <div class="ModalDialogTitle">请输入退回原因</div>
        <div class="ModalDialogContent"><textarea id="reasons_for_return" class="form-control"></textarea></div>
        <div class="text-center">
            <button type="button" class="btn btn-primary" id="SaveReturnReason">保存退回原因</button>
            <button type="button" class="btn btn-default" id="CancelReturns">取消</button>
        </div>
    </div>
    <div class="ModalDialog" id="zhifuje" style="width:400px">
        <div class="ModalDialogTitle">线下支付确认</div>
        <div class="ModalDialogContent">
            <table width="100%">
                <tr>
                    <td>支付金额：</td><td><input type="text" class="form-control QueryCriteria" id="amount_of_payment"></td>
                </tr>
                <tr><td style="height:10px"></td></tr>
                <tr>
                    <td>备注：</td>
                    <td>
                        <textarea id="remarks" class="form-control"></textarea>
                    </td>
                </tr>
            </table>
        </div>
        <div class="text-center">
            <button type="button" class="btn btn-primary" id="Savezhifuje">确认收款</button>
            <button type="button" class="btn btn-default" id="Cancelzhifuje">取消</button>
        </div>
    </div>