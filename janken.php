<?php
function janken($message){
    $a = rand(0,2);
    if($message == "グー"){
        if($a == 0){
            $message = "グー....あいこだね、もう一回やるぞ";
        }
        if($a == 1){
            $message = "チョキ....負けちゃた、次は負けないからね";
        }
        if($a == 2){
            $message = "パー....やったー勝ったー、もう1回勝負だ";
        }
    }
    else if($message == "チョキ"){
        if($a == 0){
            $message = "グー....やったー勝ったー、もう1回勝負だ";
        }
        if($a == 1){
            $message = "チョキ....あいこだね、もう一回やるぞ";
        }
        if($a == 2){
            $message = "パー....負けちゃた、次は負けないからね";
        }
    }
    else if($message == "パー"){
        if($a == 0){
            $message = "グー....負けちゃた、次は負けないからね";
        }
        if($a == 1){
            $message = "チョキ....やったー勝ったー、もう1回勝負だ";
        }
        if($a == 2){
            $message = "パー....あいこだね、もう一回やるぞ";
        }
    }
    else{
        file_put_contents("jankendata.txt", "0");
    }
    return $message;
}
?>