<?php

namespace app\models;

use Yii;
use yii\mongodb\ActiveRecord;

/**
 * This is the model class for collection "Users".
 *
 * @property \MongoId|string $_id
 * @property mixed $name
 * @property mixed $login
 * @property mixed $password
 * @property mixed $role
 */
class Users extends \yii\mongodb\ActiveRecord
{
    const ROLE_ROOT   = 'root';
    const ROLE_ADMIN  = 'admin';
    const ROLE_MODER  = 'moderator';
    const ROLE_USER   = 'user';
    const ROLE_BANNED = 'banned';
    
    
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['YP', 'Users'];
    }

    /**
     * @inheritdoc
     */
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string', 'max'=>150],
            ['login', 'string', 'max'=>50],
            ['password', 'string', 'max'=>50],
            ['role', 'string', 'max'=>9],
            [['name', 'login', 'password', 'role'], 'safe']
        ];
    }
    
    public function beforeSave($insert)
    {
        //var_dump($this->password);
        //var_dump($this);
        $this->password = md5($this->password);
        //var_dump($this->password);
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'name' => 'Имя',
            'login' => 'Логин',
            'password' => 'Пароль',
            'role' => 'Роль',
        ];
    }
}
