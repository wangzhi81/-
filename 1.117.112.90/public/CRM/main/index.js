//未读消息数量定时更新


$(function(){
    $(".caidan2").css("height",$(window).height()-80);
    $("#mainfram").attr("height",$(window).height()-54);
    //系统设置菜单
    $("#Systemsettings").load("Systemsettings.php",function(){
        //数据字典
        $("#sjzd").click(function(){
            $("#mainfram").attr("src","../dataDictionary/index.php");
        });
        $(".dtcd").click(function(){
            $(".caidan4").removeClass("caidan4selected");
            $(this).addClass("caidan4selected");
        });
    });
    //菜单伸缩
    $("#caidanan").click(function(){
        if($("#caidantd").width()==180){
            $(".wemzi").hide();
            $("#caidantd").animate({"width":"50px"});
        }else{
            $("#caidantd").animate({"width":"180px"},function(){
                $(".wemzi").show();
            });
        }
    });
    //一级菜单收起
    $(".caidan3").click(function(){
        var chevron = $(this).find(".chevron");
        var parent = $(this).parent();
        if(chevron.hasClass("glyphicon-chevron-down")){
            chevron.removeClass("glyphicon-chevron-down");
            chevron.addClass("glyphicon-chevron-right");
            parent.find(".caidan4").hide();
        }else{
            chevron.addClass("glyphicon-chevron-down");
            chevron.removeClass("glyphicon-chevron-right");
            parent.find(".caidan4").show();
        }
    });
    //顶部菜单
    $(".kuai").click(function(){
        $(".zhankai").hide();
        var chevron = $(this).find(".chevron");
        if(chevron.hasClass("glyphicon-chevron-down")){
            $(".kuai1select").each(function(i,v){
                $(v).removeClass("kuai1select");
                $(v).addClass("kuai1");
                $(v).find(".chevron").addClass("glyphicon-chevron-down");
                $(v).find(".chevron").removeClass("glyphicon-chevron-up");
            });
            chevron.removeClass("glyphicon-chevron-down");
            chevron.addClass("glyphicon-chevron-up");
            $(this).removeClass("kuai1");
            $(this).addClass("kuai1select");
        }else{
            chevron.addClass("glyphicon-chevron-down");
            chevron.removeClass("glyphicon-chevron-up");
            $(this).removeClass("kuai1select");
            $(this).addClass("kuai1");
        }
        
    });
    //用户菜单定位
    $("#yonghull").css("width",$("#yonghuxx").outerWidth());
    $("#yonghull").css("left",$(window).width()-$("#yonghuxx").outerWidth());
    //用户菜单展开
    $("#yonghuxx").click(function(){
        if($(this).hasClass("kuai1")){
            $("#yonghull").hide();
        }else{
            $("#yonghull").show();
        }
    });
    //点击标题回首页
    $("#biaoti").click(function(){
        $("#mainfram").attr("src","home.php");
    });
    $("#Accountmanagement").click(function(){
        $("#mainfram").attr("src","home.php");
    });
    //消息中心
    $("#MessageCenter").click(function(){
        $("#mainfram").attr("src","../UserCenter/MessageCenter.php");
    });
    //环保举报设计
    $("#EnvironmentalReporting").click(function(){
        $("#mainfram").attr("src","../EnvironmentalReporting/index.php");
    });
    //项目机会
    $("#xzjh").click(function(){
        $("#mainfram").attr("src","../Project/index.php");
    });
    //订单管理
    $("#ddgl").click(function(){
        $("#mainfram").attr("src","../Order/OrderM.php");
    });
    //菜单选中
    $(".caidan4").click(function(){
        $(".caidan4").removeClass("caidan4selected");
        $(this).addClass("caidan4selected");
    });
    //退出
    $("#tuichu").click(function(){
        location.href = "../index.php";
    });
});