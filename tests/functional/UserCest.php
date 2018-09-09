<?php

use app\models\Image;
use yii\web\UploadedFile;

class UserCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage('/');
    }

    public function updateUserDetails(\FunctionalTester $I)
    {
        $I->click('Login');

        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'test_user0',
            'LoginForm[password]' => 'password123'
        ]);

        $I->click('Profile');
        $I->see('Update');
        $I->click('Update');

        $I->submitForm('#user-update', [
            'User[mobile_number]' => '01611234567',
            'User[postcode]' => 'm27 8up'
        ]);

    }

    public function postEmptyItem(\FunctionalTester $I)
    {
        $I->amLoggedInAs('1');
        $I->amOnRoute('/item/create');
        $I->see('Create Item');
        $I->submitForm('#create-form', [
            'Item[category_id]' => '',
            'Item[title]' => '',
            'Item[description]' => '',
            'Item[condition]' => '',
            'Item[location]' => '',
            'Item[price]' => '',
        ]);
        $I->expectTo('see validation errors');
        $I->see('Category cannot be blank.');
        $I->see('Title cannot be blank.');
        $I->see('Description cannot be blank.');
        $I->see('Condition cannot be blank.');
        $I->see('Location cannot be blank.');
        $I->see('Price cannot be blank.');
    }

    public function postItemWithNoImage(\FunctionalTester $I)
    {
        $I->amLoggedInAs('1');
        $I->amOnRoute('/item/create');
        $I->see('Create Item');
        $I->submitForm('#create-form', [
            'Item[category_id]' => '1',
            'Item[title]' => 'Test Item',
            'Item[description]' => 'New',
            'Item[condition]' => '0',
            'Item[location_id]' => '5',
            'Item[price]' => '50',
        ]);
        $I->expectTo('see item created');
        $I->see('Test Item');
        $I->amOnRoute('view');
    }

    public function postItemWithImage(\FunctionalTester $I)
    {
        $I->amLoggedInAs('1');
        $I->amOnRoute('/item/create');
        $image = new Image();

        $I->see('Create Item');
        $I->submitForm('#create-form', [
            'Item[category_id]' => '1',
            'Item[title]' => 'Test Item',
            'Item[description]' => 'New',
            'Item[condition]' => '0',
            'Item[location_id]' => '5',
            'Item[price]' => '50',
            'Image[imageFiles]' => ['../_data/test.png'],
        ]);
        $I->expectTo('see item created');
        $I->see('Test Item');
        $I->amOnRoute('view');
    }

    public function userCanUpdateItem(\FunctionalTester $I)
    {
        $I->amLoggedInAs('1');
        $I->amOnRoute('/item/create');

        $I->see('Create Item');
        $I->submitForm('#create-form', [
            'Item[category_id]' => '1',
            'Item[title]' => 'Test Item',
            'Item[description]' => 'New',
            'Item[condition]' => '0',
            'Item[location_id]' => '5',
            'Item[price]' => '50',
        ]);
        $I->expectTo('see item created');
        $I->see('Test Item');
        $I->click('Update');

        $I->submitForm('#create-form', [
            'Item[title]' => 'New Item',
            'Item[price]' => '100',
            'Item[description]' => 'New Description',
            'Item[location_id]' => '10',
            'Item[category_id]' => '5',
        ]);

        $I->see('New Item');
        $I->see('£100');
        $I->see('New Description');
    }

    public function userCanDeleteItem(\FunctionalTester $I)
    {
        $I->amLoggedInAs('1');
        $I->amOnRoute('/item/create');

        $I->see('Create Item');
        $I->submitForm('#create-form', [
            'Item[category_id]' => '1',
            'Item[title]' => 'Test Item',
            'Item[description]' => 'New',
            'Item[condition]' => '0',
            'Item[location_id]' => '5',
            'Item[price]' => '50',
        ]);
        $I->expectTo('see item created');
        $I->see('Test Item');
        $I->see('Delete');
    }

    public function userCantEditOtherUsersPost(\FunctionalTester $I)
    {
        $I->amLoggedInAs('1');
        $I->amOnRoute('/item/create');

        // create a new item
        $I->see('Create Item');
        $I->submitForm('#create-form', [
            'Item[category_id]' => '1',
            'Item[title]' => 'Test Item',
            'Item[description]' => 'Old',
            'Item[condition]' => '0',
            'Item[location_id]' => '5',
            'Item[price]' => '50',
            'Image[imageFiles]' => ['../_data/test.png'],
        ]);
        $I->expectTo('see item created');
        $I->see('Test Item');

        $I->see('Update');
        $I->see('Delete');

        $I->click('Logout');

        //switch user check update/delete buttons not visible
        $I->amLoggedInAs('2');
        $I->amOnPage('/item');

        $I->see('Test Item');
        $I->click('Test Item');

        $I->dontSee('Update');
        $I->dontSee('Delete');
    }

}
