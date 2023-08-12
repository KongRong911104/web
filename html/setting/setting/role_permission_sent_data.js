function role_permission_sent_data() {
    var role_role = [];
    var div = document.getElementById('role_list');
    var form = document.getElementById('theform2');
    var mini_group = div.getAttribute("mini_group-index");
    var role_id=div.getAttribute("mini-index");
    
    form.action = 'role_permission.php';
    for (var i = 0; i < div.children.length; i++) {
        var ul = div.childNodes.item(i);
        console.log(ul.getAttribute("data-index"));
        role_role.push([mini_group,role_id,ul.getAttribute("data-index")]);
    }
    // console.log(role_role);
    // alert();
    var form_ = document.getElementById('mini_datas_sent');
    form_.value = JSON.stringify(role_role);
}