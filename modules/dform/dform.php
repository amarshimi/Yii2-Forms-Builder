<?php

namespace app\modules\dform;

use yii\web\View;

class dform extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\dform\controllers';

    public function init()
    {
        parent::init();

        $view = new View();
        $view->registerCss(__DIR__.'/css/dform-style.css');
    }
}
