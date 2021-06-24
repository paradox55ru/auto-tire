<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_auto_tire".
 *
 * @property int $id
 * @property string|null $name Наименование
 * @property int|null $width Ширина
 * @property int|null $profile Профиль
 * @property string|null $diameter Диаметр
 * @property string|null $load_index Индекс нагрузки
 * @property string|null $speed_index Индекс скорости
 * @property int|null $id_model Модель
 * @property string|null $quantity Количество
 * @property float|null $price Цена
 * @property string|null $create_at Дата создания
 * @property string|null $update_at Дата изменения
 * @property bool $by_edit Необходимость редактировать
 */
class AutoTire extends \yii\db\ActiveRecord
{
    const BY_EDIT = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_auto_tire';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['width', 'profile', 'id_model'], 'integer'],
            [['price'], 'number'],
            [['create_at', 'update_at'], 'safe'],
            [['by_edit'], 'boolean'],
            [['name'], 'string', 'max' => 100],
            [['diameter', 'load_index', 'speed_index', 'quantity'], 'string', 'max' => 10],
            [['name', 'width', 'profile', 'diameter', 'load_index', 'speed_index', 'id_model'], 'unique',
                'targetAttribute' => ['name', 'width', 'profile', 'diameter', 'load_index', 'speed_index', 'id_model']],
            [['name', 'width', 'profile', 'diameter', 'load_index', 'speed_index', 'id_model'], 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'width' => 'Ширина',
            'profile' => 'Профиль',
            'diameter' => 'Диаметр',
            'load_index' => 'Индекс нагрузки',
            'speed_index' => 'Индекс скорости',
            'id_model' => 'Модель',
            'quantity' => 'Количество',
            'price' => 'Цена',
            'create_at' => 'Дата создания',
            'update_at' => 'Дата изменения',
            'by_edit' => 'Необходимость редактировать',
        ];
    }

    public function getTireModel()
    {
        return $this->hasOne(TireModelManufacturer::className(), ['id_model' => 'id_model'])->with('model')->with('manufacturer');
    }
}
