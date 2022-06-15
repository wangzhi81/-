    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Userrightsallocationtable = {};
                $("#Userrightsallocationtable input").each(function(i,v){
                    Userrightsallocationtable[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Userrightsallocationtable/save",{
                    Userrightsallocationtable:Userrightsallocationtable
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Userrightsallocationtable");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Userrightsallocationtable = {};
                $("#Userrightsallocationtable input").each(function(i,v){
                    Userrightsallocationtable[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Userrightsallocationtable/update",{
                    Userrightsallocationtable:Userrightsallocationtable
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Userrightsallocationtable");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Userrightsallocationtable/kill",{
                    USER_RIGHTS_ALLOCATION_TABLE_ID:$("#USER_RIGHTS_ALLOCATION_TABLE_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Userrightsallocationtable");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Userrightsallocationtable");
            });
        };
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});