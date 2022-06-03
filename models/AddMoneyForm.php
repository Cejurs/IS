<?php

namespace app\models;

use Yii;
use yii\base\Model;

class AddMoneyForm extends Model
{
    public $sum;
    public function rules()
    {
        return [
            [['sum'], 'required'],
            [['sum'], 'integer', 'integerOnly' => false, ],
        ];
    }
}