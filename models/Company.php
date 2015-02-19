<?php

namespace app\models;

use Yii;
use app\components\behaviours\DateTimeBehavior;
use yii\mongodb\ActiveRecord;

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
class Company extends ActiveRecord
{
    
    const ADDRESS = 'address';
    
    public function behaviors()
    {
        return [
            [
                'class' => DateTimeBehavior::className(),
            ],
            [
                'class' => \app\components\behaviours\MongoIdBehavior::className(),
            ],
            [
                'class' => \app\components\behaviours\ClearEmptyBehaviour::className(),
            ],
        ];
    }
    
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
            'tradeMarkId',
            'tbl_category.name',
            'tbl_user.name',
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
            'tradeMarkId' => Yii::t('app', 'Branch Parent ID'),
            'tbl_category.name' => Yii::t('app', 'Branch Parent ID'),
            'tbl_user.name' => Yii::t('app', 'Branch Parent ID'),
        ];
    }
    
    public function getCategory()
    {
        return $this->hasMany(Category::className(), ['_id'=>'parentID']);
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['_id'=>'user_id']);
    }
    
    public function getTrademark()
    {
        return $this->hasOne(TradeMark::className(), ['_id'=>'tradeMarkId']);
    }
    
    public function getUserName()
    {
        return $this->user->name;
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sphere', 'address_id', 'working_time', 'parentID'], 'required'],
            ['phone_numbers', 'validateArrayPhone'],
            ['short_phone_numbers', 'validateArrayPhone'],
            ['hr_phone_numbers', 'validateArrayPhone'],
            ['fax_numbers', 'validateArrayPhone'],
            ['email', 'validateEmail'],
            ['url', 'validateUrl'],
            //['name', 'string', 'max'=>9],
            [['name', 'legal_form', 'legal_name', 'sphere', 'company_size', 'address_id', 'address_addition', 'phone_numbers', 'short_phone_numbers', 'hr_phone_numbers', 'fax_numbers', 'email', 'url', 'working_time', 'update_time', 'user_id', 'branch_name', 'description', 'status', 'wants_placement', 'export_to_yandex', 'postcode', 'type', 'parentID', 'tradeMarkId'], 'safe']
        ];
    }
    
    public function validateArrayPhone($attribute, $params)
    {
        //var_dump($attribute);
        $paramsForValidation = Yii::$app->request->post('Company')[$attribute];
        $validator = new \yii\validators\RegularExpressionValidator(['pattern' => '/^(\+7\(\d{3}\)\d{3}-\d{2}-\d{2};?)*$/']);
        if (!empty($paramsForValidation)) {
            foreach ($paramsForValidation as $key => $value) {
                if (!$validator->validate($value, $error)) {
                    $this->addError($attribute.'['.$key.']', $error);
                }
            }
        }
    }
    public function validateEmail($attribute, $params)
    {
        $fieldsForValidation = Yii::$app->request->post('Company')[$attribute];
        $validator = new \yii\validators\EmailValidator(['skipOnEmpty' => true,]);
        $fieldsForValidation = array_diff($fieldsForValidation, array(''));
        if (!empty($fieldsForValidation)) {
            foreach ($fieldsForValidation as $value) {
                if (!$validator->validate($value, $error)) {
                    $this->addError($attribute, $error);
                }
            }
        }
        Yii::$app->request->post('Company')[$attribute] = $fieldsForValidation;
    }
    public function validateUrl($attribute, $params)
    {
        $fieldsForValidation = Yii::$app->request->post('Company')[$attribute];
        $validator = new \yii\validators\UrlValidator(['skipOnEmpty' => true,]);
        $fieldsForValidation = array_diff($fieldsForValidation, array(''));
        if (!empty($fieldsForValidation)) {
            foreach ($fieldsForValidation as $key=>$value) {
                if (!$validator->validate($value, $error)) {
                    $this->addError($attribute.'['.$key.']', $error);
                }
            }
        }
        Yii::$app->request->post('Company')[$attribute] = $fieldsForValidation;
    }
    
    public static function dataAutocompleteList($name, $search = null, $id = null)
    {
        switch ($name) {
            default :
                if (!is_null($search)) {
                    $data = $name::find()->select(['name'])->where(['like', 'name', $search])->asArray()->limit(20)->all();
                }
                if ($id!=null) {
                    $text = $name::find()->asArray()->where(['_id'=>$id])->one()['name'];
                }
                break;
            case self::ADDRESS:
                if (!is_null($search)) {
                    $data = (new Address)->getIdByAddressName($search);
                }
                if ($id!=null) {
                    $text = (new Address)->byAddressIds(array($id));
                }
                break;
        }
        if (!is_null($search)) {
            foreach ($data as $key => $value) {
                $map[$key]['id'] = (string)$value['_id'];
                $map[$key]['text'] = (string)$value['name'];
            }
            $out['results'] = array_values($map);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => $text];
        } else {
            $out['results'] = ['id' => 0, 'text' => 'No matching records found'];
        }
        return \yii\helpers\Json::encode($out);
    }
    
    public function getStatus()
    {
        return [
            ' '=>'Не указано',
            'актуальные'=>'актуальные',
            'закрывшиеся'=>'закрывшиеся',
            'недозвон 3'=>'недозвон 3',
            'некорректная информация'=>'некорректная информация',
            'исчезнувшие'=>'исчезнувшие',
            'дубль'=>'дубль',
            'приостановили деятельность'=>'приостановили деятельность',
            'для МЮ'=>'для МЮ',
            'ненужные'=>'ненужные',
            'непонятные'=>'непонятные',
            'ни с кем не работают'=>'ни с кем не работают',
        ];
    }
    
    public function getCompanySize()
    {
        return [
            ' ' => 'Не указано',
            'малая (<50 чел.)' => 'малая (<50 чел.)',
            'средняя (от 50 чел. до 150 чел.)' => 'средняя (от 50 чел. до 150 чел.)',
            'крупная (>150 чел.)' => 'крупная (>150 чел.)',
            
        ];
    }
}
