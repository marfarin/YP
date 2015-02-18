<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Categories */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
$this->registerAssetBundle(\app\assets\JsAsset::className(), \yii\web\View::POS_HEAD);
//$this->js;
//var_dump($this->assetBundles);
//var_dump($this->registerAssetBundle(\app\assets\JsAsset::className(), \yii\web\View::POS_HEAD));
?>
<div class="categories-tree">

    <h1><?= Html::encode($this->title) ?></h1>
    <div id='rubricTree' url='<?php echo \Yii::$app->urlManager->createAbsoluteUrl("");?>'></div>
</div>    
