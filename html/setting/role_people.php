<?php
include '../crud.php';
$array = $_POST['mini_datas_sent'];
$color_array=$_POST['mini_color_datas_sent'];
$array = json_decode($array);
$color_array = json_decode($color_array);
// print_r($color_array);

$data=detail_Read('permission', 'groupid', $array[0][1]);
$database = array();
for ($i = 0; $i < count($data); $i++) {
    $database[] = [$data[$i]['id'],$data[$i]['groupid'],$data[$i]['permissionlevel']];
}
$delete_data =array();
$create_data =array();
for ($i = 0; $i < count($database); $i++) {
    $a=0;
    $b=0;
    for ($j = 0; $j < count($array); $j++) {
        if ($database[$i][0]==$array[$j][0] && $database[$i][2]==$array[$j][2]) {
            $a=1;
        }
    }
    if ($a == 0) {
        $delete_data[]=($database[$i]);
    }
}
for ($i = 0; $i < count($array); $i++) {
    $a=0;
    $b=0;
    for ($j = 0; $j < count($database); $j++) {
        if ($database[$j][0] == $array[$i][0] && $database[$j][2] == $array[$i][2]) {
            $a=1;
        }
    }
    if ($a == 0) {
        $create_data[]=($array[$i]);
    }
}
// print_r($create_data);
for ($i = 0; $i < count($delete_data); $i++) {
    delete_permission($delete_data[$i][0],$delete_data[$i][1]);
    delete_rolepermission3($$delete_data[$i][0],$delete_data[$i][1]);
}
for ($i = 0; $i < count($create_data); $i++) {
    create_permission($create_data[$i][0],$create_data[$i][1],$create_data[$i][2]);
}

// print_r($color);
for ($i = 0; $i < count($color_array); $i++) {
    // print_r ($color[$i]);
    create_rolecolor($color_array[$i][0], $color_array[$i][1], $color_array[$i][2], $color_array[$i][3]);
}
header('Location: ./');
?>