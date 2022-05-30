<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Apartment extends ActiveRecord{

    public static function tableName()
    {
        return 'apartment';
    }

    public function findById($id)
    {
        return static::findOne(['id'=>$id]);
    }
}