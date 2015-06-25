<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\dform\models\Forms */

$this->title = Yii::t('app', 'Create Forms');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'fields' => $fields,
    ]) ?>

</div>
