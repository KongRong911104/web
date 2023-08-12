<?php
// 確保此處接收到的是 POST 請求
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 接收從前端傳來的數據
    include "../crud.php";
    $permission=rough_Read("permission");
    $permission_html="";
    for($i=0;$i<count($permission);$i++){
        $Input = '<span onclick="del2(\'' .$permission[$i]['sn']. '\')" class="material-symbols-outlined">delete</span>';

        $permission_html.='<li class="permissionlist_style" id="'.$permission[$i]['sn'].'" data-index="'.$permission[$i]['sn'].'">'.$permission[$i]['permissionName'].' <span class="tooltiptext2">'.$permission[$i]['permissionName'].'</span>'.$Input .'</li>';
    }
    echo $permission_html;

}
?>
