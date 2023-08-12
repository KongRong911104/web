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
    $allGroup = rough_Read('groups');
    $group_html = "";
    for ($i = 0; $i < count($allGroup); $i++) {
        // 群組名稱
        $group_html = $group_html . '<ul class="grouplist_style" id="g_' . $allGroup[$i]['sn'] . '" data-name="' . $allGroup[$i]['groupName'] . '" style="background-color:' . $allGroup[$i]['groupColor'] . '">' . $allGroup[$i]['groupName'];
        // 群組顏色
        $group_html = $group_html . '<input type="color" onclick="set_color('.$allGroup[$i]['sn'].');" id="color_'.$allGroup[$i]['sn'].'" class="group_color" value="' . $allGroup[$i]['groupColor'] . '"/>';
        $Input = '<span onclick="del3(\'' .$allGroup[$i]['sn']. '\')" class="material-symbols-outlined">delete</span>';

        $group_html = $group_html .$Input;
        $GR=groupRole($allGroup[$i]['sn']);
        for ($j=0;$j<count($GR);$j++){
                $strSize=150/strlen($GR[$j]['roleName']);
                $Input2 = '<span onclick="del_GR(\'' . $allGroup[$i]['sn'] . '_' . $GR[$j]['sn'] .  '\')" class="material-symbols-outlined">delete</span>';

                $group_html = $group_html . '<li class="group_li_style" data-index="' . $allGroup[$i]['sn'] . '_' . $GR[$j]['sn'] . '" ondblclick="get_roleid(\''. strval($allGroup[$i]['sn']) . '_' . strval($GR[$j]['sn']) . '\');" style="font-size: '.$strSize.'px;">'.$GR[$j]['roleName'].'<span class="tooltiptext">'.$GR[$j]['roleName'].'</span>'.$Input2.'</li>';
            }

        $group_html = $group_html . '</ul>';
    }
    echo $group_html;
}
?>