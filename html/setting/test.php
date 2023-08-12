<?php
$title = ['課程名稱', '每周小時數', '數學', '基礎', '專理', '專實', '核1', '核2', '核3', '核4', '核5', '核6', '核7', '核8'];
include "../crud.php";
$a = rough_Read('exdata');
$resulr_list = [];
$completeList = array();
foreach ($a as $item) {
    $values = array_values($item);
    $completeList[] = $values;
}
// print_r($completeList);









$table = '<table border="1" class="dataframe" >';
$thead = '<thead><tr style="text-align: center;"><th style="border:none"></th>';
foreach ($title as $i) {
    $thead .= '<th>' . $i . '</th>';
}
$thead .= '</tr></thead>';
$tbody = '<tbody>';
foreach ($completeList as $i) {
    $tbody .= '<tr style="text-align: center;"><td style="border:none"><span class="material-symbols-outlined del2">delete</span></td>';
    for ($j = 0; $j < count($i); $j++) {
        if ($j == 0) {
            $Input = '<input type="text" required="required" value="' . $i[$j] . '" style="border:none"></input>';
        } elseif ($j == 1) {
            $Input = '<input type="number" required="required" value="' . $i[$j] . '" style="border:none;width:40px;"></input>';
        } elseif ($j < 6 && $j > 1) {
            $Input = '<input type="number" style="border:none;width:40px;" value="' . $value . '"></input>';
        } else {
            $Input = '<select><option value="' . $value . '" style="border:none">' . $text . '</option><option value="' . $otherValue . '" style="border:none">' . $other . '</option></select>';
        }
        $tbody .= '<td>' . $Input . '</td>';
    }
    $tbody .= '</tr>';
}
$df = null;
$tbody .= '</tbody>';
$table .= $thead . $tbody . "</table>" . '<input class="button2" type="submit" value="送出" onclick="b();"></input>' . '<div class="pre_exdata" onclick="pre_exdata();">編輯反思表(關閉)</div>';

echo $table;
?>