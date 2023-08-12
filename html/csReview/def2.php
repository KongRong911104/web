<?php
function decrypt($encryptedData, $key, $iv)
{
    $encryptedData = base64_decode($encryptedData);
    $decrypted = openssl_decrypt($encryptedData, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
    return $decrypted;
}



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $file_name = $_POST['class_name'];
    $key = "zasxcdfvbghnmjk,"; // 加密密钥（16字节）
    $iv = " 1dfl6 p9b]st1^k"; // 初始向量（16字节）
    $result= decrypt($file_name, $key, $iv);
    include '../crud.php';
    delete_exdata($result);
}
?>