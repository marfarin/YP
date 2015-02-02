<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\commands;

use Yii;
use yii\console\Controller;


use app\rbac\UserGroupRule;

/**
 * Description of RbacController
 *
 * @author stager3
 */
class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll(); //удаляем старые данные
        //Создадим для примера права для доступа к админке
        $dashboard = $auth->createPermission('dashboard');
        $dashboard->description = 'Админ панель';
        $auth->add($dashboard);
        //Включаем наш обработчик
        $rule = new UserGroupRule();
        $auth->add($rule);
        //Добавляем роли
        $guest = $auth->createRole('guest');
        $guest->description = 'Гость';
        $guest->ruleName = $rule->name;
        $auth->add($guest);
        $root = $auth->createRole('root');
        $root->description = 'Суперпользователь';
        $root->ruleName = $rule->name;
        $auth->add($root);
        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $user->ruleName = $rule->name;
        $auth->add($user);
        $moder = $auth->createRole('moderator');
        $moder->description = 'Модератор';
        $moder->ruleName = $rule->name;
        $auth->add($moder);
        //Добавляем потомков
        $auth->addChild($user, $guest);
        $auth->addChild($moder, $user);
        $auth->addChild($moder, $dashboard);
        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $admin->ruleName = $rule->name;
        $auth->add($admin);
        $auth->addChild($admin, $moder);
        $auth->addChild($root, $admin);
    }
}
