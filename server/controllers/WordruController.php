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
     * Useful constant
     */
    const LIMIT_NOT_CORRECT_ANSWER = 3;
    const LIMIT_WRITE_ANSWER = 1;

    /**
     * Return word and transfer if params $id not null
     * Return random word and four variant transfer if $id is null
     * @param null $id
     * @param null $passed
     * @return string
     */
    public function actionIndex($id = null, $passed = null)
    {
        if($id) {
            return json_encode(
                WordRu::find()
                    ->withId($id)
                    ->with('engs')
                    ->asArray()
                    ->one(),
                JSON_UNESCAPED_UNICODE
            );
        }
        else {
            $query = $passed ?
                WordRu::find()->withNotInIds(json_decode($passed)) :
                WordRu::find();

            $word = $query
                ->orderBy(new Expression('rand()'))
                ->with('engs')
                ->limit(self::LIMIT_WRITE_ANSWER)
                ->asArray()
                ->one();

            if(!$word["engs"])
                return null;

            $transfer = array_merge(
                WordEng::find()
                    ->withNotId($word["engs"][0]["id"])
                    ->limit(self::LIMIT_NOT_CORRECT_ANSWER)
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
