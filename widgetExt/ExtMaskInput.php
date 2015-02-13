<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\widgetExt;

use Yii;
use yii\widgets\MaskedInput;

/**
 * Description of ExtMaskInput
 *
 * @author stager3
 */
class ExtMaskInput extends MaskedInput
{
    public function getHash()
    {
        return $this->options[];
    }
}
