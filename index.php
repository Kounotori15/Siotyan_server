<?php
$line_accessToken = getenv('LINE_BOT_TOKEN');
$json_string = file_get_contents('php://input');
$jsonObj = json_decode($json_string);
 
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};
$messageId = $jsonObj->{"events"}[0]->{"message"}->{"id"};
$message_type = $jsonObj->{"events"}[0]->{"message"}->{"type"};
$message_recv = $jsonObj->{"events"}[0]->{"message"}->{"text"};

$flg = file_get_contents("data.txt");
$message = "";
if($message_type == "text"){
    $message = $message_recv;
    if($message == "じゃんけん"){
        $message = "じゃんけんするぞ";
        file_put_contents("data.txt", "1");
    }
    else if($flg == "1"){
        $message = janken($message);
    }
    
}else{
    $message = "申し訳ありません。テキストのみをいれてください";
}

send_message($replyToken, $line_accessToken, $message);
?>
 
<?php
//メッセージの送信
function send_message($replyToken, $line_accessToken, $message){
    $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $line_accessToken);

    $messageformat = array('type' => 'text', 'text' => $message);

    $body = json_encode(array('replyToken' => $replyToken, 'messages'   => array($messageformat)));
    
    $options = array(CURLOPT_URL => 'https://api.line.me/v2/bot/message/reply',
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $body);

    $curl = curl_init();
    curl_setopt_array($curl, $options);
    curl_exec($curl);
    curl_close($curl);
}
?>

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
        file_put_contents("data.txt", "0");
    }
    return $message;
}
?>