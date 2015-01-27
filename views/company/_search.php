<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CompanySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, '_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'legal_form') ?>

    <?= $form->field($model, 'legal_name') ?>

    <?= $form->field($model, 'sphere') ?>

    <?php // echo $form->field($model, 'company_size') ?>

    <?php // echo $form->field($model, 'address_id') ?>

    <?php // echo $form->field($model, 'address_addition') ?>

    <?php // echo $form->field($model, 'phone_numbers') ?>

    <?php // echo $form->field($model, 'short_phone_numbers') ?>

    <?php // echo $form->field($model, 'hr_phone_numbers') ?>

    <?php // echo $form->field($model, 'fax_numbers') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'working_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'branch_name') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'wants_placement') ?>

    <?php // echo $form->field($model, 'export_to_yandex') ?>

    <?php // echo $form->field($model, 'postcode') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'parentID') ?>

    <?php // echo $form->field($model, 'branchParentID') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
