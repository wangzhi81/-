    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Finalperformancecoefficient = {};
                $("#Finalperformancecoefficient input").each(function(i,v){
                    Finalperformancecoefficient[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Finalperformancecoefficient/save",{
                    Finalperformancecoefficient:Finalperformancecoefficient
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Finalperformancecoefficient");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Finalperformancecoefficient = {};
                $("#Finalperformancecoefficient input").each(function(i,v){
                    Finalperformancecoefficient[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Finalperformancecoefficient/update",{
                    Finalperformancecoefficient:Finalperformancecoefficient
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Finalperformancecoefficient");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Finalperformancecoefficient/kill",{
                    FINAL_PERFORMANCE_COEFFICIENT_ID:$("#FINAL_PERFORMANCE_COEFFICIENT_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Finalperformancecoefficient");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Finalperformancecoefficient");
            });
        };
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});