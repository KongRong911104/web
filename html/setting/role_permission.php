<?php
include '../crud.php';
$array=$_POST['mini_datas_sent'];
$array = json_decode($array);
// print_r($array);
$delete_data =array();
$database = array();
$data = permission_detail_Read('rolepermission','groupid',$array[0][0],'roleid',$array[0][1]);
// print_r($data);
for ($i = 0; $i < count($data); $i++) {
    $database[] = [$data[$i]['groupid'],$data[$i]['roleid'],$data[$i]['permissionlevel']];
}
print_r($database);
print_r($array);
for ($i = 0; $i < count($database); $i++) {
    $a=0;
    for ($j = 0; $j < count($array); $j++) {
        if ($database[$i][0] == $array[$j][0] && $database[$i][1] == $array[$j][1] && $database[$i][2] == $array[$j][2]) {
            $a=1;
            break;
        }
    }
    if ($a == 0) {
        $delete_data[]=$database[$i];
    }
}
for ($i=0;$i<count($array);$i++){
    create_rolepermission($array[$i][0],$array[$i][1],$array[$i][2]);
}
print_r($delete_data);
for ($i=0;$i<count($delete_data);$i++){
    delete_rolepermission($delete_data[$i][0],$delete_data[$i][1],$delete_data[$i][2]);
}
header('Location: ./');
?>