<?php
include '../crud.php';
$rolename = $_POST["sent_new_rolename"];
create_allrolepermission($rolename);
header('Location: ./');