<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"/www/wwwroot/erp.wangzhi81.com/public/../application/admin/view/textinformation/edit.html";i:1509718914;}*/ ?>
    <input type="hidden" id="SecondTitleInput" value="<?php echo $SecondTitle; ?>">
    <input type="hidden" id="ScriptFragment" value="<?php echo $ScriptFragment; ?>">
    <table class="FormTable" id="Textinformation">
        <tr>
            <td></td>
            <td>
                <input type="hidden" id="TEXT_INFORMATION_ID" value="<?php echo $TextInformation['TEXT_INFORMATION_ID']; ?>">
            </td>
        </tr>
        <tr>
            <td>文本标题：</td>
            <td><input type="text" id="text_title" value="<?php echo $TextInformation['text_title']; ?>"></td>
        </tr><tr>
            <td>文本内容：</td>
            <td id="text_content"><?php echo $TextInformation['text_content']; ?></td>
        </tr>
    </table>
    <div class="BottomButtons">
        <div class="Button" id="SaveEdit">保存</div><div class="Button" id="Cancellation">取消</div>
    </div>