<?php
include '../crud.php';
// 取得所有角色
$rough_data = rough_Read('allpermission');
$permission_data = array();
for ($i = 0; $i < count($rough_data); $i++) {
    $permission_data[] = [$rough_data[$i]['permissionlevel'], $rough_data[$i]['permissionname']];
}
$permission_data = json_encode($permission_data);

// 取得所有群組和所擁有的角色
$rough_group_data = rough_Read('groupid');
$group_data = array();
for ($i = 0; $i < count($rough_group_data); $i++) {
    $rough_group_permission = detail_Read('grouppermission', 'groupid', $rough_group_data[$i]['groupid']);
    $group_permission = array();
    for ($j = 0; $j < count($rough_group_permission); $j++) {
        $a = detail_Read('allpermission', 'permissionlevel', $rough_group_permission[$j]['permissionlevel']);
        $group_permission[] = [$a[0]['permissionname'], ($a[0]['permissionlevel'])];
    }
    $group_data[] = [$rough_group_data[$i]['groupid'], $rough_group_data[$i]['groupname'], $group_permission];
}
$group_data = json_encode($group_data);

// 取得群組內的角色
$rough_grouprole_data = rough_Read('permission');
$grouprole_data = array();
for ($i = 0; $i < count($rough_grouprole_data); $i++) {
    $grouprole_data[] = [$rough_grouprole_data[$i]['id'], $rough_grouprole_data[$i]['groupid'], $rough_grouprole_data[$i]['permissionlevel']];
}
$grouprole_data = json_encode($grouprole_data);

// 取得所有人
$rough_people_data = rough_Read('stu');
$people_data = array();
for ($i = 0; $i < count($rough_people_data); $i++) {
    $people_data[] = [$rough_people_data[$i]['id'], $rough_people_data[$i]['name']];
}
$people_data = json_encode($people_data);
$rough_group_color = rough_Read('groupcolor');
$group_color = array();
for ($i = 0; $i < count($rough_group_color); $i++) {
    $group_color[] = [$rough_group_color[$i]['groupid'], $rough_group_color[$i]['color'], $rough_group_color[$i]['id']];
}
$group_color = json_encode($group_color);

$rough_role_color = rough_Read('rolecolor');
$role_color = array();
for ($i = 0; $i < count($rough_role_color); $i++) {
    $role_color[] = [$rough_role_color[$i]['groupid'], $rough_role_color[$i]['roleid'], $rough_role_color[$i]['color'], $rough_role_color[$i]['id']];
}
$role_color = json_encode($role_color);

$rough_manager = rough_Read('manage');
$manager = array();
for ($i = 0; $i < count($rough_manager); $i++) {
    $manager[] = [$rough_manager[$i]['id'], detail_Read('stu', 'id', $rough_manager[$i]['id'])[0]['name']];
}
$manager = json_encode($manager);

$rough_role_permission = rough_Read('rolepermission');
$role_permission = array();
for ($i = 0; $i < count($rough_role_permission); $i++) {
    $role_permission[] = [$rough_role_permission[$i]['groupid'],$rough_role_permission[$i]['roleid'],detail_Read('allrolepermission','permissionlevel',$rough_role_permission[$i]['permissionlevel'])[0]['permissionlevel'],detail_Read('allrolepermission','permissionlevel',$rough_role_permission[$i]['permissionlevel'])[0]['permissionname']];
}
$role_permission = json_encode($role_permission);

$rough_all_role_permission=rough_Read('allrolepermission');
$all_role_permission = array();
for($i=0;$i<count($rough_all_role_permission);$i++){
    $all_role_permission[]=[$rough_all_role_permission[$i]['permissionlevel'],$rough_all_role_permission[$i]['permissionname']];
}
$all_role_permission = json_encode($all_role_permission);
?>