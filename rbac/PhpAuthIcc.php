<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\rbac;

use Yii;
use yii\rbac\PhpManager;
use app\models\Users;
use yii\base\InvalidParamException;
use yii\rbac\Assignment;

/**
 * Description of PhpAuthIcc
 *
 * @author stager3
 */
class PhpAuthIcc extends PhpManager
{
    public function getAssignments($userId)
    {
        //$userId = (string)$userId;
        try {
            return isset($this->assignments[$userId]) ? $this->assignments[$userId] : [];
        } catch (\yii\base\ErrorException $e) {
            $userBaseRole = Users::findIdentity($userId)['role'];
            if ($userBaseRole == false) {
                throw new InvalidParamException("Unknown user ID '{$userId}'.");
            } else {
                $userId = (string)$userId;
                //$result = [];
                //$this->getChildrenRecursive($userBaseRole, $result);
                $perm = $this->getPermission($userBaseRole);
                $this->arrayAssign($perm, $userId);
                //var_dump("ХУЙ");  
                return isset($this->assignments[$userId]) ? $this->assignments[$userId] : [];
            }
        }
    }
    
    public function arrayAssign($role, $userId)
    {
        if (!isset($this->items[$role->name])) {
            throw new InvalidParamException("Unknown role '{$role->name}'.");
        } elseif (isset($this->assignments[$userId][$role->name])) {
            throw new InvalidParamException("Authorization item '{$role->name}' has already been assigned to user '$userId'.");
        } else {
            $this->assignments[$userId][$role->name] = new Assignment([
                'userId' => $userId,
                'roleName' => $role->name,
                'createdAt' => time(),
            ]);
            //$this->saveAssignments();
            return $this->assignments[$userId][$role->name];
        }
    }
}
