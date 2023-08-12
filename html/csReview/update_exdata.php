<?php
function decrypt($encryptedData)
{
    $key = "zasxcdfvbghnmjk,"; // 加密密钥（16字节）
    $iv = " 1dfl6 p9b]st1^k"; // 初始向量（16字节）
    $encryptedData = base64_decode($encryptedData);
    $decrypted = openssl_decrypt($encryptedData, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
    return $decrypted;
}
include '../crud.php';
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // $a = "";
    $exdata = $_POST['exdata'];
    $b = array();
    $arr = array();
    $i = 0;
    foreach ($exdata as $name) {
       
        if ($i != 0 && $i % 15 == 0) {
            $arr[] = $b;
            $b=array();
            $b[] =$name;
        }
        else
            $b[] = $name;
        $i++;
    }
    $arr[] = $b;
    // echo $a;
    // print_r($arr);
    for ($i = 0; $i < count($arr); $i++) {
        $arr[$i][0]= decrypt($arr[$i][0]);
        $arr[$i][1]=htmlspecialchars($arr[$i][1], ENT_QUOTES, 'UTF-8');
        // if (stripos($arr[$i][1], "<") !== false) {
        //     echo "字串中包含 JavaScript 語法";
        // }
        // if (stripos($arr[$i][1], "'") !== false) {
        //     echo "字串中包含 JavaScript 語法";
        // }
        // if (stripos($arr[$i][1], '"') !== false) {
        //     echo "字串中包含 JavaScript 語法";
        // }
        // if (stripos($arr[$i][1], '=') !== false) {
        //     echo "字串中包含 JavaScript 語法";
        // }
        
        // else
        update_exdata($arr[$i][0], $arr[$i][1], $arr[$i][2], $arr[$i][3], $arr[$i][4], $arr[$i][5], $arr[$i][6], $arr[$i][7], $arr[$i][8], $arr[$i][9], $arr[$i][10], $arr[$i][11], $arr[$i][12], $arr[$i][13], $arr[$i][14]);
        // echo "\n";
    }
    // print_r($arr);
}
?>