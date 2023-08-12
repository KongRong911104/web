<?php
// 確保此處接收到的是 POST 請求
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 接收從前端傳來的數據
    include "../crud.php";
    create_Permission(htmlspecialchars($_POST['permissionName'], ENT_QUOTES, 'UTF-8'));
    // echo $_POST['permissionName'];

}
?>
