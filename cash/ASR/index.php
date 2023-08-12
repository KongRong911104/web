<?php


session_start();
if ($_SESSION['id'] != "") {
    include "../crud.php";

    $id = $_SESSION['id'];
    $check = GRUGRP(decrypt($id), 3);
    if (!empty($check)) {
        $folderName = './word_output/' . $id . "/";
        if (!is_dir($folderName)) {
            mkdir($folderName);
        }
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
    <link href="CSTE.css?v=<?= time() ?>" rel="stylesheet">

    <body>

        <!-- <div class="left_bar">
        <ul>
			學年
			<li class="folder">學年
				<ul class="hidden">
					學期
					<li class="folder">學期
						<ul class="hidden">
							課程
							<li class="folder">課程
								<ul class="hidden">
									類別
									<li class="folder">類別
										<ul class="hidden">
											次數
											<li class="folder">次數</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</li>
		</ul>
        </div> -->

        <div id="inform">
            <div id="wrap">
                <h2>各類作業及考試繳交紀錄表</h2>

                <form id="form" method="post" enctype="multipart/form-data" action="CSTEB.php">
                    <hr />
                    <a class="data" href="https://www.cs.thu.edu.tw/web/page/page.php?scid=76&sid=86">請詳讀此網頁內容</a>

                    <div class="data">

                        <div id="hint" style="font-weight: bold;color:red">※請選擇xlsx檔案&nbsp;若是xls檔請自行轉檔
                            <a href="./teach_xlsx.png" style="font-weight: bold;color:blue;cursor: pointer;">
                                <點我看教學>
                            </a>
                            <br />
                            內容欄位必須依序為學號，姓名，成績
                        </div>
                        選擇檔案&nbsp;

                        <input id="xlsx" type="file" name="my_file" required="required" accept=".xlsx"
                            width="30px"></input>
                        <span class="material-symbols-outlined" onclick="open_word();">visibility</span>
                    </div>
                    <br />
                    <br />
                    <br />

                    <span class="data">
                        授課教師:&nbsp;
                        <input id="teac_name" type="text" style="width:150px;height:50px;font-size:25px;"
                            name="teac_name" required="required" />
                    </span>
                    <span class="data">
                        助教名稱:&nbsp;
                        <input id="ta_name" type="text" style="width:150px;height:50px;font-size:25px;" name="ta_name"
                            required="required" />
                    </span>
                    <br />
                    <br />
                    <br />
                    <span class="data">
                        評量日期:&nbsp;
                        <input type="date" id="time" style="width:200px;height:50px;font-size:25px;" name="time"
                            required="required" />
                    </span>
                    <span class="data">
                        應交份數:&nbsp;
                        <input id="paper" type="number" style="width:150px;height:50px;font-size:25px;" name="paper"
                            required="required" />
                    </span>
                    <br />
                    <span class="data">
                        課程大綱之單元(4~8):&nbsp;
                        <input id="row" type="number" style="width:150px;height:50px;font-size:25px;" name="row"
                            required="required" min="4" max="8" value="4" />
                    </span>
                    <br />
                    <br />
                    <input class="button" type="submit" value="送出" onclick="a();"></input>
                    <?php

                    $dir = $folderName;

                    $files = array_map('basename', glob($dir . '{/*.docx,/*.DOCX}', GLOB_BRACE)); // 只讀取 DOCX 文件
                    if (!empty($files)) {
                        echo "<div class='data'>歷史資料(點擊下載):<br/>請下載檔案後開啟<br/>找出內容中的六位學生的考卷<br/>並用旁邊的掃瞄機掃描下載</div>";

                    }
                    foreach ($files as $file) {
                        // 對每個文件進行處理
                        $data = $dir . $file; // 要加密的数据
                        $encryptedData = encrypt($data);
                        $bu = "<span onclick='delfile(\"" . $encryptedData . "\");' class='material-symbols-outlined del'>delete</span></button>";
                        // $filename = explode("_", $file)[0];
                        $filename = $file;
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
    <script>
			// 獲取所有資料夾元素
			const folders = document.querySelectorAll('.folder');

			// 添加點擊事件監聽器
			folders.forEach(folder => {
				folder.addEventListener('click', (event) => {
					// 獲取下一層清單元素
					const subList = folder.querySelector('ul');
					// console.log(subList)
					// 切換顯示或隱藏
					if (subList != null ) {
						subList.classList.toggle('hidden');
						// 避免最下層隱藏
						if (!subList.classList.contains('hidden')) {
							const subFolders = subList.querySelectorAll('.folder');
							subFolders.forEach(subFolder => {
								subFolder.querySelectorAll('ul').forEach(sub => {
									sub.classList.add('hidden');
								});
							});
						}}
						// 停止事件冒泡
						event.stopPropagation();
				});
			});
		</script>
    <script src="./csjs/preview.js?v=<?= time() ?>"></script>

</html>