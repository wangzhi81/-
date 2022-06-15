function Validation(){
    $.post("login/Validation.php?r="+Math.random(),{
        LOGIN_VERIFICATION_NOTE_ID:$("#LOGIN_VERIFICATION_NOTE_ID").val()
    },function(data){
        //alert(data);
        if(data=="ok"){
            location.href = "main/index.html";
        }else{
            setTimeout(Validation,5000);
        }
    });
}
$(function(){
    Validation();
});