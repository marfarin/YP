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
class Categories extends \yii\mongodb\ActiveRecord
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
            'name' => 'Name',
            'type' => 'Type',
            'parentID' => 'Parent ID',
        ];
    }
}
