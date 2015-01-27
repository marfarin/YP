<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Company',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= 
        
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
            //'parentID',
            //'branchParentID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
        ?>

</div>
