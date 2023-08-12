<?php
# 檢查檔案是否上傳成功
$maxFileSize = 3000000;
$year = $_POST['years'];
$semester = $_POST['semester'];
$check = 0;
$fin_dest="";
$first_dest="";
// $d="";
// echo count($_FILES['my_file']['name']);
// print_r($_FILES["my_file"]['tmp_name'][0]);
// print_r($_FILES["my_file"]['tmp_name'][1]);
for ($i = 0; $i < count($_FILES['my_file']['name']); $i++) {
    if ($_FILES['my_file']['error'][$i] === UPLOAD_ERR_OK) {
        if (explode(".", $_FILES['my_file']['name'][$i])[1] !== "xlsx") {
            echo '<h1 style="font-weight:bold;">Σ(っ °Д °:)っ檔案格式請用xlsx</h1>&nbsp;&nbsp;&nbsp;';
            echo "<button id='b' style='border-radius: 8px;padding: 7px 14px;background-color: rgba(238, 239, 239, 0.176);border: 2px solid #999393;' onclick='history.go(-1)'>回上一頁</button>";

        } else if ($_FILES["my_file"]["size"][$i] > $maxFileSize) {
            echo '<h1 style="font-weight:bold;">Σ(っ °Д °:)っ檔案太大了xlsx</h1>&nbsp;&nbsp;&nbsp;';
            echo "<button id='b' style='border-radius: 8px;padding: 7px 14px;background-color: rgba(238, 239, 239, 0.176);border: 2px solid #999393;' onclick='history.go(-1)'>回上一頁</button>";

        } else {
            $path = "../excel_tmp/";
            $t = time()+$i . '.xlsx';
            $file = $_FILES['my_file']['tmp_name'][$i];    
            $dest = $path . $t;
            if($i==0)
                $first_dest=$dest;
            $fin_dest .= $dest ."::123::";
            move_uploaded_file($file,  $dest);
            $check++;
        }
    } else {
        echo '<h1 style="font-weight:bold;">Σ(っ °Д °:)っ錯誤代碼：' . $_FILES['my_file']['error'] . '</h1>&nbsp;&nbsp;&nbsp;';
        echo "<button id='b' style='border-radius: 8px;padding: 7px 14px;background-color: rgba(238, 239, 239, 0.176);border: 2px solid #999393;' onclick='history.go(-1)'>回上一頁</button>";
        break;
    }
}
if ($check == count($_FILES['my_file']['name'])) {
    // exec("python ../merge_excel.py");
    $python_script = "python3 ../excel.py " . $fin_dest . " " . $year . " " . $semester;
    $result = json_decode(exec($python_script), true);
    unlink($first_dest);
    print_r($result);
    if (gettype($result) == "array") {
        session_start();
        $_SESSION['file'] = 1;
        header("Location: CSTE.php");
    } else {
        echo '<h1 style="font-weight:bold;">Σ(っ °Д °:)っ';
        print_r($result);
        echo'</h1>&nbsp;&nbsp;&nbsp;';
        echo "<button id='b' style='border-radius: 8px;padding: 7px 14px;background-color: rgba(238, 239, 239, 0.176);border: 2px solid #999393;' onclick='history.go(-1)'>回上一頁</button>";
        // print_r(gettype($result));
    }
}
else{
    echo $check." ".count($_FILES['my_file']['name']);
}
// echo '檔案名稱: ' . $_FILES['my_file']['name'] . '<br/>';
// echo '檔案類型: ' . $_FILES['my_file']['type'] . '<br/>';
// echo '檔案大小: ' . ($_FILES['my_file']['size'] / 1024) . ' KB<br/>';
// echo '暫存名稱: ' . $_FILES['my_file']['tmp_name'] . '<br/>';
# 檢查檔案是否已經存在
//     else {
//         $path = "../excel_tmp/";
//         $t = time() . '.xlsx';
//         $file = $_FILES['my_file']['tmp_name'];
//         $dest = $path . $t;
//         // echo $dest;
//         # 將檔案移至指定位置
//         move_uploaded_file($file, $dest);
//         $python_script = "python ../excel.py " . $dest . " " . $year . " " . $semester;
//         $result = json_decode(exec($python_script), true);
//         unlink($dest);
//         // echo gettype($result);
//         if ($result != NULL) {
//             session_start();
//             $_SESSION['file']=1;
//             header("Location: CSTE.php");
//         } else {
//             echo '<h1 style="font-weight:bold;">Σ(っ °Д °:)っ檔案內容格式錯誤</h1>&nbsp;&nbsp;&nbsp;';
//             echo "<button id='b' style='border-radius: 8px;padding: 7px 14px;background-color: rgba(238, 239, 239, 0.176);border: 2px solid #999393;' onclick='history.go(-1)'>回上一頁</button>";
//             // print_r(gettype($result));
//         }
//     }
// } else {
//     echo '<h1 style="font-weight:bold;">Σ(っ °Д °:)っ錯誤代碼：'. $_FILES['my_file']['error'].'</h1>&nbsp;&nbsp;&nbsp;';
//     echo "<button id='b' style='border-radius: 8px;padding: 7px 14px;background-color: rgba(238, 239, 239, 0.176);border: 2px solid #999393;' onclick='history.go(-1)'>回上一頁</button>";
// }
?>
<!DOCTYPE html>
<html>

    <head>
        <title>教學成效檢討回饋表</title>
        <meta charset="UTF-8">
    </head>
    <style>
        html,
        body {
            background-color: #585AD9;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        ul {
            list-style-type: none;
        }

        li {
            margin: 0, auto;
            padding: 10px;
            font-size: 30px;
            font-weight: bold;
            height: 70px;
        }

        #submit {
            position: relative;
            left: 500px;
            border-radius: 8px;
            padding: 7px 14px;
            background-color: rgba(238, 239, 239, 0.176);
            border: 2px solid #999393;
        }
    </style>

    <body id="form">
    </body>

</html>