<?php

use app\models\Image;
use yii\web\UploadedFile;

class ItemCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage('/');
    }

    public function openCreatePageAsGuest(\FunctionalTester $I)
    {

        $I->amOnRoute('/item/create');
        $I->see('Forbidden: Please login or create an account to access this page');
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
}
