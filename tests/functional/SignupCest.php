<?php

use app\models\User;

class SignupCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['/site/signup']);
    }

    public function openSignupPage(\FunctionalTester $I)
    {
        $I->see('Signup', 'h1');

    }

    public function signupWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#form-signup', []);
        $I->expectTo('see validations errors');
        $I->see('Username cannot be blank.');
        $I->see('Email cannot be blank.');
        $I->see('Password cannot be blank.');
        $I->see('Mobile Number cannot be blank.');
    }

    public function signupWithInvalidEmail(\FunctionalTester $I)
    {
        $I->submitForm('#form-signup', [
            'SignupForm[username]' => 'admin',
            'SignupForm[password]' => 'pass123',
            'SignupForm[email]' => 'invalidemail@.',
            'SignupForm[postcode]' => 'm27 9sp',
            'SignupForm[mobile_number]' => '0739834733',
        ]);
        $I->expectTo('see email error');
        $I->see('mail is not a valid email address.');
    }

    public function signupSuccessfully(\FunctionalTester $I)
    {

        $I->submitForm('#form-signup', [
            'SignupForm[username]' => 'admin',
            'SignupForm[password]' => 'pass123',
            'SignupForm[email]' => 'valid@email.co.uk',
            'SignupForm[postcode]' => 'm27 9sp',
            'SignupForm[mobile_number]' => '0739834733',
        ]);
        $I->expectTo('see account created');
        $I->see('Logout (admin)');
    }
}