    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Parametersetting = {};
                $("#Parametersetting input").each(function(i,v){
                    Parametersetting[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Parametersetting/save",{
                    Parametersetting:Parametersetting
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Parametersetting");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Parametersetting = {};
                $("#Parametersetting input").each(function(i,v){
                    Parametersetting[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Parametersetting/update",{
                    Parametersetting:Parametersetting
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Parametersetting");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Parametersetting/kill",{
                    PARAMETER_SETTING_ID:$("#PARAMETER_SETTING_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Parametersetting");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Parametersetting");
            });
        }
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});