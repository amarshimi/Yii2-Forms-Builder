<?php

namespace app\modules\dform\models;

use app\modules\dform\models\Options;
use app\modules\dform\components\SerializeBehavior;
use Yii;

/**
 * This is the model class for table "fields".
 *
 * @property string $id
 * @property string $type
 * @property string $label
 * @property string $value_id
 * @property string $form_id
 * @property string $options
 * @property string $group
 *
 * @property Values $value
 * @property Forms $form
 */
class Fields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public function behaviors()
    {

        return [
            'serialized' => [
                'class' => SerializeBehavior::className(),
                'attributes' => [
                    'options' => ['modelName' => Options::className(), 'minRow' => 1],
                ]
            ]
        ];

    }

    public static function tableName()
    {
        return 'fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value_id', 'form_id'], 'integer'],
            [['type', 'value_id', 'form_id', 'label'], 'safe'],
            [['label'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type ID'),
            'label' => Yii::t('app', 'Label'),
            'value_id' => Yii::t('app', 'Value ID'),
            'form_id' => Yii::t('app', 'Form ID'),
        ];
    }

}
