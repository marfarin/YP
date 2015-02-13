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
use yii\helpers\Json;

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
        $configButton = [
                'class' => $model->isNewRecord ? 'btn btn-primarybtn btn-success '.$nameAttrib.'' : 'btn btn-success '.$nameAttrib.'',
                'id' => 'more_'.$nameAttrib.'',
                'onclick'=>'return addButton(this);',
                'systemid' => $nameAttrib,
            ];
        if ($widget === self::USE_AJAX_AUTOCOMPLETE) {
            $configButton['onclick'] = 'return addMultipleButton(this);';
            
        }
        $button = Html::button(
            'Add more '.$model->attributeLabels()[$nameAttrib],
            $configButton
            
        );
        $hiddenCounterField = Html::hiddenInput(
            'counter_' . $nameAttrib,
            count($model[$nameAttrib]),
            ['id'=>'counter_' . mb_strtolower($nameAttrib),]
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
            $config = array();
            switch ($widget) {
                case self::DONT_USE_WIDGET:
                    break;
                case self::USE_AJAX_AUTOCOMPLETE:
                    $field = $this->addAjaxWidget($field, $whatShow);
                    break;
                case self::USE_MASKED_INPUT_WIDGET_PHONE:
                    $config = [
                            
                            'mask' => '+7(999)999-99-99',
                            //'options' => ['class'=>'inputPhone',],
                            'name' => 'input37',
                            'options' => [
                                'class' => 'form-control addInput',
                                
                            ]
                        ];
                    //$field->inputOptions = ['crc32'=>$this->initClientOptions($config)];
                    $config['options']['crc32'] = $this->initClientOptions($config);
                    //var_dump($this->initClientOptions($config));
                    $field->widget(\yii\widgets\MaskedInput::className(), $config);
                    
                    break;
                case self::USE_MASKED_INPUT_WIDGET_URL:
                    $config = [
                            'clientOptions' => [
                                'alias' => 'url',
                            
                            ],
                            //'options' => ['class'=>'inputPhone',],
                            'name' => 'input37',
                            'options' => [
                                'class' => 'form-control addInput',
                            ]
                        ];
                    $config['options']['crc32'] = $this->initClientOptions($config);
                    $field->widget(\yii\widgets\MaskedInput::className(), $config);
                    
                    break;
                case self::USE_MASKED_INPUT_WIDGET_MAIL:
                    $config = [
                            'clientOptions' => [
                                'alias' => 'email',
                            
                            ],
                            //'options' => ['class'=>'inputPhone',],
                            'name' => 'input37',
                            'options' => [
                                'class' => 'form-control addInput',
                            ]
                        ];
                    $config['options']['crc32'] = $this->initClientOptions($config);
                    $field->widget(\yii\widgets\MaskedInput::className(), $config);
                    
                    break;
            }
            $result .= $field;
        }
        return Html::tag("div", $result, ['id'=>'div_'.mb_strtolower($nameAttrib)]);
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

    /**
     * Initializes client options
     */
    protected function initClientOptions($options)
    {
        //$options = $this->clientOptions;
        if (!empty($options['mask'])) {
            $options['clientOptions']['mask'] = $options['mask'];
        }
        foreach ($options['clientOptions'] as $key => $value) {
            if (!$value instanceof JsExpression && in_array($key, ['oncomplete', 'onincomplete', 'oncleared', 'onKeyUp',
                    'onKeyDown', 'onBeforeMask', 'onBeforePaste', 'onUnMask', 'isComplete', 'determineActiveMasksetIndex'])
            ) {
                $options['clientOptions'][$key] = new JsExpression($value);
            }
        }
        $encOptions = empty($options['clientOptions']) ? '{}' : Json::encode($options['clientOptions']);
        return hash('crc32', $encOptions);
    }
}
