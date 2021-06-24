<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_manufacturer".
 *
 * @property int $id
 * @property string $name
 *
 * @property TireModelManufacturer[] $TireModelManufacturers
 * @property TireModel[] $models
 */
class Manufacturer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_manufacturer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
            [['name'], 'unique'],
            [['name'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Производитель',
        ];
    }

    /**
     * Gets query for [[TireModelManufacturers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTireModelManufacturers()
    {
        return $this->hasMany(TireModelManufacturer::className(), ['id_manufacturer' => 'id']);
    }

    /**
     * Gets query for [[Models]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModels()
    {
        return $this->hasMany(TireModel::className(), ['id' => 'id_model'])->viaTable('tbl_tire_model_manufacturer', ['id_manufacturer' => 'id']);
    }
}
