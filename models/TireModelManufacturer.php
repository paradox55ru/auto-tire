<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_tire_model_manufacturer".
 *
 * @property int $id_model
 * @property int $id_manufacturer
 *
 * @property Manufacturer $manufacturer
 * @property TireModel $model
 */
class TireModelManufacturer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_tire_model_manufacturer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_model', 'id_manufacturer'], 'required'],
            [['id_model', 'id_manufacturer'], 'integer'],
            [['id_model', 'id_manufacturer'], 'unique', 'targetAttribute' => ['id_model', 'id_manufacturer']],
            [['id_manufacturer'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturer::className(), 'targetAttribute' => ['id_manufacturer' => 'id']],
            [['id_model'], 'exist', 'skipOnError' => true, 'targetClass' => TireModel::className(), 'targetAttribute' => ['id_model' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_model' => 'Модель',
            'id_manufacturer' => 'Производитель',
        ];
    }

    /**
     * Gets query for [[Manufacturer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::className(), ['id' => 'id_manufacturer']);
    }

    /**
     * Gets query for [[Model]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(TireModel::className(), ['id' => 'id_model']);
    }
}
