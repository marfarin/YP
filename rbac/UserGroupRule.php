<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\rbac;

use Yii;
use yii\rbac\Rule;
use yii\helpers\ArrayHelper;

/**
 * Description of UserGroupRule
 *
 * @author stager3
 */
class UserGroupRule extends Rule
{
    /*public $name = 'userGroup';
    
    public function execute($user, $item, $params)
    {
        //var_dump(Yii::$app->user->identity);
        if (!\Yii::$app->user->isGuest && Yii::$app->user->identity->login == $user) {
            $group = \Yii::$app->user->identity->role;
            if ($item->name === 'root') {
                return $group == 'root';
            } elseif ($item->name === 'admin') {
                return $group == 'admin' || $group == 'root';
            } elseif ($item->name === 'moderator') {
                return $group == 'moderator' || $group == 'admin' ||
                    $group == 'root';
            } elseif ($item->name === 'user') {
                return $group == 'admin' || $group == 'moderator'
                    || $group == 'user' || $group == 'root';
            } elseif ($item->name === 'guest') {
                return $group == 'admin' || $group == 'moderator'
                    || $group == 'user' || $group == 'root'
                    || $group == 'guest';
            }
            return true;
        }
    }*/
    
    public $name = 'userRole';
    public function execute($user, $item, $params)
    {
        //Получаем массив пользователя из базы
        $user = ArrayHelper::getValue($params, 'user', \app\models\User::findOne($user));
        if ($user) {
            $role = $user->role; //Значение из поля role базы данных
            if($item->name === 'root') {
                return $role == 'root';
            } elseif ($item->name === 'admin') {
                return $role == 'admin' || $role == 'root';
            } elseif ($item->name === 'moderator') {
                    //moder является потомком admin, который получает его права
                return $role == 'admin' || $role == 'moderator' || $role == 'root';
            } elseif ($item->name === 'user') {
                return $role == 'admin' || $role == 'moderator'
                || $role == 'user' || $role == 'root';
            } elseif ($item->name === 'guest') {
                return $role == 'admin' || $role == 'moderator'
                || $role == 'user' || $role == 'root' || $item->name === 'guest';
            }
        }
        return false;
    }
}
