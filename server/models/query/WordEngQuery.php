<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\WordEng]].
 *
 * @see \app\models\WordEng
 */
class WordEngQuery extends \yii\db\ActiveQuery
{
    /**
     * @param $id
     * @return $this
     */
    public function withId($id)
    {
        return $this->andWhere([
            "id" => $id
        ]);
    }

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
     * @return \app\models\WordEng[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\WordEng|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
