<?php




if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include '../crud.php';
    $file_name = $_POST['class_name'];
    $result= decrypt($file_name);
    
    delete_exdata($result);
}
?>