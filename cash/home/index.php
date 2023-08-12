<?php
include "../crud.php";
// include "../allpermission.php";
if (!isset($_SESSION)) {
    session_start();
} //判斷session是否已啟動

$id = $_SESSION['id'];

if ($id == "") {
    header("Location: ../");
}
$sn = decrypt($id);
$name = detail1_Read('users', 'sn', $sn)[0]['userName'];
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
        <?PHP
        echo $name;
        ?>
    </h1>
    <h2>傳送門</h2>
    <?php
        echo web_permission($sn);
    ?>

</html>