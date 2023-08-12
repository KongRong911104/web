
$(document).ready(function () {
    $.ajax({
        type: 'POST',
        url: "eat_trans.php",
        success: function (msg) {
            if(msg=="on"){
                document.getElementById("status_id").setAttribute("href","edit_store.html");
                document.getElementById("status_id").innerHTML="點此進入編輯";
            }
            else{
                null;
            }
        }
    });
});

function t_now(){
    var d= new Date;
    var hour=d.getHours();
    var minute=d.getMinutes();
    var day=d.getDay();
    document.getElementById("hour_id").setAttribute("value",hour);
    document.getElementById("minute_id").setAttribute("value",minute);
    document.getElementById("d_id").setAttribute("value",day);
    document.getElementById("form_t_id").submit();
}

function t_else(){
    var d= new Date;
    var day=d.getDay();
    var hour=document.getElementById("s_h").value;
    var minute=document.getElementById("s_m").value;
    document.getElementById("hour_id").setAttribute("value",hour);
    document.getElementById("minute_id").setAttribute("value",minute);
    document.getElementById("d_id").setAttribute("value",day);
    document.getElementById("form_t_id").submit();
}

function lead_to_iogin(){
    window.location.href='eat_login.html';
}
