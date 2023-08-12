function new_group() {
    var group = prompt("請輸入新增的角色名稱");
    if (group != null) {
        $.ajax({
            url: 'createGroup.php',
            type: 'POST',
            data: {
                groupName: group
            },
            success: function (response) {
                console.log(response);
                groupData();
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
}