<?php

use app\modules\dform\models\Fields;
use app\modules\dform\models\YiiInputs;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\dform\models\Forms */
/* @var $relatedFields app\modules\dform\models\Fields */
/* @var $groupFields app\modules\dform\models\Fields */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<script>

    var App = App || {};
    App.addField = {
        AjaxUrl: '<?= Url::to(['tabular']) ?>'
    };
    App.deleteFieldUrl = {
        AjaxUrl: '<?= Url::to(['delete-field']) ?>'
    };
    App.updateName = {
        AjaxUrl: '<?= Url::to(['update-name']) ?>'
    };


</script>

<script id="hidden-template" type="text/x-custom-template">
    <li class="hidden-wrapper-input wrapper-input ui-sortable-handle">
        <div class="wrapper-filed" id="hidden-new-div" data-group="0" data-form-id="1" data-sort="">

        </div>
        <i id="" class="icon-forms delete fa fa-trash"></i>
        <i id="glyphicon" class="icon-forms settings glyphicon glyphicon-wrench" href="#collapseExample-156"
           data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample5"></i>

        <div class="collapse" id="collapse-target">
            <div class="well">
                <div class="view-options">
                    <label for="options-classes">Classes</label>
                    <input type="text" id="options-classes" class="form-control" name="Options[classes]">

                    <div style="display:none"><p>Please fix the following errors:</p>
                        <ul></ul>
                    </div>
                </div>
                <br>

                <div class="view-options"><label for="options-name">Filed Name</label><input type="text"
                                                                                             id="options-name"
                                                                                             class="form-control"
                                                                                             name="Options[name]">

                    <div style="display:none"><p>Please fix the following errors:</p>
                        <ul></ul>
                    </div>
                </div>
                <br>

                <div class="view-options"><label for="options-placeholder">Placeholder</label><input type="text"
                                                                                                     id="options-placeholder"
                                                                                                     class="form-control"
                                                                                                     name="Options[placeholder]">

                    <div style="display:none"><p>Please fix the following errors:</p>
                        <ul></ul>
                    </div>
                </div>
                <br>
                <button type="button" class="btn btn-primary update">Update</button>
                <div id="add-place"></div>
                <button type="button" class="btn btn-danger delete-fields fa fa-trash"></button>
                <img src="../modules/dform/img/loader.gif" class="ajax-loader">

                <div class="fa fa-check"></div>
            </div>
        </div>
    </li>
</script>

