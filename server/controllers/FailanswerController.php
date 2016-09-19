<?php

namespace app\controllers;

use Yii;
use app\models\FailAnswer;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FailanswerController implements the CRUD actions for FailAnswer model.
 */
class FailanswerController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index'  => ['options', 'post', 'put']
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
                header('Access-Control-Allow-Methods : OPTIONS, POST, PUT');
                return true;
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
     * Creates a new FailAnswer model
     * @return \yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionCreate()
    {
        $model = new FailAnswer();

        if ($model->load(["FailAnswer" => Yii::$app->request->post()]) && $model->save()) {
            return json_encode(['id' => $model->id]);
        } else {
            throw new BadRequestHttpException("Bad params");
        }
    }

    /**
     * Updates an existing FailAnswer model
     * @param $id
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(["FailAnswer" => Yii::$app->request->post()]) && $model->save()) {
            return json_encode(['id' => $model->id]);
        } else {
            throw new BadRequestHttpException("Bad params");
        }
    }

    /**
     * Finds the FailAnswer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FailAnswer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FailAnswer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
