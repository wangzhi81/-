    define(['jquery','common'],function($,common){
        var Initialize = function(){
            $("#SaveData").click(function(){
                common.showShadow();
                var Noticereminding = {};
                $("#Noticereminding input").each(function(i,v){
                    Noticereminding[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Noticereminding/save",{
                    Noticereminding:Noticereminding
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Noticereminding");
                    }
                });
            });
            $("#SaveEdit").click(function(){
                common.showShadow();
                var Noticereminding = {};
                $("#Noticereminding input").each(function(i,v){
                    Noticereminding[$(v).attr("id")]=$(v).val();
                });
                $.post("/admin/Noticereminding/update",{
                    Noticereminding:Noticereminding
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Noticereminding");
                    }
                });
            });
            $("#Delete").click(function(){
                common.showShadow();
                $.post("/admin/Noticereminding/kill",{
                    NOTICE_REMINDING_ID:$("#NOTICE_REMINDING_ID").val()
                },function(res){
                    if(res==="ok"){
                        common.DisplaysModule("/admin/Noticereminding");
                    }
                });
            });
            $("#Cancellation").click(function(){
                common.showShadow();
                common.DisplaysModule("/admin/Noticereminding");
            });
        };
        return {
　　　　　　Initialize:Initialize
　　　　};
　　});