<?php
include "../crud.php";
if (!isset($_SESSION)) {
    session_start();
} //判斷session是否已啟動

if ($_SESSION['id'] != "") {
    $id = $_SESSION['id'];
    $check = GRUGRP(decrypt($id), 1);
    if (empty($check)) {
        header("Location: ../");
    }
}
?>
<!DOCTYPE html>
<html>

    <head>
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> -->
    <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.6.1/Sortable.min.js?v=<?= time() ?>"></script>
        <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js?v=<?= time() ?>"></script>
        <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js?v=<?= time() ?>"></script>
        <meta charset=" utf-8">
        <title>角色、群組設定</title>
        <link rel="stylesheet" href="index.css?v=<?= time() ?>">
    </head>

    <body>
        <!-- 標題 -->
        <div class="grouptop">群組
            <button class="new_group_button" onclick="new_group();">+</button>
            <!-- 垃圾桶圖案 -->
            <!-- <div class="icon-trash" style="float: left;">
                <div class="trash-lid" style="background-color: #3C3535"></div>
                <div class="trash-container" style="background-color: #3C3535"></div>
                <div class="trash-line-1"></div>
                <div class="trash-line-2"></div>
                <div class="trash-line-3"></div>
            </div> -->
            <input type='button' class="data_sent" onclick="sent_data();" value='送出'></input>
        </div>
        <!-- 提交群組角色資料 -->
        <div id="group" class="groupsize">
            <!--顯示群組-->
            <ul id='group_list' class='group_title_style '></ul>
        </div>
        <!-- 所有群組角色資料內容 -->

        <div id="pp" class="usertop">
            <span id="mini_usertop_word1" class="mini_usertop_word" onclick="get_up(0);">角色</span>
            <span id="mini_usertop_word2" class="mini_usertop_word" onclick="get_up(1);">使用者</span>
            <span id="mini_usertop_word3" class="mini_usertop_word" onclick="get_up(2);">權限</span>
        </div>

        <div id="permission" class="permissionsize">
            <button id="createRUP" class="new_group_button2">+</button>
            <!--顯示角色-->
            <ul id='permission_list' class='permission_title_style '></ul>
        </div>

        <!-- 懸浮視窗 -->
        <div id="content">
            <div id="role_top" class="mini_roletop">
                <div id="mini_roletop_word" class="mini_roletop_word"></div>

                <button class="mini_close" onclick="close_page();">關閉</button>
                <input type='button' id="mini_data_sent" class="mini_data_sent" onclick="mini_sent_data();"
                    value='送出'></input>
            </div>
            <div id="role" class="mini_rolesize">
            </div>
        </div>
        <div id="black_overlay" class="black_overlay"></div>


        <script src="./setting/page.js?v=<?= time() ?>"></script>
        <script>

            // function sign_out() {
            //     $.ajax({
            //         url: '../top_bar.php', // 修改为你的 PHP 文件路径
            //         type: 'POST',
            //         success: function (response) {
            //             history.go(0)
            //         },
            //         error: function (xhr, status, error) {
            //             console.error(error);
            //         }
            //     });
            // }
        </script>
        <!-- 新增GR -->
        <script src="./setting/update_GR.js"></script>
        <!-- 創建群組欄位 -->
        <script src="./setting/groupData.js?v=<?= time() ?>"></script>
        <!-- 新增群組 -->
        <script src="./setting/new_group.js?v=<?= time() ?>"></script>
        <!-- GR -->
        <script src="./setting/GRData.js?v=<?= time() ?>"></script>
        <!-- 新增RUP -->
        <script src="./setting/create_RUP.js?v=<?= time() ?>"></script>
        <!-- 拖曳 -->
        <script src="./setting/group_drag.js?v=<?= time() ?>"></script>
        <script src="./setting/top_drag.js?v=<?= time() ?>"></script>
        <!-- 角色內容 -->
        <script src="./setting/RUP.js?v=<?= time() ?>"></script>
        <script src="./setting/delRUP.js?v=<?= time() ?>"></script>
        <!-- 初始化 -->
        <script>
            $(window).on('load', function () {
                groupData();
            });
        </script>
    </body>

</html>