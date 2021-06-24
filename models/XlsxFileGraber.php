<?php

namespace app\models;

use yii\helpers\ArrayHelper;

/**
 * Class XlsxFileGraber
 * @package app\models
 */
class XlsxFileGraber
{
    /**
     * @var array
     */
    protected $activeSheetData = [];

    /**
     * @var string[]
     */
    protected $defaultKeys = [
        1 => 'name',
        'width',
        'profile',
        'diameter',
        'load_index',
        'speed_index',
        'id_model',
    ];

    /**
     * @var string[]
     */
    protected $additionalKeys = [
        'manufacture'
    ];

    /**
     * @var bool
     */
    protected $fullPattern = false;

    /**
     * @var bool
     */
    protected $shortPattern = false;

    /**
     * @param string $fileName
     * @return $this
     * @throws \PHPExcel_Exception
     */
    public function setFile(string $fileName = ''): self
    {
        try {
            $this->activeSheetData = \PHPExcel_IOFactory::load($fileName)->getActiveSheet()->toArray(null, false, true, true);
        } catch (\PHPExcel_Reader_Exception $e) {
            throw new \Exception('Файл ' . $fileName . ' не найден.');
        }

        return $this;
    }

    /**
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function runParse(): void
    {
        $manufacturer = $this->getManufacturerList();

        $modelTireModel = new TireModel();

        foreach ($this->activeSheetData as $data) {
            // колонка - наименование
            $name = $data['B'];

            $checked = $this->getChecked($name, $manufacturer);

            if (empty($checked)) continue;

            $by_edit = 1;

            if ($this->fullPattern) {
                // если одна модель шины у разных производителей (по каким то причинам),
                // тогда необходимо отредактировать данную запись
                $findModel = $modelTireModel->find()->with('tireModelManufacturers')->where(['model_name' => $checked['id_model']])->one();

                if (!empty($findModel->manufacturers) && count($findModel->manufacturers) != 1) {
                    $checked['id_model'] = null;
                } else {
                    $checked['id_model'] = $findModel->id;
                }

            } elseif ($this->shortPattern) {
                $checked['id_model'] = null;
            }

            if (!empty($checked['id_model']) && !empty($checked['profile'])) {
                $by_edit = 0;
            }

            $clean = $this->cleanValues($checked);

            $addParams = array_merge($clean, [
                'quantity' => trim($data['C']),  // колонка - количество
                'price' => trim($data['D']),     // колонка - цена
                'by_edit' => $by_edit,
            ]);

            $this->saveAutoTire($addParams);
        }
    }

    /**
     * @return string
     */
    protected function getManufacturerList(): string
    {
        $manufacturer = new Manufacturer();
        return '(' . implode('|', ArrayHelper::map($manufacturer->find()->all(), 'id', 'name')) . ')';
    }

    /**
     * @param string $name
     * @param string $manufacturer
     * @return array
     */
    protected function getChecked($name = '', $manufacturer = ''): array
    {
        $this->fullPattern = false;

        $this->shortPattern = false;

        preg_match('/(.+)\s+(\d+)(\/\d+)?\s+(\w+)\s+(\d.+|\d+\/\d+)(.)?\s+(\w.+)\s+' . $manufacturer . '/uU', $name, $matches);

        // все обязательные поля заполнены
        if (!empty($matches[1]) && !empty($matches[2]) && !empty($matches[4]) && !empty($matches[5]) && !empty($matches[6]) && !empty($matches[7]) && !empty($matches[8])) {
            unset($matches[0]);

            $this->fullPattern = true;

        } elseif (preg_match('/(.+)\s+(\d+)(\/\d+)?\s+(\w+)\s+(\d+\/\d+|\d+)(.)?(\s+\w.+)?/u', $name, $matches)) {
            unset($matches[0]);

            $this->shortPattern = true;
        }

        // profile
        $matches[3] = !empty($matches[3]) ? str_replace('/', '', $matches[3]) : 0;

        // speed_index
        $matches[6] = !empty($matches[6]) ? str_replace('/', '', $matches[6]) : '';

        return $this->fullPattern || $this->shortPattern ? $this->setValues($matches) : [];
    }

    /**
     * @param array $params
     * @return array
     */
    protected function setValues($params = []): array
    {
        $defaultKeys = $this->defaultKeys;

        if (count($params) == (count($defaultKeys) + count($this->additionalKeys))) {
            $defaultKeys = array_merge($defaultKeys, $this->additionalKeys);
        } else {
            $params = array_pad($params, count($defaultKeys), null);
        }

        return array_combine($defaultKeys, $params);
    }

    /**
     * @param array $params
     * @return array
     */
    protected function cleanValues($params = []): array
    {
        array_walk($params, function ($key, $value) use (&$params) {
            if (in_array($value, $this->additionalKeys)) {
                unset($params[$value]);
            }
        });

        return $params;
    }

    /**
     * @param array $params
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    protected function saveAutoTire($params = []): void
    {
        if (empty($params)) return;

        $autoTire = new AutoTire;

        $build[$autoTire->formName()] = $params;

        if ($autoTire->load($build)) {
            \Yii::$app->db->createCommand()->upsert($autoTire::tableName(), $params)->execute();
        }
    }
}