<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'legal_form') ?>

    <?= $form->field($model, 'legal_name') ?>

    <?= $form->field($model, 'sphere') ?>

    <?= $form->field($model, 'company_size') ?>

    <?= $form->field($model, 'address_id') ?>

    <?= $form->field($model, 'address_addition') ?>

    <?= $form->field($model, 'phone_numbers') ?>

    <?= $form->field($model, 'short_phone_numbers') ?>

    <?= $form->field($model, 'hr_phone_numbers') ?>

    <?= $form->field($model, 'fax_numbers') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'working_time') ?>

    <?= $form->field($model, 'update_time') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'branch_name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'wants_placement') ?>

    <?= $form->field($model, 'export_to_yandex') ?>

    <?= $form->field($model, 'postcode') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'parentID') ?>

    <?= $form->field($model, 'branchParentID') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
