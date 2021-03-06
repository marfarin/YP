<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use app\widgetExt\ExtActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
 
/*$this->registerJs(
   '$("document").ready(function(){ 
        $("#new_company").on("pjax:end", function() {
            //$.pjax.reload({container:"#dynagrid-company",url:\'/company\'});  //Reload GridView
        });
    });'
);*/
?>


    
    
    <?php
        $form = ExtActiveForm::begin(['id'=>'form_new_company',
            'enableClientValidation' => false,
            'enableAjaxValidation' => true,
            'validateOnChange' => true,
            'validateOnBlur'=> false,
            'validateOnSubmit' => true,
            
            
        ]);
        $queryCompanySize = $model->getCompanySize();
        $queryStatus = $model->getStatus();
        
    ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'legal_form') ?>

    <?= $form->field($model, 'legal_name') ?>

    <?= $form->field($model, 'sphere') ?>

    <?= $form->field($model, 'company_size')->dropDownList($queryCompanySize) ?>

    <?= $form->field($model, 'address_id') ?>

    <?= $form->field($model, 'address_addition') ?>

    <?php
    
    echo $form->showMultipleForm('phone_numbers', $model, ExtActiveForm::SHOW_ADD_BUTTON, ExtActiveForm::USE_MASKED_INPUT_WIDGET_PHONE);
    
    echo $form->showMultipleForm('short_phone_numbers', $model);
    
    echo $form->showMultipleForm('hr_phone_numbers', $model, ExtActiveForm::SHOW_ADD_BUTTON, ExtActiveForm::USE_MASKED_INPUT_WIDGET_PHONE);
    
    echo $form->showMultipleForm('fax_numbers', $model, ExtActiveForm::SHOW_ADD_BUTTON, ExtActiveForm::USE_MASKED_INPUT_WIDGET_PHONE);
    
    echo $form->showMultipleForm('email', $model, ExtActiveForm::SHOW_ADD_BUTTON, ExtActiveForm::USE_MASKED_INPUT_WIDGET_MAIL);
    
    echo $form->showMultipleForm('url', $model, ExtActiveForm::SHOW_ADD_BUTTON, ExtActiveForm::USE_MASKED_INPUT_WIDGET_URL);
    
    ?>

    <?= $form->field($model, 'working_time') ?>

    <?= $form->field($model, 'update_time') ?>

    <?= $form->field($model, 'branch_name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'status')->dropDownList($queryStatus)?>

    <?= $form->field($model, 'wants_placement')->dropDownList([0=>'НЕТ',1=>'ДА'])?>

    <?= $form->field($model, 'export_to_yandex')->dropDownList([0=>'НЕТ',1=>'ДА']) ?>

    <?php
        //echo $form->field($model, 'tradeMarkId')->textInput()->;
        echo $form->addAjaxWidget($form->field($model, 'tradeMarkId')->textInput(), 'TradeMark');
        //echo $form->showMultipleForm('tradeMarkId', $model, ExtActiveForm::NOT_SHOW_ADD_BUTTON, ExtActiveForm::USE_AJAX_AUTOCOMPLETE, 'company');
        echo $form->showMultipleForm('parentID', $model, ExtActiveForm::SHOW_ADD_BUTTON, ExtActiveForm::USE_AJAX_AUTOCOMPLETE, 'Category');
    ?>

    <?= $form->field($model, 'postcode') ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ExtActiveForm::end(); ?>
    <?php //yii\widgets\Pjax::end(); ?>

