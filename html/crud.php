<?php
// 查詢:  detail_Read($from, $where='', $where_value='')
//       rough_Read($from)
//       permission_detail_Read($from, $where_a = '', $where_a_value = '', $where_b = '', $where_b_value = '')

// 新增： stu : create_user($name, $account, $userimg = '', $password = '1234')
//       allgroup：create_allgroup($groupid, $id)
//       groupcontent：create_groupcontent($groupid, $id)
//       groupid：create_groupid($groupname)
//       permission：create_permission($id,$groupid,$permissionlevel)
//       allpermission:create_allpermission($permissionname='學生')
//       grouppermission:create_grouppermission($groupid, $permissionlevel)
//       create_groupcolor($groupid, $groupcolor,$id)
//       create_manage($id)
//       create_rolecolor($groupid,$roleid, $color,$id)
//       create_rolepermission($groupid,$roleid,$permissionlevel)

// 更新： stu：update_stu($name, $userimg, $password,$id)
//       groupid：update_groupid($groupid,$groupname)
//       permission：update_permission($id,$groupid,$permissionlevel,$permissionname)
//       allpermission:function update_allpermission($permissionlevel,$permissionname)

// 刪除 ： stu：delete_stu($id)
//        groupid：delete_groupid($groupid)
//        groupcontent：delete_groupcontent($groupid,$id,$content)
//        permission：delete_permission($id,$groupid)
//        permission:delete_permission2($groupid,$permissionlevel)
//        allpermission:delete_allpermission($permissionlevel)
//        grouppermission:delete_grouppermission($groupid,$permissionlevel)
//        delete_manage($id)
//        delete_group_color($groupid,$id)
include 'database.php';
function detail_Read($from, $where = '', $where_value = '')
{
    $connection = connection();
    $sqlQuery1 = "SELECT * FROM `$from` WHERE `$where` = $where_value";
    $datas = array();
    $result = mysqli_query($connection, $sqlQuery1);
    if ($result) {
        // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
        if (mysqli_num_rows($result) > 0) {
            // 取得大於0代表有資料
            // while迴圈會根據資料數量，決定跑的次數
            // mysqli_fetch_assoc方法可取得一筆值
            while ($row = mysqli_fetch_assoc($result)) {
                // 每跑一次迴圈就抓一筆值，最後放進data陣列中
                $datas[] = $row;
            }
        }
        // 釋放資料庫查到的記憶體
        mysqli_free_result($result);
    }
    return $datas;
}
function rough_Read($from)
{
    $connection = connection();
    $sqlQuery1 = "SELECT * FROM `$from`";
    $datas = array();
    $result = mysqli_query($connection, $sqlQuery1);
    if ($result) {
        // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
        if (mysqli_num_rows($result) > 0) {
            // 取得大於0代表有資料
            // while迴圈會根據資料數量，決定跑的次數
            // mysqli_fetch_assoc方法可取得一筆值
            while ($row = mysqli_fetch_assoc($result)) {
                // 每跑一次迴圈就抓一筆值，最後放進data陣列中
                $datas[] = $row;
            }
        }
        // 釋放資料庫查到的記憶體
        mysqli_free_result($result);
    }
    return $datas;
}
function permission_detail_Read($from, $where_a = '', $where_a_value = '', $where_b = '', $where_b_value = '')
{
    $connection = connection();
    $sqlQuery1 = "SELECT * FROM `$from` WHERE `$where_a` = '$where_a_value' AND `$where_b` = '$where_b_value'";
    $datas = array();
    $result = mysqli_query($connection, $sqlQuery1);
    if ($result) {
        // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
        if (mysqli_num_rows($result) > 0) {
            // 取得大於0代表有資料
            // while迴圈會根據資料數量，決定跑的次數
            // mysqli_fetch_assoc方法可取得一筆值
            while ($row = mysqli_fetch_assoc($result)) {
                // 每跑一次迴圈就抓一筆值，最後放進data陣列中
                $datas[] = $row;
            }
        }
        // 釋放資料庫查到的記憶體
        mysqli_free_result($result);
    }
    return $datas;
}
function create_user($name, $account, $userimg = '', $password = '1234')
{
    $check = rough_Read('stu');
    $con = 1;
    for ($i = 0; $i < count($check); $i++) {
        if ($check[$i]['account'] == $account) {
            $con = 0;
            break;
        }
    }
    if ($con == 1) {
        $connection = connection();
        $sqlQuery1 = "INSERT IGNORE INTO `stu` (`id`, `name`, `password`, `account`, `userimg`) VALUES (NULL, '$name','$password','$account','$userimg')";

        $result = mysqli_query($connection, $sqlQuery1);
        if (mysqli_affected_rows($connection) > 0) {
            // 如果有一筆以上代表有更新
            // mysqli_insert_id可以抓到第一筆的id
            $new_id = mysqli_insert_id($connection);
            echo "新增後的id為 {$new_id} ";
        } elseif (mysqli_affected_rows($connection) == 0) {
            echo "無資料新增";
        } else {
            echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
        }
        mysqli_close($connection);
    }
}
function create_allgroup($groupid, $id)
{
    $check = rough_Read('allgroup');
    $con = 1;
    for ($i = 0; $i < count($check); $i++) {
        if ($check[$i]['groupid'] == $groupid && $check[$i]['id'] == $id) {
            $con = 0;
            break;
        }
    }
    if ($con == 1) {
        $connection = connection();
        $sqlQuery1 = "INSERT IGNORE INTO `allgroup` (`groupid`, `id`, `sn`) VALUES ('$groupid', '$id', NULL)";
        $result = mysqli_query($connection, $sqlQuery1);
        if (mysqli_affected_rows($connection) > 0) {
            // 如果有一筆以上代表有更新
            // mysqli_insert_id可以抓到第一筆的id
            $new_id = mysqli_insert_id($connection);
            echo "新增後的id為 {$new_id} ";
        } elseif (mysqli_affected_rows($connection) == 0) {
            echo "無資料新增";
        } else {
            echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
        }
        mysqli_close($connection);
    }
}
function create_groupcontent($groupid, $id, $content)
{

    $connection = connection();
    $sqlQuery1 = "INSERT IGNORE INTO `groupcontent` (`groupid`, `id`, `content`, `sn`) VALUES ('$groupid', '$id', '$content',NULL)";
    $result = mysqli_query($connection, $sqlQuery1);
    if (mysqli_affected_rows($connection) > 0) {
        // 如果有一筆以上代表有更新
        // mysqli_insert_id可以抓到第一筆的id
        $new_id = mysqli_insert_id($connection);
        echo "新增後的id為 {$new_id} ";
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料新增";
    } else {
        echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
    }
    mysqli_close($connection);
}
function create_groupid($groupname)
{

    $connection = connection();
    $sqlQuery1 = "INSERT IGNORE INTO `groupid` (`groupid`, `groupname`) VALUES (NULL, '$groupname')";
    $result = mysqli_query($connection, $sqlQuery1);
    if (mysqli_affected_rows($connection) > 0) {
        // 如果有一筆以上代表有更新
        // mysqli_insert_id可以抓到第一筆的id
        $new_id = mysqli_insert_id($connection);
        echo "新增後的id為 {$new_id} ";
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料新增";
    } else {
        echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
    }
    mysqli_close($connection);
}

