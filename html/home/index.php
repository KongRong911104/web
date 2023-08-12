<?php
include "../crud.php";
include "../allpermission.php";
session_start();

$id = $_SESSION['id'];

if ($id ==""){
    header("Location: ../");
}
$web_list = array();
// echo $id;
$web = detail_Read("permission", "id",$id);
$permission=array();
for ($i = 0; $i<count($web); $i++){
    $permission[]=permission_detail_Read("rolepermission","groupid",$web[$i]['groupid'],"roleid",$web[$i]['permissionlevel']);
}

// print_r($permission);
?>
<!DOCTYPE html>
<html lang="zw-TW">
    <style>
        .b {
            min-width: 100px;
            width: fit-content;
            height: 100px;
            position: relative;
        }
    </style>

    <h1>你好!
        <?php echo (detail_Read("stu", "id", $id)[0]['name']); ?>
    </h1>
    <h2>傳送門</h2>
    <?php
    $setting=detail_Read("manage","id",$id);
    if (count($setting)>0){
        echo '<button class="b" onclick="window.location.href =\''."../setting'\"".'>群組角色權限設定'. '</button>';
    }
    for ($i = 0; $i < count($permission[0]); $i++) {
        $b=web_permission($permission[0][$i]['permissionlevel']);
        // echo $b;
        echo (explode("?",$b)[0]);
        if (explode("?",$b)[1]=="ok"){
            session_start();
            $_SESSION["ok"]=true;
            $_SESSION['id']=$id;
        }
    }
    ?>

</html>