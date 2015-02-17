<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components\behaviours;

use Yii;
use yii\base\Behavior;
use yii\mongodb\ActiveRecord;

/**
 * Description of MongoIdBehavior
 *
 * @author stager3
 */
class MongoIdBehavior extends Behavior
{
    public $mongoIdField  = ['parentID', 'tradeMarkId'];
    
    public function events()
    {
        //var_dump("jghghgjhghghghg");
        return [
            ActiveRecord::EVENT_BEFORE_UPDATE => 'setMongoID',
            ActiveRecord::EVENT_BEFORE_INSERT => 'setMongoID',
        ];
    }
    
    public function setMongoID($event)
    {
        if (empty($this->mongoIdField)) {
            throw new \yii\base\Exception();
        } else {
            foreach ($this->mongoIdField as $value) {
                $arr = $this->owner->{$value};
                if (is_array($arr)) {
                    foreach ($arr as $key => $value2) {
                        var_dump($arr);
                        $arr[$key] = new \MongoId($value2);
                    }
                } else {
                    $arr = new \MongoId($arr);
                }
                $this->owner->{$value} = $arr;
            }
        }
    }
}
