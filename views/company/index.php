<?php

use yii\helpers\Html;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;
use yii\web\JsExpression;

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
        
        $url = \yii\helpers\Url::to(['list-category']);
        $url2 = \yii\helpers\Url::to(['list-user']);
        $url3 = \yii\helpers\Url::to(['list-trademark']);
        $initScript2 = <<< SCRIPT
            function (element, callback) {
                var id=\$(element).val();
                if (id !== "") {
                    \$.ajax("{$url2}?id=" + id, {
                        dataType: "json"
                    }).done(function(data) { callback(data.results);});
                }
            }
SCRIPT;
            $initScript = <<< SCRIPT
            function (element, callback) {
                var id=\$(element).val();
                if (id !== "") {
                    \$.ajax("{$url}?id=" + id, {
                        dataType: "json"
                    }).done(function(data) { callback(data.results);});
                }
            }
SCRIPT;
            $initScript3 = <<< SCRIPT
            function (element, callback) {
                var id=\$(element).val();
                if (id !== "") {
                    \$.ajax("{$url3}?id=" + id, {
                        dataType: "json"
                    }).done(function(data) { callback(data.results);});
                }
            }
SCRIPT;
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
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions'=>[
                    'pluginOptions'=>
                    [
                        'allowClear'=>true,
                        'minimumInputLength' => 3,
                        'ajax' => [
                            'url' => $url,
                            'dataType' => 'json',
                            'data' => new JsExpression('function(term,page) { return {search:term}; }'),
                            'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                        ],
                        'initSelection' => new JsExpression($initScript)
                    ],
                ],
                'attribute' => 'parentID',
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
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions'=>[
                    'pluginOptions'=>
                    [
                        'allowClear'=>true,
                        'minimumInputLength' => 3,
                        'ajax' => [
                            'url' => $url3,
                            'dataType' => 'json',
                            'data' => new JsExpression('function(term,page) { return {search:term}; }'),
                            'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                        ],
                        'initSelection' => new JsExpression($initScript3)
                    ],
                ],
                'value'=>'trademark.name',
                'format'=>'raw',
                'vAlign'=>'middle',
                'attribute' => 'tradeMarkId',
            ],
            [
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions'=>[
                    'pluginOptions'=>
                    [
                        'allowClear'=>true,
                        'minimumInputLength' => 3,
                        'ajax' => [
                            'url' => $url2,
                            'dataType' => 'json',
                            'data' => new JsExpression('function(term,page) { return {search:term}; }'),
                            'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                        ],
                        'initSelection' => new JsExpression($initScript2)
                    ],
                ],
                'value'=>'user.name',
                'format'=>'raw',
                'vAlign'=>'middle',
                'attribute' => 'user_id',
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
