<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "word_eng".
 *
 * @property integer $id
 * @property string $word
 *
 * @property Relation[] $relations
 * @property WordRu[] $rus
 */
class WordEng extends \yii\db\ActiveRecord
{
    /**
     * Validate constant
     */
    const WORD_MAX_LENGTH = 255;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'word_eng';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['word'], 'required'],
            [['word'], 'string', 'max' => self::WORD_MAX_LENGTH],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'word' => Yii::t('app', 'Word'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelations()
    {
        return $this->hasMany(Relation::className(), ['eng' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRus()
    {
        return $this->hasMany(WordRu::className(), ['id' => 'ru'])->viaTable('relation', ['eng' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\WordEngQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\WordEngQuery(get_called_class());
    }
}
