<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "../crud.php";
    if (!isset($_SESSION)) {
        session_start();
    } //判斷session是否已啟動

    $id = $_SESSION['id'];
    if ($id == "") {
        http_response_code(400); // 使用 400 Bad Request 狀態碼
        echo '發生錯誤 - 請求參數不正確'; // 回傳錯誤訊息
        exit;
    }
    $allPermission = rough_Read('permission');
    $GRP=detail2_Read('GRP','groupID',$_POST['groupID'],'roleID',$_POST['roleID']);
    $allUser= rough_Read('users');
    $GRU=detail2_Read('GRU','groupID',$_POST['groupID'],'roleID',$_POST['roleID']);
    $GR_html = "";
    $GR_html.="<h3>權限</h3><hr/><br/>";
    for ($i = 0; $i < count($allPermission); $i++) {
        // 有此GR

        if (binarySearch($GRP,$allPermission[$i]['sn'],'permissionID')!=-1) {
            $GR_html = $GR_html . '<label><input GR="'.$_POST['groupID'].'_'.$_POST['roleID'].'" type="checkbox" name="GRP" value="'.$allPermission[$i]['sn'].'" checked>'.$allPermission[$i]['permissionName'].' </label>';
        } else {
            $GR_html = $GR_html . '<label><input GR="'.$_POST['groupID'].'_'.$_POST['roleID'].'" type="checkbox" name="GRP" value="'.$allPermission[$i]['sn'].'"> '.$allPermission[$i]['permissionName'].'</label>';
        }
        
    }
    $GR_html.="<br/><br/><br/><h3>使用者</h3><hr/><br/>";
    for ($i = 0; $i < count($allUser); $i++) {
        // 有此GR

        if (binarySearch($GRU,$allUser[$i]['sn'],'userID')!=-1) {
            $GR_html = $GR_html . '<label><input GR="'.$_POST['groupID'].'_'.$_POST['roleID'].'" type="checkbox" name="GRU" value="'.$allUser[$i]['sn'].'" checked>'.$allUser[$i]['userName'].' </label>';
        } else {
            $GR_html = $GR_html . '<label><input GR="'.$_POST['groupID'].'_'.$_POST['roleID'].'" type="checkbox" name="GRU" value="'.$allUser[$i]['sn'].'"> '.$allUser[$i]['userName'].'</label>';
        }
        
    }
    echo $GR_html;
}
?>