<?php
# 檢查檔案是否上傳成功
session_start();

$id=$_SESSION['id'];

if ($id == '') {
    header('Location: ../');
    exit;
}
else{
    unset($_SESSION['id']);
    $_SESSION['id']=$id;
}
$maxFileSize = 3000000;
$year = $_POST['years'];
$semester = $_POST['semester'];
$check = 0;
$fin_dest="";
$first_dest="";

for ($i = 0; $i < count($_FILES['my_file']['name']); $i++) {
    if ($_FILES['my_file']['error'][$i] === UPLOAD_ERR_OK) {
        if (explode(".", $_FILES['my_file']['name'][$i])[1] !== "xlsx") {
            echo '<h1 style="font-weight:bold;">Σ(っ °Д °:)っ檔案格式請用xlsx</h1>&nbsp;&nbsp;&nbsp;';
            echo "<button id='b' style='border-radius: 8px;padding: 7px 14px;background-color: rgba(238, 239, 239, 0.176);border: 2px solid #999393;' onclick='history.go(-1)'>回上一頁</button>";

        } else if ($_FILES["my_file"]["size"][$i] > $maxFileSize) {
            echo '<h1 style="font-weight:bold;">Σ(っ °Д °:)っ檔案太大了xlsx</h1>&nbsp;&nbsp;&nbsp;';
            echo "<button id='b' style='border-radius: 8px;padding: 7px 14px;background-color: rgba(238, 239, 239, 0.176);border: 2px solid #999393;' onclick='history.go(-1)'>回上一頁</button>";

        } else {
            $path = "./excel_tmp/";
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
    $python_script = "python3 ./excel.py " . $fin_dest . " " . $year . " " . $semester." ".$id;
    $result = json_decode(exec($python_script), true);
    echo gettype($result);
    if (gettype($result) == "NULL") {
        header("Location: ./");
    } else {
        echo '<h1 style="font-weight:bold;">Σ(っ °Д °:)っ';
        print_r($result);
        echo'</h1>&nbsp;&nbsp;&nbsp;';
        echo "<button id='b' style='border-radius: 8px;padding: 7px 14px;background-color: rgba(238, 239, 239, 0.176);border: 2px solid #999393;' onclick='history.go(-1)'>回上一頁</button>";
    }
}
else{
    echo $check." ".count($_FILES['my_file']['name']);
}
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