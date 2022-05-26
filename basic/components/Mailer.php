<?php

namespace app\components;
use Yii;

class Mailer
{
    public static function sendMail($email,$message){
        
        $result = Yii::$app->mailer->compose()
                  ->setFrom(Yii::$app->params['senderEmail'])
                  ->setTo($email)
                  ->setSubject($message['Subject'])
                  ->setHtmlBody('<b>'. $message['Letter']. '</b>')
                  ->send();
    }
}