function createRUP(a) {
    if (a == 0) {
        var role = prompt("請輸入新增的角色名稱");
        if (role != null) {
            $.ajax({
                url: 'createRole.php',
                type: 'POST',
                data: {
                    roleName: role
                },
                success: function (response) {
                    get_up(0);
                    // console.log(response);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
    }
    else if (a == 1) {
        var acc = prompt("請輸入新增的使用者帳號");
        if (acc != null) {
            $.ajax({
                url: 'createUser.php',
                type: 'POST',
                data: {
                    account: acc
                },
                success: function (response) {
                    get_up(1);
                    // console.log(response);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
    }
    else if (a == 2) {
        var permission = prompt("請輸入新增的權限名稱");
        if (permission != null) {
            $.ajax({
                url: 'createPermission.php',
                type: 'POST',
                data: {
                    permissionName: permission
                },
                success: function (response) {
                    get_up(2);
                    // console.log(response);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
    }
}