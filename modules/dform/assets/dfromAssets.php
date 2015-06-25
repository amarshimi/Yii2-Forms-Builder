<?php

namespace app\modules\dform;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Created by PhpStorm.
 * User: amarshimi
 * Date: 6/1/2015
 * Time: 1:31 PM
 */
class dfromAssets extends AssetBundle
{

    public function init() {
        parent::init();
    }

    public $basePath = '@webroot';
    public $baseUrl = __DIR__;

    public $css = [
        'css/dform-style.css'
    ];

    public $js = [
        'js/create-elements.js',
        'js/elements.js',
        'js/ajax.js',
        'js/forms.js',
        'js/jquery-ui.min.js',
    ];

} 