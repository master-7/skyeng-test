<?php

namespace app\controllers;

use Yii;
use app\models\WordRu;
use app\models\WordEng;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\db\Expression;

/**
 * WordengController implements the CRUD actions for WordEng model.
 */
class WordengController extends Controller
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
     * @return null|string
     */
    public function actionIndex($id = null, $passed = null)
    {
        if($id) {
            return json_encode(
                WordEng::find()
                    ->withId($id)
                    ->with('rus')
                    ->asArray()
                    ->one(),
                JSON_UNESCAPED_UNICODE
            );
        }
        else {
            $query = $passed ?
                WordEng::find()->withNotInIds(json_decode($passed)) :
                WordEng::find();

            $word = $query
                ->orderBy(new Expression('rand()'))
                ->with('rus')
                ->limit(self::LIMIT_WRITE_ANSWER)
                ->asArray()
                ->one();

            if(!$word["rus"])
                return null;

            $transfer = array_merge(
                WordRu::find()
                    ->withNotId($word["rus"][0]["id"])
                    ->limit(self::LIMIT_NOT_CORRECT_ANSWER)
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
