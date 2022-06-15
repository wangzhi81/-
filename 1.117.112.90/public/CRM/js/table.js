//建立表格html函数
//_ths：表头数组
//_data：数据数组
//_oper：操作项html串
function crratTable(_ths,_data,_oper){
    var len = _ths.length;
    var strhtml = '<table class="table table-bordered">';
    strhtml += '<tr>';
    strhtml += '<th><input type="checkbox"></th>';
    $.each(_ths,function(i,v){
        strhtml += '<th>'+v+'</th>';
    });
    strhtml += '<th>操作</th>';
    strhtml += '</tr>';
    $.each(_data,function(i,v){
        strhtml += '<tr id="'+v[0]+'">';
        strhtml += '<td><input type="checkbox"></td>';
        for(var l=1;l<=len;l++){
            strhtml += '<td>'+v[l]+'</td>';
        }
        strhtml += '<td>'+_oper+'</td>';
        strhtml += '</tr>';
    });
    strhtml += '</table>';
    return strhtml;
}

function getTable(_ths,_data,_oper){
    var len = _ths.length;
    var strhtml = '<table class="table table-bordered">';
    strhtml += '<tr>';
    strhtml += '<th><input type="checkbox"></th>';
    $.each(_ths,function(i,v){
        strhtml += '<th>'+v['n']+'</th>';
    });
    strhtml += '<th>操作</th>';
    strhtml += '</tr>';
    $.each(_data.list_,function(i,v){
        strhtml += '<tr id="'+v[_data.idf]+'">';
        strhtml += '<td><input type="checkbox"></td>';
        $.each(_ths,function(ii,vv){
            strhtml += '<td>'+v[vv['f']]+'</td>';
        });
        strhtml += '<td>';
        $.each(_oper,function(ii,vv){
            strhtml += '<a href="#" onclick="'+vv['onclick']+'(this)">'+vv['text']+'</a>';
        });
        strhtml += '</td>';
        strhtml += '</tr>';
    });
    strhtml += '</table>';
    strhtml += '<table width="100%"><tr><td align="right"><span style="color:#888;margin:5px">共有'+_data.count_+'条， 每页显示：'+_data.pageSize+'条， 共'+_data.maxpage+'页， 当前为第'+_data.pageNow+'页</span><button class="btn btn-default" style="margin:5px" type="submit" onclick="Previouspage()">上一页</button><button class="btn btn-default" style="margin:5px" type="submit" onclick="Nextpage()">下一页</button></td></tr></table>';
    return strhtml;
}