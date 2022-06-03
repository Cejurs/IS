<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Account extends ActiveRecord{

    public static function tableName()
    {
        return 'account';
    }

    public function findById($id)
    {
        return static::findOne(['id'=>$id]);
    }
}