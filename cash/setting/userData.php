<?php
// 確保此處接收到的是 POST 請求
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 接收從前端傳來的數據
    include "../crud.php";
    $user=rough_Read("users");
    $user_html="";
    for($i=0;$i<count($user);$i++){
        $Input = '<span onclick="del1(\'' .$user[$i]['sn']. '\')" class="material-symbols-outlined">delete</span>';

        $user_html.='<li class="permissionlist_style id="'.$user[$i]['sn'].'" data-index="'.$user[$i]['sn'].'">'.$user[$i]['userName'].' <span class="tooltiptext2">'.$user[$i]['account'].'</span>'.$Input .'</li>';
    }
    echo $user_html;

}
?>
