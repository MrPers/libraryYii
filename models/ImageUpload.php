<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model{
    
    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png']
        ];
    }

    public function uploadFile($file, $name)
    {
        $file->saveAs(Yii::getAlias('@web') . 'img/' . "b{$name}.jpg");
        return true;
    }

}