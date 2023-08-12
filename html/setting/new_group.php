<?php
include '../crud.php';
$groupname = $_POST["sent_new_groupname"];
create_groupid($groupname);
// header('Location: ./');