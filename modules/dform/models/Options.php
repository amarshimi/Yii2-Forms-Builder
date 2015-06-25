<?php
/**
 * Created by PhpStorm.
 * User: amarshimi
 * Date: 6/2/2015
 * Time: 3:21 PM
 */

namespace app\modules\dform\models;


use Yii;
use yii\base\Model;

class Options extends Model
{

    public $classes;
    public $name;
    public $placeholder;

    private $model;


    public function rules()
    {
        return[
            [['classes', 'name', 'placeholder'], 'safe']];

    }


    public function attributeLabels()
    {
        return [
            'name'=>Yii::t('app','Filed Name'),
        ];
    }

    public function setModel($model)
    {
        /* @var $model Options */
        $this->classes = $model->classes;
        $this->name = $model->name;
        $this->placeholder = $model->placeholder;
    }

    public function getModel()
    {
        if (!$this->model) {
            $this->model = new Options();
        }
        return $this->model;
    }


} 