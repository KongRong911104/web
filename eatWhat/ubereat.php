<?php 

    session_start();

    if (isset($_SESSION['store_to_eat']) && ( !empty($_SESSION['store_to_eat']) )) {
        $r_f=$_SESSION['store_to_eat'];
        session_unset();
        echo sprintf("<script>alert('%s'); window.location.href='index.html'</script>",$r_f);
        exit;
    }
include 'database.php';
$conn = connection();

    if ($conn->connect_error) {
        die("連接失敗" . $conn->connect_error);
    }

    $t_hour=$_POST["t_h"];
    $t_minute=$_POST["t_m"];
    $t_d=$_POST["t_d"];
    // echo sprintf("<script>alert('%s');</script>",$t_hour." ".$t_minute." ".$t_d);

    if($t_d=="0" or $t_d==0){
        $t_d+=7;
    }
    // echo sprintf("<script>alert('%s');</script>",$t_hour." ".$t_minute." ".$t_d);
    // if(gettype($t_minute)==gettype("String")){
    //     $t_minute=intval($t_minute);
    // }
    // if(gettype($t_houre)==gettype("String")){
    //     $t_hour=intval($t_hour);
    // }

    // echo sprintf("<script>alert('%s');</script>",$t_hour." ".$t_minute." ".gettype($t_hour)." ".gettype($t_minute));

    //if @ { c_t<o_t && [ o_t<=n_t || ( c_t>n_t || " c_t=n_t && c_t_m>n_t_m " ) ] } or { c_t>o_t && [ o_t<=n_t && ( c_t>n_t || " c_t=n_t && c_t_m>n_t_m " ) ] } @ and ...;
    //`closed_time_hour`
    //`open_time_hour`
    //`closed_time_minute`
    $sql = sprintf("SELECT * FROM `stores` WHERE ( ( `closed_time_hour`<`open_time_hour` AND ( `open_time_hour` 
    <=%d OR ( `closed_time_hour`>%d OR ( `closed_time_hour`=%d AND `closed_time_minute`>%d ) ) ) ) OR 
    ( `closed_time_hour`>`open_time_hour` AND ( `open_time_hour`<=%d AND (
    `closed_time_hour`>%d OR ( `closed_time_hour`=%d AND `closed_time_minute`>%d ) ) ) ) OR 
    ( (`closed_time_hour`=`open_time_hour`) AND ( `closed_time_minute`=`open_time_minute` ) AND (`closed_time_hour`=0) AND ( `closed_time_minute`=0 ) ) ) AND 
    (`closed_day` LIKE ",$t_hour,$t_hour,$t_hour,$t_minute,$t_hour,$t_hour,$t_hour,$t_minute)."'%".sprintf("%s",$t_d)."%');";

    $result = $conn->query($sql);
    $row = $result->fetch_all();
    $c_r=count($row);


    if($c_r<1){
        $_SESSION['store_to_eat']='沒東西吃，餓死。';
        
    }
    elseif($c_r==1){
        $_SESSION['store_to_eat']=$row[0][1];
    }
    elseif($c_r>1){
        $r=rand(0,$c_r-1);
        $_SESSION['store_to_eat']=$row[$r][1];
        // echo sprintf("<script>alert('%s');</script>",$row[0][1]." ".$row[1][1]." ".$c_r." ".$r." ".$row[$r][1]);
    }
    else{
        $_SESSION['store_to_eat']="rand wrong";
    }

    header("location:ubereat.php");
    exit;





    // if($t==="0"){
    //     $sql = sprintf("SELECT * FROM `stores` WHERE `closed_time_hour`);
    // }
    // elseif($t===){
    //     $sql = sprintf("SELECT * FROM `user` WHERE `user_name`= '%s';", $user_name);
    // }

?>