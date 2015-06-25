<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\dform\models\Forms */
/* @var $fields app\modules\dform\models\Fields */
/* @var $form yii\widgets\ActiveForm */
/* @var $groupFields app\modules\dform\models\Fields */
?>

<div class="forms-form">
    <div class="view-wrapper-input">

    <?php $form = ActiveForm::begin(); ?>
    <ul>

        <?
        foreach ($groupFields as $relatedFields) {

            ?>
            <li class="wrapper-input">
                <?
                foreach ($relatedFields as $field) {


                    $group = $field['group'];
                    ?>


                    <div class="wrapper-filed" data-group="<?= $field['group'] ?>"
                         data-form-id="<?= $field['form_id'] ?>" data-sort="<?= $field['sort'] ?>">
                        <?
                        echo Html::label($field['label'], '', ['id' => $field['id']]);
                        echo Html::$field['type']('Form[' . $field['id'].']', $field['value_id'],
                            [
                                'class' => 'form-control',
                                'id' => $field['id'],
                                'group' => $field['group'],
                            ]
                        );
                        ?>
                    </div>
                <?
                }
                ?> </li>
            <br>
            <br>
        <?
        } ?>


    </ul>

    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>