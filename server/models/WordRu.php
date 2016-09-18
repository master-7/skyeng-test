<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "word_ru".
 *
 * @property integer $id
 * @property string $word
 *
 * @property Relation[] $relations
 * @property WordEng[] $engs
 */
class WordRu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'word_ru';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['word'], 'required'],
            [['word'], 'string', 'max' => 255],
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
        return $this->hasMany(Relation::className(), ['ru' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngs()
    {
        return $this->hasMany(WordEng::className(), ['id' => 'eng'])->viaTable('relation', ['ru' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\WordRuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\WordRuQuery(get_called_class());
    }
}
