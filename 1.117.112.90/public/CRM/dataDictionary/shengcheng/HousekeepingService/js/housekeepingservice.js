    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Housekeepingservice = {};
                $("#Housekeepingservice input").each(function(i,v){
                    Housekeepingservice[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Housekeepingservice/save",{
                    Housekeepingservice:Housekeepingservice
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Housekeepingservice");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Housekeepingservice = {};
                $("#Housekeepingservice input").each(function(i,v){
                    Housekeepingservice[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Housekeepingservice/update",{
                    Housekeepingservice:Housekeepingservice
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Housekeepingservice");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Housekeepingservice/kill",{
                    HOUSEKEEPING_SERVICE_ID:$("#HOUSEKEEPING_SERVICE_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Housekeepingservice");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Housekeepingservice");
            });
        }
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});