<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelegramSendApi extends Controller
{
    public static function SendApi($message) {
        $botToken="6060205719:AAFr_JjkcDOp5PXq_cuo73ZUPImpluqrm7g";
        $website="https://api.telegram.org/bot".$botToken;
        $chatId=-971107260;
        $params=[
            'chat_id'=>$chatId,
            'text'=> $message,
        ];
        $ch = curl_init($website . '/sendMessage');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $json = json_decode($result, true);
        $repo = array_search("true",$json);
        if ($repo == 'ok') {
            echo '{';
            echo '"status": "200",';
            echo '"message": "success"';
            echo '}';
        } else {
            echo '{';
            echo '"status": "500",';
            echo '"message": "fail"';
            echo '}';
        }
        curl_close($ch);
    }
}
