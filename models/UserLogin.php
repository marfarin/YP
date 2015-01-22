<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use Yii;
use yii\mongodb\ActiveRecord;
use app\models\Users;
use yii\base\NotSupportedException;
/**
 * Description of UserLogin
 *
 * @author stager3
 */



class UserLogin extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $id;
    public $login;
    public $password;
    public $role;
    public $authKey;
    public $rememberMe = true;
    
    public function attributes()
    {
        return [
            '_id',
            'name',
            'login',
            'password',
            'role',
        ];
    }
    
    public static function findIdentity($id)
    {
        return new static(Users::findOne(['_id' => $id]));
    }
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    public static function findByUsername($username)
    {
        return new static(Users::findOne(['login' => $username]));
    }
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    public function getAuthKey()
    {
        return $this->authKey;
    }    
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    public function validatingPassword($password)
    {
        //var_dump($password);
        return $this->password === md5($password);
        
    }
}
