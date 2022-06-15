<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"/www/wwwroot/erp.wangzhi81.com/public/../application/admin/view/index/addwechatmenus.html";i:1508041442;}*/ ?>
    <input type="hidden" id="SecondTitleInput" value="<?php echo $SecondTitle; ?>">
    <input type="hidden" id="ScriptFragment" value="<?php echo $ScriptFragment; ?>">
    <input type="hidden" id="WECHAT_MENU_ID" value="<?php echo $WechatMenu['WECHAT_MENU_ID']; ?>">
    <table>
        <tr>
            <td valign="top">
                <table class="NoBorder wechat_menu" id="wechat_menu">
                    <tr>
                        <td>
                            二级菜单：
                        </td>
                        <td>
                            <table class="table-bordered Level2" style="width:300px">
                                <tr>
                                    <td><div class="Menu1" MenuUrl="">&nbsp;</div></td><td><div class="Menu2" MenuUrl="">&nbsp;</div></td><td><div class="Menu3" MenuUrl="">&nbsp;</div></td>
                                </tr>
                                <tr>
                                    <td><div class="Menu1" MenuUrl="">&nbsp;</div></td><td><div class="Menu2" MenuUrl="">&nbsp;</div></td><td><div class="Menu3" MenuUrl="">&nbsp;</div></td>
                                </tr>
                                <tr>
                                    <td><div class="Menu1" MenuUrl="">&nbsp;</div></td><td><div class="Menu2" MenuUrl="">&nbsp;</div></td><td><div class="Menu3" MenuUrl="">&nbsp;</div></td>
                                </tr>
                                <tr>
                                    <td><div class="Menu1" MenuUrl="">&nbsp;</div></td><td><div class="Menu2" MenuUrl="">&nbsp;</div></td><td><div class="Menu3" MenuUrl="">&nbsp;</div></td>
                                </tr>
                                <tr>
                                    <td><div class="Menu1" MenuUrl="">&nbsp;</div></td><td><div class="Menu2" MenuUrl="">&nbsp;</div></td><td><div class="Menu3" MenuUrl="">&nbsp;</div></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            一级菜单：
                        </td>
                        <td>
                            <table class="table-bordered Level1" style="width:300px">
                                <tr>
                                    <td><div class="Menu1" MenuUrl="">&nbsp;</div></td><td><div class="Menu2" MenuUrl="">&nbsp;</div></td><td><div class="Menu3" MenuUrl="">&nbsp;</div></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="width:10px"></td>
            <td valign="top">
                <table class="formTable">
                    <tr>
                        <td>菜单名称：</td>
                        <td><input type="text" value="" id="MenuName"></td>
                    </tr>
                    <tr>
                        <td>链接地址：</td>
                        <td><input type="text" value="" style="width:300px" id="MenuUrl"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    
    <div class="BottomButtons">
        <div class="Button" id="SaveData">保存</div><div class="Button" id="Cancellation">取消</div>
    </div>