<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"/www/wwwroot/erp.wangzhi81.com/public/../application/admin/view/businesshall/add.html";i:1518358888;}*/ ?>
    <input type="hidden" id="SecondTitleInput" value="<?php echo $SecondTitle; ?>">
    <input type="hidden" id="ScriptFragment" value="<?php echo $ScriptFragment; ?>">
    <table class="FormTable" id="Businesshall">
        <tr>
            <td>营业厅名称：</td>
            <td><input type="text" id="business_hall_name" value=""></td>
        </tr><tr>
            <td>地址：</td>
            <td><input type="text" id="address" value=""></td>
        </tr><tr>
            <td>负责人：</td>
            <td><input type="text" id="person_in_charge" value=""></td>
        </tr><tr>
            <td>联系电话：</td>
            <td><input type="text" id="contact_number" value=""></td>
        </tr><tr>
            <td>显示顺序：</td>
            <td><input type="text" id="display_order" value=""></td>
        </tr>
    </table>
    <div class="BottomButtons">
        <div class="Button" id="SaveData">保存</div><div class="Button" id="Cancellation">取消</div>
    </div>