<div class="forms-view col-md-9">


    <p>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?

    /*
     * @todo visible only admin
     * */
    ?>

    <h1>Name : <?= Html::encode($model->name) ?></h1>

    <h1>Category : <?= Html::encode($model->category) ?></h1>
    <?= Html::hiddenInput('form-id-input', $model->id, ['id' => 'form-id']) ?>


    <div class="forms-form">
        <div class="edit-wrapper-input">
            <?
            echo Html::label(Yii::t('app', 'Field Type'), 'add-field');
            echo Html::dropDownList('add-field', Yii::t('app', 'Select Field'), ArrayHelper::map(YiiInputs::find()->all(), 'name', 'options'),
                [
                    'class' => 'form-control form-edit',
                    'id' => 'add-field',
                ]
            );

            echo Html::label(Yii::t('app', 'Field Name'), 'add-label');
            echo Html::textInput('add-label', null, ['class' => 'form-control form-edit', 'id' => 'add-label']);
            ?>
            <br>
            <?

            echo Html::button('+', [
                'class' => 'btn btn-primary',
                'id' => 'add-field-ajax',
            ]);

            ?>
            <br>
            <br>
            <input type="hidden" name="hiddenField"/>
            <?= Html::beginForm() ?>
            <?
            if (!empty($relatedFields)) {
                ?>
                <ul class="sortable ui-draggable-connect" id="ui-draggable-connect">
                <!--  <li class="ui-connect-start">
                    <? /*= Yii::t('app','Drag hear') */ ?>
                </li>-->

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
                                echo Html::$field['type']('name-' . $field['id'], $field['value_id'],
                                    [
                                        'class' => 'form-control',
                                        'id' => $field['id'],
                                        'group' => $field['group'],
                                    ]
                                );
                                ?>
                            </div>
                        <? } ?>



                        <?
                        echo Html::tag('i', '',
                            [
                                'class' => 'icon-forms delete fa fa-trash',
                                'id' => $field['id']
                            ]
                        );

                        echo Html::tag('i', '',
                            [
                                'class' => 'icon-forms settings glyphicon glyphicon-wrench',
                                'id' => $field['id'],
                                'data-toggle' => 'collapse',
                                'href' => '#collapseExample-' . $field['id'],
                                'aria-expanded' => 'false',
                                'aria-controls' => 'collapseExample5',
                            ]
                        );
                        ?>

                        <div class="collapse" id="collapseExample-<?= $field['id'] ?>">
                            <div class="well">
                                <?
                                /* @var $field Fields */
                                foreach ($field->options as $option) {
                                    foreach ($option as $key => $value) {
                                        ?>
                                        <div class="view-options"> <?
                                            echo Html::activeLabel($option, $key);
                                            echo Html::activeInput('text', $option, $key, ['class' => 'form-control']);
                                            echo Html::errorSummary($option);
                                            ?></div>
                                        <br>
                                    <?
                                    }

                                    echo Html::button(Yii::t('app', 'Update'), ['class' => 'btn btn-primary update']);

                                    if (strstr($field['type'], 'radio')) {
                                        echo Html::button(Yii::t('app', 'Add Radio'), ['class' => 'btn btn-primary group-fields']);
                                        echo Html::button(Yii::t('app', 'Add Caption'), ['class' => 'btn btn-primary group-caption']);
                                        echo Html::button(Yii::t('app', ''), ['class' => 'btn btn-danger delete-fields fa fa-trash']);
                                    }
                                    if (strstr($field['type'], 'checkbox')) {
                                        echo Html::button(Yii::t('app', 'Add Checkbox'), ['class' => 'btn btn-primary group-fields']);
                                        echo Html::button(Yii::t('app', 'Add Caption'), ['class' => 'btn btn-primary group-caption']);
                                        echo Html::button(Yii::t('app', ''), ['class' => 'btn btn-danger delete-fields fa fa-trash']);
                                    }
                                }

                                ?>

                                <img
                                    src="<?= '../modules/' . Yii::$app->controller->module->id . '/img/loader.gif' ?>"
                                    class="ajax-loader">
                                <?= Html::tag('div', '', ['class' => 'fa fa-check']) ?>
                            </div>


                        </div>
                    </li>


                <?
                }
                ?>   </ul><?
                // }
            } else {
            ?>
            <ul class="sortable ui-draggable-connect" id="ui-draggable-connect">
                <li></li>
                <?
                echo Html::encode(Yii::t('app', 'No match fields on this form'));
                ?>
                </ul>
                <?
                }
                ?>
                <div class="tabular">


                </div>

                <?= Html::endForm() ?>

        </div>
    </div>
</div>
<div class="col-md-3 area-buttons-draggable ">

    drag & drop components |: - (0)

    <ol class="clearfix wrapper-buttons-draggable" style="position: relative">
        <li data-type='select' data-yii-input-type="dropDownList" class="ui-state-default">
            <div class="col-md-10 btn btn-success">Drop Down</div>
        </li>
        <li data-type='input' data-yii-input-type="textInput" class="ui-state-default">
            <div class="col-md-10 btn btn-danger">Text Field</div>
        </li>
        <li data-type='input' data-yii-input-type="checkbox" class="ui-state-default">
            <div class="col-md-10 btn btn-danger">Checkbox</div>
        </li>
        <li data-type='input' data-yii-input-type="radio" class="ui-state-default">
            <div class="col-md-10 btn btn-success">Radio Button</div>
        </li>
        <li data-type='input' data-yii-input-type="password" class="ui-state-default">
            <div class="col-md-10 btn btn-success">Password</div>
        </li>
        <li data-type='a' data-yii-input-type="a" class="ui-state-default">
            <div class="col-md-10 btn btn-danger">Link</div>
        </li>
        <li data-type='button' data-yii-input-type="button" class="ui-state-default">
            <div class="col-md-10 btn btn-danger">Button</div>
        </li>
        <li data-type='input' data-yii-input-type="file" class="ui-state-default">
            <div class="col-md-10 btn btn-success">File</div>
        </li>
        <li data-type='label' data-yii-input-type="label" class="ui-state-default">
            <div class="col-md-10 btn btn-success">Caption</div>
        </li>
    </ol>
</div>