function create_permission($id, $groupid, $permissionlevel)
{
    $check = rough_Read('permission');
    $con = 1;
    for ($i = 0; $i < count($check); $i++) {
        if ($check[$i]['id'] == $id && $check[$i]['groupid'] == $groupid) {
            $con = 0;
            break;
        }
    }
    if ($con == 1) {
        $connection = connection();
        $sqlQuery1 = "INSERT IGNORE INTO `permission` (`sn`, `id`, `groupid`,`permissionlevel`) VALUES (NULL, '$id', '$groupid' ,'$permissionlevel')";
        $result = mysqli_query($connection, $sqlQuery1);
        if (mysqli_affected_rows($connection) > 0) {
            // 如果有一筆以上代表有更新
            // mysqli_insert_id可以抓到第一筆的id
            $new_id = mysqli_insert_id($connection);
            echo "新增後的id為 {$new_id} ";
        } elseif (mysqli_affected_rows($connection) == 0) {
            echo "無資料新增";
        } else {
            echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
        }
        mysqli_close($connection);
    }
}
function create_allpermission($permissionname)
{
    $check = rough_Read('allpermission');
    $con = 1;
    for ($i = 0; $i < count($check); $i++) {
        if ($check[$i]['permissionname'] == $permissionname) {
            $con = 0;
            break;
        }
    }
    if ($con == 1) {
        $connection = connection();
        $sqlQuery1 = "INSERT IGNORE INTO `allpermission` (`permissionname`) VALUES ('$permissionname')";
        $result = mysqli_query($connection, $sqlQuery1);
        if (mysqli_affected_rows($connection) > 0) {
            // 如果有一筆以上代表有更新
            // mysqli_insert_id可以抓到第一筆的id
            $new_id = mysqli_insert_id($connection);
            echo "新增後的id為 {$new_id} ";
        } elseif (mysqli_affected_rows($connection) == 0) {
            echo "無資料新增";
        } else {
            echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
        }
        mysqli_close($connection);
    }
}
function create_grouppermission($groupid, $permissionlevel)
{
    $connection = connection();
    $sqlQuery1 = "INSERT IGNORE INTO `grouppermission` (`groupid`,`permissionlevel`) VALUES ($groupid,$permissionlevel)";
    $result = mysqli_query($connection, $sqlQuery1);
    if (mysqli_affected_rows($connection) > 0) {
        // 如果有一筆以上代表有更新
        // mysqli_insert_id可以抓到第一筆的id
        $new_id = mysqli_insert_id($connection);
        // echo "新增後的id為 {$new_id} ";
    } elseif (mysqli_affected_rows($connection) == 0) {
        // echo "無資料新增";
    } else {
        echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
    }
    mysqli_close($connection);
}
function create_groupcolor($groupid, $groupcolor, $id)
{
    $check = rough_Read('groupcolor');
    $con = 1;
    for ($i = 0; $i < count($check); $i++) {
        if ($check[$i]['groupid'] == $groupid) {
            $con = 0;
            break;
        }
    }
    if ($con == 0) {
        $connection = connection();
        $sqlQuery1 = "UPDATE  `groupcolor` SET `color` = '$groupcolor' , `id` = '$id' WHERE `groupid`= '$groupid';";
        $result = mysqli_query($connection, $sqlQuery1);
        if (mysqli_affected_rows($connection) > 0) {
            // 如果有一筆以上代表有更新
            // mysqli_insert_id可以抓到第一筆的id
            $new_id = mysqli_insert_id($connection);
        } elseif (mysqli_affected_rows($connection) == 0) {
            echo "無資料新增";
        } else {
            echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
        }
        mysqli_close($connection);
    } else if ($con == 1) {
        $connection = connection();
        $sqlQuery1 = "INSERT IGNORE INTO `groupcolor` (`groupid`,`color`,`id`) VALUES ('$groupid','$groupcolor','$id')";
        $result = mysqli_query($connection, $sqlQuery1);
        if (mysqli_affected_rows($connection) > 0) {
            // 如果有一筆以上代表有更新
            // mysqli_insert_id可以抓到第一筆的id
            $new_id = mysqli_insert_id($connection);
            // echo "新增後的id為 {$new_id} ";
        } elseif (mysqli_affected_rows($connection) == 0) {
            // echo "無資料新增";
        } else {
            echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
        }
        mysqli_close($connection);
    }
}
function create_rolecolor($groupid, $roleid, $color, $id)
{
    $check = rough_Read('rolecolor');
    $con = 1;
    for ($i = 0; $i < count($check); $i++) {
        if ($check[$i]['groupid'] == $groupid && $check[$i]['roleid'] == $roleid) {
            $con = 0;
            break;
        }
    }
    if ($con == 0) {
        $connection = connection();
        $sqlQuery1 = "UPDATE  `rolecolor` SET `color` = '$color' , `id` = '$id' WHERE `groupid`= '$groupid' AND `roleid`= '$roleid';";
        $result = mysqli_query($connection, $sqlQuery1);
        if (mysqli_affected_rows($connection) > 0) {
            // 如果有一筆以上代表有更新
            // mysqli_insert_id可以抓到第一筆的id
            $new_id = mysqli_insert_id($connection);
        } elseif (mysqli_affected_rows($connection) == 0) {
            echo "無資料新增";
        } else {
            echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
        }
        mysqli_close($connection);
    } else if ($con == 1) {
        $connection = connection();
        $sqlQuery1 = "INSERT IGNORE INTO `rolecolor` (`groupid`,`roleid`,`color`,`id`) VALUES ('$groupid','$roleid','$color','$id')";
        $result = mysqli_query($connection, $sqlQuery1);
        if (mysqli_affected_rows($connection) > 0) {
            // 如果有一筆以上代表有更新
            // mysqli_insert_id可以抓到第一筆的id
            $new_id = mysqli_insert_id($connection);
            // echo "新增後的id為 {$new_id} ";
        } elseif (mysqli_affected_rows($connection) == 0) {
            // echo "無資料新增";
        } else {
            echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
        }
        mysqli_close($connection);
    }
}
function create_manage($id)
{
    $connection = connection();
    $sqlQuery1 = "INSERT IGNORE INTO `manage` (`id`) VALUES ('$id')";
    $result = mysqli_query($connection, $sqlQuery1);
    if (mysqli_affected_rows($connection) > 0) {
        // 如果有一筆以上代表有更新
        // mysqli_insert_id可以抓到第一筆的id
        $new_id = mysqli_insert_id($connection);
        // echo "新增後的id為 {$new_id} ";
    } elseif (mysqli_affected_rows($connection) == 0) {
        // echo "無資料新增";
    } else {
        echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
    }
    mysqli_close($connection);
}
function create_allrolepermission($permissionname)
{
    $connection = connection();
    $sqlQuery1 = "INSERT IGNORE INTO `allrolepermission` (`permissionname`) VALUES ('$permissionname')";
    $result = mysqli_query($connection, $sqlQuery1);
    if (mysqli_affected_rows($connection) > 0) {
        // 如果有一筆以上代表有更新
        // mysqli_insert_id可以抓到第一筆的id
        $new_id = mysqli_insert_id($connection);
        // echo "新增後的id為 {$new_id} ";
    } elseif (mysqli_affected_rows($connection) == 0) {
        // echo "無資料新增";
    } else {
        echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
    }
    mysqli_close($connection);
}
function create_rolepermission($groupid, $roleid, $permissionlevel)
{
    $check = rough_Read('rolepermission');
    $con = 1;
    for ($i = 0; $i < count($check); $i++) {
        if ($check[$i]['groupid'] == $groupid && $check[$i]['roleid'] == $roleid && $check[$i]['permissionlevel'] == $permissionlevel) {
            $con = 0;
            break;
        }
    }
    if ($con != 0) {
        $connection = connection();
        $sqlQuery1 = "INSERT IGNORE INTO `rolepermission` (`groupid`,`roleid`,`permissionlevel`) VALUES ('$groupid','$roleid','$permissionlevel')";
        $result = mysqli_query($connection, $sqlQuery1);
        if (mysqli_affected_rows($connection) > 0) {
            // 如果有一筆以上代表有更新
            // mysqli_insert_id可以抓到第一筆的id
            $new_id = mysqli_insert_id($connection);
            // echo "新增後的id為 {$new_id} ";
        } elseif (mysqli_affected_rows($connection) == 0) {
            echo "無資料新增";
        } else {
            echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
        }
    }
    mysqli_close($connection);
}
function create_exdata($classname, $hour, $math, $base, $li, $shi, $value1, $value2, $value3, $value4, $value5, $value6, $value7, $value8)
{
    $check = rough_Read('exdata');
    $con = 1;
    for ($i = 0; $i < count($check); $i++) {
        if ($check[$i]['classname'] == $classname) {
            $con = 0;
            break;
        }
    }
    if ($con != 0) {
        $connection = connection();
        $sqlQuery1 = "INSERT IGNORE INTO `exdata` (`classname`,`hour`,`math`,`base`,`li`,`shi`,`value1`,`value2`,`value3`,`value4`,`value5`,`value6`,`value7`,`value8`) VALUES ('$classname','$hour','$math','$base','$li','$shi','$value1','$value2','$value3','$value4','$value5','$value6','$value7','$value8')";
        $result = mysqli_query($connection, $sqlQuery1);
        if (mysqli_affected_rows($connection) > 0) {
            // 如果有一筆以上代表有更新
            // mysqli_insert_id可以抓到第一筆的id
            $new_id = mysqli_insert_id($connection);
            // echo "新增後的id為 {$new_id} ";
        } elseif (mysqli_affected_rows($connection) == 0) {
            echo "無資料新增";
        } else {
            echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
        }
    }
    mysqli_close($connection);
}
function update_stu($name, $userimg, $password, $id)
{
    $connection = connection();
    $sqlQuery1 = "UPDATE  `stu` SET `name` = '$name', `password`='$password' ,`userimg`='$userimg' WHERE `id`= '$id';";
    $result = mysqli_query($connection, $sqlQuery1);
    if (mysqli_affected_rows($connection) > 0) {
        // 如果有一筆以上代表有更新
        // mysqli_insert_id可以抓到第一筆的id
        $new_id = mysqli_insert_id($connection);
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料新增";
    } else {
        echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
    }
    mysqli_close($connection);
}
function update_groupid($groupid, $groupname)
{
    $connection = connection();
    $sqlQuery1 = "UPDATE  `groupid` SET `groupname` = '$groupname' WHERE `groupid`= '$groupid';";
    $result = mysqli_query($connection, $sqlQuery1);
    if (mysqli_affected_rows($connection) > 0) {
        // 如果有一筆以上代表有更新
        // mysqli_insert_id可以抓到第一筆的id
        $new_id = mysqli_insert_id($connection);
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料新增";
    } else {
        echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
    }
    mysqli_close($connection);
}
function update_permission($id, $groupid, $permissionlevel, $permissionname)
{
    $connection = connection();
    $sqlQuery1 = "UPDATE  `permission` SET `permissionlevel` = '$permissionlevel' , `permissionname` ='$permissionname' WHERE `id`= '$id' AND `groupid`= '$groupid';";
    $result = mysqli_query($connection, $sqlQuery1);
    if (mysqli_affected_rows($connection) > 0) {
        // 如果有一筆以上代表有更新
        // mysqli_insert_id可以抓到第一筆的id
        $new_id = mysqli_insert_id($connection);
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料新增";
    } else {
        echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
    }
    mysqli_close($connection);
}
function update_allpermission($permissionlevel, $permissionname)
{
    $connection = connection();
    $sqlQuery1 = "UPDATE  `allpermission` SET `permissionname` = '$permissionname'  WHERE `permissionlevel`= '$permissionlevel';";
    $result = mysqli_query($connection, $sqlQuery1);
    if (mysqli_affected_rows($connection) > 0) {
        // 如果有一筆以上代表有更新
        // mysqli_insert_id可以抓到第一筆的id
        $new_id = mysqli_insert_id($connection);
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料新增";
    } else {
        echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
    }
    mysqli_close($connection);
}
function update_exdata($sn, $classname, $hour, $math, $base, $li, $shi, $value1, $value2, $value3, $value4, $value5, $value6, $value7, $value8)
{
    $connection = connection();
    $sqlQuery1 = "UPDATE  `exdata` SET `classname` = '$classname' ,`hour`=$hour,`math`=$math,`base`=$base,`li`=$li,`shi`=$shi,`value1`='$value1',`value2`='$value2',`value3`='$value3',`value4`='$value4',`value5`='$value5',`value6`='$value6',`value7`='$value7',`value8`='$value8' WHERE `sn`= $sn;";
    $result = mysqli_query($connection, $sqlQuery1);
    if (mysqli_affected_rows($connection) > 0) {
        // 如果有一筆以上代表有更新
        // mysqli_insert_id可以抓到第一筆的id
        $new_id = mysqli_insert_id($connection);
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料新增";
    } else {
        echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
    }
    mysqli_close($connection);
}
function delete_stu($id)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `stu` WHERE `id`= '$id'";
    $result = mysqli_query($connection, $sqlQuery1);
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($connection) > 0) {
        echo "資料已刪除";
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料刪除";
    }
    mysqli_close($connection);
}

