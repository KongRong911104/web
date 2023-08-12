function new_user() {
    var new_user_name = prompt('請輸入新成員名稱');
    var new_user_id = prompt('請輸入新成員帳號');
    var new_username = document.getElementById('new_username');
    var r=[];
    if (new_user_name.length > 0 && new_user_id.length > 0) {
        r.push([new_user_id,new_user_name]);
        new_username.value = JSON.stringify(r);
        console.log(new_username);
        var user = document.getElementById('new_user');
        user.submit();
    }
}