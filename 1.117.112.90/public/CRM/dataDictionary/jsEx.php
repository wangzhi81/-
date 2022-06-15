    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Broadbandpackage = {};
                $("#Broadbandpackage input").each(function(i,v){
                    Broadbandpackage[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Broadbandpackage/save",{
                    Broadbandpackage:Broadbandpackage
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Broadbandpackage");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Broadbandpackage = {};
                $("#Broadbandpackage input").each(function(i,v){
                    Broadbandpackage[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Broadbandpackage/update",{
                    Broadbandpackage:Broadbandpackage
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Broadbandpackage");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Broadbandpackage/kill",{
                    BROADBAND_PACKAGE_ID:$("#BROADBAND_PACKAGE_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Broadbandpackage");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Broadbandpackage");
            });
        };
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});