function delete_groupid($groupid)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `groupid` WHERE `groupid`= '$groupid'";
    $result = mysqli_query($connection, $sqlQuery1);
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($connection) > 0) {
        echo "資料已刪除";
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料刪除";
    }
    mysqli_close($connection);
}
function delete_groupcontent($groupid, $id, $content)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `groupcontent` WHERE `groupid`= '$groupid' AND `id`= '$id' AND `content`= '$content'";
    $result = mysqli_query($connection, $sqlQuery1);
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($connection) > 0) {
        echo "資料已刪除";
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料刪除";
    }
    mysqli_close($connection);
}
function delete_permission($id, $groupid)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `permission` WHERE `id`= '$id' AND `groupid`= '$groupid'";
    $result = mysqli_query($connection, $sqlQuery1);
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($connection) > 0) {
        echo "資料已刪除";
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料刪除";
    }
    mysqli_close($connection);
}
function delete_allpermission($permissionlevel)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `allpermission` WHERE `permissionlevel`= '$permissionlevel'";
    $result = mysqli_query($connection, $sqlQuery1);
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($connection) > 0) {
        echo "資料已刪除";
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料刪除";
    }
    mysqli_close($connection);
}
function delete_grouppermission($groupid, $permissionlevel)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `grouppermission` WHERE `groupid` = '$groupid' AND `permissionlevel`= '$permissionlevel' ";
    $result = mysqli_query($connection, $sqlQuery1);
    // 如果有異動到資料庫數量(更新資料庫)

    mysqli_close($connection);
}

