    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Businesshall = {};
                $("#Businesshall input").each(function(i,v){
                    Businesshall[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Businesshall/save",{
                    Businesshall:Businesshall
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Businesshall");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Businesshall = {};
                $("#Businesshall input").each(function(i,v){
                    Businesshall[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Businesshall/update",{
                    Businesshall:Businesshall
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Businesshall");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Businesshall/kill",{
                    BUSINESS_HALL_ID:$("#BUSINESS_HALL_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Businesshall");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Businesshall");
            });
        };
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});