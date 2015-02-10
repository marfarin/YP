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
    
    public $fieldClass = 'app\widgetExt\ExtActiveField';
    
    public function showMultipleForm($nameAttrib, $model)
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
        $result =  Html::label($model->attributeLabels()[$nameAttrib]).'  '. $button;
        //var_dump($button);
            
        
              
        if (is_array($model[$nameAttrib])) {
            foreach ($model[$nameAttrib] as $key => $value) {
                $result .= $this->field($model, $nameAttrib . '[' . $key . ']')->textInput()->label(false);
            }
            //$result .= $this->field($model, $nameAttrib . '[' . 100000 . ']')->textInput()->label(false);
        } else {
            $result .= $this->field($model, $nameAttrib)->textInput()->label(false);
        }
        $result .= Html::hiddenInput(
            'counter_' . $nameAttrib,
            count($model[$nameAttrib]),
            ['id'=>'counter_' . $nameAttrib,]
        );
        return Html::tag("div", $result, ['id'=>'div_'.$nameAttrib]);
    }
    
    public function showAdditionModelField($model, $nameAttrib, $showAttribs = array())
    {
        $result =  Html::label($model->attributeLabels()[$nameAttrib]);
        $url = \yii\helpers\Url::to(['list']);
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
        $submodel = $model[$nameAttrib];
        if (is_array($submodel)) {
            foreach ($submodel as $key => $value) {
                foreach ($showAttribs as $keyAttribs => $valAttribs) {
                    $valAttribs['value'] = (string)$value["_id"];
                    //var_dump($valAttribs)
                    $result .= $this->field($value, '[' . $key . ']' . '' . $keyAttribs. '')
                        ->textInput()
                        ->label(false)
                        ->widget(\kartik\select2\Select2::className(), [
                            'options' => ['placeholder' => 'Search for a city ...'],
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
                }
            }
        } else {
            $result .= $this->field($model, $nameAttrib)->textInput()->label(false);
        }
        $result .= Html::hiddenInput(
            'counter_' . $nameAttrib,
            count($model[$nameAttrib]),
            ['id'=>'counter_' . $nameAttrib,]
        );
        return Html::tag("div", $result, ['id'=>'div_'.$nameAttrib]);
    }
}
