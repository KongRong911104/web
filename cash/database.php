<?php
function connection()
{
    $PATH= dirname(__FILE__);
    $filename = $PATH."/database_setting.txt"; // 要讀取的文本檔案名稱
    $file = fopen($filename, 'r');
    $arr=Array();
    if ($file) {
        // 逐行讀取檔案內容
        while (($line = fgets($file)) !== false) {
            // 輸出每一行的內容
            $arr[]=trim(explode("#",$line)[0]);
        }

        // 關閉檔案
        fclose($file);
    } else {
        // 無法開啟檔案
        echo "無法開啟檔案: $filename";
    }
    $server = (string)$arr[0];         # 伺服器
    $dbuser =  (string)$arr[1];       # 使用者帳號
    $dbpassword = (string)$arr[2]; # 使用者密碼
    $dbname = (string)$arr[3];    # 資料庫名稱
    // echo $server;
    // echo $dbuser;
    // echo $dbpassword;
    // echo $dbname;
    return  mysqli_connect($server, $dbuser, $dbpassword, $dbname);
}
// connection();
?>