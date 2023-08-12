<?php
include 'database.php';
$conn = connection();

if ($conn->connect_error) {
    die("連接失敗" . $conn->connect_error);
}

$del_name_name=intval($_POST["del_name_name"]);

$sql=sprintf("DELETE FROM `stores` WHERE `SID`=%d ;",$del_name_name);

$result = $conn->query($sql);

echo "<script>window.alert('刪除成功');window.location.href='edit_store.html';</script>";
exit;

?>