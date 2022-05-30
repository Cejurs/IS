<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ReplyForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $reply;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body','reply'], 'trim'],
            // email has to be a valid email address
            ['email', 'email']
        ];
    }
}