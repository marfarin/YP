<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


use yii\widgets\ActiveField;

$field = new ActiveField();
$field->textInput()->label(false);
$field->model = $model;
$field->attribute = 'phone_numbers['.$i.']';
