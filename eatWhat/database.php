<?php
function connection()
{
    $server = "172.24.15.21";         # 伺服器
    $dbuser = "yeley_remote";       # 使用者帳號
    $dbpassword = "3.14159"; # 使用者密碼
    $dbname = "ubereat";    # 資料庫名稱
    $port = "3306";
    return  new mysqli($server, $dbuser, $dbpassword, $dbname,$port);
}
?>
