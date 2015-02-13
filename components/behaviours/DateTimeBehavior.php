<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\behaviours;

use Yii;
use yii\base\Behavior;
use yii\mongodb\ActiveRecord;

/**
 * Description of DateTimeBehaviuor
 *
 * @author stager3
 */
class DateTimeBehavior extends Behavior
{
    /**
     * Имя поля, хранящее время обновления объекта
     */
    public $updated = 'update_time';
    
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'setUpdateTime',
        ];
    }
    
    public function setUpdateTime($event)
    {
        if (empty($this->updated)) {
            throw new \yii\base\Exception();
        } else {
            $this->owner->{$this->updated} = date("Y-m-d H:i:s");
        }
    }
}
