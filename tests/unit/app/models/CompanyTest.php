<?php

namespace app\models;

use Yii;

class CompanyTest extends \PHPUnit_Framework_TestCase
{
    protected $company;
    
    protected function setUp()
    {
        $this->company = new Company();
        //
        
        \Yii::$app->request->setBodyParams(['Company' => [ 'name' => 'Рус-Дао', 'legal_form' => 'ООО', 'legal_name' => '', 'sphere' => 'Чайный клуб', 'company_size' => ' ', 'address_id' => '8935', 'address_addition' => '', 'phone_numbers' => [ 0 => '+7(831)423-94-54', 1 => '+7(454)548-5_-__', 2 => '+7(454)445-48-44' ], 'short_phone_numbers' => [ 0 => '' ], 'hr_phone_numbers' => [ 0 => '' ], 'fax_numbers' => [ 0 => '' ], 'email' => [ 0 => 'info@rus-dou.ru' ], 'url' => [ 0 => 'http://rus-dao.ru' ], 'working_time' => 'Пн-Вс 10:00-22:00', 'update_time' => '2015-02-19 00:28:22', 'branch_name' => 'Маленький дракон', 'description' => '', 'status' => 'актуальные', 'wants_placement' => '0', 'export_to_yandex' => '0', 'tradeMarkId' => '54e59cbf7ed1d437048b4567', 'parentID' => [ 0 => '54e2145d7ed1d4e3258b48a6', 1 => '' ], 'postcode' => '' ]]);
        //$_POST = ['Company' => "[ 'name' => 'Рус-Дао' 'legal_form' => 'ООО' 'legal_name' => '' 'sphere' => 'Чайный клуб' 'company_size' => ' ' 'address_id' => '8935' 'address_addition' => '' 'phone_numbers' => [ 0 => '+7(831)423-99-40' 1 => '+7(45_)___-__-__' ] 'short_phone_numbers' => [ 0 => '' ] 'hr_phone_numbers' => [ 0 => '' ] 'fax_numbers' => [ 0 => '' ] 'email' => [ 0 => 'info@rus-dou.ru' ] 'url' => [ 0 => 'http://rus-dao.ru' ] 'working_time' => 'Пн-Вс 10:00-22:00' 'update_time' => '2015-02-19 00:28:22' 'branch_name' => 'Маленький дракон' 'description' => '' 'status' => 'актуальные' 'wants_placement' => '0' 'export_to_yandex' => '0' 'tradeMarkId' => '54e59cbf7ed1d437048b4567' 'parentID' => [ 0 => '54e2145d7ed1d4e3258b48a6' ] 'postcode' => '' ]"];
            
        //new \yii\web\Request()
        //
        //$_POST = ['Company' => [ 'name' => 'Рус-Дао', 'legal_form' => 'ООО', 'legal_name' => '', 'sphere' => 'Чайный клуб', 'company_size' => ' ', 'address_id' => '8935', 'address_addition' => '', 'phone_numbers' => [ 0 => '+7(831)423-94-54', 1 => '+7(454)548-5_-__', 2 => '+7(454)445-48-44' ], 'short_phone_numbers' => [ 0 => '' ], 'hr_phone_numbers' => [ 0 => '' ], 'fax_numbers' => [ 0 => '' ], 'email' => [ 0 => 'info@rus-dou.ru' ], 'url' => [ 0 => 'http://rus-dao.ru' ], 'working_time' => 'Пн-Вс 10:00-22:00', 'update_time' => '2015-02-19 00:28:22', 'branch_name' => 'Маленький дракон', 'description' => '', 'status' => 'актуальные', 'wants_placement' => '0', 'export_to_yandex' => '0', 'tradeMarkId' => '54e59cbf7ed1d437048b4567', 'parentID' => [ 0 => '54e2145d7ed1d4e3258b48a6', 1 => '' ], 'postcode' => '' ]];
        //Yii::$app->request->post() = ['Company' => [ 'name' => 'Рус-Дао', 'legal_form' => 'ООО', 'legal_name' => '', 'sphere' => 'Чайный клуб', 'company_size' => ' ', 'address_id' => '8935', 'address_addition' => '', 'phone_numbers' => [ 0 => '+7(831)423-94-54', 1 => '+7(454)548-5_-__', 2 => '+7(454)445-48-44' ], 'short_phone_numbers' => [ 0 => '' ], 'hr_phone_numbers' => [ 0 => '' ], 'fax_numbers' => [ 0 => '' ], 'email' => [ 0 => 'info@rus-dou.ru' ], 'url' => [ 0 => 'http://rus-dao.ru' ], 'working_time' => 'Пн-Вс 10:00-22:00', 'update_time' => '2015-02-19 00:28:22', 'branch_name' => 'Маленький дракон', 'description' => '', 'status' => 'актуальные', 'wants_placement' => '0', 'export_to_yandex' => '0', 'tradeMarkId' => '54e59cbf7ed1d437048b4567', 'parentID' => [ 0 => '54e2145d7ed1d4e3258b48a6', 1 => '' ], 'postcode' => '' ]];
        //Yii::$app->request->setParams(['Company' => [ 'name' => 'Рус-Дао', 'legal_form' => 'ООО', 'legal_name' => '', 'sphere' => 'Чайный клуб', 'company_size' => ' ', 'address_id' => '8935', 'address_addition' => '', 'phone_numbers' => [ 0 => '+7(831)423-94-54', 1 => '+7(454)548-5_-__', 2 => '+7(454)445-48-44' ], 'short_phone_numbers' => [ 0 => '' ], 'hr_phone_numbers' => [ 0 => '' ], 'fax_numbers' => [ 0 => '' ], 'email' => [ 0 => 'info@rus-dou.ru' ], 'url' => [ 0 => 'http://rus-dao.ru' ], 'working_time' => 'Пн-Вс 10:00-22:00', 'update_time' => '2015-02-19 00:28:22', 'branch_name' => 'Маленький дракон', 'description' => '', 'status' => 'актуальные', 'wants_placement' => '0', 'export_to_yandex' => '0', 'tradeMarkId' => '54e59cbf7ed1d437048b4567', 'parentID' => [ 0 => '54e2145d7ed1d4e3258b48a6', 1 => '' ], 'postcode' => '' ]]);
    }   

    protected function tearDown()
    {
        
    }

    // tests
    public function testCollectionName()
    {
        $abs = $this->company;
        $this->assertEquals(['YP', 'Company'], $abs::collectionName());
    }
    public function testGetStatus()
    {
        $abs = $this->company;
        $abs->validate();
        $this->assertNotEmpty($abs->getErrors());
        $this->assertEquals(0, $abs->validateArrayPhone('phone_numbers', null));
    }
    public function testGetCompanySize()
    {
        $abs = $this->company;
        $this->assertEquals(['YP', 'Company'], $abs::collectionName());
    }
    public function testAttributes()
    {
        $abs = $this->company;
        $this->assertEquals(['YP', 'Company'], $abs::collectionName());
    }
    
    public function testValidateArrayPhone()
    {
        $abs = $this->company;
        $this->assertEquals(['YP', 'Company'], $abs::collectionName());
    }
    public function testValidateEmail()
    {
        $abs = $this->company;
        $this->assertEquals(['YP', 'Company'], $abs::collectionName());
    }
    public function testValidateUrl()
    {
        $abs = $this->company;
        $this->assertEquals(['YP', 'Company'], $abs::collectionName());
    }
    
    public function testDataAutocompleteList()
    {
        $abs = $this->company;
        $this->assertEquals(['YP', 'Company'], $abs::collectionName());
    }
    
    protected function dataProvider()
    {
        
    }
}