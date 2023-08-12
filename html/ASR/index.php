<?php


function encrypt($data)
{
    $key = "zasxcdfvbghnmjk,"; // 加密密钥（16字节）
    $iv = " 1dfl6 p9b]st1^k"; // 初始向量（16字节）
    $encrypted = openssl_encrypt($data, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($encrypted);
}
session_start();
if ($_SESSION["ok"] == true && $_SESSION['id'] != "") {
    include "../crud.php";
    $p = detail_Read("rolepermission", "permissionlevel", "2");
    $g = array();
    for ($i = 0; $i < count($p); $i++) {
        $g = permission_detail_Read("permission", "groupid", $p[$i]['groupid'], "permissionlevel", $p[$i]['roleid']);
    }
    
    $id = $_SESSION['id'];
    print_r($g);
    $k = 0;
    for ($i = 0; $i < count($g); $i++) {
        if ($id == $g[$i]['id']) {
            // echo $g[$i]['id'];
            $k = 1;
            $folderName = './word_output/' . encrypt($id) . "/";
            if (!is_dir($folderName)) {
                mkdir($folderName);
            }
        }
    }
    if ($k == 0) {
        header("Location: ../");
    }
} else {
    header("Location: ../");
} ?>
<!DOCTYPE html>
<html>

    <head>
        <title>各類作業及考試繳交紀錄表</title>
        <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <!-- <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> -->
        <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
        <!-- <meta http-equiv="Content-Security-Policy" content="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"> -->
        <!-- <meta http-equiv="Content-Security-Policy" content="https://unpkg.com"> -->
        <!-- <meta http-equiv="Content-Security-Policy" content="CSTE.css"> -->
        <!-- <meta http-equiv="Content-Security-Policy" content='https://unpkg.com/vue@3/dist/'> -->
        <!-- <meta http-equiv="Content-Security-Policy" content="'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200'"> -->
        <meta charset="UTF-8">
    </head>
    <link href="CSTE.css" rel="stylesheet">

    <body>
        <div id="inform">
            <div id="wrap">
                <h2>各類作業及考試繳交紀錄表</h2>

                <form id="form" method="post" enctype="multipart/form-data" action="CSTEB.php">
                    <hr />
                    <div class="data">

                        <div id="hint" style="font-weight: bold;color:red">※請選擇xlsx檔案&nbsp;若是xls檔請自行轉檔
                            <a href="./teach_xlsx.png" style="font-weight: bold;color:blue;cursor: pointer;">
                                <點我看教學>
                            </a>
                        </div>
                        選擇檔案&nbsp;

                        <input id="xlsx" type="file" name="my_file" required="required" accept=".xlsx"
                            width="30px"></input>
                        <span class="material-symbols-outlined" onclick="open_word();">visibility</span>
                    </div>
                    <br />
                        <br />
                        <br />
                    <!-- <span class="data">
                        科目代號:&nbsp;
                        <input type="number" id="class_id" style="width:100px;height:50px;font-size:25px;" name="class_id" required="required" />
                    </span>

                    <span class="data">
                        科目名稱:&nbsp;
                        <input id="class_name" type="text" style="width:200px;height:50px;font-size:25px;" name="class_name" required="required" />
                    </span>
                    <br/>
                    <br />
                    <br /> -->
                    <span class="data">
                        授課教師:&nbsp;
                        <input id="teac_name" type="text" style="width:150px;height:50px;font-size:25px;" name="teac_name" required="required" />
                    </span>
                    <span class="data">
                        助教名稱:&nbsp;
                        <input id="ta_name" type="text" style="width:150px;height:50px;font-size:25px;" name="ta_name" required="required" />
                    </span>
                    <br />
                        <br />
                        <br />
                    <div class="data">
                        評量日期:&nbsp;
                        <input type="date" id="time" style="width:200px;height:50px;font-size:25px;" name="time" required="required" />
                    </div>
                    <br />
                        <br />
                        <br />
                    <input class="button" type="submit" value="送出" onclick="a();"></input>

                    <?php

                    $dir = $folderName;

                    $files = array_map('basename', glob($dir . '{/*.docx,/*.DOCX}', GLOB_BRACE)); // 只讀取 DOCX 文件
                    if (!empty($files)) {
                        echo "<div class='data_title'>歷史資料(點擊下載):</div>";
                    }
                    foreach ($files as $file) {
                        // 對每個文件進行處理
                        $data = $dir . $file; // 要加密的数据
                        $encryptedData = encrypt($data);
                        $bu = "<span onclick='delfile(\"" . $encryptedData . "\");' class='material-symbols-outlined del'>delete</span></button>";
                        // $filename = explode("_", $file)[0];
                        $filename=$file;
                        // $day = explode(".", explode("_", $file)[1])[0];
                        echo "<div class='data' id='" . $encryptedData . "_id' ><span id='" . $encryptedData . "' onclick='File();'>" . $filename . "&nbsp;&nbsp;&nbsp;" . "</span>" . $bu . "</div>";
                    }
                    ?>
                    <div id="pre_w"></div>
                </form>

                <div id="border" class="border" style="display:none">
                    <div id="load" class="loader" style="display:none">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <svg>
                    <filter id="gooey">
                        <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                        <feColorMatrix type="matrix" in="blur" values="1 0 0 0 0
                           0 1 0 0 0
                           0 0 1 0 0
                           0 0 0 10 -5" />
                    </filter>
                </svg>
            </div>
            <div id="preview" style="display:none">
                <div id="word_page"></div>
            </div>
        </div>

    </body>
    <script src="./csjs/preview.js"></script>

</html>