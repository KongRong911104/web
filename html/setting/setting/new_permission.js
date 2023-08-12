function new_permission() {
    var new_role_name = prompt('請輸入新權限內容');
    var new_rolename = document.getElementById('new_rolename');
    if (new_role_name.length > 0) {
        new_rolename.value = new_role_name;
        var role = document.getElementById('new_role');
        role.submit();
    }
}