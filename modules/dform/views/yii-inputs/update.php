<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\dform\models\YiiInputs */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Yii Inputs',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yii Inputs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="yii-inputs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
