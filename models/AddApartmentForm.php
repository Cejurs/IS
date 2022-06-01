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
    public $monthrent;

    public function rules()
    {
        return [
            [['name', 'adress', 'description','square','monthrent'], 'required'],
            [['img'], 'file', 'extensions' => 'png, jpg, jfif,jpeg'],
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