<?php
require_once 'Bot.php';

header('content-type: application/json');
$token = $_REQUEST['token'] ?? null;
$message = $_REQUEST['message'] ?? '';

$bot = new Bot();
console.log("Token: " . json_encode($token));
console.log("Message: " . json_encode($message));
if (is_null($token)) {
    echo json_encode(['code' => 422, 'message' => 'token 不能为空']);
} else {
    // 发送消息
    $chat_id = $bot->decryption($token);
    console.log("Chat ID: " . json_encode($chat_id));
    $ret = $bot->sendMessage(['text' => $message, 'chat_id' => $chat_id]);
    console.log("Response: " . json_encode($ret));
    if ($ret['ok']) {
        echo json_encode(['code' => 200, 'message' => 'success']);
    } else {
        echo json_encode(['code' => 422, 'message' => $ret['description']]);
    }
}
