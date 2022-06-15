<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:97:"/www/wwwroot/erp.wangzhi81.com/public/../application/admin/view/broadbandorders/query_panels.html";i:1535811236;}*/ ?>
<table width="100%">
    <tr>
        <td style="width:100px" align="right">
            开户人：
        </td>
        <td style="width:200px">
            <input type="text" class="form-control QueryCriteria" id="full_name">
        </td>
        <td style="width:100px" align="right">
            手机号：
        </td>
        <td style="width:200px">
            <input type="text" class="form-control QueryCriteria" id="phone_number">
        </td>
        <td style="width:100px" align="right">
            姓名：
        </td>
        <td style="width:200px">
            <input type="text" class="form-control QueryCriteria" id="master_name">
        </td>
    </tr>
    <tr>
        <td style="height:10px"></td>
    </tr>
    <tr>
        <td align="right">
            营业厅：
        </td>
        <td>
            <select class="form-control QueryCriteria" id="affiliated_business_hall"></select>
        </td>
        <td align="right">业务状态：</td>
        <td>
            <select class="form-control QueryCriteria" id="business_state">
                <option value="">所有</option>
                <option value="已下单">已下单</option>
                <option value="录入完成">录入完成</option>
                <option value="安装完成">安装完成</option>
                <option value="票据已派发">票据已派发</option>
                <option value="订单已完成">订单已完成</option>
            </select>
        </td>
    </tr>
    <tr>
        <td style="height:10px"></td>
    </tr>
    <tr>
        <td align="right">
            提交时间：
        </td>
        <td colspan="2">
            <table>
                <tr>
                    <td>
                        <div class='input-group date' id='submission_time_div1'>  
                            <input type='text' class="form-control QueryCriteria" id="submission_time1" data-date-format="yyyy-mm-dd" readonly="readonly" style="background-color:#FFF"/>  
                            <span class="input-group-addon">  
                                <span class="glyphicon glyphicon-calendar"></span>  
                            </span>  
                        </div>
                    </td>
                    <td>~</td>
                    <td>
                        <div class='input-group date' id='submission_time_div2'>  
                            <input type='text' class="form-control QueryCriteria" id="submission_time2" data-date-format="yyyy-mm-dd" readonly="readonly" style="background-color:#FFF"/>  
                            <span class="input-group-addon">  
                                <span class="glyphicon glyphicon-calendar"></span>  
                            </span>  
                        </div>
                    </td>
                </tr>
            </table>
        </td>
        <td></td><td></td>
        <td align="right">
            
        </td>
    </tr>
</table>
<div style="height:10px"></div>
<table width="100%">
    <tr>
        <td align="right" style="width:100px">底商：</td><td style="width:200px"><input type="text" class="form-control QueryCriteria" id="dishang"></td>
        <td align="right" style="width:100px">业务员：</td><td style="width:200px"><input type="text" class="form-control QueryCriteria" id="yewuyuan"></td>
        <td align="right">
            <button type="button" class="btn btn-primary" id="Inquire">查询</button>
        </td>
    </tr>
</table>
<div id="huidiao" style="display:none"></div>