<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\dform\models\YiiInputs */

$this->title = Yii::t('app', 'Create Yii Inputs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Yii Inputs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yii-inputs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
