<?php

namespace  app\modules\dform\components;;

use app\modules\dform\models\Options;
use Yii;
use yii\base\Behavior;
use yii\base\Event;
use yii\base\Exception;
use yii\db\ActiveRecord;



/**
 * @property $attributes
 */
class SerializeBehavior extends Behavior
{

    /**
     * @var ActiveRecord the owner of this behavior
     */
    public $owner;
    protected $attributes = [];

    function getattributes()
    {
        return $this->attributes;
    }

    function setattributes($val)
    {
        if (! is_array($val)) {
            throw new Exception("Attributes must be an array");
        }
        foreach ($val as $attribute => $params) {
            if (is_int($attribute)) { /*it's a key, with a value only, without params*/
                $this->attributes[$params] = [];
            } else {
                $this->attributes[$attribute] = $params;
            }
        }
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',

            ActiveRecord::EVENT_AFTER_INSERT => 'afterFind',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterFind',
            ActiveRecord::EVENT_AFTER_FIND => 'afterFind',
        ];
    }

    /**
     * Sets the values of the creation or modified attributes as configured
     *
     */
    public function beforeSave()
    {
        foreach ($this->attributes as $attribute => $params) {
            $_att = $this->owner->$attribute;
            if (! is_array($_att)) {
                throw new Exception("_att must be an array");
            }
            // check if the attribute is an array, and serialize it
            $this->owner->$attribute = $this->SerializeAttribute($_att);
        }
    }

    function SerializeAttribute($value)
    {
        if (!is_array($value))
            throw new Exception(Yii::t('errors', 'Error #331'));

        $data = array();
        foreach ($value as $attr_model) {
                if (!is_object($attr_model))
                    throw new Exception("attr_model must be an object");

                $data[] = $attr_model->attributes;
        }

        return serialize($data);
    }

    public function afterFind(/*Event $event*/)
    {
        foreach ($this->attributes as $attribute => $params) {
            $_att = $this->owner->$attribute;
            $this->owner->$attribute = array();

            if (empty($_att) || !is_scalar($_att))
                continue;

            $unserialized = @unserialize($_att);
            if ($unserialized === false)
                continue;

            $modelName = $this->getAttributeParam($params, 'modelName');
            $attributeKey = $this->getAttributeParam($params, 'attributeKey');

            /* it's an array that not associated to a model, aet the attribute to the unseriliazed array, and continue; */
            if (is_null($modelName)) {
                $this->owner->$attribute = $unserialized;
                continue;
            }

            $this->owner->{$attribute} = $this->getUnserializedAttributes($unserialized, $modelName, $attributeKey);
        }
    }

    public function getAttributeParam($params, $attribute)
    {
        return empty($params) || !isset($params[$attribute]) ? null : $params[$attribute];
    }

    /**
     * @param $unserialized
     * @param $modelName
     * @param $attributeKey
     * @return array
     */
    private function getUnserializedAttributes($unserialized, $modelName, $attributeKey)
    {
        $newVal = [];
        /* @var $model ActiveRecord */

        foreach ($unserialized as $i => $field_data) {
            $model = new $modelName();
            $model->attributes = $field_data;
            $model->validate();

            $key = empty($attributeKey) ? $i : $model->{$attributeKey};
            $newVal[$key] = $model;
        }
        return $newVal;
    }

}