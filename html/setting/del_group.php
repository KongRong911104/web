<?php
include '../crud.php';
$array = $_POST['sent_del_groupname'];
$array=json_decode($array);
// print_r($array);
delete_groupid($array[0]);
delete_rolepermission2('groupid',$array[0]);
$permission=detail_Read('permission','groupid',$array[0]);
$grouppermission=detail_Read('grouppermission','groupid',$array[0]);
$group_color=permission_detail_Read('groupcolor','groupid',$array[0],'id',$array[1]);
$role_color=detail_Read('rolecolor','groupid',$array[0]);
for($i=0;$i<count($permission);$i++){
    delete_permission($permission[$i]['id'],$array[0]);
}
for($i=0;$i<count($grouppermission);$i++){
    delete_grouppermission($array[0],$grouppermission[$i]['permissionlevel']);
}
for($i=0;$i<count($group_color);$i++){
    delete_group_color($group_color[$i]['groupid'],$group_color[$i]['id']);
}
for($i=0;$i<count($role_color);$i++){
    delete_role_color2($array[0],$role_color[$i]['roleid']);
}
header('Location: ./');
?>