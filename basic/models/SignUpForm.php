<?php

namespace app\models;

use yii\base\Model;

class SignUpForm extends Model
{
    public $username;
    public $password;
    public $email;

    public function rules()
    {
        return [
            [['username','password','email'],'required'],
            [['username','password','email'],'trim'],
            ['email','email','message'=> 'Incorrect email'],
            ['username','unique','targetClass'=>User::className(),'message'=> 'This username is already taken']
        ];
    }
}