<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "Categories".
 *
 * @property \MongoId|string $_id
 * @property mixed $name
 * @property mixed $type
 * @property mixed $parentID
 */
class Category extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['YP', 'Categories'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'name',
            'type',
            'parentID',
            'tbl_category.name',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'parentID'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'name' => 'Название',
            'type' => 'Тип',
            'parentID' => 'ID предка',
            'tbl_category.name' => 'ИМЯ ПРЕДКА',
        ];
    }
    
    private function findChildren($parentId, $page = 1, $pageSize = 100)
    {   
        //var_dump($parentId);
        
        //var_dump(parent::find()->where(['parentID' => $parentId])->limit($pageSize)->all());
        return parent::find()
            ->where(['parentID' => $parentId])
            ->limit($pageSize)
            ->offset($pageSize*($page-1))
            
            ->all();
    }
    
    public static function initJsonTree($parentId, $page = 1, $pageSize = 100)
    {   
        //var_dump($parentId);
        if ($parentId=='') {
            $parentId = null;
        } else {
            $parentId = new \MongoId($parentId);
        }
        //var_dump($parentId);
        $children = array();
        //var_dump(self::findChildren($parentId, $page, $pageSize));
        foreach (self::findChildren($parentId, $page, $pageSize) as $k => $object) {
            //var_dump($object);
            $title = mb_strlen($object->name) > 70 ? mb_substr($object->name,0,70, 'UTF-8').'...' : $object->name;
            $children[$k]["data"]["title"] = $title;
            $children[$k]["attr"]["id"] = (string)$object->_id;
                
            if ($count = self::find()->where(['parentID' => $object->_id])->count()) {//$object->count('parentId = :parentId', array('parentId'=>$object->_id))) {
                $children[$k]["state"] = "closed";
                $children[$k]["attr"]["count"] = $count;
                if ($count > $pageSize) {
                    $children[$k]["attr"]["page"] = $count;
                    $children[$k]["attr"]["pageCount"] = ceil($count/$pageSize);
                }
            }
        }
        return json_encode($children);
    }
    
    public function getCategory()
    {
        return $this->hasOne(self::className(), ['_id' => 'parentID']);
    }
    
    public function getCompany()
    {
        return $this->hasMany(Company::className(), ['parentID'=>'_id']);
    }
    
    public static function findCategoryByName($name)
    {
        if ($name == null) {
            return null;
        }
        $result = self::find()
            ->select(['_id'])
            ->andFilterWhere(['like', 'name', $name])
            ->asArray()
            ->all();
        if (empty($result)) {
            return $name;
        } else {
            return $result[0];
        }
    }
}
