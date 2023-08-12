<?php
include 'pre_setting.php';
session_start();
$id = $_SESSION['id'];

if ($id == '') {
    header('Location: ../');
    exit;
} else {
    unset($_SESSION['id']);
    $_SESSION['id'] = $id;
}
?>
<!DOCTYPE html>
<html>

    <head>
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.6.1/Sortable.min.js"></script>
        <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <meta charset=" utf-8">
        <title>角色、群組設定</title>
        <link rel="stylesheet" href="setting.css">
    </head>

    <body>
        <!-- 標題 -->
        <div class="grouptop">群組
            <button class="new_group_button" onclick="new_group();">+</button>
            <!-- 垃圾桶圖案 -->
            <div class="icon-trash" style="float: left;">
                <div class="trash-lid" style="background-color: #3C3535"></div>
                <div class="trash-container" style="background-color: #3C3535"></div>
                <div class="trash-line-1"></div>
                <div class="trash-line-2"></div>
                <div class="trash-line-3"></div>
            </div>
            <form method="post" id="theform" action="group_permission.php">
                <input type='submit' name='submit' class="data_sent" onclick="sent_data();" value='送出'></input>
                <input type="hidden" id='datas_sent' name="datas_sent" />
                <input type="hidden" id='color_datas_sent' name="color_datas_sent" />
                <input type="hidden" id='role_datas_sent' name="role_datas_sent" />
                <input type="hidden" id='datas_sent_type' name="datas_sent_type" />
                <input type="hidden" id='role_permission_datas_sent' name="role_permission_datas_sent" />
                <!-- 送出角色資料 -->
            </form>
            <form id="del_group" method="POST" action="del_group.php">
                <input id="del_groupname" type="hidden" name="sent_del_groupname"></input>
            </form>
        </div>
        </div>
        <!-- 提交群組角色資料 -->

        <div id="group" class="groupsize">
            <!--顯示群組-->
            <ul id='group_list' class='group_title_style '></ul>
        </div>
        <!-- 所有群組角色資料內容 -->

        <div id="pp" class="usertop">
            <span id="mini_usertop_word1" class="mini_usertop_word" onclick="get_up(0);">角色</span>
            <span id="mini_usertop_word2" class="mini_usertop_word" onclick="get_up(1);">人員</span>
            <span id="mini_usertop_word3" class="mini_usertop_word" onclick="get_up(2);">權限</span>
            <button id="sign_out" onclick="sign_out();">登出</button>
        </div>

        <div id="permission" class="permissionsize">
            <button id="sent_up" class="new_group_button2">+</button>
            <!--顯示角色-->
            <ul id='permission_list' class='permission_title_style '></ul>
            <form id="new_role" method="POST" action="">
                <input id="new_rolename" type="hidden" name="sent_new_rolename"></input>
            </form>
        </div>
        <div class="managertop">管理員</div>
        <div id="manager" class="managersize">
            <!--顯示角色-->
            <ul id='manager_list' class='manager_title_style'></ul>
        </div>
        <form id="new_manager" method="POST" action="new_manager.php">
            <input id="new_managername" type="hidden" name="sent_new_managername"></input>
            <input hidden="true" type="submit"></input>
        </form>

        <!-- 懸浮視窗 -->
        <div id="content">
            <div id="role_top" class="mini_roletop">
                <div id="mini_roletop_word" class="mini_roletop_word"></div>
                <!-- 垃圾桶圖案 -->
                <div class="icon-trash2" style="float:left;">
                    <div class="trash2-lid" style="background-color: #3C3535"></div>
                    <div class="trash2-container" style="background-color: #3C3535"></div>
                    <div class="trash2-line-1"></div>
                    <div class="trash2-line-2"></div>
                    <div class="trash2-line-3"></div>
                </div>
                <button class="mini_close" onclick="close_page();">關閉</button>
                <form method="post" id="theform2" action="">
                    <input type="hidden" id='mini_datas_sent' name="mini_datas_sent" />
                    <input type="hidden" id='mini_color_datas_sent' name="mini_color_datas_sent" />
                    <input type='submit' id="mini_data_sent" class="mini_data_sent" onclick="mini_sent_data();"
                        value='送出'></input>
                </form>

            </div>
            <!-- 標題 -->
            <!-- 提交角色成員資料 -->
            <div id="role" class="mini_rolesize">
                <!--顯示角色-->
                <ul id='role_list' class='mini_role_title_style '></ul>
            </div>
            <!-- 所有角色成員資料內容 -->

            <div id="mini_usertop" class="mini_usertop"></div>
            <div id="people" class="mini_peoplesize">
                <!--顯示成員-->
                <ul id='people_list' class='mini_people_title_style '></ul>
                <form id="new_user" method="POST" action="new_user.php">
                    <input id="new_username" type="hidden" name="sent_new_username"></input>
                </form>
            </div>
        </div>

        <div class="black_overlay"></div>
        <div id="myMenu" data-index="">
            <ul>
                <li onclick="del_group();">刪除群組</li>
            </ul>
        </div>
        <div id="set_id" data-index=""></div>
        <div id="sent_type" data-index=""></div>
        <script src="./setting/manager_drag.js"></script>
        <script src="./setting/new_group.js"></script>
        <script src="./setting/new_role.js"></script>
        <script src="./setting/new_user.js"></script>
        <script src="./setting/new_permission.js"></script>
        <script src="./setting/del_group.js"></script>
        <script src="./setting/group_drag.js"></script>
        <script src="./setting/top_drag.js"></script>
        <script src="./setting/role_permission_drag.js"></script>
        <script src="./setting/page.js"></script>
        <script src="./setting/mini_role_drag.js"></script>
        <script src="./setting/sent_group_data.js"></script>
        <script src="./setting/mini_sent_role_data.js"></script>
        <script src="./setting/role_permission_sent_data.js"></script>
        <script>
            //取得id
            var Id = document.getElementById('set_id');
            Id.setAttribute('data-index', '<?= $id; ?>');
            function sign_out() {
                $.ajax({
                    url: '../top_bar.php', // 修改为你的 PHP 文件路径
                    type: 'POST',
                    success: function (response) {
                        history.go(0)
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        </script>
        <script>
            // 創建群組欄位
            var group_data = <?php echo $group_data; ?>;
            var group_color_array = <?php echo $group_color; ?>;
            // console.log(group_color);
            // console.log(group_data);
            // console.log(group_data[0]);
            // console.log(group_data[0][1]);
            // console.log(group_data[0][2][0]);
            // console.log(group_data[0][2][0][1]);
            var group_div = document.getElementById('group_list');
            for (var i = 0; i < (group_data.length); i++) {
                var group_ul = document.createElement('ul');
                group_ul.className = "grouplist_style ";
                group_ul.id = "g_" + group_data[i][0];
                var group_color = document.createElement('input');
                group_color.type = "color";
                group_color.setAttribute('id', 'color_' + group_data[i][0])
                group_color.className = "group_color";
                group_color.onclick = set_color;

                function set_color() {
                    let color = document.getElementById(event.target.id);
                    let r = document.getElementById('g_' + event.target.id.split("_").pop());
                    color.addEventListener('input', function (e) {
                        r.style.backgroundColor = (this.value)
                    });

                }
                var ch = 0;
                for (var j = 0; j < group_color_array.length; j++) {
                    if (group_color_array[j][0] == group_data[i][0] && group_color_array[j][2] == '<?= $id; ?>') {
                        group_ul.style.backgroundColor = group_color_array[j][1];
                        group_color.value = group_color_array[j][1];
                        ch = 1;
                        break;
                    }
                }
                if (i % 6 == 0 && ch == 0) {
                    group_ul.style.backgroundColor = "#FAADA2";
                    group_color.value = "#FAADA2";
                } else if (i % 6 == 1 && ch == 0) {
                    group_ul.style.backgroundColor = "#FFAB46";
                    group_color.value = "#FFAB46";
                } else if (i % 6 == 2 && ch == 0) {
                    group_ul.style.backgroundColor = "#FFF48C";
                    group_color.value = "#FFF48C";
                } else if (i % 6 == 3 && ch == 0) {
                    group_ul.style.backgroundColor = "#99FFCA";
                    group_color.value = "#99FFCA";
                } else if (i % 6 == 4 && ch == 0) {
                    group_ul.style.backgroundColor = "#99E0FF";
                    group_color.value = "#99E0FF";
                } else if (i % 6 == 5 && ch == 0) {
                    group_ul.style.backgroundColor = "#BC85FF";
                    group_color.value = "#BC85FF";
                }
                group_ul.innerHTML = group_data[i][1];
                group_ul.setAttribute('data-name', group_data[i][1]);
                group_ul.appendChild(group_color);
                if (group_data[i][2].length > 0) {
                    for (var j = 0; j < (group_data[i][2].length); j++) {
                        var group_li = document.createElement('li');
                        group_li.className = "group_li_style";
                        group_li.innerHTML = group_data[i][2][j][0] + " " + group_data[i][2][j][1] + " ";
                        group_li.style.fontSize = 60 / ((group_li.innerHTML.length - 1) - 1).toString() + "px";
                        group_li.setAttribute('data-index', group_data[i][2][j][1]);
                        group_li.ondblclick = get_roleid;
                        var group_li_text = document.createElement('span');
                        group_li_text.className = "tooltiptext";
                        group_li_text.innerHTML = group_data[i][2][j][0] + " " + group_data[i][2][j][1];
                        group_li.appendChild(group_li_text);
                        group_ul.appendChild(group_li);
                    }
                }
                group_ul.ondblclick = get_groupid;
                group_div.appendChild(group_ul);
                function get_roleid() {
                    var people_top = document.getElementById("mini_usertop");
                    people_top.innerHTML = "權限";
                    // console.log(event.target.parentNode.id.split("_").pop()); //groupid
                    // console.log(event.target.getAttribute('data-index')); //roleid
                    // var role_div = document.getElementById('role_list');
                    $("#role_list").empty();
                    var role_ul = document.getElementById('role_list');
                    var role_permission = (<?php echo $role_permission; ?>);
                    // console.log(role_permission);

                    var group_id = event.target.parentNode.id.split("_").pop()
                    // console.log(event.target.parentNode.getAttribute('data-name')); //groupid
                    role_ul.setAttribute('mini_group-index', group_id);
                    // var groupname = event.target.children;
                    var group_name = event.target.parentNode.getAttribute('data-name');
                    role_ul.setAttribute('mini-index', event.target.getAttribute('data-index'));
                    var role_top = document.getElementById('role_top');
                    var top_word = document.getElementById('mini_roletop_word');
                    // role_ul.innerHTML="";
                    // alert(group_name);
                    top_word.innerHTML = group_name + "中" + event.target.innerText.substring(0, event.target.innerText.length / 2) + "的權限";
                    for (var i = 0; i < (role_permission.length); i++) {
                        if (role_permission[i][0] == group_id && role_permission[i][1] == event.target.getAttribute('data-index')) {

                            var role_li = document.createElement('li');
                            role_li.className = "mini_peoplelist_style2";

                            role_li.innerHTML = role_permission[i][3];
                            role_li.setAttribute('style', 'font-size: 200%; width:50%;');
                            role_li.setAttribute('data-index', role_permission[i][2]);
                            // console.log(role_permission[i][3]);
                            role_li.setAttribute('name', 'role_peoples[]');
                            var role_li_text = document.createElement('span');
                            role_li_text.className = "tooltiptext2";
                            role_li_text.innerHTML = role_permission[i][3];
                            role_li.appendChild(role_li_text);
                            // var role_ul=role_ul.cloneNode(1);
                            role_ul.appendChild(role_li);
                            // console.log(role_ul);
                        }
                    }
                    var all_role_permission_data = <?php echo $all_role_permission; ?>;
                    // console.log(all_role_permission_data);
                    var people_ul = document.getElementById('people_list');
                    people_ul.innerHTML = "";
                    for (var i = 0; i < (all_role_permission_data.length); i++) {
                        var people_li = document.createElement('li');
                        people_li.className = "mini_peoplelist_style";
                        people_li.setAttribute('style', 'font-size:90%')
                        people_li.id = "s " + all_role_permission_data[i][0];
                        people_li.setAttribute('data-index', all_role_permission_data[i][0]);
                        people_li.innerHTML = all_role_permission_data[i][1];
                        var people_li_text = document.createElement('span');
                        people_li_text.className = "tooltiptext2";
                        people_li_text.innerHTML = all_role_permission_data[i][1];
                        people_li.appendChild(people_li_text);
                        people_ul.appendChild(people_li);
                    }
                }

                function get_groupid() { //跳轉群組
                    if (event.target.className.split(" ")[0] == 'grouplist_style') {
                        var people_top = document.getElementById("mini_usertop");
                        people_top.innerHTML = "人員";
                        $("#role_list").empty();
                        var group_id = event.target.id;
                        var role_div = document.getElementById('role_list');
                        // console.log(group_id);
                        var groupname = event.target.children;
                        var group_name = event.target.childNodes.item(0).data;
                        // console.log(group_name);
                        var role_top = document.getElementById('role_top');
                        // role_top.innerHTML=top_word;
                        var top_word = document.getElementById('mini_roletop_word');
                        top_word.innerHTML = group_name + "的角色";
                        // role_top.innerHTML = top_word.innerHTML + "的角色"+role_top.innerHTML;
                        var role_data_array = [];
                        // console.log(group_id);
                        var grouprole_data = <?php echo $grouprole_data ?>;
                        var role_people_data = <?php echo $people_data ?>;
                        for (var i = 0; i < groupname.length; i++) {
                            var t0 = groupname.item(i).innerHTML.split(" ")[0];
                            var t1 = groupname.item(i).innerHTML.split(" ")[1];
                            role_data_array.push(t0.concat(" ", t1));
                            // console.log(groupname.item(i));
                        }
                        // console.log(role_data_array);

                        role_div.setAttribute('mini_group-index', group_id);
                        // role_div.id="mini_group";
                        for (var i = 1; i < (role_data_array.length); i++) {
                            var role_ul = document.createElement('ul');
                            role_ul.className = "mini_rolelist_style ";
                            role_ul.id = "r_" + (role_data_array[i].split(" ").pop());
                            role_ul.innerHTML = role_data_array[i];
                            var role_color = document.createElement('input');
                            role_color.type = "color";
                            role_color.setAttribute('id', 'color_' + role_data_array[i].split(" ").pop())
                            role_color.className = "group_color";
                            role_color.onclick = set_color2;

                            function set_color2() {
                                var color2 = document.getElementById(event.target.id);
                                var r2 = document.getElementById("r_" + ((event.target.id).split("_").pop()));
                                // console.log(r2);
                                // console.log(this.value);
                                event.target.addEventListener('input', function (e) {
                                    r2.style.backgroundColor = (this.value)
                                });
                            }
                            var ch = 0;
                            var role_color_array = <?php echo $role_color; ?>;
                            // console.log(role_color_array[i-1]);
                            for (var j = 0; j < role_color_array.length; j++) {
                                if (role_color_array[j][0] == group_id.split('_').pop() && role_color_array[j][3] == '<?= $id; ?>' && role_color_array[j][1] == role_data_array[i].split(" ").pop()) {
                                    role_ul.style.backgroundColor = role_color_array[j][2];
                                    role_color.value = role_color_array[j][2];
                                    ch = 1;
                                    break;
                                }
                            }
                            if ((i - 1) % 6 == 0 && ch == 0) {
                                role_ul.style.backgroundColor = "#FAADA2";
                                role_color.value = "#FAADA2";
                            } else if ((i - 1) % 6 == 1 && ch == 0) {
                                role_ul.style.backgroundColor = "#FFAB46";
                                role_color.value = "#FFAB46";
                            } else if ((i - 1) % 6 == 2 && ch == 0) {
                                role_ul.style.backgroundColor = "#FFF48C";
                                role_color.value = "#FFF48C";
                            } else if ((i - 1) % 6 == 3 && ch == 0) {
                                role_ul.style.backgroundColor = "#99FFCA";
                                role_color.value = "#99FFCA";
                            } else if ((i - 1) % 6 == 4 && ch == 0) {
                                role_ul.style.backgroundColor = "#99E0FF";
                                role_color.value = "#99E0FF";
                            } else if ((i - 1) % 6 == 5 && ch == 0) {
                                role_ul.style.backgroundColor = "#BC85FF";
                                role_color.value = "#BC85FF";
                            }
                            role_ul.appendChild(role_color);
                            // 顯示角色中的成員  
                            // var role_people_array = '';
                            var role_color_array = <?php echo $role_color; ?>;
                            if (role_data_array.length > 0) {
                                for (var j = 0; j < grouprole_data.length; j++) {
                                    // console.log(grouprole_data[j]);
                                    // console.log(role_data_array[i]);
                                    // console.log(group_id);
                                    if (grouprole_data[j][1] == group_id.split("_").pop() && role_data_array[i].split(" ").pop() == grouprole_data[j][2]) {
                                        var role_li = document.createElement('li');
                                        role_li.className = "mini_role_li_style";
                                        var ch = 0;
                                        for (var k = 0; k < role_people_data.length; k++) {
                                            // console.log(role_people_data[k]);
                                            if (role_people_data[k][0] == grouprole_data[j][0]) {
                                                role_li.innerHTML = role_people_data[k][1];
                                                role_li.style.fontSize = (40 / (role_people_data[k][1]).length) + "px";
                                                role_li.setAttribute('data-index', role_people_data[k][0]);
                                                var role_li_text = document.createElement('span');
                                                role_li_text.className = "tooltiptext";
                                                role_li_text.innerHTML = role_people_data[k][1];
                                                role_li.appendChild(role_li_text);
                                                role_ul.appendChild(role_li);
                                                ch = 1;
                                            }
                                        }
                                    }
                                }
                                role_div.appendChild(role_ul);
                            }
                        }
                        var people_data = <?php echo $people_data ?>;
                        var people_ul = document.getElementById('people_list');
                        people_ul.innerHTML = "";
                        for (var i = 0; i < (people_data.length); i++) {
                            var people_li = document.createElement('li');
                            people_li.className = "mini_peoplelist_style ";
                            people_li.id = "s " + people_data[i][0];
                            people_li.innerHTML = people_data[i][1];
                            var people_li_text = document.createElement('span');
                            people_li_text.className = "tooltiptext2";
                            people_li_text.innerHTML = people_data[i][1];
                            people_li.appendChild(people_li_text);
                            people_ul.appendChild(people_li);
                        }
                    }
                }
            }

        </script>
        <script>
            // 創建角色與人員欄位切換
            var pp = 0;
            var sent_type = document.getElementById("sent_type");
            sent_type.setAttribute("data-index", pp);
            get_up(0);

            function get_up(pp) {
                form = document.getElementById('new_role');
                var up_f = document.getElementById('sent_up');

                if (pp == 0) {
                    var user_top = document.getElementById('mini_usertop_word1');
                    user_top.style.backgroundColor = '#848484';
                    document.getElementById('mini_usertop_word2').style.backgroundColor = 'transparent';
                    document.getElementById('mini_usertop_word3').style.backgroundColor = 'transparent';
                    document.getElementById('sent_up').innerHTML = '+';
                    document.getElementById('sent_up').style.fontSize = '38px';
                    var permission_data = <?php echo $permission_data; ?>;
                    var permission_ul = document.getElementById('permission_list');
                    permission_ul.innerHTML = "";
                    for (var i = 0; i < (permission_data.length); i++) {
                        var permission_li = document.createElement('li');
                        permission_li.className = "permissionlist_style ";
                        permission_li.id = "p " + permission_data[i][0];
                        permission_li.innerHTML = permission_data[i][1] + " " + permission_data[i][0] + " ";
                        var permission_li_text = document.createElement('span');
                        permission_li_text.className = "tooltiptext2";
                        permission_li_text.innerHTML = permission_data[i][1] + " " + permission_data[i][0];
                        permission_li.appendChild(permission_li_text);
                        permission_ul.appendChild(permission_li);
                    }
                    form.action = "new_role.php";
                    up_f.onclick = new_role;
                    drag();
                    top_drag();
                } else if (pp == 1) {
                    var user_top = document.getElementById('mini_usertop_word2');
                    user_top.style.backgroundColor = '#848484';
                    document.getElementById('mini_usertop_word1').style.backgroundColor = 'transparent';
                    document.getElementById('mini_usertop_word3').style.backgroundColor = 'transparent';
                    document.getElementById('sent_up').innerHTML = '+';
                    document.getElementById('sent_up').style.fontSize = '38px';
                    var permission_data = <?php echo $people_data ?>;
                    var permission_ul = document.getElementById('permission_list');
                    permission_ul.innerHTML = "";
                    for (var i = 0; i < (permission_data.length); i++) {
                        var permission_li = document.createElement('li');
                        permission_li.className = "permissionlist_style ";
                        permission_li.id = "p " + permission_data[i][0];
                        permission_li.innerHTML = permission_data[i][1];
                        var permission_li_text = document.createElement('span');
                        permission_li_text.className = "tooltiptext2";
                        permission_li_text.innerHTML = permission_data[i][1];
                        permission_li.appendChild(permission_li_text);
                        permission_ul.appendChild(permission_li);
                    }
                    form.action = "new_user.php";
                    up_f.onclick = new_user;
                } else if (pp == 2) {
                    var user_top = document.getElementById('mini_usertop_word3');
                    user_top.style.backgroundColor = '#848484';
                    document.getElementById('mini_usertop_word1').style.backgroundColor = 'transparent';
                    document.getElementById('mini_usertop_word2').style.backgroundColor = 'transparent';
                    document.getElementById('sent_up').innerHTML = '+(後端也要新增才有用)';
                    document.getElementById('sent_up').style.fontSize = '28px';
                    var all_role_permission_data = <?php echo $all_role_permission; ?>;
                    var people_ul = document.getElementById('permission_list');
                    people_ul.innerHTML = "";
                    for (var i = 0; i < (all_role_permission_data.length); i++) {
                        var people_li = document.createElement('li');
                        people_li.className = "permissionlist_style ";
                        people_li.id = "s " + all_role_permission_data[i][0];
                        people_li.setAttribute('data-index', all_role_permission_data[i][0]);
                        people_li.innerHTML = all_role_permission_data[i][1];
                        var people_li_text = document.createElement('span');
                        people_li_text.className = "tooltiptext2";
                        people_li_text.innerHTML = all_role_permission_data[i][1];
                        people_li.appendChild(people_li_text);
                        people_ul.appendChild(people_li);
                    }
                    form.action = "new_permission.php";
                    up_f.onclick = new_permission;
                }
            }
            var pu = document.getElementById('pp');
            pu.ondblclick = change_pp;

            function change_pp() {
                if (pp == 0) {
                    pp = 1;
                    sent_type.setAttribute("data-index", pp);
                    get_up();
                } else if (pp == 1) {
                    pp = 2;
                    sent_type.setAttribute("data-index", pp);
                    get_up();
                } else if (pp == 2) {
                    pp = 0;
                    sent_type.setAttribute("data-index", pp);
                    get_up();
                }
            }
        </script>
        <script>
            //取得人員id
            function getuserid() {
                var role_div = document.getElementById('role_list');
                role_div.setAttribute('mini_group-index', 0);
                $("#role_list").empty();
                var people_top = document.getElementById("mini_usertop");
                people_top.innerHTML = "人員";
                var group_id = 0;
                var role_people_data = <?php echo $manager ?>;
                for (var k = 0; k < role_people_data.length; k++) {
                    var role_li = document.createElement('li');
                    role_li.className = "mini_role_li_style";
                    // console.log(role_people_data[k]);
                    role_li.innerHTML = role_people_data[k][1];
                    role_li.style.fontSize = (40 / (role_people_data[k][1]).length) + "px";
                    role_li.setAttribute('data-index', role_people_data[k][0]);
                    var role_li_text = document.createElement('span');
                    role_li_text.className = "tooltiptext";
                    role_li_text.innerHTML = role_people_data[k][1];
                    role_li.appendChild(role_li_text);
                    role_div.appendChild(role_li);
                }
                var people_data = <?php echo $people_data ?>;
                var people_ul = document.getElementById('people_list');
                people_ul.innerHTML = "";
                for (var i = 0; i < (people_data.length); i++) {
                    var people_li = document.createElement('li');
                    people_li.className = "mini_peoplelist_style ";
                    people_li.id = "s " + people_data[i][0];
                    people_li.innerHTML = people_data[i][1];
                    var people_li_text = document.createElement('span');
                    people_li_text.className = "tooltiptext2";
                    people_li_text.innerHTML = people_data[i][1];
                    people_li.appendChild(people_li_text);
                    people_ul.appendChild(people_li);
                }
            }
        </script>
        <script>
            //創建管理員欄位

            var manager = document.getElementById('manager');
            manager.ondblclick = getuserid;
            var manager_data = <?php echo $manager; ?>;
            var manager_ul = document.getElementById('manager_list');
            for (var i = 0; i < (manager_data.length); i++) {
                var manager_li = document.createElement('li');
                manager_li.className = "manager_style";
                manager_li.id = "m " + manager_data[i][0];
                manager_li.innerHTML = manager_data[i][1] + " " + manager_data[i][0] + " ";
                var manager_li_text = document.createElement('span');
                manager_li_text.className = "tooltiptext2";
                manager_li_text.innerHTML = manager_data[i][1] + " " + manager_data[i][0];
                manager_li.appendChild(manager_li_text);
                manager_ul.appendChild(manager_li);
            }
            var people_data = <?php echo $people_data ?>;
            var people_ul = document.getElementById('people_list');
            people_ul.innerHTML = "";
            for (var i = 0; i < (people_data.length); i++) {
                var people_li = document.createElement('li');
                people_li.className = "mini_peoplelist_style ";
                people_li.id = "s " + people_data[i][0];
                people_li.innerHTML = people_data[i][1];
                var people_li_text = document.createElement('span');
                people_li_text.className = "tooltiptext2";
                people_li_text.innerHTML = people_data[i][1];
                people_li.appendChild(people_li_text);
                people_ul.appendChild(people_li);
            }
        </script>
        <script>
        // 創建所有成員欄位
        </script>

    </body>

</html>