<?php
include "./crud.php";
$username = $_POST['id'];
$password = $_POST['passwd'];
$datas=permission_detail_Read("stu","account",$username,"password",$password);
// 找出資料
$check_a = 0;
$check_b = 0;
$id="";
$id = $datas[0]['id'];
$name = $datas[0]['name'];
$userimg = $datas[0]['userimg'];
if($id!=""){
    $check_a = 1;
}
if (!isset($_SESSION)) {
    session_start();
}  //判斷session是否已啟動
$_SESSION['logtime'] = 0;
$_SESSION['captchatime'] = 0;
if ((!empty($_SESSION['check_word'])) && (!empty($_POST['checkword']))) {  //判斷此兩個變數是否為空
    if (strtolower($_SESSION['check_word']) == strtolower($_POST['checkword'])) {
        $_SESSION['check_word'] = ''; //比對正確後，清空將check_word值
        $check_b = 1;
    }
}

// 判斷登入是否正確,並跳轉
if ($check_a == 0 || $check_b == 0) {
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
    session_start();
    $_SESSION['id'] = $id;
    header('Location: ./home');
}
?>
