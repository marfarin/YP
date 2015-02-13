<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Company */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="company-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => (string)$model->_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => (string)$model->_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'_id',
            'name',
            'legal_form',
            'legal_name',
            'sphere',
            'company_size',
            'address_id',
            'address_addition',
            
            [
                'attribute' => 'phone_numbers',
                'value' => call_user_func(function($model) {
                    $branchParentID = implode($model->phone_numbers, '<br>');
                    return $branchParentID;
                }, $model),
                'format' => 'raw'
                                
            ],
            [
                'attribute' => 'short_phone_numbers',
                'value' => call_user_func(function($model) {
                    $branchParentID = implode($model->short_phone_numbers, '<br>');
                    return $branchParentID;
                }, $model),
                'format' => 'raw'
                                
            ],
            [
                'attribute' => 'hr_phone_numbers',
                'value' => call_user_func(function($model) {
                    $branchParentID = implode($model->hr_phone_numbers, '<br>');
                    return $branchParentID;
                }, $model),
                'format' => 'raw'
                                
            ],
            [
                'attribute' => 'fax_numbers',
                'value' => call_user_func(function($model) {
                    $branchParentID = implode($model->fax_numbers, '<br>');
                    return $branchParentID;
                }, $model),
                'format' => 'raw'
                                
            ],
            [
                'attribute' => 'email',
                'value' => call_user_func(function($model) {
                    $branchParentID = implode($model->email, '<br>');
                    return $branchParentID;
                }, $model),
                'format' => 'raw'
                                
            ],
            [
                'attribute' => 'url',
                'value' => call_user_func(function($model) {
                    $branchParentID = implode($model->url, '<br>');
                    return $branchParentID;
                }, $model),
                'format' => 'raw'
                                
            ],
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
                'value' => call_user_func(function($model) {
                    $result = "";
                    foreach ($model->category as $value) {
                        $result.=$value['name']."</br>";
                    }
                    return $result;
                }, $model),
                'format' => 'raw'
                                
            ],
            /*[
                'attribute' => 'branchParentID',
                'value' => call_user_func(function($model) {
                    $branchParentID = implode($model->branchParentID, '<br>');
                    return $branchParentID;
                }, $model),
                'format' => 'raw'
                                
            ],
            [
                'attribute' => 'parentID',
                'value' => call_user_func(function($model) {
                    $parentID = implode($model->parentID, '<br>');
                    return $parentID;
                }, $model),
                'format' => 'raw'
            ],*/
        ],
    ]) ?>

</div>
