    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Finalperformance = {};
                $("#Finalperformance input").each(function(i,v){
                    Finalperformance[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Finalperformance/save",{
                    Finalperformance:Finalperformance
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Finalperformance");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Finalperformance = {};
                $("#Finalperformance input").each(function(i,v){
                    Finalperformance[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Finalperformance/update",{
                    Finalperformance:Finalperformance
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Finalperformance");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Finalperformance/kill",{
                    FINAL_PERFORMANCE_ID:$("#FINAL_PERFORMANCE_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Finalperformance");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Finalperformance");
            });
        };
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});