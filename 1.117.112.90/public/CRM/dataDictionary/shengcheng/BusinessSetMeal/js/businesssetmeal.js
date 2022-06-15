    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Businesssetmeal = {};
                $("#Businesssetmeal input").each(function(i,v){
                    Businesssetmeal[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Businesssetmeal/save",{
                    Businesssetmeal:Businesssetmeal
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Businesssetmeal");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Businesssetmeal = {};
                $("#Businesssetmeal input").each(function(i,v){
                    Businesssetmeal[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Businesssetmeal/update",{
                    Businesssetmeal:Businesssetmeal
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Businesssetmeal");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Businesssetmeal/kill",{
                    BUSINESS_SET_MEAL_ID:$("#BUSINESS_SET_MEAL_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Businesssetmeal");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Businesssetmeal");
            });
        };
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});