<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fail_answer".
 *
 * @property integer $id
 * @property integer $test_id
 * @property string $data
 *
 * @property Test $test
 */
class FailAnswer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fail_answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_id', 'data'], 'required'],
            [['test_id'], 'integer'],
            [['data'], 'string'],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'test_id' => Yii::t('app', 'Test ID'),
            'data' => Yii::t('app', 'Data'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\FailAnswerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\FailAnswerQuery(get_called_class());
    }
}
