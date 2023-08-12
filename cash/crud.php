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
function encrypt($data)
{
    $key = "zasxcdfvbghnmjk,"; // 加密密钥（16字节）
    $iv = " 1dfl6 p9b]st1^k"; // 初始向量（16字节）
    $encrypted = openssl_encrypt($data, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
    $encrypted = base64_encode($encrypted);
    return $encrypted;
}

function decrypt($encryptedData)
{
    $key = "zasxcdfvbghnmjk,"; // 加密密钥（16字节）
    $iv = " 1dfl6 p9b]st1^k"; // 初始向量（16字节）
    $encryptedData = base64_decode($encryptedData);
    $decrypted = openssl_decrypt($encryptedData, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
    return $decrypted;
}
function binarySearch($arr, $target, $index)
{
    $left = 0;
    $right = count($arr) - 1;

    while ($left <= $right) {
        $mid = $left + floor(($right - $left) / 2);

        // 如果找到目標值，返回索引
        if ($arr[$mid][$index] === $target) {
            return $mid;
        }

        // 如果目標值比中間值小，在左半部分繼續搜索
        if ($arr[$mid][$index] > $target) {
            $right = $mid - 1;
        }

        // 如果目標值比中間值大，在右半部分繼續搜索
        if ($arr[$mid][$index] < $target) {
            $left = $mid + 1;
        }
    }

    // 如果沒找到目標值，返回 -1
    return -1;
}
function userPermission($id)
{
    $id = decrypt($id);
    // echo $id;
    // return $id;
    $connection = connection();
    $sql = "SELECT permission.sn
    FROM users
    INNER JOIN GRU ON users.sn = GRU.userID
    INNER JOIN GRP ON GRU.groupID = GRP.groupID AND GRU.roleID = GRP.roleID
    INNER JOIN permission ON GRP.permissionID = permission.sn
    WHERE users.sn = '$id'";
    $datas = array();
    $result = mysqli_query($connection, $sql);
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
function groupRole($group)
{
    $connection = connection();
    $sql = "SELECT roles.*
    FROM GR
    INNER JOIN roles ON GR.roleID = roles.sn
    WHERE GR.groupID = '$group'";
    $datas = array();
    $result = mysqli_query($connection, $sql);
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
function GRPermission($group, $role)
{
    $connection = connection();
    $sql = "SELECT permission.sn
    FROM GRP
    INNER JOIN permission ON GRP.permissionID = permission.sn
    WHERE GRP.groupID = '$group' AND GRP.roleID = '$role'";
    $datas = array();
    $result = mysqli_query($connection, $sql);
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
function GRUser($group, $role)
{
    $connection = connection();
    $sql = "SELECT users.sn
    FROM GRU
    INNER JOIN users ON GRU.userID = users.sn
    WHERE GRU.groupID = '$group' AND GRU.roleID = '$role'";
    $datas = array();
    $result = mysqli_query($connection, $sql);
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
function web_permission($id)
{
    $connection = connection();
    $sql = "SELECT DISTINCT permission.sn
    FROM users
    INNER JOIN GRU ON users.sn = GRU.userID
    INNER JOIN GRP ON GRU.groupID = GRP.groupID AND GRU.roleID = GRP.roleID
    INNER JOIN permission ON GRP.permissionID = permission.sn
    WHERE users.sn = '$id'";
    $datas = "";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
        if (mysqli_num_rows($result) > 0) {
            // 取得大於0代表有資料
            // while迴圈會根據資料數量，決定跑的次數
            // mysqli_fetch_assoc方法可取得一筆值
            while ($row = mysqli_fetch_assoc($result)) {
                // 每跑一次迴圈就抓一筆值，最後放進data陣列中
                // $datas[] = $row['sn'];
                $a=$row['sn'];
                // print_r($row);
                if ($a == "1") {
                    $datas .= '<button class="b" onclick="window.location.href =\'' . "../setting'\"" . '>群組角色權限設定' . '</button>';
                } else if ($a == "2") {
                    $datas .= '<button class="b" onclick="window.location.href = \'' . "../csReview'\"" . '>csReview' . '</button>';
                } else if ($a == "3") {
                    $datas .= '<button class="b" onclick="window.location.href =\'' . "../ASR'\"" . '>各類作業及考試繳交紀錄表' . '</button>';
                }
            }
        }
        // 釋放資料庫查到的記憶體
        mysqli_free_result($result);
    }
    // return $datas;
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
function detail1_Read($from, $where = '', $where_value = '')
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
function detail2_Read($from, $where_a = '', $where_a_value = '', $where_b = '', $where_b_value = '')
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
function create_Role($roleName)
{

    $connection = connection();
    $sqlQuery1 = "INSERT IGNORE INTO `roles` (`roleName`) 
                  SELECT '$roleName'
                  FROM DUAL 
                  WHERE NOT EXISTS (
                      SELECT 1 
                      FROM `roles` 
                      WHERE `roleName` = '$roleName' 
                  )";

    $result = mysqli_query($connection, $sqlQuery1);
    if (mysqli_affected_rows($connection) > 0) {
        // 如果有一筆以上代表有更新
        // mysqli_insert_id可以抓到第一筆的id
        $new_id = mysqli_insert_id($connection);
    }
    mysqli_close($connection);
}
function create_User($account)
{
    $userName = "user#";
    $connection = connection();
    $sql = "SELECT COUNT(*) as count FROM users"; // 計算 users 資料表的個數
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // 讀取結果
        $row = $result->fetch_assoc();
        $count = $row["count"];
        $userName .= $count + 1;
    } else {
        $userName .= 1;
        ;
    }
    $sqlQuery1 = "INSERT IGNORE INTO `users` (`account` ,`userName`) 
                  SELECT '$account','userName'
                  FROM DUAL 
                  WHERE NOT EXISTS (
                      SELECT 1 
                      FROM `users` 
                      WHERE `account` = '$account' 
                  )";

    $result = mysqli_query($connection, $sqlQuery1);
    if (mysqli_affected_rows($connection) > 0) {
        // 如果有一筆以上代表有更新
        // mysqli_insert_id可以抓到第一筆的id
        $new_id = mysqli_insert_id($connection);
    }
    mysqli_close($connection);
}
function create_Permission($permissionName)
{

    $connection = connection();
    $sqlQuery1 = "INSERT IGNORE INTO `permission` (`permissionName`) 
                  SELECT '$permissionName'
                  FROM DUAL 
                  WHERE NOT EXISTS (
                      SELECT 1 
                      FROM `permission` 
                      WHERE `permissionName` = '$permissionName' 
                  )";

    $result = mysqli_query($connection, $sqlQuery1);
    if (mysqli_affected_rows($connection) > 0) {
        // 如果有一筆以上代表有更新
        // mysqli_insert_id可以抓到第一筆的id
        $new_id = mysqli_insert_id($connection);
    }
    mysqli_close($connection);
}
function create_Group($groupName)
{
    $connection = connection();
    $colorQuery = "SELECT groupColor
                   FROM test2.groups
                   ORDER BY sn DESC
                   LIMIT 1";

    $colorResult = mysqli_query($connection, $colorQuery);
    if ($colorResult) {
        $colorRow = mysqli_fetch_assoc($colorResult);
        $color = $colorRow['groupColor'];
        // 根據顏色值進行相應處理
        if ($color == "#FAADA2")
            $groupColor = "#FFAB46";
        else if ($color == "#FFAB46")
            $groupColor = "#FFF48C";
        else if ($color == "#FFF48C")
            $groupColor = "#99FFCA";
        else if ($color == "#99FFCA")
            $groupColor = "#99E0FF";
        else if ($color == "#99E0FF")
            $groupColor = "#BC85FF";
        else
            $groupColor = "#FAADA2";

        $sqlQuery1 = "INSERT IGNORE INTO `groups` (`groupName`, `groupColor`) 
                      SELECT '$groupName', '$groupColor'
                      FROM DUAL 
                      WHERE NOT EXISTS (
                          SELECT 1 
                          FROM `groups` 
                          WHERE `groupName` = '$groupName' 
                      )";

        $result = mysqli_query($connection, $sqlQuery1);
        if (mysqli_affected_rows($connection) > 0) {
            $new_id = mysqli_insert_id($connection);
        }
    }

    mysqli_close($connection);
}
function create_GR($groupID, $roleID)
{
    $connection = connection();
    $sqlQuery1 = "INSERT IGNORE INTO `GR` (`groupID`,`roleID`) 
                  SELECT $groupID, $roleID
                  FROM DUAL 
                  WHERE NOT EXISTS (
                      SELECT 1 
                      FROM `GR` 
                      WHERE `groupID` = $groupID 
                      AND `roleID` = $roleID
                  )";

    $result = mysqli_query($connection, $sqlQuery1);
    if (mysqli_affected_rows($connection) > 0) {
        // 如果有一筆以上代表有更新
        // mysqli_insert_id可以抓到第一筆的id
        $new_id = mysqli_insert_id($connection);
    }
    mysqli_close($connection);
}
function create_GRP($groupID, $roleID, $permissionID)
{

    $connection = connection();
    $sqlQuery1 = "INSERT IGNORE INTO `GRP` (`groupID`,`roleID`,`permissionID`) 
                  SELECT $groupID, $roleID, $permissionID 
                  FROM DUAL 
                  WHERE NOT EXISTS (
                      SELECT 1 
                      FROM `GRP` 
                      WHERE `groupID` = $groupID 
                      AND `roleID` = $roleID 
                      AND `permissionID` = $permissionID
                  )";

    $result = mysqli_query($connection, $sqlQuery1);
    if (mysqli_affected_rows($connection) > 0) {
        // 如果有一筆以上代表有更新
        // mysqli_insert_id可以抓到第一筆的id
        $new_id = mysqli_insert_id($connection);
    }
    mysqli_close($connection);
}
function delete_GRP($groupID, $roleID, $permissionID)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `GRP` WHERE `groupID`= '$groupID' AND`roleID`= '$roleID' AND`permissionID`= '$permissionID' ";
    $result = mysqli_query($connection, $sqlQuery1);

    mysqli_close($connection);
}
function create_GRU($groupID, $roleID, $userID)
{

    $connection = connection();
    $sqlQuery1 = "INSERT IGNORE INTO `GRU` (`groupID`,`roleID`,`userID`) 
                  SELECT $groupID, $roleID, $userID 
                  FROM DUAL 
                  WHERE NOT EXISTS (
                      SELECT 1 
                      FROM `GRU` 
                      WHERE `groupID` = $groupID 
                      AND `roleID` = $roleID 
                      AND `userID` = $userID
                  )";

    $result = mysqli_query($connection, $sqlQuery1);
    if (mysqli_affected_rows($connection) > 0) {
        // 如果有一筆以上代表有更新
        // mysqli_insert_id可以抓到第一筆的id
        $new_id = mysqli_insert_id($connection);
    }
    mysqli_close($connection);
}
function delete_GRU($groupID, $roleID, $userID)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `GRU` WHERE `groupID`= '$groupID' AND`roleID`= '$roleID' AND`userID`= '$userID' ";
    $result = mysqli_query($connection, $sqlQuery1);

    mysqli_close($connection);
}
function GRUGRP($userID, $permissionID)
{
    $connection = connection();
    $sql = "SELECT GRP.permissionID
    FROM GRU
    INNER JOIN GRP ON GRU.groupID = GRP.groupID AND GRU.roleID = GRP.roleID
    WHERE GRU.userID = '$userID' AND GRP.permissionID = '$permissionID'";
    $datas = array();
    $result = mysqli_query($connection, $sql);
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

function update_groupColor($groupID, $groupColor)
{
    $connection = connection();
    $sqlQuery1 = "UPDATE  `groups` SET `groupColor` = '$groupColor' WHERE `sn`= '$groupID';";
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
function delGRUP($table, $ID)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `$table` WHERE `sn`= '$ID' ";
    $result = mysqli_query($connection, $sqlQuery1);
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($connection) > 0) {
        echo "資料已刪除";
    } elseif (mysqli_affected_rows($connection) == 0) {
        echo "無資料刪除";
    }
    mysqli_close($connection);
}
function delGR($groupID, $roleID)
{
    $connection = connection();
    $sqlQuery1 = "DELETE FROM `GR` WHERE `groupID`= '$groupID' AND `roleID` = '$roleID'";
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