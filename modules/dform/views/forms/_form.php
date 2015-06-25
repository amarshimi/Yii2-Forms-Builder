<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\dform\models\Forms */
/* @var $fields app\modules\dform\models\Fields */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="forms-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>



        <?= $form->field($fields, 'type')->textInput() ?>
        <?= $form->field($fields, 'label')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
</div>
