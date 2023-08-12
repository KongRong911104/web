<?php




if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include '../crud.php';
    $file_name = $_POST['delfile_name'];
    $result= decrypt($file_name);
    unlink($result);
    echo $result;

}
?>