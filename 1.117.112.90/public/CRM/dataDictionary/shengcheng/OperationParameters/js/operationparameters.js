    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Operationparameters = {};
                $("#Operationparameters input").each(function(i,v){
                    Operationparameters[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Operationparameters/save",{
                    Operationparameters:Operationparameters
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Operationparameters");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Operationparameters = {};
                $("#Operationparameters input").each(function(i,v){
                    Operationparameters[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Operationparameters/update",{
                    Operationparameters:Operationparameters
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Operationparameters");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Operationparameters/kill",{
                    OPERATION_PARAMETERS_ID:$("#OPERATION_PARAMETERS_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Operationparameters");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Operationparameters");
            });
        }
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});