<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function encrypt($data)
    {
        $key = "zasxcdfvbghnmjk,"; // 加密密钥（16字节）
        $iv = " 1dfl6 p9b]st1^k"; // 初始向量（16字节）
        $encrypted = openssl_encrypt($data, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($encrypted);
    }

    $title = ['課程名稱', '每周小時數', '數學', '基礎', '專理', '專實', '核1', '核2', '核3', '核4', '核5', '核6', '核7', '核8'];
    include "../crud.php";
    $a = rough_Read('exdata');
    $resulr_list = [];
    $completeList = array();
    foreach ($a as $item) {
        $values = array_values($item);
        $completeList[] = $values;
    }

    $table = '<table id="Exdata" border="1" class="dataframe"  > ';
    $thead = '<thead><tr style="text-align: center;"><th style="border:none"></th>';
    foreach ($title as $i) {
        $thead .= '<th>' . $i . '</th>';
    }
    $thead .= '</tr></thead>';
    $tbody = '<tbody>';
    foreach ($completeList as $i) {
        $sn = encrypt($i[0]);
        $tbody .= '<tr id="' . $sn . '">';
        if ($i[count($i) - 1] == 0) {
            for ($j = 0; $j < count($i) - 1; $j++) {
                if ($j == 0) {
                    $Input = '<span onclick="del2(\'' . $sn . '\')" class="material-symbols-outlined del2">delete</span><input type="hidden" name="exdata[]" value="' . $sn . '"/></td>';
                } elseif ($j == 1) {
                    $Input = '<input type="text" name="exdata[]" required="required" value="' . $i[$j] . '" style="border:none;font-size:25px;"></input>';
                } elseif ($j == 2) {
                    $Input = '<input type="number" name="exdata[]" required="required" value="' . $i[$j] . '" style="border:none;width:60px;height:50px;font-size:25px;"></input>';
                } elseif ($j < 7 && $j > 2) {
                    $Input = '<input type="number" name="exdata[]" style="border:none;width:60px;height:50px;font-size:25px;" value="' . $i[$j] . '"></input>';
                } else {
                    if ($i[$j] == "■") {
                        $value = "■";
                        $text = "■";
                        $otherValue = "NULL";
                        $other = "";
                    } else {
                        $value = "NULL";
                        $text = "";
                        $otherValue = "■";
                        $other = "■";
                    }
                    $Input = '<select style="border:none;width:60px;font-size:25px;" name="exdata[]"><option value="' . $value . '" style="border:none">' . $text . '</option><option value="' . $otherValue . '" style="border:none">' . $other . '</option></select>';
                }
                if ($j == 0)
                    $tbody .= '<td style="border:none">' . $Input . '</td>';
                else
                    $tbody .= '<td>' . $Input . '</td>';
            }
        }
        else{

        }
        $tbody .= '</tr>';
    }

    $tbody .= '</tbody>';
    $table .= $thead . $tbody . "</table>" . '<input class="button2" type="submit" value="送出" onclick="update_exdata();"></input>' .'<br/><br/>'.'<span style="font-size:25px;">新增資料(份數):</span>&nbsp;<input type="number" id="numexdatas" name="numexdatas" min="0" style="width:60px;height:50px;font-size:25px;" >&nbsp;&nbsp;<input id="add_button" class="button2" type="submit" value="送出" onclick="create_exdata();" style="display:none;"></input><table id="add_extable" ></table>'.'<br/><br/>'.'<div class="pre_exdata" onclick="pre_exdata();">編輯反思表(關閉)</div>';

    echo $table;
}
?>