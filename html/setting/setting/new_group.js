function new_group() {
    var new_group_name = prompt('請輸入新群組名稱');
    if (new_group_name.length > 0) {
        $.ajax({
            url: "new_group.php",
            method: "POST", // 使用 POST 方法发送请求
            data: { sent_new_groupname: new_group_name}, // 将变量作为对象传递给服务器
            success: function(){
                location.reload();
            }
        });
    }
}