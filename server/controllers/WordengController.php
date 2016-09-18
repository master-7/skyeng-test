<?php

namespace app\controllers;

use app\models\WordRu;
use Yii;
use app\models\WordEng;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

use yii\db\Expression;

/**
 * WordengController implements the CRUD actions for WordEng model.
 */
class WordengController extends Controller
{
    /**
     * Return word and transfer if params $id not null
     * Return random word and four variant transfer if $id is null
     * @param null $id
     * @return string
     */
    public function actionIndex($id = null)
    {
        if($id) {
            return json_encode(
                WordEng::find()
                    ->withId($id)
                    ->with('rus')
                    ->asArray()
                    ->all(),
                JSON_UNESCAPED_UNICODE
            );
        }
        else {
            $word = WordEng::find()
                ->orderBy(new Expression('rand()'))
                ->with('rus')
                ->limit(1)
                ->asArray()
                ->one();

            $transfer = array_merge(
                WordRu::find()
                    ->withNotId($word['id'])
                    ->limit(3)
                    ->asArray()
                    ->all(),
                $word["rus"]
            );

            shuffle($transfer);

            unset($word["rus"]);

            return json_encode(
                [
                    "word" => $word,
                    "transfer" => $transfer
                ],
                JSON_UNESCAPED_UNICODE
            );
        }
    }

    /**
     * Finds the WordEng model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WordEng the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WordEng::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
