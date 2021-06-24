<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $xlsxFile;

    public $file;

    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'xlsx'],
            ['xlsxFile', 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'file' => 'Файл'
        ];
    }
}