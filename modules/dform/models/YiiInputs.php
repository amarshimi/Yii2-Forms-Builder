<?php

namespace app\modules\dform\models;

use Yii;

/**
 * This is the model class for table "yii_inputs".
 *
 * @property string $id
 * @property string $name
 *
 * @property Fields[] $fields
 */
class YiiInputs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yii_inputs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

}
