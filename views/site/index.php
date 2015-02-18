<?php
use yii\jui\Menu;
/* @var $this yii\web\View */
$this->title = 'Желтые страницы';
?>
<div class="site-index">
    <?php echo Menu::widget([
    'items' => [
        // Important: you need to specify url as 'controller/action',
        // not just as 'controller' even if default action is used.
        ['label' => 'Home', 'url' => ['site/index']],
        // 'Products' menu item will be selected as long as the route is 'product/index'
        ['label' => 'Products', 'url' => ['product/index'], 'items' => [
            ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
            ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
        ]],
        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
    ],
]);
    var_dump((string)Yii::$app->user->getId());
    //var_dump(Yii::$app->authManager->checkAccess('54e2145c7ed1d4e3258b457a', 'admin'));
    //var_dump(Yii::$app->user);
    //var_dump(Yii::$app->authManager);?>
</div>
