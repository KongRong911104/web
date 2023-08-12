<?php
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
$check = 0;

$html="";
for ($i = 0; $i < count($_FILES['my_file']['name']); $i++) {
    $fin_dest="";
    $first_dest="";
    if ($_FILES['my_file']['error'][$i] === UPLOAD_ERR_OK) {
        if (explode(".", $_FILES['my_file']['name'][$i])[1] !== "xlsx") {

        } else if ($_FILES["my_file"]["size"][$i] > $maxFileSize) {
            echo '<h1 style="font-weight:bold;">Σ(っ °Д °:)っ檔案太大了xlsx</h1>&nbsp;&nbsp;&nbsp;';
            // echo "<button id='b' style='border-radius: 8px;padding: 7px 14px;background-color: rgba(238, 239, 239, 0.176);border: 2px solid #999393;' onclick='history.go(-1)'>回上一頁</button>";

        } else {
            $path = "./excel_tmp/";
            $t = time()+$i . '.xlsx';
            $file = $_FILES['my_file']['tmp_name'][$i];    
            $dest = $path . $t;
            if($i==0)
                $first_dest=$dest;
            $fin_dest .= $dest;
            move_uploaded_file($file,  $dest);
            $check++;
            $python_script = "python3 ./preview_excel.py " . $fin_dest;
            $result = json_decode(exec($python_script), true);
            $html=$html."<li id='preview_".$check."' onclick='preview(".$check.");' class='preview_title'>".$_FILES['my_file']['name'][$i]."&nbsp;&nbsp;&nbsp;&nbsp;▼".$result."</li>";
        }
    } else {
        echo '<h1 style="font-weight:bold;">Σ(っ °Д °:)っ錯誤代碼：' . $_FILES['my_file']['error'] . '</h1>&nbsp;&nbsp;&nbsp;';
        // echo "<button id='b' style='border-radius: 8px;padding: 7px 14px;background-color: rgba(238, 239, 239, 0.176);border: 2px solid #999393;' onclick='history.go(-1)'>回上一頁</button>";
        break;
    }
    // unlink($fin_dest);
}
// $python_script = "python3 ./preview_excel.py " . $fin_dest . " " . $year . " " . $semester." ".$id;
// $result = json_decode(exec($python_script), true);
echo $html;

?>