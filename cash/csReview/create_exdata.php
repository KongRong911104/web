<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    include '../crud.php';
    $exdata = $_POST['add_exdata'];
    $b = array();
    $arr = array();
    $i = 0;
    foreach ($exdata as $name) {
       
        if ($i != 0 && $i % 14 == 0) {
            $arr[] = $b;
            $b=array();
            $b[] =$name;
        }
        else
            $b[] = $name;
        $i++;
    }
    $arr[] = $b;
    for ($i = 0; $i < count($arr); $i++) {
        $arr[$i][0]=htmlspecialchars($arr[$i][0], ENT_QUOTES, 'UTF-8');

        create_exdata($arr[$i][0], $arr[$i][1], $arr[$i][2], $arr[$i][3], $arr[$i][4], $arr[$i][5], $arr[$i][6], $arr[$i][7], $arr[$i][8], $arr[$i][9], $arr[$i][10], $arr[$i][11], $arr[$i][12], $arr[$i][13]);
    }
}
?>