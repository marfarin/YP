<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClearEmptyBehaviour
 *
 * @author stager3
 */

namespace app\components\behaviours;

use Yii;
use yii\base\Behavior;
use yii\mongodb\ActiveRecord;


class ClearEmptyBehaviour extends Behavior
{
    
    public $clearVariable = [
        'phone_numbers',
        'short_phone_numbers',
        'hr_phone_numbers',
        'fax_numbers',
        'email',
        'url',
        'parentID',
    ];
    
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_UPDATE => 'clearEmpty',
            ActiveRecord::EVENT_BEFORE_INSERT => 'clearEmpty',
        ];
    }
    
    public function clearEmpty($event)
    {
        foreach ($this->clearVariable as $value) {
            if (empty($this->owner->{$value})) {
                $this->owner->{$value} = [null];
            } else {
                $array = $this->owner->{$value};
                foreach ($array as $key => $value2) {
                    if (empty($value2)) {
                        unset($array[$key]);
                        sort($array);
                    }
                }
                $this->owner->{$value} = $array;
                if (count($this->owner->{$value}) == 0) {
                    $this->owner->{$value} = [null];
                }
            }
        }
    }
}
