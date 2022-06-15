    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Merchantorder = {};
                $("#Merchantorder input").each(function(i,v){
                    Merchantorder[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Merchantorder/save",{
                    Merchantorder:Merchantorder
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Merchantorder");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Merchantorder = {};
                $("#Merchantorder input").each(function(i,v){
                    Merchantorder[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Merchantorder/update",{
                    Merchantorder:Merchantorder
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Merchantorder");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Merchantorder/kill",{
                    MERCHANT_ORDER_ID:$("#MERCHANT_ORDER_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Merchantorder");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Merchantorder");
            });
        };
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});