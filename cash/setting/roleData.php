<?php
// 確保此處接收到的是 POST 請求
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 接收從前端傳來的數據
    include "../crud.php";
    $role=rough_Read("roles");
    $role_html="";
    for($i=0;$i<count($role);$i++){
        $Input = '<span onclick="del0(\'' .$role[$i]['sn']. '\')" class="material-symbols-outlined">delete</span>';

        $role_html.='<li class="permissionlist_style  ui-draggable" id="'.$role[$i]['sn'].'" data-index="'.$role[$i]['sn'].'">'.$role[$i]['roleName'].' <span class="tooltiptext2">'.$role[$i]['roleName'].'</span>'.$Input.'</li>';
    }
    echo $role_html;

}
?>
