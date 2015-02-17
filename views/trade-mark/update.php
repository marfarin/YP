<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TradeMark */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Trade Mark',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trade Marks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => (string)$model->_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="trade-mark-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
