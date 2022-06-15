    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Broadbandperformance = {};
                $("#Broadbandperformance input").each(function(i,v){
                    Broadbandperformance[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Broadbandperformance/save",{
                    Broadbandperformance:Broadbandperformance
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Broadbandperformance");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Broadbandperformance = {};
                $("#Broadbandperformance input").each(function(i,v){
                    Broadbandperformance[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Broadbandperformance/update",{
                    Broadbandperformance:Broadbandperformance
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Broadbandperformance");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Broadbandperformance/kill",{
                    BROADBAND_PERFORMANCE_ID:$("#BROADBAND_PERFORMANCE_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Broadbandperformance");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Broadbandperformance");
            });
        };
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});