<?php

namespace  app\modules\dform\components;;

use app\modules\dform\models\Options;
use Yii;
use yii\base\Behavior;
use yii\base\Event;
use yii\base\Exception;
use yii\db\ActiveRecord;


class SerializeBehavior extends Behavior
{

    /**
     * @var ActiveRecord the owner of this behavior
     */
    public $owner;

    public $attributes = [];

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

        if (count($this->attributes)) {

            foreach ($this->attributes as $attribute => $params) {

                if (is_int($attribute)) { /*it's a key, with a value only, without params*/
                    $attribute = $params;
                    $params = [];
                }

                $_att = $this->owner->$attribute;

                // check if the attribute is an array, and serialize it
                if (is_array($_att)) {

                    $this->owner->$attribute = $this->SerializeAttribute($_att);

                } else {
                    // if its a string, lets see if its serializable, if not set it to null
                    if (is_scalar($_att)) {
                        $a = @unserialize($_att);
                        if ($a === false) {
                            $this->owner->$attribute = null;
                        }
                    }
                }
            }
        }

    }

    function SerializeAttribute($value)
    {
        if (!is_array($value))
            throw new Exception(Yii::t('errors', 'Error #331'));

        $data = array();

        foreach ($value as $attr_model) {

            if (is_object($attr_model))
                $data[] = $attr_model->attributes;
            else
                $data[] = $attr_model;
        }


        return serialize($data);
    }

    public function afterFind(Event $event)
    {

        if (empty($this->attributes))
            return;

        foreach ($this->attributes as $attribute => $params) {

            if (is_int($attribute)) { /*it's a key, with a value only, without params*/
                $attribute = $params;
                $params = [];
            }

            $_att = $this->owner->$attribute;

            if (empty($_att) || !is_scalar($_att)) {

                $this->owner->$attribute = array();

                continue;
            }


            $this->owner->$attribute = array();

            $unserialized = @unserialize($_att);
            if ($unserialized === false)
                continue;


            if (!empty($params)) {

                if (isset($params['modelName'])) {
                    $modelName = $params['modelName'];
                }

                if (isset($params['attributeKey'])) {
                    $attributeKey = $params['attributeKey'];
                }
            }

            /* it's an array that not associated to a model, aet the attribute to the unseriliazed array, and continue; */
            if (!isset($modelName)) {
                $this->owner->$attribute = $unserialized;
                continue;
            }

            $newVal = [];
            /* @var $model ActiveRecord */

            foreach ($unserialized as $i => $field_data) {
                $model = new $modelName();
                $model->attributes = $field_data;
                    $model->validate();

                $key = empty($attributeKey) ? $i : $model->{$attributeKey};
                $newVal[$key] = $model;

            }

            $this->owner->{$attribute} = $newVal;

            unset($modelName); //for next attribute
        }
    }

}