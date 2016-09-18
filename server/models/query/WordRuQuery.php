<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\WordRu]].
 *
 * @see \app\models\WordRu
 */
class WordRuQuery extends \yii\db\ActiveQuery
{
    /**
     * @param $id
     * @return $this
     */
    public function withNotId($id)
    {
        return $this->andWhere([
            "<>",
            "id",
            $id
        ]);
    }

    /**
     * @inheritdoc
     * @return \app\models\WordRu[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\WordRu|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
