    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Housekeepingstaff = {};
                $("#Housekeepingstaff input").each(function(i,v){
                    Housekeepingstaff[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Housekeepingstaff/save",{
                    Housekeepingstaff:Housekeepingstaff
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Housekeepingstaff");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Housekeepingstaff = {};
                $("#Housekeepingstaff input").each(function(i,v){
                    Housekeepingstaff[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Housekeepingstaff/update",{
                    Housekeepingstaff:Housekeepingstaff
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Housekeepingstaff");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Housekeepingstaff/kill",{
                    HOUSEKEEPING_STAFF_ID:$("#HOUSEKEEPING_STAFF_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Housekeepingstaff");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Housekeepingstaff");
            });
        }
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});