function delete_permission2($groupid, $permissionlevel)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `permission` WHERE `groupid` = '$groupid' AND `permissionlevel`= '$permissionlevel' ";
    $result = mysqli_query($connection, $sqlQuery1);
    // 如果有異動到資料庫數量(更新資料庫)

    mysqli_close($connection);
}
function delete_manage($id)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `manage` WHERE `id`= '$id'";
    $result = mysqli_query($connection, $sqlQuery1);
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($connection) > 0) {
        echo "資料已刪除";
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料刪除";
    }
    mysqli_close($connection);
}
function delete_group_color($groupid, $id)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `groupcolor` WHERE `id` = '$id' AND `groupid` = '$groupid' ";
    $result = mysqli_query($connection, $sqlQuery1);
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($connection) > 0) {
        echo "資料已刪除";
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料刪除";
    }
    mysqli_close($connection);
}
function delete_role_color($groupid, $roleid, $id)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `rolecolor` WHERE `id`= '$id' AND `groupid` = '$groupid' AND `roleid` = '$roleid'";
    $result = mysqli_query($connection, $sqlQuery1);
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($connection) > 0) {
        echo "資料已刪除";
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料刪除";
    }
    mysqli_close($connection);
}
function delete_role_color2($groupid, $roleid)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `rolecolor` WHERE `groupid` = '$groupid' AND `roleid` = '$roleid'";
    $result = mysqli_query($connection, $sqlQuery1);
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($connection) > 0) {
        echo "資料已刪除";
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料刪除";
    }
    mysqli_close($connection);
}
function delete_role_color3($groupid, $id)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `rolecolor` WHERE `groupid` = '$groupid' AND `id` = '$id'";
    $result = mysqli_query($connection, $sqlQuery1);
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($connection) > 0) {
        echo "資料已刪除";
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料刪除";
    }
    mysqli_close($connection);
}
function delete_rolepermission($groupid, $roleid, $permissionlevel)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `rolepermission` WHERE `groupid` = '$groupid' AND `roleid` = '$roleid'AND `permissionlevel`= '$permissionlevel' ";
    $result = mysqli_query($connection, $sqlQuery1);
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($connection) > 0) {
        echo "資料已刪除";
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料刪除";
    }
    mysqli_close($connection);
}
function delete_rolepermission2($id, $value)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `rolepermission` WHERE `$id`= '$value' ";
    $result = mysqli_query($connection, $sqlQuery1);
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($connection) > 0) {
        echo "資料已刪除";
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料刪除";
    }
    mysqli_close($connection);
}
function delete_rolepermission3($groupid, $roleid)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `rolepermission` WHERE `groupid`= '$groupid' AND`roleid`= '$roleid' ";
    $result = mysqli_query($connection, $sqlQuery1);
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($connection) > 0) {
        echo "資料已刪除";
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料刪除";
    }
    mysqli_close($connection);
}
function delete_allrolepermission($permissionlevel)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `allrolepermission` WHERE `permissionlevel`= '$permissionlevel' ";
    $result = mysqli_query($connection, $sqlQuery1);
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($connection) > 0) {
        echo "資料已刪除";
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料刪除";
    }
    mysqli_close($connection);
}
function delete_exdata($sn)
{
    $connection = connection();
    $sqlQuery1 = "UPDATE  `exdata` SET `del_flag` = '1'  WHERE `sn`= '$sn';";
    $result = mysqli_query($connection, $sqlQuery1);
    if (mysqli_affected_rows($connection) > 0) {
        // 如果有一筆以上代表有更新
        // mysqli_insert_id可以抓到第一筆的id
        $new_id = mysqli_insert_id($connection);
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料新增";
    } else {
        echo "{$sqlQuery1} 語法執行失敗，錯誤訊息: " . mysqli_error($connection);
    }
    mysqli_close($connection);
}