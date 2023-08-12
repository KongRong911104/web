<?php
include "./crud.php";
$check_a = 0;
$check_b = 0;
if (!isset($_SESSION)) {
    session_start();
}  //判斷session是否已啟動
// 驗證碼
$_SESSION['logtime'] = 0;
$_SESSION['captchatime'] = 0;
if ((!empty($_SESSION['check_word'])) && (!empty($_POST['checkword']))) {  //判斷此兩個變數是否為空
    if (strtolower($_SESSION['check_word']) == strtolower($_POST['checkword'])) {
        $_SESSION['check_word'] = ''; //比對正確後，清空將check_word值
        $check_b = 1;
    }
}
$username = $_POST['id'];
$password = $_POST['passwd'];
$datas=detail2_Read("users","account",$username,"password",$password);
print_r($datas);
// 判斷帳號是否存在
$sn="";
if (count($datas)!=0){
    $check_a=1;
    $sn = $datas[0]['sn'];
    $userName = $datas[0]['userName'];
}

// // 判斷登入是否正確,並跳轉
if (!($check_a && $check_b )){
    if ($check_a == 0) {
        $_SESSION['logtime'] = 1;
    }
    if ($check_b == 0) {
        $_SESSION['captchatime'] = 1;
    }
    header('Location: ./');
    exit;
} 
else{
//     echo ($sn);
    $_SESSION['id'] = encrypt($sn);
    header('Location: ./home');
}
?>
