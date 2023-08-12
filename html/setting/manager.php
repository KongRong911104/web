<?php
$data = $_POST['mini_datas_sent'];

$data = json_decode($data);
// print_r($data);
include '../crud.php';
$database=rough_Read('manage');
$delete_data =array();
for ($i = 0; $i < count($database); $i++) {
    $a=0;
    for ($j = 0; $j < count($data); $j++) {
        if ($database[$i]['id'] == $data[$j]) {
            $a=1;
        }
    }
    if ($a == 0) {
        // print_r($database[$i]['id']);
        $delete_data[]=($database[$i]['id']);
    }
}
for($i=0;$i<count($data);$i++){
    $test=detail_Read('manage','id',$data[$i]);
    
    if(empty($test)){
        // print_r($data[$i]);
        create_manage($data[$i]);
    }
}
// print_r($delete_data);
for ($i = 0; $i < count($delete_data); $i++) {
    delete_manage($delete_data[$i]);
}
header('Location: ./');
?> 