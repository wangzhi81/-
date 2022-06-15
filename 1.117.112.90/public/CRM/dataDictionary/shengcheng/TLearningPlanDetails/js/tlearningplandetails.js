    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Tlearningplandetails = {};
                $("#Tlearningplandetails input").each(function(i,v){
                    Tlearningplandetails[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Tlearningplandetails/save",{
                    Tlearningplandetails:Tlearningplandetails
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Tlearningplandetails");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Tlearningplandetails = {};
                $("#Tlearningplandetails input").each(function(i,v){
                    Tlearningplandetails[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Tlearningplandetails/update",{
                    Tlearningplandetails:Tlearningplandetails
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Tlearningplandetails");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Tlearningplandetails/kill",{
                    T_LEARNING_PLAN_DETAILS_ID:$("#T_LEARNING_PLAN_DETAILS_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Tlearningplandetails");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Tlearningplandetails");
            });
        };
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});