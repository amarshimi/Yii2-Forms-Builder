<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/dform-style.css',
        'css/jquery-ui.min.css',
        'font-awesome/css/font-awesome.min.css',
    ];
    public $js = [
        'js/create-elements.js',
        'js/elements-1.js',
        'js/ajax.js',
        'js/forms.js',
        'js/jquery-ui.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
       // 'app\modules\dform\assets\dformAssets',
    ];
}
