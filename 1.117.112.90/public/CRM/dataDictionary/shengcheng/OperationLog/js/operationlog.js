    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Operationlog = {};
                $("#Operationlog input").each(function(i,v){
                    Operationlog[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Operationlog/save",{
                    Operationlog:Operationlog
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Operationlog");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Operationlog = {};
                $("#Operationlog input").each(function(i,v){
                    Operationlog[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Operationlog/update",{
                    Operationlog:Operationlog
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Operationlog");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Operationlog/kill",{
                    OPERATION_LOG_ID:$("#OPERATION_LOG_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Operationlog");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Operationlog");
            });
        }
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});