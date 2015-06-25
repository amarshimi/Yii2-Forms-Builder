<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\dform\models\Forms */
/* @var $fields app\modules\dform\models\Fields */

$this->title = Yii::t('app', 'Create Fields');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fields'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fields-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'fields' => $fields,
    ]) ?>

</div>
