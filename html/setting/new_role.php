<?php
include '../crud.php';
$rolename = $_POST["sent_new_rolename"];
create_allpermission($rolename);
header('Location: ./');