<?php

session_start();

if (isset($_SESSION['s_login']) && $_SESSION['s_login'] == "ok") {
    session_unset();
    $_SESSION['login_status']="on";
    echo "<script>alert('登入成功！');window.location.href='index.html';</script>";
    exit;
}

$servername = "172.24.15.21";
$username = "yeley_remote";
$password = "3.14159";
$dbname = "little_pro_web";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("連接失敗" . $conn->connect_error);
}

$user_name = $_POST['user_name'];
$user_password = $_POST['password'];

$sql = sprintf("SELECT * FROM `user` WHERE `user_name`= '%s';", $user_name);

$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($result->num_rows == 1 && $user_password == $row['user_password']) {
    $_SESSION['s_login'] = "ok";
    header("location:eat_login.php");
    exit;
} else {
    echo "<script>alert('登入失敗。'); window.location.href='index.html';</script>";

}

?>