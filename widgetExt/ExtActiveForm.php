<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\widgetExt;

use Yii;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\JsExpression;

/**
 * Description of ExtActiveForm
 *
 * @author stager3
 */
class ExtActiveForm extends ActiveForm
{
    const SHOW_ADD_BUTTON = true;
    const NOT_SHOW_ADD_BUTTON = false;
    const DONT_USE_WIDGET = 0;
    const USE_AJAX_AUTOCOMPLETE = 1;
    const USE_MASKED_INPUT_WIDGET_PHONE = 2;
    const USE_MASKED_INPUT_WIDGET_URL = 3;
    const USE_MASKED_INPUT_WIDGET_MAIL = 4;
    


    public $fieldClass = 'app\widgetExt\ExtActiveField';
    
    public function showMultipleForm($nameAttrib, $model, $showAddButton = self::SHOW_ADD_BUTTON, $widget = self::DONT_USE_WIDGET, $whatShow = null)
    {
        $this->getView()->registerJsFile("@web/js/addbutton.js");
        $nameAtr = preg_replace("/[-_]/u", '', $nameAttrib);
        $nameAtr  =  mb_strtolower($nameAtr);
        //$div = Html::tag("div".$nameAttrib, $content);
        $button = Html::button(
            'Add more '.$model->attributeLabels()[$nameAttrib],
            [
                'class' => $model->isNewRecord ? 'btn btn-primarybtn btn-success '.$nameAttrib.'' : 'btn btn-success '.$nameAttrib.'',
                'id' => 'more_'.$nameAttrib.'',
                'onclick'=>'return addButton(this);',
                'systemid' => $nameAttrib,
            ]
        );
        $hiddenCounterField = Html::hiddenInput(
            'counter_' . $nameAttrib,
            count($model[$nameAttrib]),
            ['id'=>'counter_' . $nameAttrib,]
        );
        $result =  Html::label($model->attributeLabels()[$nameAttrib]);
        switch ($showAddButton) {
            case self::SHOW_ADD_BUTTON:
                $result.= '  '.$button.$hiddenCounterField;
                break;
            case self::NOT_SHOW_ADD_BUTTON:
                break;
        }
        
        if (!is_array($model[$nameAttrib])) {
            $widget = self::DONT_USE_WIDGET;
        }
        foreach ($model[$nameAttrib] as $key => $value) {
            $field = $this->field($model, $nameAttrib . '[' . $key . ']')->textInput()->label(false);    
            switch ($widget) {
                case self::DONT_USE_WIDGET:
                    break;
                case self::USE_AJAX_AUTOCOMPLETE:
                    $field = $this->addAjaxWidget($field, $whatShow);
                    break;
                case self::USE_MASKED_INPUT_WIDGET_PHONE:
                    $field->widget(
                        \yii\widgets\MaskedInput::className(),
                        [
                            
                            'mask' => '+7(999)999-99-99',
                            //'options' => ['class'=>'inputPhone',],
                            'name' => 'input37',
                            'options' => [
                                'class' => 'form-control addInput',
                                
                            ]
                        ]
                    );
                    break;
                case self::USE_MASKED_INPUT_WIDGET_URL:
                    $field->widget(
                        \yii\widgets\MaskedInput::className(),
                        [
                            'clientOptions' => [
                                'alias' => 'url',
                            
                            ],
                            //'options' => ['class'=>'inputPhone',],
                            'name' => 'input37',
                            'options' => [
                                'class' => 'form-control addInput',
                            ]
                        ]
                    );
                    break;
                case self::USE_MASKED_INPUT_WIDGET_MAIL:
                    $field->widget(
                        \yii\widgets\MaskedInput::className(),
                        [
                            'clientOptions' => [
                                'alias' => 'email',
                            ],
                            //'options' => ['class'=>'inputPhone',],
                            'name' => 'input37',
                            'options' => [
                                'class' => 'form-control addInput',
                                'id'=>'123'
                            ]
                        ]
                    );
                    break;
            }
            $result .= $field;
        }
        return Html::tag("div", $result, ['id'=>'div_'.$nameAttrib]);
    }
    
    public function addAjaxWidget($field, $whatShow = 'company')
    {
        $url = \yii\helpers\Url::to(['list-'.$whatShow]);
        $initScript = <<< SCRIPT
            function (element, callback) {
                var id=\$(element).val();
                if (id !== "") {
                    \$.ajax("{$url}?id=" + id, {
                        dataType: "json"
                    }).done(function(data) { callback(data.results);});
                }
            }
SCRIPT;
        $field->widget(\kartik\select2\Select2::className(), [
            'options' => ['placeholder' => 'Поиск родительских компаний'],
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 3,
                'ajax' => [
                    'url' => $url,
                    'dataType' => 'json',
                    'data' => new JsExpression('function(term,page) { return {search:term}; }'),
                    'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                ],
                'initSelection' => new JsExpression($initScript)
            ],
        ]);
        return $field;
    }
}
