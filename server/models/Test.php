<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property integer $id
 * @property string $username
 * @property integer $evaluation
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * Validate constant
     */
    const USERNAME_MAX_LENGTH = 255;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'evaluation'], 'required'],
            [['evaluation'], 'integer'],
            [['username'], 'string', 'max' => self::USERNAME_MAX_LENGTH],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'evaluation' => Yii::t('app', 'Evaluation'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\TestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\TestQuery(get_called_class());
    }
}
