<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\dform\models\Values */

$this->title = Yii::t('app', 'Create Values');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="values-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
