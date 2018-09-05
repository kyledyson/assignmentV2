<?php

class LoginFormCest
{
    public function _before(\FunctionalTester $I)
    {
        Yii::$app->user->logout();
        $I->amOnPage(['/site/login']);
    }

    public function openLoginPage(\FunctionalTester $I)
    {
        $I->see('Login', 'h1');

    }

    public function loginWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', []);
        $I->expectTo('see validations errors');
        $I->see('Username cannot be blank.');
        $I->see('Password cannot be blank.');
    }

    public function loginWithWrongCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'wrong',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Incorrect username or password.');
    }

    public function loginSuccessfully(\FunctionalTester $I)
    {

        $I->see('Login');
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'test_user',
            'LoginForm[password]' => 'password123',
        ]);
        $I->see('Logout (test_user)');
    }
}