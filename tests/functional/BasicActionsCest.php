<?php
class BasicActionsCest{
    public function indexSiteTest(\FunctionalTester $I)
    {
        $I->amOnPage(['/']);
        $I->see('Congratulations!', 'h1');
    }

    public function openLoginPageTest(\FunctionalTester $I)
    {
        $I->amOnPage(['user/login']);
        $I->see('Login', 'h1');
    }

    // demonstrates `amLoggedInAs` method
    public function internalLoginByIdTest(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage('/');
        $I->see('Logout (Admin)');
    }

    public function loginWithEmptyCredentialsTest(\FunctionalTester $I)
    {
        $I->amOnPage("user/login");
        $I->submitForm('#login-form', []);
        $I->expectTo('see validations errors');
        $I->see('Email / Username cannot be blank.');
        $I->see('Password cannot be blank.');
    }

    public function loginWithWrongCredentialsTest(\FunctionalTester $I)
    {
        $I->amOnPage("user/login");
        $I->submitForm('#login-form', [
            'LoginForm[email]' => 'admin',
            'LoginForm[password]' => 'wrong',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Incorrect password');
    }

    public function loginSuccessfullyTest(\FunctionalTester $I)
    {
        $I->amOnPage("user/login");
        $I->submitForm('#login-form', [
            'LoginForm[email]' => 'admin',
            'LoginForm[password]' => 'admin',
        ]);
        $I->see('Logout (Admin)');
        $I->dontSeeElement('form#login-form');
    }

    public function logoutTest(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage('/');
        $I->see('Logout (Admin)');
        $I->click('Logout (Admin)');
    }
}

