<?php
// 確保此處接收到的是 POST 請求
function binarySearch2($arr, $target) {
    $left = 0;
    $right = count($arr) - 1;

    while ($left <= $right) {
        $mid = $left + floor(($right - $left) / 2);

        // 如果找到目標值，返回索引
        if ($arr[$mid] === $target) {
            return $mid;
        }

        // 如果目標值比中間值小，在左半部分繼續搜索
        if ($arr[$mid] > $target) {
            $right = $mid - 1;
        }

        // 如果目標值比中間值大，在右半部分繼續搜索
        if ($arr[$mid] < $target) {
            $left = $mid + 1;
        }
    }

    // 如果沒找到目標值，返回 -1
    return -1;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 接收從前端傳來的數據
    include "../crud.php";
    $selectedGRP = $_POST['selectedGRP'];
    $selectedGRU = $_POST['selectedGRU'];
    $GR=explode('_',$_POST['GR']);

    $allGRP=GRPermission($GR[0],$GR[1]);
    // 刪除GRP
    for ($i = 0; $i < count($allGRP); $i++) {
        if (binarySearch2($selectedGRP,$allGRP[$i]['sn'])==-1)
            delete_GRP($GR[0], $GR[1], $allGRP[$i]['sn']);
    }
    // 新增GRP
    for ($i=0;$i<count($selectedGRP);$i++){
        if (binarySearch($allGRP,$selectedGRP[$i],'permissionID')==-1)
            create_GRP($GR[0], $GR[1], $selectedGRP[$i]);
    }

    $allGRU=GRUser($GR[0],$GR[1]);

    // 刪除GRU
    for ($i = 0; $i < count($allGRU); $i++) {
        if (binarySearch2($selectedGRU,$allGRU[$i]['sn'])==-1)
            delete_GRU($GR[0], $GR[1], $allGRU[$i]['sn']);
    }
    // 新增GRU
    for ($i=0;$i<count($selectedGRU);$i++){
        if (binarySearch($allGRU,$selectedGRU[$i],'userID')==-1)
            create_GRU($GR[0], $GR[1], $selectedGRU[$i]);
    }
}
?>
