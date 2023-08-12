<?php 
function web_permission($a){
    if ($a=="1"){
        return '<button class="b" onclick="window.location.href = \''."../csReview'\"".'>csReview'.'</button>?ok';
        
    }
    else if ($a=="2"){
        return '<button class="b" onclick="window.location.href =\''."../ASR'\"".'>各類作業及考試繳交紀錄表'. '</button>'.'?ok';
    }
    else{
        return ;
    }
}
?>