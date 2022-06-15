    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Textinformation = {};
                $("#Textinformation input").each(function(i,v){
                    Textinformation[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Textinformation/save",{
                    Textinformation:Textinformation
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Textinformation");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Textinformation = {};
                $("#Textinformation input").each(function(i,v){
                    Textinformation[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Textinformation/update",{
                    Textinformation:Textinformation
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Textinformation");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Textinformation/kill",{
                    TEXT_INFORMATION_ID:$("#TEXT_INFORMATION_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Textinformation");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Textinformation");
            });
        }
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});