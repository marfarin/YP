<?php

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index" data-pjax="0">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?php/* echo Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Company',
]), ['create'], ['class' => 'btn btn-success'])*/ ?>
    </p>-->

     
    <?php
        $queryStatus = \app\models\Company::find()->asArray()->distinct('status');
        $queryCompanySize = \app\models\Company::find()->asArray()->distinct('company_size');
        $createButton = Html::a(Yii::t('app', 'Create {modelClass}', [
            'modelClass' => 'Company',
        ]), ['create'], ['class' => 'btn btn-succes']);
        //var_dump($createButton);
        $columns = [
            ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
            //'_id',
            'name',
            'legal_form',
            'legal_name',
            'sphere',
            [
                'attribute' => 'company_size',
                'vAlign'=>'middle',
                'filterType'=>GridView::FILTER_SELECT2,
                'filterInputOptions'=>['placeholder'=>'Any company size'],
                
                'filter'=>  array_combine(
                    array_filter($queryCompanySize),
                    array_filter($queryCompanySize)
                ),
                'format'=>'raw'
            ],
            'address_id',
            'address_addition',
            [
                'attribute' => 'phone_numbers',
                'value' => function ($model, $key, $index, $widget) {
                    $result = "";
                    foreach ($model->phone_numbers as $value) {
                        $result.=$value."</br>";
                    }
                    return $result;
                },
                'format'=>'raw',
                'vAlign'=>'middle',
            ],
            [
                'attribute' => 'short_phone_numbers',
                'value' => function ($model, $key, $index, $widget) {
                    $result = "";
                    foreach ($model->short_phone_numbers as $value) {
                        $result.=$value."</br>";
                    }
                    return $result;
                },
                'format'=>'raw',
                'vAlign'=>'middle',
            ],
            [
                'attribute' => 'hr_phone_numbers',
                'value' => function ($model, $key, $index, $widget) {
                    $result = "";
                    foreach ($model->hr_phone_numbers as $value) {
                        $result.=$value."</br>";
                    }
                    return $result;
                },
                'format'=>'raw',
                'vAlign'=>'middle',
            ],
            [
                'attribute' => 'fax_numbers',
                'value' => function ($model, $key, $index, $widget) {
                    $result = "";
                    foreach ($model->fax_numbers as $value) {
                        $result.=$value."</br>";
                    }
                    return $result;
                },
                'format'=>'raw',
                'vAlign'=>'middle',
            ],
            [
                'attribute' => 'url',
                'value' => function ($model, $key, $index, $widget) {
                    $result = "";
                    foreach ($model->url as $value) {
                        $result.=$value."</br>";
                    }
                    return $result;
                },
                'format'=>'raw',
                'vAlign'=>'middle',
            ],
            [
                'attribute' => 'email',
                'value' => function ($model, $key, $index, $widget) {
                    $result = "";
                    foreach ($model->email as $value) {
                        $result.=$value."</br>";
                    }
                    return $result;
                },
                'format'=>'raw',
                'vAlign'=>'middle',
            ],
            'working_time',
            'update_time',
            'branch_name',
            'description',
            
            [
                'attribute' => 'status',
                'vAlign'=>'middle',
                'filterType'=>GridView::FILTER_SELECT2,
                'filterInputOptions'=>['placeholder'=>'Any status'],
                
                'filter'=>  array_combine(
                    array_filter($queryStatus),
                    array_filter($queryStatus)
                ),
                'format'=>'raw'
            ],
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'export_to_yandex',
                'vAlign'=>'middle',
            ],
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'wants_placement',
                'vAlign'=>'middle',
            ],
            'postcode',
            [
                'attribute' => 'category',
                'value'=>function ($model, $key, $index, $widget) {
                    $result = "";
                    foreach ($model->category as $value) {
                        $result.=$value['name']."</br>";
                    }
                    return $result;
                },
                'format'=>'raw',
                'vAlign'=>'middle',
            ],
            [
                'attribute' => 'user',
                'value'=>'user.name'
            ],

            [
                'class'=>'kartik\grid\ActionColumn',
                'dropdown'=>false,
                'order'=>DynaGrid::ORDER_FIX_RIGHT
            ],
        ];
        echo DynaGrid::widget([
            'columns' => $columns,
            'theme' => 'panel-info',
            'showPersonalize'=>true,
            'storage'=>'cookie',
            'gridOptions' => [
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'showPageSummary' => false,
                'floatHeader' => true,
                'pjax' => true,               
                'toolbar' =>  [
                    [
                        'content' => $createButton
                    ],
                    ['content'=>'{dynagridFilter}{dynagridSort}{dynagrid}'],
                '{export}',
                ],
                
            ],
            'options'=>['id'=>'dynagrid-company'],
            
        ]);
    ?>

</div>
