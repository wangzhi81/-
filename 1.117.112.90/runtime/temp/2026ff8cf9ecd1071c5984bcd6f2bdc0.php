<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"/www/wwwroot/erp.wangzhi81.com/public/../application/admin/view/salesman/edit.html";i:1518851290;}*/ ?>
    <input type="hidden" id="SecondTitleInput" value="<?php echo $SecondTitle; ?>">
    <input type="hidden" id="ScriptFragment" value="<?php echo $ScriptFragment; ?>">
    <table class="FormTable" id="Salesman">
        <tr>
            <td></td>
            <td>
                <input type="hidden" id="SALESMAN_ID" value="<?php echo $Salesman['SALESMAN_ID']; ?>">
            </td>
        </tr>
        <tr>
            <td>姓名：</td>
            <td><input type="text" id="FULL_NAME" value="<?php echo $Salesman['FULL_NAME']; ?>"></td>
        </tr><tr>
            <td>手机号码：</td>
            <td><input type="text" id="PHONE_NUMBER" value="<?php echo $Salesman['PHONE_NUMBER']; ?>" readonly="readonly"></td>
        </tr><tr>
            <td>职务：</td>
            <td>
                <select id="serve_as_a_post" val="<?php echo $Salesman['serve_as_a_post']; ?>">
                    
                </select>
            </td>
        </tr><tr>
            <td>所属营业厅：</td>
            <td>
                <select id="affiliated_business_hall" val="<?php echo $Salesman['affiliated_business_hall']; ?>">
                    
                </select>
            </td>
        </tr>
    </table>
    <div class="BottomButtons">
        <div class="Button" id="SaveEdit">保存</div><div class="Button" id="Cancellation">取消</div>
    </div>