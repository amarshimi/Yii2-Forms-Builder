<?php

namespace app\modules\dform\components;

use Yii;
use yii\base\Action;
use yii\base\Exception;
use yii\helpers\Html;
use yii\grid\ActionColumn;

/**
 * Created by PhpStorm.
 * User: amarshimi
 * Date: 5/27/2015
 * Time: 3:02 PM
 */

class DynamicFormsButtons extends ActionColumn {


    public $template = '{view} {form-view} {update} {delete}';

    protected function initDefaultButtons()
    {

       parent::initDefaultButtons();

        if (!isset($this->buttons['form-view'])) {
            $this->buttons['form-view'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('yii', 'Add'),
                    'aria-label' => Yii::t('yii', 'Add'),
                    'data-pjax' => '0',
                ], $this->buttonOptions);
                return Html::a('<span class="glyphicon glyphicon-wrench"></span>', $url, $options);
            };
        }
    }
} 