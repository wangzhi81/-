    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Deshanginformation = {};
                $("#Deshanginformation input").each(function(i,v){
                    Deshanginformation[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Deshanginformation/save",{
                    Deshanginformation:Deshanginformation
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Deshanginformation");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Deshanginformation = {};
                $("#Deshanginformation input").each(function(i,v){
                    Deshanginformation[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Deshanginformation/update",{
                    Deshanginformation:Deshanginformation
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Deshanginformation");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Deshanginformation/kill",{
                    DESHANG_INFORMATION_ID:$("#DESHANG_INFORMATION_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Deshanginformation");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Deshanginformation");
            });
        };
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});