<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\dform\models\Forms */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Forms',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="forms-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'fields' => $fields,
    ]) ?>

</div>
