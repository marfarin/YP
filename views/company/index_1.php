<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
//var_dump($dataProvider);
?>
<div class="company-index" data-pjax="0">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Company',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

     
    <?php    Pjax::begin(['id' => 'companies', 'options' => [
        'data-pjax' => '1'
    ]]); ?>
    <?= //var_dump($dataProvider);
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            '_id',
            'name',
            'legal_form',
            'legal_name',
            'sphere',
            'company_size',
            'address_id',
            'address_addition',
            'phone_numbers',
            'short_phone_numbers',
            'hr_phone_numbers',
            'fax_numbers',
            'email',
            'url',
            'working_time',
            'update_time',
            'user_id',
            'branch_name',
            'description',
            'status',
            'wants_placement',
            'export_to_yandex',
            'postcode',
            'type',
            [
                'attribute' => 'category',
                'value'=>'category.name'
            ],
            [
                'attribute' => 'user',
                'value'=>'user.name'
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);  ?>
    <?php    
    Pjax::end();
    //var_dump($dataProvider);
    ?>    

</div>
