<?php
include '../crud.php';
$array = $_POST['datas_sent'];
$d = rough_Read('grouppermission');
$database = array();
for ($i = 0; $i < count($d); $i++) {
    $database[] = [$d[$i]['groupid'], $d[$i]['permissionlevel']];
}
$array = json_decode($array);
// print_r($array);
$delete_data =array();
for ($i = 0; $i < count($database); $i++) {
    $a=0;
    for ($j = 0; $j < count($array); $j++) {
        if ($database[$i][0] == $array[$j][0] && $database[$i][1] == $array[$j][1]) {
            $a=1;
        }
    }
    if ($a == 0) {
        $delete_data[]=($database[$i]);
    }
}
// print_r($delete_data);
for ($i=0;$i<count($array);$i++){
    $r=permission_detail_Read("grouppermission", "groupid",$array[$i][0],"permissionlevel",$array[$i][1]);
    // print_r($r);
    if(empty($r)){
        create_grouppermission((int)$array[$i][0],(int)$array[$i][1]);
    }
}
for ($i = 0; $i < count($delete_data); $i++) {
    delete_grouppermission($delete_data[$i][0], $delete_data[$i][1]);
    delete_permission2($delete_data[$i][0], $delete_data[$i][1]);
    // print_r($r[$j]);
    delete_role_color2($delete_data[$i][0],$delete_data[$i][1]);
}

$color = $_POST['color_datas_sent'];
$color = json_decode($color);
// // print_r($color);
for ($i = 0; $i < count($color); $i++) {
    // print_r ($color[$i]);
    create_groupcolor($color[$i][0], $color[$i][1], $color[$i][2]);
}

$role = $_POST['role_datas_sent'];
$type = $_POST['datas_sent_type'];
// echo ($type);
$role = json_decode($role);
// print_r($role);
if ($type == 0) {
    $role_database = rough_Read('allpermission');
    for ($i = 0; $i < count($role_database); $i++) {
        $a = 0;
        for ($j = 0; $j < count($role); $j++) {
            if ($role_database[$i]['permissionlevel'] == $role[$j]) {
                $a = 1;
            }
        }
        if ($a == 0) {
            $r = detail_Read('grouppermission', 'permissionlevel', $role_database[$i]['permissionlevel']);
            delete_allpermission($role_database[$i]['permissionlevel']);
            delete_rolepermission2('roleid',$role_database[$i]['permissionlevel']);
            for ($j = 0; $j < count($r); $j++) {
                delete_grouppermission($r[$j]['groupid'], $r[$j]['permissionlevel']);
                delete_role_color2($r[$j]['groupid'], $r[$j]['permissionlevel']);
                delete_permission2($r[$j]['groupid'], $r[$j]['permissionlevel']);
            }
        }
    }
} else if($type==1){
    $role_database = rough_Read('stu');
    for ($i = 0; $i < count($role_database); $i++) {
        $a = 0;
        for ($j = 0; $j < count($role); $j++) {
            if ($role_database[$i]['id'] == $role[$j]) {
                $a = 1;
            }
        }
        if ($a == 0) {
            $r = detail_Read('permission', 'id', $role_database[$i]['id']);
            delete_stu($role_database[$i]['id']);
            for ($j = 0; $j < count($r); $j++) {
                delete_permission($r[$j]['id'], $r[$j]['groupid']);
                delete_role_color3($r[$j]['groupid'], $r[$j]['id']);
                delete_manage($r[$j]['id']);
                delete_group_color($r[$j]['groupid'], $r[$j]['id']);
            }
        }
    }
}else if($type==2){
    $role_database = rough_Read('allrolepermission');
    for ($i = 0; $i < count($role_database); $i++) {
        $a = 0;
        for ($j = 0; $j < count($role); $j++) {
            if ($role_database[$i]['permissionlevel'] == $role[$j]) {
                $a = 1;
            }
        }
        if ($a == 0) {
            $r = detail_Read('rolepermission', 'permissionlevel', $role_database[$i]['permissionlevel']);
            delete_allrolepermission($role_database[$i]['permissionlevel']);
            delete_rolepermission2('permissionlevel',$role_database[$i]['permissionlevel']);
        }
    }
}
header('Location: ./');
?>