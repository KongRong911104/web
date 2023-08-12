function mini_sent_data() {
    var role_role = [];
    var div = document.getElementById('role_list');
    var form = document.getElementById('theform2');
    var mini_group = div.getAttribute("mini_group-index");
    if (div.getAttribute("mini_group-index") == 0) {
        form.action = 'manager.php';
        for (var i = 0; i < div.children.length; i++) {
            var ul = div.childNodes.item(i);
            console.log(ul.getAttribute("data-index"));
            role_role.push(ul.getAttribute("data-index"));
        }
    }
    else {
        form.action = 'role_people.php';
        var role_color = [];
        for (var i = 0; i < div.children.length; i++) {
            var ul = div.childNodes.item(i);
            // console.log(ul);
            var ul_id = ul.id.split("_").pop();
            // console.log(ul_id);
            // var lisId = div.childNodes.item(i).getAttribute("mini_group-index");
            var lis = ul.childNodes;
            // console.log(lis);
            role_color.push([div.getAttribute("mini_group-index").split('_').pop(),ul_id, lis.item(1).value, Id.getAttribute('data-index')]);
            if (lis.length > 1) {
                for (var j = 1; j < lis.length; j++) {
                    if (lis.item(j).getAttribute("data-index") != null)
                        role_role.push([lis.item(j).getAttribute("data-index"), mini_group.split("_").pop(), ul_id]);
                }
            }
        }
        // console.log(role_color);
        // alert(role_color);
        var color_form=document.getElementById('mini_color_datas_sent');
        color_form.value=JSON.stringify(role_color);
        
    }
    // console.log(div.getAttribute("mini_group-index"));
    var form_ = document.getElementById('mini_datas_sent');
    
    form_.value = JSON.stringify(role_role);
    // console.log(form.value);
}