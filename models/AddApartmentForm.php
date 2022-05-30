<?php

namespace app\models;

use Yii;
use yii\base\Model;

class AddApartmentForm extends Model
{
    public $name;
    public $adress;
    public $img;
    public $description;
    public $imgurl;
    public $square;

    public function rules()
    {
        return [
            [['name', 'adress', 'description','square'], 'required'],
            [['img'], 'file', 'extensions' => 'png, jpg, jfif'],
        ];
    }

    public function upload()
    {
        if($this->validate()){
            $this->img->saveAs("images/{$this->img->baseName}.{$this->img->extension}");
            $this->imgurl="/images/{$this->img->baseName}.{$this->img->extension}";
            return true;
        }
        return false;
    }
}