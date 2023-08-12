<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "../crud.php";
    $file_name = $_POST['file_name'];
    $result= decrypt($file_name);
    echo $result;
}
?>