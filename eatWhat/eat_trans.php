<?php 

    session_start();

    if(isset($_SESSION['login_status']) && $_SESSION['login_status']=="on"){
        session_unset();
        echo "on";
    }
    else{
        echo "off";
    }

?>