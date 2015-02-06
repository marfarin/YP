<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use app\widgetExt\ExtActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
 
$this->registerJs(
   '$("document").ready(function(){ 
        $("#new_company").on("pjax:end", function() {
            $.pjax.reload({container:"#companies"});  //Reload GridView
        });
    });'
);
?>


    
    <?php yii\widgets\Pjax::begin(['id' => 'new_company', 'options' => [
        'data-pjax' => '1'
    ]]); ?>
    <?php 
        $form = ExtActiveForm::begin(['options' => [
        'data-pjax' => '1'
    ],]);
        $queryStat = \app\models\Company::find()->asArray()->distinct('status');
        $queryCompany = \app\models\Company::find()->asArray()->distinct('company_size');
        $queryStat = array_combine(array_filter($queryStat), array_filter($queryStat));
        $queryCompany = array_combine(array_filter($queryCompany), array_filter($queryCompany));
        $queryCompanySize[''] = 'Не указано';
        $queryStatus[''] = 'Не указано';
        $queryCompanySize += $queryCompany;
        $queryStatus += $queryStat;
    ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'legal_form') ?>

    <?= $form->field($model, 'legal_name') ?>

    <?= $form->field($model, 'sphere') ?>

    <?= $form->field($model, 'company_size')->dropDownList($queryCompanySize) ?>

    <?= $form->field($model, 'address_id') ?>

    <?= $form->field($model, 'address_addition') ?>

    <?php
    /*echo Html::input(
        'button',
        'btn_add',
        'Add More',
        [
            'onclick'=>'$.post( "' . Yii::$app->urlManager->createUrl(['company/phonebutton', 'i'=>'']).'"+$("#counter").val(),
                                function( data ){
                                        var val = $("#counter").val();
                                        $( "#counter" ).val( parseInt(val) + 1 );
                                        $( "div#newlyaddedfields" ).append( data );
                                });
                ',//onclick end
        ]
    );
    echo Html::hiddenInput('counter', count($model->phone_numbers), ['id'=>'palcnt',]);*/
    ?>

    <?php
    
    echo $form->showMultipleForm('phone_numbers', $model);
    
    echo $form->showMultipleForm('short_phone_numbers', $model);
    
    echo $form->showMultipleForm('hr_phone_numbers', $model);
    
    echo $form->showMultipleForm('fax_numbers', $model);
    
    echo $form->showMultipleForm('email', $model);
    
    echo $form->showMultipleForm('url', $model);
    
    ?>

    <?= $form->field($model, 'working_time') ?>

    <?= $form->field($model, 'update_time') ?>

    <?= $form->field($model, 'branch_name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'status')->dropDownList($queryStatus)?>

    <?= $form->field($model, 'wants_placement')->dropDownList([0=>'НЕТ',1=>'ДА'])?>

    <?= $form->field($model, 'export_to_yandex')->dropDownList([0=>'НЕТ',1=>'ДА']) ?>

    <?= $form->field($model, 'postcode') ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ExtActiveForm::end(); ?>
    <?php yii\widgets\Pjax::end(); ?>

