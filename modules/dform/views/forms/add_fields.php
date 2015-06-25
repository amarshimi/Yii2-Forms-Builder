<?php
/**
 * Created by PhpStorm.
 * User: amarshimi
 * Date: 5/27/2015
 * Time: 4:53 PM
 */
use app\modules\dform\models\YiiInputs;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="forms-form">

    <?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, '[0]type')->dropDownList(ArrayHelper::map(YiiInputs::find()->all(),'name','name')) ?>

<?= $form->field($model, '[0]label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, '[1]type')->dropDownList(ArrayHelper::map(YiiInputs::find()->all(),'name','name')) ?>

    <?= $form->field($model, '[1]label')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, '[2]type')->dropDownList(ArrayHelper::map(YiiInputs::find()->all(),'name','name')) ?>

    <?= $form->field($model, '[2]label')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
