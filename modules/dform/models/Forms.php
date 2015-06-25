<?php

namespace  app\modules\dform\models;

use Yii;

/**
 * This is the model class for table "forms".
 *
 * @property string $id
 * @property string $name
 * @property string $category
 *
 * @property Fields[] $fields
 */
class Forms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'forms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category'], 'string', 'max' => 50]
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
            'category' => Yii::t('app', 'Category'),
        ];
    }


}
