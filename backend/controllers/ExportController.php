<?php

namespace backend\controllers;

use backend\models\forms\ExportExcelForm;
use backend\models\MapPoints;
use backend\services\ExportExcelService;
use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * ExportController
 */
class ExportController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'download'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'download' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = Yii::$container->get(ExportExcelForm::class);
        return $this->render('index', compact('model'));
    }

    public function actionDownload(): Response
    {
        $model = Yii::$container->get(ExportExcelForm::class);

        if (Yii::$app->request->isPost) {
            $service = Yii::$container->get(ExportExcelService::class);
            $file = UploadedFile::getInstance($model, 'excelFile');

            $this->deleteAll();
            $service->export($file);
        }

        return $this->redirect('index');
    }

    /**
     * @throws \yii\db\StaleObjectException
     * @return void
     */
    private function deleteAll()
    {
        $mapPoints = MapPoints::find()->all();

        foreach ($mapPoints as $mapPoint) {
            $mapPoint->delete();
        }
    }
}
