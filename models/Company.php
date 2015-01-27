<?php

namespace app\models;

use Yii;

/**
 * This is the model class for collection "Company".
 *
 * @property \MongoId|string $_id
 * @property mixed $name
 * @property mixed $legal_form
 * @property mixed $legal_name
 * @property mixed $sphere
 * @property mixed $company_size
 * @property mixed $address_id
 * @property mixed $address_addition
 * @property mixed $phone_numbers
 * @property mixed $short_phone_numbers
 * @property mixed $hr_phone_numbers
 * @property mixed $fax_numbers
 * @property mixed $email
 * @property mixed $url
 * @property mixed $working_time
 * @property mixed $update_time
 * @property mixed $user_id
 * @property mixed $branch_name
 * @property mixed $description
 * @property mixed $status
 * @property mixed $wants_placement
 * @property mixed $export_to_yandex
 * @property mixed $postcode
 * @property mixed $type
 * @property mixed $parentID
 * @property mixed $branchParentID
 */
class Company extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['YP', 'Company'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'name',
            'legal_form',
            'legal_name',
            'sphere',
            'company_size',
            'address_id',
            'address_addition',
            'phone_numbers',
            'short_phone_numbers',
            'hr_phone_numbers',
            'fax_numbers',
            'email',
            'url',
            'working_time',
            'update_time',
            'user_id',
            'branch_name',
            'description',
            'status',
            'wants_placement',
            'export_to_yandex',
            'postcode',
            'type',
            'parentID',
            'branchParentID',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'legal_form', 'legal_name', 'sphere', 'company_size', 'address_id', 'address_addition', 'phone_numbers', 'short_phone_numbers', 'hr_phone_numbers', 'fax_numbers', 'email', 'url', 'working_time', 'update_time', 'user_id', 'branch_name', 'description', 'status', 'wants_placement', 'export_to_yandex', 'postcode', 'type', 'parentID', 'branchParentID'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'legal_form' => Yii::t('app', 'Legal Form'),
            'legal_name' => Yii::t('app', 'Legal Name'),
            'sphere' => Yii::t('app', 'Sphere'),
            'company_size' => Yii::t('app', 'Company Size'),
            'address_id' => Yii::t('app', 'Address ID'),
            'address_addition' => Yii::t('app', 'Address Addition'),
            'phone_numbers' => Yii::t('app', 'Phone Numbers'),
            'short_phone_numbers' => Yii::t('app', 'Short Phone Numbers'),
            'hr_phone_numbers' => Yii::t('app', 'Hr Phone Numbers'),
            'fax_numbers' => Yii::t('app', 'Fax Numbers'),
            'email' => Yii::t('app', 'Email'),
            'url' => Yii::t('app', 'Url'),
            'working_time' => Yii::t('app', 'Working Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'user_id' => Yii::t('app', 'User ID'),
            'branch_name' => Yii::t('app', 'Branch Name'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'wants_placement' => Yii::t('app', 'Wants Placement'),
            'export_to_yandex' => Yii::t('app', 'Export To Yandex'),
            'postcode' => Yii::t('app', 'Postcode'),
            'type' => Yii::t('app', 'Type'),
            'parentID' => Yii::t('app', 'Parent ID'),
            'branchParentID' => Yii::t('app', 'Branch Parent ID'),
        ];
    }
}
