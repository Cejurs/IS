<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Contact extends ActiveRecord{

    public static function tableName()
    {
        return 'contact';
    }

    public function findById($id)
    {
        return static::findOne(['id'=>$id]);
    }
}