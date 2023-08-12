<?php
// 讀取群組名稱,id,使用者名稱,圖片,群組列表
$groupid = $_GET['group'];
$groupname = $_GET['groupname'];
session_start();
$id = $_SESSION['id'];
if ($id == '') {
    header('Location: ../');
    exit;
}
include '../crud.php';
$stu_data = detail_Read('stu', 'id', $id);
$username = $stu_data[0]['name'];
$userimg = $stu_data[0]['userimg'];
$group1 = detail_Read('permission', 'id', $id);
$groupid1 = rough_Read('groupid');
$gronplist = array();
for ($i = 0; $i < count($group1); $i++) {
    for ($j = 0; $j < count($groupid1); $j++) {
        if ($group1[$i]['groupid'] == $groupid1[$j]['groupid']) {
            $grouplist[] = [$groupid1[$j]['groupid'], $groupid1[$j]['groupname']];
        }
    }
}
array_multisort($grouplist);
$grouplist = json_encode($grouplist);

?>
<!DOCTYPE html>
<html lang="zw-TW">

<head>
    <meta charset="utf-8">
    <title>
        真的登入了!
    </title>
    <script>
        function keyLogin() {
            if (event.keyCode == 13) //enter的鍵值為13
                document.getElementById("send").click(); //觸動按鈕的點擊
        }
    </script>
    <style>
        html {
            background-color: rgba(19, 18, 18, 0.76);
        }

        .grouptop {
            margin-left: -8px;
            background-color: #1A1818;
            position: absolute;
            top: 0px;
            height: 5%;
            width: 15%;
            border: 1px solid black;
            padding-left: 2%;
            font-size: 35px;
            color: white;
        }

        .chattop {
            background-color: #1A1818;
            position: absolute;
            top: 0px;
            left: 17%;
            width: 64%;
            height: 5%;
            border: 1px solid black;
            padding-left: 2%;
            font-size: 35px;
            color: white;
        }

        .usertop {
            top: 0px;
            left: 83%;
            background-color: #1A1818;
            position: absolute;
            width: 14.9%;
            height: 5%;
            border: 1px solid black;
            padding-left: 2%;
            font-size: 35px;
            color: white;
        }

        .inputsite {
            position: absolute;
            top: 93%;
            left: 17%;
            border: 1px solid;
            width: 66%;
            height: 6.5%;
        }

        .groupsize {
            top: 5%;
            margin-left: -8px;
            background-color: #272626;
            position: absolute;
            width: 17%;
            height: 88%;
            border: 1px solid;
            overflow-y: scroll;
            overflow-x: hidden;

        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .grouplist_style {
            position: relative;
            left: -12%;
            padding-left: 10%;
            width: 100%;
            height: 70px;
            font-size: 35px;
            color: white;
            list-style: none;
        }

        .grouplist_style:hover {
            background-color: #0F0F0E;
        }

        .userlist_title_style {
            position: relative;
            width: 100%;
            font-size: 20px;
            color: white;
            padding-left: 2%;
            list-style: none;
        }

        .userlist_style {
            position: relative;
            padding-left: 10%;
            width: 98%;
            font-size: 25px;
            color: #A0A0A0;
            list-style: none;
        }

        .userlist_style:hover {
            background-color: #0F0F0E;
        }

        .chat {

            background-color: #272727b9;
            position: absolute;
            top: 5%;
            left: 17%;
            width: 66%;
            height: 88%;
            border: 2px solid;
        }

        .inputStyle {
            margin-top: 10px;
            margin-left: 35px;
            position: relative;
            border-radius: 8px;
            width: 92%;
            height: 70%;
            border: 2px solid;
            border-color: #383838;
            font-size: 27px;
            color: rgb(255, 255, 255);
            background-color: #6e6c6cb7;
        }

        .inputStyle::placeholder {
            color: rgba(233, 231, 231, 0.363);
        }

        .inputStyle:focus {
            outline: none;
            border-color: rgba(107, 107, 107, 0.733);
        }

        .userset {
            position: absolute;
            top: 93%;
            border: 1px solid;
            width: 17%;
            height: 6.5%;
            margin-left: -8px;
            background-color: rgba(0, 0, 0, 0.733);
        }

        .logo {
            position: absolute;
            border-radius: 50px;
            left: 15%;
            top: 17%;
        }

        .username {
            position: relative;
            border-radius: 50px;
            left: 30%;
            top: 30%;
            color: white;
            font-size: 18px;
            font-weight: bold;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        .userposition {
            position: absolute;
            border-radius: 50px;
            left: 17%;
            top: 5%;
            color: rgba(255, 255, 255, 0.39);
            font-size: 16px;
            font-weight: bold;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        .usersize {
            top: 5%;
            left: 83%;
            background-color: #272626;
            position: absolute;
            width: 16.9%;
            height: 94.5%;
            border: 1px solid;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        .sentphoto {

            position: relative;
            top: 0px;
            left: -30px;
            border: hidden;

        }
    </style>
</head>

<body>
    <div class="grouptop">群組</div>
    <div id="groupname" class="chattop"></div>
    <!--顯示群組名稱-->
    <div class="usertop">成員</div>
    <div class="groupsize">
        <!--顯示群組-->
        <ul id="grouplist"></ul>
    </div>
    <div class="userset">
        <!--顯示群個人資訊-->
        <img class="logo" id="userimg" width="40px">
        <div class="username" id="username"></div>
    </div>
    <div class="chat">
        <!--顯示聊天室-->
        <ul id="contentlist"></ul>
    </div>
    <div class="inputsite">
        <!--輸入框-->
        <input type="text" class="inputStyle" placeholder="寫點什麼吧..."></input>
        <img id="photo" class="sentphoto" src="https://www.transparentpng.com/thumb/send-email-button/tCjejK-send-email-button-transparent.png" onclick="sendword()" width="20px">
    </div>
    <div id="usersize" class="usersize">
        <!--顯示成員-->
    </div>
    <script>
        // 顯示使用者名稱,圖片和目前群組名稱
        var $username = document.getElementById("username")
        $username.innerHTML = '<?= $username ?>';
        var userimg = document.getElementById("userimg");
        userimg.src = '<?= $userimg ?>';
        var chattop = document.getElementById("groupname");
        chattop.innerHTML = '<?= $groupname ?>';
    </script>
    <script>
        // 顯示群組列表
        var groupul = document.getElementById('grouplist');
        var grouplist = <?php echo $grouplist; ?>;
        for (var i = 0; i < (grouplist.length); i++) {
            var groupli = document.createElement('li');
            groupli.className = "grouplist_style";
            groupli.id = grouplist[i][0];
            groupli.onclick = get_groupid;
            groupli.innerHTML = grouplist[i][1];
            groupul.appendChild(groupli);

            function get_groupid() { //跳轉群組
                var group_id = event.target.id;
                var groupname = event.target.innerHTML;
                window.location.href = 'chat.php?group=' + group_id + '&groupname=' + groupname;
            }
        }
    </script>
    <script>
        // 顯示人員名單
        <?php
        // 找出群組中有的權限
        $permission = detail_Read('permission', 'groupid', $groupid);
        for ($i = 0; $i < count($permission); $i++) {
            $permission[$i]['permissionlevel'] = detail_Read('allpermission', 'permissionlevel', $permission[$i]['permissionlevel'])[0]['permissionname'];
        }

        // 找出成員的權限名稱,id,名稱,圖片，並排序
        $alluser = array();
        $all_members = detail_Read('permission', 'groupid', $groupid);
        for ($i = 0; $i < count($all_members); $i++) {
            $alluser[] = [detail_Read('allpermission', 'permissionlevel', permission_detail_Read('permission', 'id', $all_members[$i]['id'], 'groupid', $groupid)[0]['permissionlevel'])[0]['permissionname'], $all_members[$i]['id'], detail_Read('stu', 'id', $all_members[$i]['id'])[0]['name'], detail_Read('stu', 'id', $all_members[$i]['id'])[0]['userimg']];
        }
        sort($alluser);
        $alluser = json_encode($alluser);
        ?>
        // 把找好的陣列以權限名稱做分類
        var userlist = <?php echo $alluser; ?>;
        var userlist_count = 1;
        for (var i = 0; i < userlist.length - 1; i++) {
            if (userlist[i][0] != userlist[i + 1][0]) {
                userlist_count++;
            }
        }
        var fin_userlist = [];
        for (var i = 0; i < userlist_count; i++) {
            fin_userlist.push([]);
        }
        fin_userlist[0].push(userlist[0]);
        var y = 1;
        var k = 0;
        while (y < userlist.length) {
            if (userlist[y - 1][0] == userlist[y][0]) {
                fin_userlist[k].push(userlist[y]);
            } else {
                k++;
                fin_userlist[k].push(userlist[y]);
            }
            y++;
        }
        // 分類後製作成清單
        var usersize = document.getElementById('usersize');
        for (var i = 0; i < fin_userlist.length; i++) {
            var userul = document.createElement('ul');
            userul.setAttribute('id', i);
            userul.className = "userlist_title_style";
            userul.innerHTML = fin_userlist[i][0][0] + "<hr/>";
            for (var j = 0; j < fin_userlist[i].length; j++) {
                var userli = document.createElement('li');
                userli.className = "userlist_style";
                userli.id = String(i)+String(j);
                //groupli.onclick = get_groupid;
                userli.innerHTML = fin_userlist[i][j][2];
                userul.appendChild(userli);
            }
            usersize.appendChild(userul);
        }
        
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.6.1/Sortable.min.js"></script>
    <script>
        
    </script> -->

    
</body>

</html>