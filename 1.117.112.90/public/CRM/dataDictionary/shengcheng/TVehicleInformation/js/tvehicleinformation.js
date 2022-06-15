    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Tvehicleinformation = {};
                $("#Tvehicleinformation input").each(function(i,v){
                    Tvehicleinformation[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Tvehicleinformation/save",{
                    Tvehicleinformation:Tvehicleinformation
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Tvehicleinformation");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Tvehicleinformation = {};
                $("#Tvehicleinformation input").each(function(i,v){
                    Tvehicleinformation[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Tvehicleinformation/update",{
                    Tvehicleinformation:Tvehicleinformation
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Tvehicleinformation");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Tvehicleinformation/kill",{
                    T_VEHICLE_INFORMATION_ID:$("#T_VEHICLE_INFORMATION_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Tvehicleinformation");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Tvehicleinformation");
            });
        };
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});