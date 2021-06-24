<?php

namespace app\controllers;

use app\models\Manufacturer;
use app\models\TireModel;
use Yii;
use app\models\TireModelManufacturer;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TireModelManufacturerController implements the CRUD actions for TireModelManufacturer model.
 */
class TireModelManufacturerController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TireModelManufacturer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TireModelManufacturer::find()->with('model')->with('manufacturer'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TireModelManufacturer model.
     * @param integer $id_model
     * @param integer $id_manufacturer
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_model, $id_manufacturer)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_model, $id_manufacturer),
        ]);
    }

    /**
     * Creates a new TireModelManufacturer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TireModelManufacturer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_model' => $model->id_model, 'id_manufacturer' => $model->id_manufacturer]);
        }

        return $this->render('create', [
            'model' => $model,
            'tireModels' => new TireModel(),
            'manufacturer' => new Manufacturer(),
        ]);
    }

    /**
     * Updates an existing TireModelManufacturer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_model
     * @param integer $id_manufacturer
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_model, $id_manufacturer)
    {
        $model = $this->findModel($id_model, $id_manufacturer);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_model' => $model->id_model, 'id_manufacturer' => $model->id_manufacturer]);
        }

        return $this->render('update', [
            'model' => $model,
            'tireModels' => new TireModel(),
            'manufacturer' => new Manufacturer(),
        ]);
    }

    /**
     * Deletes an existing TireModelManufacturer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_model
     * @param integer $id_manufacturer
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_model, $id_manufacturer)
    {
        $this->findModel($id_model, $id_manufacturer)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TireModelManufacturer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_model
     * @param integer $id_manufacturer
     * @return TireModelManufacturer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_model, $id_manufacturer)
    {
        if (TireModelManufacturer::findOne(['id_model' => $id_model, 'id_manufacturer' => $id_manufacturer]) !== null) {
            return TireModelManufacturer::find()->with('model')->with('manufacturer')->where(['id_model' => $id_model, 'id_manufacturer' => $id_manufacturer])->one();
        }

        throw new NotFoundHttpException('Запрашиваемая станица не найдена.');
    }
}
