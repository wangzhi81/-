    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Housekeepingserviceclassification = {};
                $("#Housekeepingserviceclassification input").each(function(i,v){
                    Housekeepingserviceclassification[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Housekeepingserviceclassification/save",{
                    Housekeepingserviceclassification:Housekeepingserviceclassification
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Housekeepingserviceclassification");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Housekeepingserviceclassification = {};
                $("#Housekeepingserviceclassification input").each(function(i,v){
                    Housekeepingserviceclassification[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Housekeepingserviceclassification/update",{
                    Housekeepingserviceclassification:Housekeepingserviceclassification
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Housekeepingserviceclassification");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Housekeepingserviceclassification/kill",{
                    HOUSEKEEPING_SERVICE_CLASSIFICATION_ID:$("#HOUSEKEEPING_SERVICE_CLASSIFICATION_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Housekeepingserviceclassification");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Housekeepingserviceclassification");
            });
        }
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});