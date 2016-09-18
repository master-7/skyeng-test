<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "relation".
 *
 * @property integer $ru
 * @property integer $eng
 *
 * @property WordEng $eng0
 * @property WordRu $ru0
 */
class Relation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ru', 'eng'], 'required'],
            [['ru', 'eng'], 'integer'],
            [['eng'], 'exist', 'skipOnError' => true, 'targetClass' => WordEng::className(), 'targetAttribute' => ['eng' => 'id']],
            [['ru'], 'exist', 'skipOnError' => true, 'targetClass' => WordRu::className(), 'targetAttribute' => ['ru' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ru' => Yii::t('app', 'Ru'),
            'eng' => Yii::t('app', 'Eng'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEng0()
    {
        return $this->hasOne(WordEng::className(), ['id' => 'eng']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRu0()
    {
        return $this->hasOne(WordRu::className(), ['id' => 'ru']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\RelationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\RelationQuery(get_called_class());
    }
}
