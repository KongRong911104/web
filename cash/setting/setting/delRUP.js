function del0(a) {
    var isConfirmed = window.confirm("你確定要刪除嗎？");
    if (isConfirmed) {
        $.ajax({
            url: 'delRole.php',
            type: 'POST',
            data: {
                roleID: a
            },
            success: function (response) {
                get_up(0)
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
    
}
function del1(a) {
    var isConfirmed = window.confirm("你確定要刪除嗎？");
    if (isConfirmed) {
    $.ajax({
        url: 'delUser.php',
        type: 'POST',
        data: {
            userID: a
        },
        success: function (response) {
            get_up(1)
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });}
}
function del2(a) {
    var isConfirmed = window.confirm("你確定要刪除嗎？");
    if (isConfirmed) {
    $.ajax({
        url: 'delPermission.php',
        type: 'POST',
        data: {
            permissionID: a
        },
        success: function (response) {
            get_up(2)
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });}
}
function del3(a) {
    var isConfirmed = window.confirm("你確定要刪除嗎？");
    if (isConfirmed) {
    $.ajax({
        url: 'delGroup.php',
        type: 'POST',
        data: {
            groupID: a
        },
        success: function (response) {
            groupData();
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });}
}