<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\commands;

use Yii;
use yii\console\Controller;

/**
 * Description of RbacController
 *
 * @author stager3
 */
class RbacController extends Controller
{
    public function actionInit()
    {
        $authManager = Yii::$app->authManager;

        $guest  = $authManager->createRole('guest');
        $user  = $authManager->createRole('user');
        $moderator = $authManager->createRole('moderator');
        $admin  = $authManager->createRole('admin');
        $root = $authManager->createRole('root');
        $banned = $authManager->createRole('banned');
        
        $login  = $authManager->createPermission('login');
        $logout = $authManager->createPermission('logout');
        $error  = $authManager->createPermission('error');
        $signUp = $authManager->createPermission('sign-up');
        $index  = $authManager->createPermission('index');
        $view   = $authManager->createPermission('view');
        $update = $authManager->createPermission('update');
        $delete = $authManager->createPermission('delete');
        
        $authManager->add($login);
        $authManager->add($logout);
        $authManager->add($error);
        $authManager->add($signUp);
        $authManager->add($index);
        $authManager->add($view);
        $authManager->add($update);
        $authManager->add($delete);
        
        $userGroupRule = new UserGroupRule();
        $authManager->add($userGroupRule);
        
        $guest->ruleName  = $userGroupRule->name;
        $user->ruleName  = $userGroupRule->name;
        $moderator->ruleName = $userGroupRule->name;
        $root->ruleName  = $userGroupRule->name;
        $banned->ruleName  = $userGroupRule->name;
        $admin->ruleName  = $userGroupRule->name;
        
        $authManager->addChild($guest, $login);
        $authManager->addChild($guest, $logout);
        $authManager->addChild($guest, $error);
        $authManager->addChild($guest, $signUp);
        $authManager->addChild($guest, $index);
        $authManager->addChild($guest, $view);
 
        // BRAND
        $authManager->addChild($brand, $update);
        $authManager->addChild($brand, $guest);
 
        // TALENT
        $authManager->addChild($talent, $update);
        $authManager->addChild($talent, $guest);
 
        // Admin
        $authManager->addChild($admin, $delete);
        $authManager->addChild($admin, $talent);
        $authManager->addChild($admin, $brand);
    }
}
