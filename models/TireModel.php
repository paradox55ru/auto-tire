<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_tire_model".
 *
 * @property int $id
 * @property string $model_name
 *
 * @property TireModelManufacturer[] $TireModelManufacturers
 * @property Manufacturer[] $manufacturers
 */
class TireModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_tire_model';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['model_name'], 'required'],
            [['model_name'], 'string', 'max' => 50],
            [['model_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model_name' => 'Модель шины',
        ];
    }

    /**
     * Gets query for [[TireModelManufacturers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTireModelManufacturers()
    {
        return $this->hasMany(TireModelManufacturer::className(), ['id_model' => 'id'])->with('manufacturer');
    }

    /**
     * Gets query for [[Manufacturers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturers()
    {
        return $this->hasMany(Manufacturer::className(), ['id' => 'id_manufacturer']);
    }
}
