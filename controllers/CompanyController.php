<?php

namespace app\controllers;

use Yii;
use app\models\Company;
use app\models\CompanySearch;
use app\models\Users;
use yii\web\Controller;
use app\models\Categories;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                
                'rules' => [
                    //'class'=>  'app\rbac\rules',
                    [
                        'actions' => ['index','view', 'autocomplete'],
                        'allow' => true,
                        'roles' => ['@','?'],
                    ],
                    [
                        'actions' => ['create', 'update','phonebutton'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['delete', 'phonenumbers'],
                        'allow' => true,
                        'roles' => ['moderator'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        var_dump(Users::findUserByName('Марина'));
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        var_dump(Users::findUserByName('Марина'));
        var_dump(Categories::findCategoryByName('Акад'));
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Company model.
     * @param integer $_id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Company();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => (string)$model->_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => (string)$model->_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionPhonenumbers($i)
    {
        $model = new Company();
        //var_dump($model);
        //echo \yii\helpers\Html::activeTextInput($model, 'phone_numbers[' . $i . ']');
        return $this->render('addfield', [
                'model' => $model,
                'i' => $i,
            ]);
    }
}
