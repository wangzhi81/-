    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Unifiedorder = {};
                $("#Unifiedorder input").each(function(i,v){
                    Unifiedorder[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Unifiedorder/save",{
                    Unifiedorder:Unifiedorder
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Unifiedorder");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Unifiedorder = {};
                $("#Unifiedorder input").each(function(i,v){
                    Unifiedorder[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Unifiedorder/update",{
                    Unifiedorder:Unifiedorder
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Unifiedorder");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Unifiedorder/kill",{
                    UNIFIED_ORDER_ID:$("#UNIFIED_ORDER_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Unifiedorder");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Unifiedorder");
            });
        };
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});