    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Broadbandinstallationresources = {};
                $("#Broadbandinstallationresources input").each(function(i,v){
                    Broadbandinstallationresources[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Broadbandinstallationresources/save",{
                    Broadbandinstallationresources:Broadbandinstallationresources
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Broadbandinstallationresources");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Broadbandinstallationresources = {};
                $("#Broadbandinstallationresources input").each(function(i,v){
                    Broadbandinstallationresources[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Broadbandinstallationresources/update",{
                    Broadbandinstallationresources:Broadbandinstallationresources
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Broadbandinstallationresources");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Broadbandinstallationresources/kill",{
                    BROADBAND_INSTALLATION_RESOURCES_ID:$("#BROADBAND_INSTALLATION_RESOURCES_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Broadbandinstallationresources");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Broadbandinstallationresources");
            });
        }
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});