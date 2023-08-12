<?php
session_start();
if ($_SESSION["ok"]==true && $_SESSION['id']!=""){
    $id=$_SESSION['id'];
}
else{
    header("Location: /index.php");
}?>
<!DOCTYPE html>
<html>

    <head>
        <title>教學成效檢討回饋表</title>
        <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <!-- <meta http-equiv="Content-Security-Policy" content="https://unpkg.com"> -->
        <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'https://unpkg.com/vue@3/dist/'"> -->
        <meta charset="UTF-8">
    </head>
    <link href="CSTE.css" rel="stylesheet">

    <body>
        <div id="wrap">
            <h2>教學成效檢討回饋表</h2>
            <span id="menu" class="material-icons" onclick="open_word();">menu</span>
            <form id="form" method="post" enctype="multipart/form-data" action="CSTEB.php">
                <hr />
                <div class="file">

                    <div id="hint" style="font-weight: bold;color:red">※請選擇xlsx檔案&nbsp;若是xls檔請自行轉檔
                        <a href="../teach_xlsx.png" style="font-weight: bold;color:blue;cursor: pointer;">
                            < 點我看教學 >
                        </a>
                    </div>
                    選擇檔案(可選多個):&nbsp;
                    <input id="xlsx" type="file"  multiple="multiple" name="my_file[]" required="required" accept=".xlsx" width="50px"></input>
                </div>

                <div id="years_data" class="years">
                    學年:&nbsp;
                    <!-- <input id="years" type="text" name="years" placeholder="--請輸入學年--" required="required" /> -->
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
            <!-- <VueDocPreview value="../1011_微積分甲〈一〉_謝維華_教學成效檢討回饋表.docx" type="office" /> -->
            <iframe src="https://view.officeapps.live.com/op/view.aspx?src=../word_output/1/111上教學成效表.docx" width="500px" height="700px"></iframe>      
            <?php
            // echo '<a href="../test.zip">檔案下載</a> '."<br />";
            $dir = '../word_output';
            $files = array_map('basename', glob($dir . '{\*.docx,\*.DOCX}', GLOB_BRACE)); // 只讀取 DOCX 文件
            foreach ($files as $file) {
                // 對每個文件進行處理
                echo $file . "<br/>";
            }
            ?>
        </div>
    </body>
    <script>
        check = "";
        document.getElementById('xlsx').onchange = function () {
            check = this.value.replace(/.*[\/\\]/, '').split(".")[1];
            if (check != "xlsx") {
                document.getElementById('xlsx').value = "";
                alert("請選擇.xlsx檔");
            }
        };
        function a() {
            if (document.getElementById('xlsx').value != "" && document.getElementById('years').value != "" && document.getElementById('semester').value != "") {
                document.getElementById('border').style = "display:block";
                document.getElementById('load').style = "display:block";
            }

        }
    </script>
    <script>
        let myDate = new Date();
        let thisYear = myDate.getFullYear();
        const app = Vue.createApp({
            data() {
                return {
                    numbers: []
                }
            },
            created() {
                for (let i = 0; i >= -5; i--) {
                    this.numbers.push(thisYear - 1911 + i)
                }
            }
        })
        app.mount('#years_data')
    </script>
    <script>
        let page = 1;
        function open_word() {
            if (page == 1) {
                document.getElementById("preview").style = "display:block;";
                document.getElementById("wrap").style = "border-top-right-radius: 0%;border-bottom-right-radius: 0%;";
            }

            else {
                document.getElementById("preview").style = "display:none";
                document.getElementById("wrap").style = "border-top-right-radius: 40px;border-bottom-right-radius: 40px;";
            }

            page = -page;
        }
    </script>

</html>