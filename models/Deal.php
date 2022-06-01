<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Deal extends ActiveRecord{

    public static function tableName()
    {
        return 'deal';
    }

    public function findById($id)
    {
        return static::findOne(['id'=>$id]);
    }
}