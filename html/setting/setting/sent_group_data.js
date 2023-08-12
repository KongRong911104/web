// 送出資料
function sent_data() {
    var group_role = [];
    var group_color = [];
    var permission = [];
    var permission_list = document.getElementById('permission_list');
    // console.log(permission_list.childNodes.length);
    for (var i = 0; i < permission_list.childNodes.length; i++) {
        permission.push(permission_list.childNodes.item(i).id.split(' ').pop());
    }
    // console.log(permission);
    var div = document.getElementById('group_list');
    for (var i = 0; i < group_data.length; i++) {
        var ul = div.childNodes.item(i);
        var lisId = div.childNodes.item(i).id.split("_").pop();
        var lis = ul.childNodes;
        // console.log(lis.item(1).value);
        group_color.push([lisId, lis.item(1).value, Id.getAttribute('data-index')])
        if (lis.length > 1) {
            for (var j = 2; j < lis.length; j++) {
                group_role.push([lisId, lis.item(j).innerText.split(" ").pop()]);
            }
        }
    }
    // console.log(group_color);
    // console.log(group_role);
    var form = document.getElementById('datas_sent');
    form.value = JSON.stringify(group_role);
    var color_form = document.getElementById('color_datas_sent');
    color_form.value = JSON.stringify(group_color);
    var role_form = document.getElementById('role_datas_sent');
    role_form.value = JSON.stringify(permission);
    var sent_type=document.getElementById("sent_type");
    var form_type = document.getElementById('datas_sent_type');
    form_type.value=sent_type.getAttribute("data-index");
    // console.log(form.value);
}