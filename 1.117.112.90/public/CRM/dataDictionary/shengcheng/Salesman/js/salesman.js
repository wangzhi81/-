    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Salesman = {};
                $("#Salesman input").each(function(i,v){
                    Salesman[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Salesman/save",{
                    Salesman:Salesman
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Salesman");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Salesman = {};
                $("#Salesman input").each(function(i,v){
                    Salesman[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Salesman/update",{
                    Salesman:Salesman
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Salesman");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Salesman/kill",{
                    SALESMAN_ID:$("#SALESMAN_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Salesman");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Salesman");
            });
        };
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});