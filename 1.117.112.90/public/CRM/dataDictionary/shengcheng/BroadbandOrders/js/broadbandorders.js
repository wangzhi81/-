    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Broadbandorders = {};
                $("#Broadbandorders input").each(function(i,v){
                    Broadbandorders[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Broadbandorders/save",{
                    Broadbandorders:Broadbandorders
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Broadbandorders");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Broadbandorders = {};
                $("#Broadbandorders input").each(function(i,v){
                    Broadbandorders[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Broadbandorders/update",{
                    Broadbandorders:Broadbandorders
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Broadbandorders");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Broadbandorders/kill",{
                    BROADBAND_ORDERS_ID:$("#BROADBAND_ORDERS_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Broadbandorders");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Broadbandorders");
            });
        }
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});