<?php

namespace app\controllers;

use Yii;
use app\models\AutoTire;
use app\models\XlsxFileGraber;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\models\Manufacturer;
use app\models\TireModel;
use app\models\TireModelManufacturer;
//use yii\filters\AccessControl;

/**
 * AutoTireController implements the CRUD actions for AutoTire model.
 */
class AutoTireController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            /*'access' => [
                'class' => AccessControl::className(),
                'only' => ['delete'],
                'rules' => [
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],*/
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists AutoTire models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AutoTire::find()->with('tireModel')->where(['by_edit' => !AutoTire::BY_EDIT]),
            'sort' => false,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists by edit AutoTire models.
     * @return mixed
     */
    public function actionIndex2()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AutoTire::find()->with('tireModel')->where(['by_edit' => AutoTire::BY_EDIT]),
            'sort' => false,
        ]);

        return $this->render('index2', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AutoTire model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AutoTire model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AutoTire();

        if ($model->load(Yii::$app->request->post())) {
            $model->setAttribute('create_at', date('Y-m-d H:i'));

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'tireModels' => new TireModel(),
        ]);
    }

    /**
     * Updates an existing AutoTire model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->by_edit = 0;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'manufacturer' => new Manufacturer(),
            'tireModelsManufacturer' => new TireModelManufacturer()
        ]);
    }

    /**
     * Deletes an existing AutoTire model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param string $fileName
     * @return \yii\web\Response
     */
    public function actionReadXlsxFile($fileName = '')
    {
        $fileInfo = pathinfo($fileName);
        $fileExtension = $fileInfo['extension'];

        if (!in_array($fileExtension, Yii::$app->params['toParse'])) {
            Yii::$app->session->addFlash('info', 'Ошибка в загрузке типа файла!');
            return $this->redirect(Url::to(['site/index2'], true));
        }

        $pathToFile = Yii::getAlias('@uploads/' . $fileInfo['basename']);

        (new XlsxFileGraber())->setFile($pathToFile)->runParse();

        return $this->redirect(['index2']);
    }

    /**
     * Finds the AutoTire model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AutoTire the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (AutoTire::findOne($id) !== null) {
            return AutoTire::find()->with('tireModel')->where([AutoTire::tableName().'.id'=> $id])->one();
        }

        throw new NotFoundHttpException('Запрашиваемая станица не найдена.');
    }
}
