<?php

namespace app\modules\dform\controllers;

use app\modules\dform\models\Fields;
use app\modules\dform\models\Options;
use app\modules\dform\models\YiiInputs;
use Yii;
use app\modules\dform\models\Forms;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FormsController implements the CRUD actions for Forms model.
 */
class FormsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Forms models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Forms::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Forms model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        /* @var $relatedFields Fields */

        $relatedFields = Fields::find()->where(['form_id' => $id])->orderBy('group')->all();

        $groupFields = $this->orderToMultidimensional($relatedFields);


        return $this->render('view', [
            'model' => $this->findModel($id),
            'relatedFields' => $relatedFields,
            'groupFields' => $groupFields,
        ]);
    }

    public function actionFormView($id)
    {
        /* @var $relatedFields Fields */

        if(isset($_FILES['Form'])){
            echo '';

        }

        $relatedFields = Fields::find()->where(['form_id' => $id])->orderBy('group')->all();

        $groupFields = $this->orderToMultidimensional($relatedFields);


        return $this->render('form-view', [
            'model' => $this->findModel($id),
            'relatedFields' => $relatedFields,
            'groupFields' => $groupFields,
        ]);
    }

    private function orderToMultidimensional($relatedFields)
    {
        $groupFields = [];
        foreach ($relatedFields as $key => $value) {
            /* @var $value Fields */

            if (!isset($groupFields[$value->group]))
                $groupFields[$value->group] = [];

            $groupFields[$value->group][] = $value;
        }

        return $groupFields;
    }


    public function findYiiInputsById($id)
    {
        return YiiInputs::find()->where(['id' => $id]);
    }

    /**
     * Creates a new Forms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Forms();

        $fields = new Fields();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'fields' => $fields,

            ]);
        }
    }

    /**
     * Updates an existing Forms model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $fields = new Fields();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'fields' => $fields,
            ]);
        }
    }

    /**
     * Deletes an existing Forms model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionAdd($id)
    {
        $forms = $this->findModel($id);

        $fields = new Fields();

        if ($fields->load(Yii::$app->request->post())) {

            foreach ($_POST['Fields'] as $field) {
                $fields->attributes = $field;
                $fields->form_id = $id;
                if ($fields->save()) {
                    $fields = new Fields();

                }
            }

            return $this->redirect(['index']);
        } else {
            return $this->render('add_fields', [
                'model' => $fields,
                'forms' => $forms,
            ]);
        }


    }

    public function actionTabular()
    {
        if (Yii::$app->request->isAjax) {

            $attributes = $_POST;

            $fields = new Fields();
            $fields->type = $attributes['input'];
            $fields->label = $attributes['label'];
            $fields->form_id = $attributes['formId'];
            $fields->group = isset($attributes['group']) ? $attributes['group'] : 0;
            $fields->options = [new Options()];

            if (!$fields->save()) {
                echo '0';
            };
            if ($fields->save()) {
                if ($fields->group == 0) {
                    $fields->group = $fields->id;
                    $fields->save();
                }
            };

        }
    }


    public function actionAddInput()
    {
        if (Yii::$app->request->isAjax) {


        }
    }

    public function actionUpdateName()
    {
        if (Yii::$app->request->isAjax) {

            /* @var $model Fields */
            if (isset($_POST['id'])) {
                $model = Fields::findOne($_POST['id']);
                $model->label = $_POST['value'];
                $model->save();
            }
        }
    }

    public function actionDeleteField()
    {
        if (Yii::$app->request->isAjax) {
            if (isset($_POST['id'])) {
                $bool = Fields::findOne(['id' => $_POST['id']])->delete();
                if ($bool) {

                }
            }
        }
    }

    /**
     * Finds the Forms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Forms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Forms::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
