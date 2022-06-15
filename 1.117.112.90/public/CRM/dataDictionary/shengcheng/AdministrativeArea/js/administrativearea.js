    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Administrativearea = {};
                $("#Administrativearea input").each(function(i,v){
                    Administrativearea[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Administrativearea/save",{
                    Administrativearea:Administrativearea
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Administrativearea");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Administrativearea = {};
                $("#Administrativearea input").each(function(i,v){
                    Administrativearea[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Administrativearea/update",{
                    Administrativearea:Administrativearea
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Administrativearea");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Administrativearea/kill",{
                    ADMINISTRATIVE_AREA_ID:$("#ADMINISTRATIVE_AREA_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Administrativearea");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Administrativearea");
            });
        };
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});