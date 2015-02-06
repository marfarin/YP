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

/**
 * Description of ExtActiveForm
 *
 * @author stager3
 */
class ExtActiveForm extends ActiveForm
{
    public function showMultipleForm($nameAttrib, $model)
    {
        $this->getView()->registerJsFile("@web/js/addbutton.js");
        $nameAtr = preg_replace("/[-_]/u", '', $nameAttrib);
        $nameAtr  =  mb_strtolower($nameAtr);
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
        return $result.'<div id="newlyaddedfields_'.$nameAttrib.'"></div>';
    }
}
