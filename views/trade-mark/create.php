<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TradeMark */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Trade Mark',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trade Marks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trade-mark-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
