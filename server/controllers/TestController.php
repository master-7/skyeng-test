<?php

namespace app\controllers;

use Yii;
use app\models\Test;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * TestController implements the CRUD actions for Test model.
 */
class TestController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index'  => ['get', 'put', 'post', 'options']
                ],
            ],
        ];
    }

    /**
     * REST method switch action depending on the HTTP method
     * @param $id
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionIndex($id = null)
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'OPTIONS':
                header('Access-Control-Allow-Methods : POST, GET, OPTIONS, PUT');
                return true;
                break;
            case 'GET':
                return $this->actionView($id);
                break;
            case 'POST':
                return $this->actionCreate();
                break;
            case 'PUT':
                return $this->actionUpdate($id);
                break;
        }
        throw new BadRequestHttpException("Not allow {$_SERVER['REQUEST_METHOD']} method!");
    }

    /**
     * View the test by $id
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        return json_encode(
            $this->findModel($id)->attributes
        );
    }

    /**
     * Create the new test
     * If test create success return $id
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionCreate()
    {
        $model = new Test();

        if ($model->load(["Test" => Yii::$app->request->post()]) && $model->save()) {
            return json_encode([
                "id" => $model->id
            ]);
        } else {
            throw new BadRequestHttpException("Bad params");
        }
    }

    /**
     * Updates an existing Test model.
     * If update is successful, return true.
     * @param $id
     * @return bool
     * @throws BadRequestHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($model->evaluation) {
            if($model->updateCounters(['evaluation' => 1]))
                return true;
        }
        else {
            $model->evaluation = 1;
            if($model->save())
                return true;
        }
        throw new BadRequestHttpException("Bad params");
    }

    /**
     * Finds the Test model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Test the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Test::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
