<?php

namespace app\controllers;

use Yii;
use app\models\WordEng;
use app\models\WordRu;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\db\Expression;

/**
 * WordruController implements the CRUD actions for WordRu model.
 */
class WordruController extends Controller
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
                WordRu::find()
                    ->withId($id)
                    ->with('engs')
                    ->asArray()
                    ->all(),
                JSON_UNESCAPED_UNICODE
            );
        }
        else {
            $word = WordRu::find()
                ->orderBy(new Expression('rand()'))
                ->with('engs')
                ->limit(1)
                ->asArray()
                ->one();

            $transfer = array_merge(
                WordEng::find()
                    ->withNotId($word['id'])
                    ->limit(3)
                    ->asArray()
                    ->all(),
                $word["engs"]
            );

            shuffle($transfer);

            unset($word["engs"]);

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
     * Finds the WordRu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WordRu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WordRu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
