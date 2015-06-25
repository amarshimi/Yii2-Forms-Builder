<?php

namespace app\modules\dform\models;

use Yii;

/**
 * This is the model class for table "values".
 *
 * @property string $id
 * @property string $field_id
 * @property string $value
 *
 * @property Fields[] $fields
 */
class Values extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['field_id'], 'integer'],
            [['value'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'field_id' => Yii::t('app', 'Field ID'),
            'value' => Yii::t('app', 'Value'),
        ];
    }


}
