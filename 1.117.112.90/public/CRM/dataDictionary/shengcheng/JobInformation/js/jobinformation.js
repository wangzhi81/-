    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Jobinformation = {};
                $("#Jobinformation input").each(function(i,v){
                    Jobinformation[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Jobinformation/save",{
                    Jobinformation:Jobinformation
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Jobinformation");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Jobinformation = {};
                $("#Jobinformation input").each(function(i,v){
                    Jobinformation[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Jobinformation/update",{
                    Jobinformation:Jobinformation
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Jobinformation");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Jobinformation/kill",{
                    JOB_INFORMATION_ID:$("#JOB_INFORMATION_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Jobinformation");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Jobinformation");
            });
        };
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});