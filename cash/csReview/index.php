<?php
session_start();

if ($_SESSION['id'] != "") {
    include "../crud.php";

    $id = $_SESSION['id'];
    $check = GRUGRP(decrypt($id), 2);
    if (!empty($check)) {
        $folderName = './word_output/' . $id . "/";
        if (!is_dir($folderName)) {
            mkdir($folderName);
        }
    }
} else {
    header("Location: ../");
}
?>
<!DOCTYPE html>
<html>

    <head>
        <title>教學成效檢討回饋表</title>
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
    <link href="CSTE.css?v=<?=time()?>" rel="stylesheet">

    <body>
        <!-- 
        <div>
            <button id="sign_out" onclick="sign_out();">登出</button>
        </div> -->

        <div id="inform">
            <div id="wrap">
                <h2>教學成效檢討回饋表</h2>

                <form id="form" method="post" enctype="multipart/form-data" action="CSTEB.php">
                    <hr />
                    <div class="file">

                        <div id="hint" style="font-weight: bold;color:red">※請選擇xlsx檔案&nbsp;若是xls檔請自行轉檔
                            <a href="./teach_xlsx.png" style="font-weight: bold;color:blue;cursor: pointer;">
                                <點我看教學>
                            </a>
                        </div>
                        選擇檔案(可選多個):&nbsp;
                        <br />
                        <input id="xlsx" type="file" multiple="multiple" name="my_file[]" required="required"
                            accept=".xlsx" width="50px"></input>
                        <span class="material-symbols-outlined" onclick="open_word();">visibility</span>
                    </div>

                    <div id="years_data" class="years">
                        學年:&nbsp;
                        <select id="years" name="years" required="required">
                            <option value="">--請選擇學年--</option>
                            <option v-for="n in numbers" :key="n">
                                {{n}}
                            </option>
                        </select>
                    </div>

                    <div class="semester">
                        學期:&nbsp;
                        <select id="semester" name="semester" required="required">
                            <option value="">--請選擇學期--</option>
                            <option value="上">上</option>
                            <option value="下">下</option>
                        </select>
                    </div>
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
                        $filename = explode("_", $file)[0];
                        $day = explode(".", explode("_", $file)[1])[0];
                        echo "<div class='data' id='" . $encryptedData . "_id' ><span id='" . $encryptedData . "' onclick='File();'>" . $filename . "&nbsp;&nbsp;&nbsp;" . $day . "</span>" . $bu . "</div>";
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
        <br />
        <div id="pre_exdata" class="pre_exdata" onclick="pre_exdata();">編輯反思表(開啟)</div>
        <div id="preview_exdata"></div>

    </body>
    <script src="./csjs/preview.js?v=<?=time()?>"></script>

</html>