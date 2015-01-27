<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Categories */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = $this->title;

?>
<div class="categories-tree">

    <h1><?= Html::encode($this->title) ?></h1>
    <div id='rubricTree' url='<?php echo \Yii::$app->urlManager->createAbsoluteUrl("");?>'></div>
</div>    
