<?php

namespace app\controllers;

use Yii;
use app\models\Company;
use app\models\CompanySearch;
use app\models\User;
use yii\web\Controller;
use app\models\Category;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use app\models\TradeMark;
use consultnn\api\Address;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
{
    
    const USER = 'user';
    const COMPANY = 'company';
    const CATEGORY = 'category';
    const ADDRESS = 'address';
    const TRADEMARK = 'trademark';
    
    
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
                        'actions' => ['create', 'update','phonebutton', 'list', 'list-company', 'list-category','list-user', 'list-address', 'list-trademark'],
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
            [
                'class' => \app\components\behaviours\ClearEmptyBehaviour::className(),
            ],
        ];
    }

    /**
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //var_dump(Yii::$app->request->queryParams);
        //var_dump($dataProvider);
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

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            log($model->load(Yii::$app->request->post()));
            return \app\widgetExt\ExtActiveForm::validate($model);
        } elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
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
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            //var_dump($model->load(Yii::$app->request->post()));
            return \app\widgetExt\ExtActiveForm::validate($model);
        } elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => (string)$model->_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    
    public function actionValidNewField($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            //var_dump($model);
            return \app\widgetExt\ExtActiveForm::validate($model);
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
    
    public function actionListAddress($search = null, $id = null)
    {
        $map = array();
        $out = ['more' => false];
        $seeee = new Address();
        if (!is_null($search)) {
            $data = $seeee->getIdByAddressName($search);
            $out['results'] = $data;
            
        } elseif ($id > 0) {
            //var_dump(Categories::find(new \MongoId($id))->asArray()->one());
            $out['results'] = ['id' => $id, 'text' => $seeee->byAddressIds([$id])['name']];
        } else {
            $out['results'] = ['id' => 0, 'text' => 'No matching records found'];
        }
        //var_dump('$value');
        echo \yii\helpers\Json::encode($out);
    }
    
    public function actionList($name, $search = null, $id = null)
    {
        $data = array();
        $text = '';
        $map = array();
        $out = ['more' => false];
        switch ($name) {
            case self::USER:
                if (!is_null($search)) {
                    $data = User::find()->select(['name'])->where(['like', 'name', $search])->asArray()->limit(20)->all();
                }
                if ($id!=null) {
                    $text = User::find()->asArray()->where(['_id'=>$id])->one()['name'];
                }
                break;
            case self::CATEGORY:
                if (!is_null($search)) {
                    $data = Category::find()->select(['name'])->where(['like', 'name', $search])->asArray()->limit(20)->all();
                }
                if ($id!=null) {
                    $text = Category::find()->asArray()->where(['_id'=>$id])->one()['name'];
                }
                break;
            case self::TRADEMARK:
                if (!is_null($search)) {
                    $data = TradeMark::find()->select(['name'])->where(['like', 'name', $search])->asArray()->limit(20)->all();
                }
                if ($id!=null) {
                    $text = TradeMark::find()->asArray()->where(['_id'=>$id])->one()['name'];
                }
                break;
            case self::ADDRESS:
                if (!is_null($search)) {
                    $data = (new Address)->getIdByAddressName($search);
                }
                if ($id!=null) {
                    $text = (new Address)->byAddressIds(array($id));
                }
                break;
            case self::COMPANY:
                if (!is_null($search)) {
                    $data = Company::find()->select(['name'])->where(['like', 'name', $search])->asArray()->limit(20)->all();
                }
                if ($id!=null) {
                    $text = Company::find()->asArray()->where(['_id'=>$id])->one()['name'];
                }
                break;
            default:
                break;
        }
        if (!is_null($search)) {
            foreach ($data as $key => $value) {
                $map[$key]['id'] = (string)$value['_id'];
                $map[$key]['text'] = (string)$value['name'];
            }
            $out['results'] = array_values($map);
            
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => $text];
        } else {
            $out['results'] = ['id' => 0, 'text' => 'No matching records found'];
        }
        echo \yii\helpers\Json::encode($out);
    }
}
