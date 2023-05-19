<?php
session_start();
require_once "db.php";

if ($_POST) {
    if ($_POST['chat_id'] == '' || $_POST['password'] == '') {
        $response = ['status' => 1, 'message' => 'Both fields are required'];
    } else {
        $chat_id = $_POST['chat_id'];
        $password = md5($_POST['password']);
        $pdo = new db($chat_id);
        $a = $pdo->checkUser($chat_id, $password);
        if (empty($a)) {
            $response = ['status' => 2, 'message' => 'Invalid username or password'];
        } else {
            $response = ['status' => 0, 'message' => 'Success'];
            $_SESSION['chat_id'] = $chat_id;
            $_SESSION['auth'] = true;
        }
    }
    echo json_encode($response);
}

//448082677
//aboba