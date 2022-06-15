    <input type="hidden" id="SecondTitleInput" value="{$SecondTitle}">
    <input type="hidden" id="ScriptFragment" value="{$ScriptFragment}">
    <div>是否确认删除以下数据？</div>
    <table class="FormTable" id="Broadbandpackage">
        <tr>
            <td></td>
            <td>
                <input type="hidden" id="BROADBAND_PACKAGE_ID" value="{$BroadbandPackage.BROADBAND_PACKAGE_ID}">
            </td>
        </tr>
        {table}
    </table>
    <div class="BottomButtons">
        <div class="Button" id="Delete">删除</div><div class="Button" id="Cancellation">取消</div>
    </div>